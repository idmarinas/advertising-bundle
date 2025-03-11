<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 10/03/2025, 13:02
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    bundles.php
 * @date    07/03/2025
 * @time    15:31
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

use Idm\Bundle\Advertising\IdmAdvertisingBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MakerBundle\MakerBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\UX\TwigComponent\TwigComponentBundle;

return [
	FrameworkBundle::class      => ['all' => true],
	//	DoctrineBundle::class       => ['all' => true],
	TwigBundle::class           => ['all' => true],
	TwigComponentBundle::class  => ['all' => true],
	IdmAdvertisingBundle::class => ['all' => true],

	// Dev-Test Bundles
	MakerBundle::class          => ['all' => true],
	//	DoctrineFixturesBundle::class => ['all' => true],
	//	DAMADoctrineTestBundle::class => ['all' => true],
	//	ZenstruckFoundryBundle::class => ['all' => true],
];
