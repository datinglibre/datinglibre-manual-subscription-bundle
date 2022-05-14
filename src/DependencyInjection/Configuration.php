<?php

namespace DatingLibre\ManualSubscriptionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('dating_libre_manual_subscription');

        $treeBuilder->getRootNode()
            ->children()
            ->booleanNode('signupActive')->end()
            ->end();

        return $treeBuilder;
    }
}
