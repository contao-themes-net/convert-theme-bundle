<?php

namespace ContaoThemesNet\ConvertThemeBundle;

use Contao\System;
use Contao\StringUtil;

class ThemeUtils
{
    public static function getRootDir() {
        return System::getContainer()->getParameter('kernel.project_dir');
    }

    public static function getWebDir() {
        return StringUtil::stripRootDir(System::getContainer()->getParameter('contao.web_dir'));
    }

    public static function getCombinedStylesheet() {
        $scssStr = '';
        $hash = hash('ripemd160', implode(" ,",$GLOBALS['CONVERT_STYLES']));
        $objFile  = new File('var/cache/convert/scss/' . $hash . '.scss');

        if(!$objFile->exists()) {
            // add convert to end of array
            $GLOBALS['CONVERT_STYLES'][] = '_convert';
            $GLOBALS['CONVERT_STYLES'] = array_unique($GLOBALS['CONVERT_STYLES']);

            foreach($GLOBALS['CONVERT_STYLES'] as $style) {
                $scssStr .= sprintf('@import "../../../../%s/bundles/contaothemesnetconverttheme/scss/%s.scss";%s',
                    self::getWebDir(),
                    $style,
                    "\n"
                );

            }
            $objFile->write($scssStr);
            $objFile->close();
        }

        $GLOBALS['TL_CSS'][] = $objFile->path . '|static';
    }
}
