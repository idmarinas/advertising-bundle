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

class AdsenseNetworkConfiguration implements NetworkConfigurationInterface
{
    public function buildConfiguration(NodeBuilder $node)
    {
        $node
            ->scalarNode('client')
                ->isRequired()
                ->info('Publisher identificator like: ca-pub-XXXXXXX11XXX9')
            ->end()
            ->scalarNode('service_network')
                ->defaultValue('idm_advertising.network.adsense')
                ->info('Custom service network, ID of service')
            ->end()
            ->arrayNode('banners')
                ->isRequired()
                ->useAttributeAsKey('name')
                ->arrayPrototype()
                    ->children()
                        ->booleanNode('in_article')
                            ->info('Mark this ad as in article')
                            ->defaultFalse()
                        ->end()
                        ->scalarNode('style')
                            ->info('Style for block in <ins style="display:inline-block">')
                            ->defaultValue('')
                        ->end()
                        ->integerNode('slot')
                            ->min(0)
                            ->isRequired()
                            ->info('Slot ID of Ad block 8XXXXX1')
                        ->end()
                        ->enumNode('format')
                            ->info('Format of Ad, can be: auto, rectangle, vertical, horizontal')
                            ->values(['auto', 'rectangle', 'vertical', 'horizontal', 'fluid'])
                            ->defaultValue('auto')
                        ->end()
                        ->booleanNode('responsive')
                            ->info('Indicate if Ad is responsive, for mobile')
                            ->defaultTrue()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
