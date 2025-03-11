<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 07/03/2025, 16:48
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    maker.php
 * @date    07/03/2025
 * @time    15:31
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Advertising\IdmAdvertisingBundle;
use ReflectionClass;

return static function (ContainerConfigurator $container) {
	$container->extension('maker', [
		'root_namespace' => (new ReflectionClass(IdmAdvertisingBundle::class))->getNamespaceName(),
	]);
};
