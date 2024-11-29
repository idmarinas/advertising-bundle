<?php

/**
 * This file is part of Bundle "IDM Advertising Bundle".
 *
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @license https://github.com/idmarinas/advertising-bundle/blob/master/LICENSE.txt
 * @author  IDMarinas
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Advertising\Tests\Configuration;

use Idm\Bundle\Advertising\DependencyInjection\Configuration;
use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test configuration
 */
class ConfigurationTest extends TestCase
{
	use ConfigurationTestCaseTrait;

	public function testConfigurationWhenIsInvalid (): void
	{
		$this->assertConfigurationIsInvalid([[]], 'networks');
	}

	public function testConfigurationWhenGenericIsValid (): void
	{
		$conf = [
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
		];
		$this->assertConfigurationIsValid([$conf]);
	}

	protected function getConfiguration (): Configuration
	{
		return new Configuration();
	}
}