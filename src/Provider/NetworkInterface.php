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

interface NetworkInterface
{
    /**
     * Check if network is active.
     */
    public function isNetworkEnabled(): bool;

    /**
     * Check if advertising bundle is active.
     */
    public function isAdvertisingEnabled(): bool;

    /**
     * Enable advertising bundle.
     */
    public function enableAdvertising(): self;

    /**
     * Disable advertising bundle.
     */
    public function disableAdvertising(): self;

    /**
     * Add configuration for provider.
     */
    public function configure(array $config);

    /**
     * Get a banner of network.
     */
    public function getBanner(string $banner): string;

    /**
     * Get configuration of provider.
     */
    public function getConfig(): array;

    /**
     * Get script of provider Advertising.
     */
    public function getScriptUrl(): string;

    /** Get Config of last slot returned */
    public function getSlotConfig(): array;
}
