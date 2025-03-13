<?php
/**
 * Copyright 2021-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/03/2025, 17:39
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

	use Idm\Bundle\Advertising\IdmAdvertisingBundle;
	use Idm\Bundle\Advertising\Provider\ProviderHub;
	use Idm\Bundle\Advertising\Twig\Extension\AdvertisingExtension;
	use Idm\Bundle\Advertising\Twig\Runtime\BannerRuntime;
	use Idm\Bundle\Advertising\Twig\Runtime\ScriptsRuntime;
	use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
	use Symfony\Component\Config\Loader\LoaderInterface;
	use Symfony\Component\DependencyInjection\ContainerInterface;
	use Symfony\Component\HttpKernel\Kernel;
	use Twig\RuntimeLoader\FactoryRuntimeLoader;
	use Twig\Test\IntegrationTestCase;

	final class IntegrationTest extends IntegrationTestCase
	{
		protected function getContainer (): ContainerInterface
		{
			$kernel = new ExtensionTestingKernel();
			$kernel->boot();

			return $kernel->getContainer();
		}

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
	}

	class ExtensionTestingKernel extends Kernel
	{
		public function __construct ()
		{
			parent::__construct('test', true);
		}

		public function registerBundles (): iterable
		{
			return [
				new FrameworkBundle(),
				new IdmAdvertisingBundle(),
			];
		}

		public function registerContainerConfiguration (LoaderInterface $loader): void
		{
			$loader->load(dirname(__DIR__, 2) . '/config/idm_advertising.php');
		}
	}
}
