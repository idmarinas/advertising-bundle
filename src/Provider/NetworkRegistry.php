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

namespace Idm\Bundle\Advertising\Provider;

use InvalidArgumentException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NetworkRegistry
{
    private ContainerInterface $container;

    private array $networksMap;

    private array $scripts            = [];
    private array $networksHasBanners = [];

    /**
     * Network registry constructor.
     */
    public function __construct(ContainerInterface $container, array $networksMap)
    {
        $this->container   = $container;
        $this->networksMap = $networksMap;
    }

    /**
     * Easy accessor for network objects.
     *
     * @param string $key
     */
    public function getNetwork($key): NetworkInterface
    {
        if (isset($this->networksMap[$key]))
        {
            $network = $this->container->get($this->networksMap[$key]);
            if ( ! $network instanceof NetworkInterface)
            {
                throw new InvalidArgumentException(sprintf(
                    'Somehow the "%s" network is not implement the interface NetworkInterface.',
                    $key
                ));
            }

            return $network;
        }

        throw new InvalidArgumentException(sprintf(
            'There is no network called "%s". Available are: %s',
            $key,
            implode(', ', array_keys($this->networksMap))
        ));
    }

    /**
     * Add script to print in end of page.
     *
     * @param string|array $url
     */
    public function addScriptUrl(string $network, string $url): self
    {
        $this->scripts[$network] = $url;

        return $this;
    }

    public function getScriptUrl(): array
    {
        return array_filter($this->scripts, fn ($val) => ! (
            \array_key_exists($val, $this->networksMap)
            && $this->networkHasBanners($val)
            && $this->getNetwork($val)->isNetworkEnabled()
        ));
    }

    /**
     * Set that network has a banners.
     */
    public function setNetworkHasBanners(string $network): self
    {
        $this->networksHasBanners[$network] = true;

        return $this;
    }

    /**
     * Get if network has banners.
     */
    public function networkHasBanners(string $network): bool
    {
        return isset($this->networksHasBanners[$network]);
    }

    /**
     * Returns all enabled network keys.
     *
     * @return array
     */
    public function getEnabledNetworksKeys()
    {
        return array_keys($this->networksMap);
    }
}