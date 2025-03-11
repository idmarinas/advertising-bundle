<?php
/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 21:25
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    services.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Advertising\Provider\Network\AdsenseNetwork;
use Idm\Bundle\Advertising\Provider\Network\CpmStarNetwork;
use Idm\Bundle\Advertising\Provider\ProviderHub;

return function (ContainerConfigurator $container) {
	// @formatter:off
	$container->services()
		->set('.idm_advertising.provider_hub', ProviderHub::class)
				->private()
			->alias(ProviderHub::class, '.idm_advertising.provider_hub')
				->public()

		->set('idm_advertising.network.adsense', AdsenseNetwork::class)
				->private()
				->args([
					'$provider' => service('.idm_advertising.provider_hub'),
					'$denormalizer' => service('serializer'),
					'$eventDispatcher' => service('event_dispatcher'),
				])
			->alias(AdsenseNetwork::class, 'idm_advertising.network.adsense')
				->public()

		->set('idm_advertising.network.cpmstar', CpmStarNetwork::class)
				->private()
				->args([
					'$provider' => service('.idm_advertising.provider_hub'),
					'$denormalizer' => service('serializer'),
					'$eventDispatcher' => service('event_dispatcher'),
				])
			->alias(CpmStarNetwork::class, 'idm_advertising.network.cpmstar')
				->public()
	;
	// @formatter::on
};
