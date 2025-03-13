<?php
/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 20:48
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    IntegrationTest.php
 * @date    13/02/2021
 * @time    17:09
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   0.1.0
 */

namespace Idm\Bundle\Advertising\Provider\Banner
{

	function random_int (): int
	{
		return 502632;
	}
}

namespace Idm\Bundle\Advertising\Tests\Twig\Extension
{

	use App\Kernel;
	use Idm\Bundle\Advertising\Provider\ProviderHub;
	use Idm\Bundle\Advertising\Twig\Extension\AdvertisingExtension;
	use Idm\Bundle\Advertising\Twig\Runtime\BannerRuntime;
	use Idm\Bundle\Advertising\Twig\Runtime\ScriptsRuntime;
	use Symfony\Component\DependencyInjection\ContainerInterface;
	use Twig\RuntimeLoader\FactoryRuntimeLoader;
	use Twig\Test\IntegrationTestCase;

	final class IntegrationTest extends IntegrationTestCase
	{
		protected function getRuntimeLoaders (): iterable
		{
			$container = $this->getContainer();
			$providerHub = $container->get(ProviderHub::class);
			$eventDispatcher = $container->get('event_dispatcher');

			yield new FactoryRuntimeLoader([
				BannerRuntime::class  => fn(): BannerRuntime => new BannerRuntime($eventDispatcher, $providerHub),
				ScriptsRuntime::class => fn(): ScriptsRuntime => new ScriptsRuntime($eventDispatcher, $providerHub),
			]);
		}

		protected static function getFixturesDirectory (): string
		{
			return __DIR__ . '/Fixtures/';
		}

		protected function getExtensions (): array
		{
			return [
				new AdvertisingExtension(),
			];
		}

		protected function getContainer (): ContainerInterface
		{
			$kernel = new Kernel('test', true);
			$kernel->addExtraConfig(dirname(__DIR__, 2) . '/config/idm_advertising.php');
			$kernel->boot();

			return $kernel->getContainer();
		}
	}
}
