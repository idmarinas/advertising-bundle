<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 16:59
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    idm_generic_network.php
 * @date    14/03/2025
 * @time    16:52
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Provider\Network\GenericNetwork;
use Symfony\Config\IdmAdvertisingConfig;

return static function (IdmAdvertisingConfig $config) {
	// @formatter:off
	$generic = $config->generic()
		->enabled(true)
		->serviceNetwork(GenericNetwork::class)
	;

	$generic
		->banner('main')
			->slot(89745631)
			->attributes([
				'nonce' => '276389r4cd5j51g328g972e35',
			])
	;
	// @formatter:on
};
