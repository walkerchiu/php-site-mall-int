<?php

namespace WalkerChiu\SiteMall\Events\Handlers;

use WalkerChiu\SiteMall\Models\Services\EmailService;

abstract class Notification
{
    /**
     * Service.
     *
     * @var EmailService
     */
    public $service;

    /**
     * Site.
     *
     * @var Site
     */
    public $site;

    /**
     * User.
     *
     * @var User
     */
    public $user;

    /**
     * Notification.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new EmailService();
    }
}
