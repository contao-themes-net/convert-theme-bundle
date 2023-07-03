<?php

namespace ContaoThemesNet\ConvertThemeBundle\Module;

use Contao\BackendModule;

class ConvertThemeSetup extends BackendModule
{
    const VERSION = '2.0.0';

    protected $strTemplate = 'be_converttheme_setup';

    /**
     * Generate the module.
     */
    protected function compile(): void
    {
        $this->Template->version = self::VERSION;
    }
}
