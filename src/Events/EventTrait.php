<?php

namespace WalkerChiu\SiteMall\Events;

use WalkerChiu\SiteMall\Models\Services\SiteService;

trait EventTrait
{
    /**
     * Get Site.
     *
     * @return void
     */
    public function getSite()
    {
        $service = new SiteService();
        $service->rememberSite();

        return $service->getSite();
    }
}
