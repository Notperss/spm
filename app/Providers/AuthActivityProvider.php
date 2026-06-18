<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AuthActivityProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen(Login::class, function ($event) {
            activity('auth-login')
                ->causedBy($event->user)
                ->withProperties(['ip' => request()->ip(), 'agent' => request()->userAgent()])
                ->event('login')
                ->log('User Login')
            ;
        });

        Event::listen(Logout::class, function ($event) {
            activity('auth-logout')
                ->causedBy($event->user)
                ->withProperties(['ip' => request()->ip(), 'agent' => request()->userAgent()])
                ->event('logout')
                ->log('User Logout');
        });
    }

}
