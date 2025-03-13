<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 19:43
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    KernelTestCaseTrait.php
 * @date    13/03/2025
 * @time    19:40
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Tests;

use Symfony\Component\HttpKernel\KernelInterface;

trait KernelTestCaseTrait
{
	protected static function createKernel (array $options = []): KernelInterface
	{
		$kernel = parent::createKernel($options);
		$kernel->handleOptions($options);

		return $kernel;
	}
}
