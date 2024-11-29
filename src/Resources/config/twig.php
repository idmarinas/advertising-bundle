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

use Idm\Bundle\Advertising\Twig\Extension\AdvertisingGeneric;

return static function (ContainerConfigurator $container)
{
    $container->services()
        ->set(AdvertisingGeneric::class)
        ->args([
            new ReferenceConfigurator('idm_advertising.networks.registry'),
            new ReferenceConfigurator('event_dispatcher'),
        ])
        ->tag('twig.extension')
    ;
};
