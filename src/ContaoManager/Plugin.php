<?php

namespace ContaoThemesNet\ConvertThemeBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ContaoThemesNet\ConvertThemeBundle\ContaoThemesNetConvertThemeBundle;
use ContaoThemesNet\ThemeComponentsBundle\ThemeComponentsBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoThemesNetConvertThemeBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    ThemeComponentsBundle::class
                ]),
        ];
    }
}
