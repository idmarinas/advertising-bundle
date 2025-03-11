<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 07/03/2025, 16:48
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    doctrine.php
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
use Symfony\Component\Filesystem\Filesystem;
use function Symfony\Component\String\u;

return static function (ContainerConfigurator $container) {
    $getDatabaseCache = function (): string {
        $dir = dirname(__DIR__, 3) . '/var/cache/database';

        $filesystem = new Filesystem();

        if (!$filesystem->exists($dir)) {
            $filesystem->mkdir($dir);
        }

        return $dir;
    };

    $dbName = (new ReflectionClass(IdmAdvertisingBundle::class))->getShortName();
    $dbName = u($dbName)->snake()->toString();

    $container->extension('doctrine', [
        'dbal' => [
            'driver'         => 'pdo_sqlite',
            'url'            => sprintf('sqlite:///%s/%s_%s.sqlite', $getDatabaseCache(), $dbName, $container->env()),
            'use_savepoints' => true,
        ],
        'orm'  => [
            'enable_lazy_ghost_objects'   => true,
            'auto_generate_proxy_classes' => true,
            'auto_mapping'                => false,
            'controller_resolver'         => [
                'auto_mapping' => false,
            ],
            'mappings'                    => [
                'Tests' => [
                    'is_bundle' => false,
                    'mapping'   => true,
                    'type'      => 'attribute',
                    'dir'       => dirname(__DIR__, 2) . '/src/Entity',
                    'prefix'    => 'App\Entity',
                ],
                //'resolve_target_entities' => [
                //	AbstractUser::class => User::class,
                //],
            ],
        ],
    ]);
};
