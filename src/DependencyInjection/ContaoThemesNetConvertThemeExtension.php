<?php

namespace ContaoThemesNet\ConvertThemeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class ContaoThemesNetConvertThemeExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $container->loadFromExtension('twig', array(
            'paths' => array(
                '%kernel.project_dir%/vendor/contao-themes-net/convert-theme-bundle/src/Resources/ContaoCoreBundle/views/' => 'ContaoCore',
            ),
        ));
    }
}
