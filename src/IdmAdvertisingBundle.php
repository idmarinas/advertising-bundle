<?php
/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 07/03/2025, 19:06
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    IdmAdvertisingBundle.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Advertising;

use Idm\Bundle\Advertising\Provider\Network\NetworkInterface;
use InvalidArgumentException;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\UX\TwigComponent\TwigComponentBundle;

final class IdmAdvertisingBundle extends AbstractBundle
{
	public function configure (DefinitionConfigurator $definition): void
	{
		$definition->import(dirname(__DIR__) . '/config/definitions.php');
	}

	public function loadExtension (array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		$container->import(dirname(__DIR__) . '/config/services.php');
	}

	public function prependExtension (ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		if ($builder::willBeAvailable('symfony/ux-twig-component', TwigComponentBundle::class, ['symfony/twig-bundle'])) {
			$container->import(dirname(__DIR__) . '/config/twig_component.php');
		}
	}
}
