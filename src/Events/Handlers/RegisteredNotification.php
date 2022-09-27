<?php

namespace WalkerChiu\SiteMall\Events\Handlers;

use WalkerChiu\SiteMall\Events\Registered;
use WalkerChiu\SiteMall\Events\Handlers\Notification;

class RegisteredNotification extends Notification
{
    /**
     * Handle the event.
     *
     * @param \WalkerChiu\SiteMall\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $this->site = $event->site;
        $this->user = $event->user;

        $parameters = [
            'created_at' => $this->user->created_at
        ];

        $this->service->email($this->site, 'registered', 'user', $this->user, $parameters);
    }

    /**
     * Handle a job failure.
     *
     * @param \WalkerChiu\SiteMall\Events\Registered  $event
     * @param \Exception                          $exception
     * @return void
     */
    public function failed(Registered $event, $exception)
    {
        //
    }
}
