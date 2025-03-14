<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 14/03/2025, 17:57
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    NetworksBannerTest.php
 * @date    14/03/2025
 * @time    17:45
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   2.0.0
 */

namespace Idm\Bundle\Advertising\Tests\Provider\Network;

use App\Kernel;
use Idm\Bundle\Advertising\Provider\Banner\AdsenseBanner;
use Idm\Bundle\Advertising\Provider\Banner\CpmStarBanner;
use Idm\Bundle\Advertising\Provider\Network\AdsenseNetwork;
use Idm\Bundle\Advertising\Provider\Network\CpmStarNetwork;
use Idm\Bundle\Advertising\Provider\ProviderHub;
use Idm\Bundle\Advertising\Tests\CreateKernelTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

class NetworksBannerTest extends KernelTestCase
{
	use CreateKernelTestCaseTrait;

	protected static function bootKernel (array $options = []): KernelInterface
	{
		$options = $options + [
				'config' => static function (Kernel $kernel) {
					$kernel->addExtraConfig(dirname(__DIR__, 2) . '/config/idm_advertising.php');
				},
			];

		return parent::bootKernel($options);
	}

	public function testAdsenseBanner ()
	{
		/** @var ProviderHub $provider */
		$provider = self::getContainer()->get(ProviderHub::class);

		$network = $provider->getNetwork('adsense');

		$this->assertInstanceOf(AdsenseNetwork::class, $network);

		$banner = $network->getBanner('main');

		$this->assertInstanceOf(AdsenseBanner::class, $banner);
	}

	public function testCpmstarBanner ()
	{
		/** @var ProviderHub $provider */
		$provider = self::getContainer()->get(ProviderHub::class);

		$network = $provider->getNetwork('cpmstar');

		$this->assertInstanceOf(CpmStarNetwork::class, $network);
		$this->assertEquals('', $network->getScriptUrl(''));

		$banner = $network->getBanner('main');

		$this->assertInstanceOf(CpmStarBanner::class, $banner);
	}
}
