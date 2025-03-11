<?php
/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 19:45
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    twig.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Advertising\Twig\Extension\AdvertisingExtension;
use Idm\Bundle\Advertising\Twig\Runtime\BannerRuntime;
use Idm\Bundle\Advertising\Twig\Runtime\ScriptsRuntime;

return static function (ContainerConfigurator $container) {
	// @formatter:off
	$container
		->services()
			->set('.idm_advertising.twig.extension', AdvertisingExtension::class)
				->tag('twig.extension')

			->set('.idm_advertising.twig.banner_runtime', BannerRuntime::class)
				->arg('$eventDispatcher', service('event_dispatcher'))
				->arg('$providerHub', service('.idm_advertising.provider_hub'))
				->tag('twig.runtime')
				->tag('ux.twig_component.twig_renderer', ['key' => 'idmadvertising:show:banner'])

			->set('.idm_advertising.twig.scripts_runtime', ScriptsRuntime::class)
				->arg('$eventDispatcher', service('event_dispatcher'))
				->arg('$providerHub', service('.idm_advertising.provider_hub'))
				->tag('twig.runtime')
				->tag('ux.twig_component.twig_renderer', ['key' => 'idmadvertising:show:scripts'])

	;
	// @formatter:on
};
