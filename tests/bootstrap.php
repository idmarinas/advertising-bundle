<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 20:52
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    bootstrap.php
 * @date    11/03/2025
 * @time    21:39
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

use Symfony\Component\Filesystem\Filesystem;

require dirname(__DIR__) . '/vendor/autoload.php';

$filesystem = new Filesystem();

$cache = dirname(__DIR__) . '/var/cache/test';

if ($filesystem->exists($cache)) {
	$filesystem->remove($cache);
}
