<?php

/**
 * This file is part of Bundle "IDM Advertising Bundle".
 *
 * @see https://github.com/idmarinas/advertising-bundle
 *
 * @license https://github.com/idmarinas/advertising-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Idm\Bundle\AdvertisingBundle\Tests;

use Idm\Bundle\AdvertisingBundle\IdmAdvertisingBundle;
use Idm\Bundle\AdvertisingBundle\Provider\NetworkRegistry;
use Nyholm\BundleTest\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

class BundleInitializationTest extends KernelTestCase
{
    public function testInitBundle(): void
    {
        // Boot the kernel.
        $kernel = self::bootKernel();

        // Get the container
        $container = $kernel->getContainer();

        $this->assertTrue(true);
        // Or for FrameworkBundle@^5.3.6 to access private services without the PublicCompilerPass
        // $container = self::getContainer();

        // Test if your services exists
        $this->assertTrue($container->has('idm_advertising.networks.registry'));
        $service = $container->get('idm_advertising.networks.registry');
        $this->assertInstanceOf(NetworkRegistry::class, $service);
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    protected static function createKernel(array $options = []): KernelInterface
    {
        /**
         * @var TestKernel $kernel
         */
        $kernel = parent::createKernel($options);
        $kernel->addTestBundle(IdmAdvertisingBundle::class);
        $kernel->handleOptions($options);
        $kernel->addTestConfig(__DIR__.'/config/idm_advertising.yaml');

        return $kernel;
    }
}
