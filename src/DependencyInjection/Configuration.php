<?php

/**
 * This file is part of Bundle "IDM Advertising Bundle".
 *
 * @see https://github.com/idmarinas/advertising-bundle
 *
 * @license https://github.com/idmarinas/advertising-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Idm\Bundle\Advertising\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('idm_advertising');
        $rootNode    = $treeBuilder->getRootNode();

        $rootNode
            ->fixXmlConfig('network')
            ->children()
                ->booleanNode('enable')
                ->defaultFalse()
            ->end()
            ->arrayNode('networks')
                ->isRequired()
                ->requiresAtLeastOneElement()
                ->useAttributeAsKey('variable')
                    ->prototype('array')
                        ->useAttributeAsKey('variable')
                        ->prototype('variable')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}