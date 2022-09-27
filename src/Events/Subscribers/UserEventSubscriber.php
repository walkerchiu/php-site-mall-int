<?php

namespace WalkerChiu\SiteMall\Events\Subscribers;

class UserEventSubscriber
{
    /**
     * Register the handlers for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        if (config('wk-site-mall.register_event.VerifyEmail'))
            $events->listen(
                'WalkerChiu\SiteMall\Events\VerifyEmail',
                'WalkerChiu\SiteMall\Events\Handlers\EmailVerificationNotification'
            );

        if (config('wk-site-mall.register_event.EmailVerified'))
            $events->listen(
                'WalkerChiu\SiteMall\Events\EmailVerified',
                'WalkerChiu\SiteMall\Events\Handlers\EmailVerificationNotification'
            );

        if (config('wk-site-mall.register_event.PasswordForgot'))
            $events->listen(
                'WalkerChiu\SiteMall\Events\PasswordForgot',
                'WalkerChiu\SiteMall\Events\Handlers\EmailVerificationNotification'
            );

        if (config('wk-site-mall.register_event.PasswordReset'))
            $events->listen(
                'WalkerChiu\SiteMall\Events\PasswordReset',
                'WalkerChiu\SiteMall\Events\Handlers\EmailVerificationNotification'
            );

        if (config('wk-site-mall.register_event.Registered'))
            $events->listen(
                'WalkerChiu\SiteMall\Events\Registered',
                'WalkerChiu\SiteMall\Events\Handlers\RegisteredNotification'
            );

        if (config('wk-site-mall.register_event.Authenticated'))
            $events->listen(
                'WalkerChiu\SiteMall\Events\Authenticated',
                'WalkerChiu\SiteMall\Events\Handlers\AuthenticatedNotification'
            );
    }
}
