<?php

declare(strict_types=1);

/*
 * CONVERT theme for Contao Open Source CMS
 *
 * Copyright (C) 2026 pdir / digital agentur // pdir GmbH
 *
 * @package    contao-themes-net/convert-theme-bundle
 * @link       https://github.com/contao-themes-net/convert-theme-bundle
 * @license    pdir contao theme licence
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    public static function getRootDir(): string
    {
        return System::getContainer()->getParameter('kernel.project_dir');
    }

    public static function getWebDir(): string
    {
        return StringUtil::stripRootDir(System::getContainer()->getParameter('contao.web_dir'));
    }

    /**
     * @throws InvalidResourceException
     */
    public static function getCombinedStylesheet(null|bool|string $theme = null): void
    {
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

            if (null === $theme) {
                $scssStr .= "@import '_custom_variables.scss';\n";
            }

            if (null !== $theme) {
                $scssStr .= "@import '".$theme."/_custom_variables.scss';\n";
            }

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
            if (null === $theme) {
                $scssStr .= "@import 'custom.scss';\n";
            }

            if (null !== $theme) {
                $scssStr .= "@import '".$theme."/custom.scss';\n";
            }

            $objFile->write($scssStr);
            $objFile->close();
        }

        if ($objFile->exists()) {
            $scssStr = $objFile->getContent();
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
