<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/03/2025, 21:40
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

use App\Kernel;
use Symfony\Component\Filesystem\Filesystem;

require dirname(__DIR__) . '/vendor/autoload.php';

$kernel = new Kernel('test', true);
$filesystem = new Filesystem();

if ($filesystem->exists($kernel->getCacheDir())) {
	$filesystem->remove($kernel->getCacheDir());
}

if ($filesystem->exists($kernel->getLogDir())) {
	$filesystem->remove($kernel->getLogDir());
}
