<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 17:01
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    config_generic_network.php
 * @date    14/03/2025
 * @time    16:53
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Provider\Network\GenericNetwork;

return static function (ContainerConfigurator $container) {
	// @formatter:off
	$container
		->services()
			->set(GenericNetwork::class)
				->autowire()
				->autoconfigure()
	;
	$container->import(__DIR__.'/idm_generic_network.php');
	// @formatter:on
};
