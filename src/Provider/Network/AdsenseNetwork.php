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

namespace Idm\Bundle\AdvertisingBundle\Provider\Network;

use Idm\Bundle\AdvertisingBundle\Provider\NetworkAbstract;

final class AdsenseNetwork extends NetworkAbstract
{
    /**
     * Indicate if script is rendered.
     *
     * @var bool
     */
    protected $scriptRendered = false;

    public function getBanner(string $slot): string
    {
        //-- If not enable return empty string.
        if ( ! $this->isNetworkEnabled())
        {
            return '';
        }

        $config     = $this->getConfig();
        $slotConfig = $config['banners'][$slot] ?? [];

        if (empty($slotConfig) || ! $slotConfig['slot'])
        {
            return '';
        }

        return \sprintf(
            '<ins class="adsbygoogle"
                style="%1$s"
                data-ad-client="%2$s"
                data-ad-slot="%3$s"
                data-ad-format="%4$s"
                data-full-width-responsive="%5$s"></ins>
            <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
            ',
            $slotConfig['style'] ?? '',
            $config['client'],
            $slotConfig['slot'],
            $slotConfig['format'],
            $slotConfig['responsive'] ? 'true' : 'false'
        );
    }

    /**
     * Is enable only if 'enable' = true and client is configured.
     */
    public function isNetworkEnabled(): bool
    {
        return parent::isNetworkEnabled() && \is_string($this->configuration['client']) && ! empty($this->configuration['client']);
    }

    /**
     * {@inheritDoc}
     */
    public function getScriptUrl(): string
    {
        return 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';
    }
}
