<?php

/**
 * This file is part of Bundle "IDM Advertising Bundle".
 *
 * @see https://github.com/idmarinas/advertising-bundle
 *
 * @license https://github.com/idmarinas/advertising-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.2.0
 */

namespace Idm\Bundle\AdvertisingBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class TwigGeneric extends Event
{
    /**
     * Event that occurs before the banner is selected.
     */
    public const TWIG_GENERIC_SELECT_BANNER_PRE = 'idm.bundle.advertising.twig.generic.select.banner.pre';

    /**
     * Event that occurs after the banner is selected.
     */
    public const TWIG_GENERIC_SELECT_BANNER_POST = 'idm.bundle.advertising.twig.generic.select.banner.post';

    /**
     * Event that occurs before the scripts is select.
     */
    public const TWIG_GENERIC_SHOW_SCRIPTS_PRE = 'idm.bundle.advertising.twig.generic.show.scripts.pre';

    /**
     * Event that occurs after the scripts is selected.
     */
    public const TWIG_GENERIC_SHOW_SCRIPTS_POST = 'idm.bundle.advertising.twig.generic.show.scripts.post';

    private string $banner  = '';
    private string $network = '';
    private string $slot    = '';
    private array $scripts  = [];

    /**
     * Set or reemplace banner selected.
     */
    public function setBanner(string $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner selected.
     */
    public function getBanner(): string
    {
        return $this->banner;
    }

    /**
     * Get name of network.
     */
    public function getNetwork(): string
    {
        return $this->network;
    }

    /**
     * Set a network.
     */
    public function setNetwork(string $network): self
    {
        $this->network = $network;

        return $this;
    }

    /**
     * Get slot of banner.
     */
    public function getSlot(): string
    {
        return $this->slot;
    }

    /**
     * Set slot of banner.
     */
    public function setSlot(string $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    /**
     * Get the scripts.
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }

    /**
     * Set/overwrite the scripts.
     */
    public function setScripts(array $scripts): self
    {
        $this->scripts = $scripts;

        return $this;
    }
}
