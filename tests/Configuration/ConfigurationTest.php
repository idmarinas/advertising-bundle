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

namespace Idm\Bundle\AdvertisingBundle\Tests\Configuration;

use Idm\Bundle\AdvertisingBundle\DependencyInjection\Configuration;
use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test configuration
 */
class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    public function testConfigurationWhenIsInvalid(): void
    {
        try
        {
            $this->assertConfigurationIsInvalid([],
                'networks'
            );
            $this->assertEquals(true, true);
        }
        catch (\InvalidArgumentException $e)
        {
            $this->assertInstanceOf('\InvalidArgumentException', $e);
        }
    }

    public function testConfigurationWhenGenericIsValid(): void
    {
        try
        {
            $this->assertConfigurationIsValid([
                'enable'   => true,
                'networks' => [
                    'test_network' => [
                        'type'    => 'generic',
                        'enable'  => true,
                        'banners' => [
                            'header' => [],
                        ],
                    ],
                ],
            ]);
            $this->assertEquals(true, true);
        }
        catch (\InvalidArgumentException $e)
        {
            $this->assertInstanceOf('\InvalidArgumentException', $e);
        }
    }

    protected function getConfiguration(): Configuration
    {
        return new Configuration();
    }
}
