<?php

// Insert the zero one theme category
array_insert($GLOBALS['TL_CTE'], 1, ['convertTheme' => []]);

/**
 * Add content elements
 */



/**
 * Available tags for Zero One Theme
 */

array_push($GLOBALS['tl_config']['theme_tags'], '-');
$GLOBALS['tl_config']['theme_tags'][] = 'Convert01/01';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert01/02';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert01/03';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert01/04';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert01/05';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert02/01';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert02/02';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert02/03';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert02/04';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert02/05';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert03/01';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert03/02';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert03/03';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert03/04';
$GLOBALS['tl_config']['theme_tags'][] = 'Convert03/05';

/**
 * Wrapper elements
 */

$GLOBALS['TL_WRAPPERS']['start'][] = 'tabsStartElement';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'tabsStopElement';

/**
 * Load default styles for every page
 */

if($GLOBALS['CONVERT_STYLES'])
    $GLOBALS['CONVERT_STYLES'] = [];

$GLOBALS['CONVERT_STYLES'][] = 'variables';
$GLOBALS['CONVERT_STYLES'][] = 'mixins';
$GLOBALS['CONVERT_STYLES'][] = 'normalize';
$GLOBALS['CONVERT_STYLES'][] = 'base';
$GLOBALS['CONVERT_STYLES'][] = 'layout';
$GLOBALS['CONVERT_STYLES'][] = 'utilities';

/**
 * Backend Modules
 */
array_insert($GLOBALS['BE_MOD']['contaoThemesNet'], 1, array
(
    'convertThemeSetup' => array
    (
        'callback'          => 'ContaoThemesNet\\ConvertThemeBundle\\Module\\ConvertThemeSetup',
        'tables'            => array(),
        'stylesheet'		=> 'bundles/contaothemesnetconverttheme/scss/backend.css'
    ),
));
