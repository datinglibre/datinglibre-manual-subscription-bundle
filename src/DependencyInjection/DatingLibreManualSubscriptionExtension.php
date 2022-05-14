<?php

declare(strict_types=1);

namespace DatingLibre\ManualSubscriptionBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class DatingLibreManualSubscriptionExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $configuration = $this->processConfiguration(new Configuration(), $configs);
        $container->setParameter('datinglibre.manual_signup_active', $configuration['signupActive']);

        $loader->load('services.php');
    }
}
