<?php

namespace ContaoThemesNet\ConvertThemeBundle;

use Contao\CoreBundle\Exception\InvalidResourceException;
use Contao\File;
use Contao\StringUtil;
use Contao\System;
use ScssPhp\ScssPhp\Compiler;
use Symfony\Component\Filesystem\Path;

class ThemeUtils
{
    public static string $filesFolder = 'files/convert';
    public static string $themeFolder = 'contaothemesnetconverttheme';
    public static string $scssFolder = 'scss/';

    public static function getRootDir() {
        return System::getContainer()->getParameter('kernel.project_dir');
    }

    public static function getWebDir() {
        return StringUtil::stripRootDir(System::getContainer()->getParameter('contao.web_dir'));
    }

    /**
     * @throws InvalidResourceException
     */
    public static function getCombinedStylesheet(null|bool|string $theme = null): void {
        if (!file_exists(Path::join(self::getRootDir(), self::$filesFolder))) {
            throw new InvalidResourceException('Theme folder does not exists - Please run migrations first!');
        }

        self::$scssFolder = Path::join(self::getWebDir(), 'bundles', self::$themeFolder, self::$scssFolder);

        $scssStr = '';
        $styles = implode(' ,', array_unique($GLOBALS['CONVERT_STYLES']));

        if (isset($GLOBALS['CUSTOM_STYLES'])) {
            $styles .= ','.implode(' ,', array_unique($GLOBALS['CUSTOM_STYLES']));
        }

        $hash = hash('ripemd160', $styles);
        $objFile = new File('var/cache/convert/scss/'.$hash.'.scss');

        if (!$objFile->exists()) {
            // add 0.1 to end of array
            $GLOBALS['CONVERT_STYLES'][] = '_convert';
            $GLOBALS['CONVERT_STYLES'] = array_unique($GLOBALS['CONVERT_STYLES']);

            $scssStr .= "@import \"_custom_variables.scss\";\n";

            foreach ($GLOBALS['CONVERT_STYLES'] as $style) {
                $scssStr .= sprintf(
                    '@import "%s.scss";%s',
                    $style,
                    "\n"
                );
            }

            if (!isset($GLOBALS['CUSTOM_STYLES'])) {
                $GLOBALS['CUSTOM_STYLES'] = [];
            }

            $GLOBALS['CUSTOM_STYLES'] = array_unique($GLOBALS['CUSTOM_STYLES']);

            foreach ($GLOBALS['CUSTOM_STYLES'] as $style) {
                $scssStr .= sprintf(
                    '@import "%s";%s',
                    $style,
                    "\n"
                );
            }

            // add custom
            $scssStr .= "@import \"custom.scss\";\n";

            $objFile->write($scssStr);
            $objFile->close();
        }

        if ($objFile->exists()) {
            $scssStr = $objFile->getContent();
        }

        // for multi domain setup
        if (null !== $theme) {
            self::$scssFolder .= 'files/convert/scss/'.$theme.'/';
        }

        $compiler = new Compiler();
        $compiler->setImportPaths([
            self::getRootDir().'/'.self::$scssFolder,
            self::getRootDir().'/files/convert/scss/',
        ]);

        $objFile = new File('assets/css/convert.'.$hash.'.css');
        $objFile->write($compiler->compileString($scssStr)->getCss());
        $objFile->close();

        $GLOBALS['TL_CSS'][] = $objFile->path.'|static';
    }
}
