<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 16:11
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    idm_advertising_invalid_network.php
 * @date    14/03/2025
 * @time    16:04
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

use App\Provider\Network\InvalidNetwork;
use Symfony\Config\IdmAdvertisingConfig;

return function (IdmAdvertisingConfig $config) {
	// @formatter:off
	$generic = $config->generic()->enabled(true)->serviceNetwork(InvalidNetwork::class);
	$generic
		->banner('main')
			->slot(89745631)
			->attributes([
				'nonce' => '276389r4cd5j51g328g972e35',
			])
	;
};
