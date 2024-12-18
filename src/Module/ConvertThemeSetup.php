<?php

declare(strict_types=1);

/*
 * CONVERT theme for Contao Open Source CMS
 *
 * Copyright (C) 2024 pdir / digital agentur // pdir GmbH
 *
 * @package    contao-themes-net/convert-theme-bundle
 * @link       https://github.com/contao-themes-net/convert-theme-bundle
 * @license    pdir contao theme licence
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ContaoThemesNet\ConvertThemeBundle\Module;

use Contao\BackendModule;

class ConvertThemeSetup extends BackendModule
{
    public const VERSION = '2.0.4';

    protected $strTemplate = 'be_converttheme_setup';

    /**
     * Generate the module.
     */
    protected function compile(): void
    {
        $this->Template->version = self::VERSION;
    }
}
