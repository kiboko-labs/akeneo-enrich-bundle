<?php
/**
 * Created by PhpStorm.
 * User: mghoubali
 * Date: 03/10/2017
 * Time: 09:45
 */

namespace Kiboko\Bundle\EnrichBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class KibokoEnrichExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('view_elements.yml');
        $loader->load('services.yml');
        //$loader->load('normalizers.yml');
    }
}