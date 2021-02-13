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

namespace Idm\Bundle\AdvertisingBundle\Twig\Extension;

use Idm\Bundle\AdvertisingBundle\Provider\NetworkRegistry;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AdvertisingGeneric extends AbstractExtension
{
    protected $networks;

    public function __construct(NetworkRegistry $network)
    {
        $this->networks = $network;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('advertising_banner', [$this, 'showBanner'], ['is_safe' => ['html']]),
            new TwigFunction('advertising_scripts', [$this, 'showScripts'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Show an banner from provider.
     */
    public function showBanner(string $network, string $adSlot): string
    {
        $net = $this->networks->getNetwork($network);
        $ad  = $net->getBanner($adSlot);

        if ($ad)
        {
            $this->networks
                ->setNetworkHasBanners($network)
                ->addScriptUrl($network, $net->getScriptUrl())
            ;

            return $ad;
        }

        return '';
    }

    /**
     * Displays scripts for a specific network or for all networks.
     */
    public function showScripts(?string $network = null): string
    {
        $scripts = $this->networks->getScriptUrl();

        if (isset($scripts[$network]))
        {
            $scripts = [$scripts[$network]];
        }

        if (empty($scripts))
        {
            return '';
        }

        return '<script async src="'.\implode('"></script><script async src="', $scripts).'"></script>';
    }
}
