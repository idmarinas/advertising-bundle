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

namespace Idm\Bundle\Advertising\DependencyInjection\Network;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;

class GenericNetworkConfiguration implements NetworkConfigurationInterface
{
    public function buildConfiguration(NodeBuilder $node)
    {
        $node
            ->scalarNode('service_network')
                ->isRequired()
                ->cannotBeEmpty()
                ->info('Custom service network, ID of service')
            ->end()
            ->arrayNode('banners')
                ->isRequired()
                ->useAttributeAsKey('name')
                    ->arrayPrototype()
                    ->scalarPrototype()->end()
                ->end()
            ->end()
        ;
    }
}
