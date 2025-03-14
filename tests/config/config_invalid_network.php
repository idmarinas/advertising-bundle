<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 16:54
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    config_invalid_network.php
 * @date    07/03/2025
 * @time    15:31
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Provider\Network\InvalidNetwork;

return static function (ContainerConfigurator $container) {
	// @formatter:off
	$container
		->services()
			->set(InvalidNetwork::class)
				->autowire()
				->autoconfigure()
	;
	$container->import(__DIR__.'/idm_invalid_network.php');
	// @formatter:on
};
