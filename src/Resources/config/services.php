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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Advertising\Provider\Network\AdsenseNetwork;
use Idm\Bundle\Advertising\Provider\Network\CpmStarNetwork;
use Idm\Bundle\Advertising\Provider\NetworkRegistry;

return static function (ContainerConfigurator $container)
{
    $container->services()
        ->set('idm_advertising.network.adsense', AdsenseNetwork::class)
            ->public()
        ->alias(AdsenseNetwork::class, 'idm_advertising.network.adsense')

        ->set('idm_advertising.network.cpmstar', CpmStarNetwork::class)
            ->public()
        ->alias(CpmStarNetwork::class, 'idm_advertising.network.cpmstar')

        ->set('idm_advertising.networks.registry', NetworkRegistry::class)
            ->public()
            ->args([
                new ReferenceConfigurator('service_container'),
                [],
            ])
        ->alias(NetworkRegistry::class, 'idm_advertising.networks.registry')
    ;
};