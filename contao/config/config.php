<?php

use Contao\ArrayUtil;

// Insert the convert theme category
ArrayUtil::arrayInsert($GLOBALS['TL_CTE'], 1, ['convertTheme' => []]);

/**
 * Available tags for Convert Theme
 */

if (empty($GLOBALS['tl_config']['theme_tags'])) 
{
    $GLOBALS['tl_config']['theme_tags'] = [];
    $GLOBALS['tl_config']['theme_tags'][] = '-';
}

if (!empty($GLOBALS['tl_config']['theme_tags']) && \is_array($GLOBALS['tl_config']['theme_tags'])) 
{
    $GLOBALS['tl_config']['theme_tags'] = array_merge($GLOBALS['tl_config']['theme_tags'], [
        'Convert01/01',
        'Convert01/02',
        'Convert01/03',
        'Convert01/04',
        'Convert01/05',
        'Convert02/01',
        'Convert02/02',
        'Convert02/03',
        'Convert02/04',
        'Convert02/05',
        'Convert03/01',
        'Convert03/02',
        'Convert03/03',
        'Convert03/04',
        'Convert03/05'
    ]);
}

/**
 * Load default styles for every page
 */

if (!isset($GLOBALS['CONVERT_STYLES'])) {
    $GLOBALS['CONVERT_STYLES'] = [];
}

$GLOBALS['CONVERT_STYLES'][] = 'variables';
$GLOBALS['CONVERT_STYLES'][] = 'mixins';
$GLOBALS['CONVERT_STYLES'][] = 'normalize';
$GLOBALS['CONVERT_STYLES'][] = 'base';
$GLOBALS['CONVERT_STYLES'][] = 'layout';
$GLOBALS['CONVERT_STYLES'][] = 'utilities';

/**
 * Backend Modules
 */

ArrayUtil::arrayInsert($GLOBALS['BE_MOD']['contaoThemesNet'], 1, [
    'convertThemeSetup' => [
        'callback'          => 'ContaoThemesNet\\ConvertThemeBundle\\Module\\ConvertThemeSetup',
        'tables'            => [],
        'stylesheet'        => 'bundles/contaothemesnetconverttheme/scss/backend.css'
    ],
]);
