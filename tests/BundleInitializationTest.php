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
use Nyholm\BundleTest\BaseBundleTestCase;

/**
 * @internal
 * @coversNothing
 */
class BundleInitializationTest extends BaseBundleTestCase
{
    public function testInitBundle()
    {
        // Create a new Kernel
        $kernel = $this->createKernel();

        // Add some configuration
        $kernel->addConfigFile(__DIR__.'/config/idm_advertising.yaml');

        // Boot the kernel.
        $this->bootKernel();

        // Get the container
        $container = $this->getContainer();

        // Test if you services exists
        $this->assertTrue($container->has('idm_advertising.networks.registry'));
        $this->assertInstanceOf(NetworkRegistry::class, $container->get('idm_advertising.networks.registry'));
    }

    protected function getBundleClass()
    {
        return IdmAdvertisingBundle::class;
    }
}
