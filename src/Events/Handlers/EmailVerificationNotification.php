<?php

namespace WalkerChiu\SiteMall\Events\Handlers;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use WalkerChiu\SiteMall\Events\VerifyEmail;
use WalkerChiu\SiteMall\Events\EmailVerified;
use WalkerChiu\SiteMall\Events\PasswordForgot;
use WalkerChiu\SiteMall\Events\PasswordReset;
use WalkerChiu\SiteMall\Events\Handlers\Notification;

class EmailVerificationNotification extends Notification
{
    protected $address;

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        $this->site = $event->site;
        $this->user = $event->user;

        $this->address = 'user';

        if ($event instanceof VerifyEmail) {
            if (
                $event->user instanceof MustVerifyEmail
                && !$event->user->hasVerifiedEmail()
            ) {
                $this->verifyEmail($event);
            }
        }
        elseif ($event instanceof EmailVerified) {
            $this->emailVerified();
        }
        elseif ($event instanceof PasswordForgot) {
            $this->passwordForgot($event);
        }
        elseif ($event instanceof PasswordReset) {
            $this->passwordReset();
        }
    }

    /**
     * Handle a job failure.
     *
     * @param \Exception  $exception
     * @return void
     */
    public function failed($event, $exception)
    {
        //
    }

    /**
     * Verify Email
     *
     * @return void
     */
    public function verifyEmail($event)
    {
        $parameters = [
            'created_at' => $this->user->created_at,
            'link'       => $event->link
        ];

        $this->service->email($this->site, 'verifyEmail', $this->address, $this->user, $parameters);
    }

    /**
     * Email Verified
     *
     * @return void
     */
    public function emailVerified()
    {
        $parameters = [
            'email_verified_at' => $this->user->email_verified_at
        ];

        $this->service->email($this->site, 'emailVerified', $this->address, $this->user, $parameters);
    }

    /**
     * Password Forgot
     *
     * @return void
     */
    public function passwordForgot($event)
    {
        $link = config('wk-site-mall.client.link.backend') .'/'. config('wk-site-mall.client.link.password-reset');
        if ($event->admin)
            $link = config('wk-site-mall.client.url') .'/'. $link;

        switch (config('wk-site-mall.client.mode')) {
            case 'lighthouse-graphql-passport':
                $link = config('wk-site-mall.client.url') .'/'. $link .'?token='. $event->token;
                break;
            default:
                $link = url($link .'/'. $event->token);
        }

        $parameters = [
            'token' => $event->token,
            'link'  => $link
        ];

        $this->service->email($this->site, 'passwordForgot', $this->address, $this->user, $parameters);
    }

    /**
     * Password Reset
     *
     * @return void
     */
    public function passwordReset()
    {
        $parameters = [
            'updated_at' => $this->user->updated_at
        ];

        $this->service->email($this->site, 'passwordReset', $this->address, $this->user, $parameters);
    }
}
