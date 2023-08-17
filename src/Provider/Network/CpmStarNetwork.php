<?php

/**
 * This file is part of Bundle "IDM Advertising Bundle".
 *
 * @see https://github.com/idmarinas/advertising-bundle
 *
 * @license https://github.com/idmarinas/advertising-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 1.6.0
 */

namespace Idm\Bundle\AdvertisingBundle\Provider\Network;

use Idm\Bundle\AdvertisingBundle\Provider\NetworkAbstract;

final class CpmStarNetwork extends NetworkAbstract
{

    public function getBanner(string $slot): string
    {
        $config     = $this->getConfig();
        $slotConfig = $config['banners'][$slot] ?? [];

        if (empty($slotConfig) || ! $slotConfig['cpmstar_pid'])
        {
            return '';
        }

        // -- If not enable return empty string.
        if ( ! $this->isNetworkEnabled())
        {
            return '';
        }

        return sprintf('<script src="//server.cpmstar.com/view.aspx?poolid=%1$s&script=1&rnd=%2$s"></script>',
            $slotConfig['cpmstar_pid'] ?? 0,
            random_int(100000, 999999)
        );
    }

    public function getScriptUrl(): string
    {
        return '';
    }
}
