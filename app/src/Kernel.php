<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/03/2025, 15:26
 *
 * @project IDMarinas Advertising Bundle
 * @see     https://github.com/idmarinas/advertising-bundle
 *
 * @file    Kernel.php
 * @date    07/03/2025
 * @time    15:31
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace App;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{
	use MicroKernelTrait;

	private array $extraBundles = [];
	private array $extraRoutes  = [];
	private array $extraConfig  = [];

	public function configureRoutes (RoutingConfigurator $routes): void
	{
//		$routes->import($this->getConfigDir() . '/routes.php');
//		$routes->import('security.route_loader.logout', 'service')->methods(['GET']);

		$extraRoutes = array_unique($this->extraRoutes);

		foreach ($extraRoutes as $route) {
			$routes->import($route);
		}

		$routes
			->add('app_home', '/')
			->methods(['GET'])
			->controller(TemplateController::class)
			//->defaults([
			//	'template' => 'path/to/template.html.twig',
			//])
		;
	}

	public function addExtraBundle (string $bundleName): self
	{
		$this->extraBundles[$bundleName] = ['all' => true];

		return $this;
	}

	public function addExtraConfig (string|array $config): self
	{
		if (is_array($config)) {
			$this->extraConfig = array_merge($this->extraConfig, $config);
		} else {
			$this->extraConfig[] = $config;
		}

		return $this;
	}

	public function addExtraRoutesFile (string $route): self
	{
		$this->extraRoutes[] = $route;

		return $this;
	}

	public function registerBundles (): iterable
	{
		$contents = require $this->getBundlesPath();
		$contents = array_merge($contents, $this->extraBundles);

		foreach ($contents as $class => $envs) {
			if ($envs[$this->environment] ?? $envs['all'] ?? false) {
				yield new $class();
			}
		}
	}

	/**
	 * For add more config/routes/bundles to kernel
	 *
	 * <code>
	 *   <?php
	 *    use Symfony\Bundle\FrameworkBundle\Test\{
	 *      KernelTestCase,
	 *      WebTestCase
	 *    };
	 *
	 *    class TestKernel extends [(KernelTestCase|WebTestCase)]
	 *    {
	 *      public function testAnything (): void
	 *      {
	 *        $kernel = self::bootKernel([
	 *          'config' => static function (Kernel $kernel) {
	 *            $kernel->addExtraBundle(BundleName::class);
	 *            $kernel->addExtraConfigFile('path/to/file.php');
	 *            $kernel->addExtraRoutesFile('path/to/file.php');
	 *          }
	 *        ]);
	 *      }
	 *
	 *      #[Override]
	 *      protected static function createKernel (array $options = []): KernelInterface
	 *      {
	 *        $kernel = parent::createKernel($options);
	 *        $kernel->handleOptions($options);
	 *
	 *        return $kernel;
	 *      }
	 *    }
	 * </code>
	 */
	public function handleOptions (array $options): void
	{
		if (array_key_exists('config', $options) && is_callable($config = $options['config'])) {
			$config($this);
		}
	}

	/**
	 * @throws Exception
	 */
	protected function build (ContainerBuilder $container): void
	{
		$loader = $this->getContainerLoader($container);

		// Load config for Test App
		$loader->load($this->getTestPackagesConfigDir() . '/framework.php');
//		$loader->load($this->getTestPackagesConfigDir() . '/doctrine.php');
		$loader->load($this->getTestPackagesConfigDir() . '/maker.php');

		// Load service of Bundle
		$loader->load($this->getTestConfigDir() . '/services.php');

		// Load Fixtures and Factories of Bundle
//		$loader->load($this->getTestConfigDir() . '/factories.php');
//		$loader->load($this->getTestConfigDir() . '/fixtures.php');

		foreach ($this->extraConfig as $extension => $config) {
			if (is_array($config)) {
				$container->loadFromExtension($extension, $config);
			} else {
				$loader->load($config);
			}
		}
	}

	private function getBundlesPath (): string
	{
		return $this->getTestConfigDir() . '/bundles.php';
	}

	private function getTestConfigDir (): string
	{
		return $this->getProjectDir() . '/app/config';
	}

	private function getTestPackagesConfigDir (): string
	{
		return $this->getTestConfigDir() . '/packages';
	}
}
