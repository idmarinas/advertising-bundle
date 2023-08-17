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

namespace Idm\Bundle\AdvertisingBundle\DependencyInjection\Network;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;

class CpmStarNetworkConfiguration implements NetworkConfigurationInterface
{
    public function buildConfiguration(NodeBuilder $node)
    {
        $node
            ->scalarNode('service_network')
                ->defaultValue('idm_advertising.network.cpmstar')
                ->info('Custom service network, ID of service')
            ->end()
            ->arrayNode('banners')
                ->isRequired()
                ->useAttributeAsKey('name')
                ->arrayPrototype()
                    ->children()
                        ->integerNode('cpmstar_pid')
                            ->min(0)
                            ->isRequired()
                            ->info('Pool ID of Ad block 8XXXXX1')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
