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

use Idm\Bundle\AdvertisingBundle\Event\TwigGeneric as EventTwig;
use Idm\Bundle\AdvertisingBundle\Provider\NetworkRegistry;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AdvertisingGeneric extends AbstractExtension
{
    private $networks;
    private $dispatcher;

    public function __construct(NetworkRegistry $network, EventDispatcherInterface $dispatcher)
    {
        $this->networks   = $network;
        $this->dispatcher = $dispatcher;
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
        $event = new EventTwig();
        $event->setNetwork($network);
        $event->setSlot($adSlot);

        //-- Allow to select a custom banner
        $this->dispatcher->dispatch($event, EventTwig::TWIG_GENERIC_SELECT_BANNER_PRE);

        $banner = $event->getBanner();

        if (empty($banner))
        {
            $net    = $this->networks->getNetwork($event->getNetwork());
            $banner = $net->getBanner($event->getSlot());

            if ( ! empty($banner))
            {
                $this->networks
                    ->setNetworkHasBanners($network)
                    ->addScriptUrl($network, $net->getScriptUrl())
                ;
            }
        }

        $event->setBanner($banner);

        //-- Allow to overwrite/manipulate/delete banner
        $this->dispatcher->dispatch($event, EventTwig::TWIG_GENERIC_SELECT_BANNER_POST);

        return $event->getBanner();
    }

    /**
     * Displays scripts for a specific network or for all networks.
     */
    public function showScripts(?string $network = null): string
    {
        $event = new EventTwig();
        $event->setNetwork($network ?: '');

        $this->dispatcher->dispatch($event, EventTwig::TWIG_GENERIC_SHOW_SCRIPTS_PRE);

        $scripts = $event->getScripts();

        if (empty($scripts))
        {
            $scripts = $this->networks->getScriptUrl();

            if (isset($scripts[$network]))
            {
                $scripts = [$scripts[$network]];
            }
        }

        $event->setScripts($scripts);

        $this->dispatcher->dispatch($event, EventTwig::TWIG_GENERIC_SHOW_SCRIPTS_POST);

        $scripts = $event->getScripts();

        if (empty($scripts))
        {
            return '';
        }

        return '<script async src="'.implode('"></script><script async src="', $scripts).'"></script>';
    }
}
