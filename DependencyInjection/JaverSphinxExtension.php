<?php

namespace Javer\SphinxBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class JaverSphinxExtension
 *
 * @package Javer\SphinxBundle\DependencyInjection
 */
class JaverSphinxExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('javer_sphinx.host', $config['host']);
        $container->setParameter('javer_sphinx.port', $config['port']);
        $container->setParameter('javer_sphinx.config_path', $config['config_path']);
        $container->setParameter('javer_sphinx.data_dir', $config['data_dir']);
        $container->setParameter('javer_sphinx.searchd_path', $config['searchd_path']);

        $container->setAlias('Javer\SphinxBundle\Sphinx\Manager', new Alias('sphinx'), true);
    }
}
