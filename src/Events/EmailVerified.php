<?php

namespace WalkerChiu\SiteMall\Events;

use Illuminate\Auth\Events\Verified as BaseClass;
use WalkerChiu\SiteMall\Events\EventTrait;

class EmailVerified extends BaseClass
{
    use EventTrait;

    /**
     * Site.
     *
     * @var Site
     */
    public $site;



    /**
     * Create a new event instance.
     *
     * @param \Illuminate\Contracts\Auth\MustVerifyEmail  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;

        $this->site = $this->getSite();
    }
}
