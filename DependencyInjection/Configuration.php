<?php

namespace Bitheater\RatingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bitheater_rating');

        $drivers = ['orm'];

        $rootNode
            ->children()
                ->scalarNode('driver')
                    ->cannotBeEmpty()
                    ->cannotBeOverwritten()
                    ->isRequired()
                    ->validate()
                        ->ifNotInArray($drivers)
                        ->thenInvalid('Driver %s is not supported. Please choose one of ' . implode(', ', $drivers))
                    ->end()
                ->end()
                ->scalarNode('model_class')
                    ->cannotBeEmpty()
                    ->isRequired()
                ->end()
                ->scalarNode('model_manager_name')
                    ->defaultValue('default')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
