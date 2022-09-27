<?php

namespace WalkerChiu\SiteMall\Models\Entities;

use WalkerChiu\SiteMall\Events\Attempting;
use WalkerChiu\SiteMall\Events\Authenticated;
use WalkerChiu\SiteMall\Events\AuthFailed;
use WalkerChiu\SiteMall\Events\EmailVerified;
use WalkerChiu\SiteMall\Events\PasswordForgot;
use WalkerChiu\SiteMall\Events\PasswordReset;
use WalkerChiu\SiteMall\Events\Registered;
use WalkerChiu\SiteMall\Events\VerifyEmail;

trait EmailUserTrait
{
    /**
     * Attempting.
     * 
     * @param $guard
     * @param Bool  $remember
     * @return void
     */
    public function notifyAttempting($guard, bool $remember)
    {
        event(new Attempting($guard, $this, $remember));
    }

    /**
     * Authenticated.
     *
     * @param $guard
     * @return void
     */
    public function notifyAuthenticated($guard)
    {
        event(new Authenticated($guard, $this));
    }

    /**
     * AuthFailed.
     * 
     * @param $guard
     * @param Array  $credentials
     * @return void
     */
    public function notifyAuthFailed($guard, array $credentials)
    {
        event(new AuthFailed($guard, $this, $credentials));
    }

    /**
     * Email Verified.
     * 
     * @return void
     */
    public function notifyEmailVerified()
    {
        event(new EmailVerified($this));
    }

    /**
     * Send the password reset link.
     * 
     * @param String  $token
     * @param Bool    $admin
     * @return void
     */
    public function notifyPasswordLink(string $token, $admin = false)
    {
        event(new PasswordForgot($this, $token, $admin));
    }

    /**
     * PasswordReset.
     * 
     * @return void
     */
    public function notifyPasswordReset()
    {
        event(new PasswordReset($this));
    }

    /**
     * Registered.
     * 
     * @return void
     */
    public function notifyRegistered()
    {
        event(new Registered($this));
    }

    /**
     * Verify Email.
     * 
     * @return void
     */
    public function notifyVerifyEmail()
    {
        event(new VerifyEmail($this));
    }
}
