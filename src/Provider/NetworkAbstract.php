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

namespace Idm\Bundle\AdvertisingBundle\Provider;

abstract class NetworkAbstract implements NetworkInterface
{
    /** Configuration for Network. */
    protected array $configuration;

    /** Indicate if advertising bundle is enable or disabled. */
    protected bool $advertisingEnable;

    /** Config of last slot returned */
    protected array $lastSlotConfig = [];

    /**
     * {@inheritDoc}
     */
    public function isNetworkEnabled(): bool
    {
        return $this->isAdvertisingEnabled() && $this->configuration['enable'];
    }

    /**
     * {@inheritDoc}
     */
    public function isAdvertisingEnabled(): bool
    {
        return $this->advertisingEnable;
    }

    /**
     * {@inheritDoc}
     */
    public function enableAdvertising(): self
    {
        $this->advertisingEnable = true;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function disableAdvertising(): self
    {
        $this->advertisingEnable = false;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    abstract public function getBanner(string $banner): string;

    /**
     * {@inheritDoc}
     */
    public function configure(array $config): self
    {
        $this->configuration = $config;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig(): array
    {
        return $this->configuration;
    }

    /**
     * Set Config of last slot returned.
     */
    protected function setSlotConfig(array $slotConfig): self
    {
        $this->lastSlotConfig = $slotConfig;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSlotConfig(): array
    {
        return $this->lastSlotConfig;
    }
}
