<?php

namespace WalkerChiu\SiteMall\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var Array
     */
    protected $listen = [
    ];

    /**
     * The subscriber classes to register.
     *
     * @var Array
     */
    protected $subscribe = [
        'WalkerChiu\SiteMall\Events\Subscribers\UserEventSubscriber',
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
