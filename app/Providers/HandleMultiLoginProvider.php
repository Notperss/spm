<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

class HandleMultiLoginProvider extends ServiceProvider
{

    protected $listen = [
        Logout::class => [
            \App\Listeners\UserLoggedOut::class,
        ],
    ];
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
        Fortify::authenticateUsing(function (Request $request) {

            $user = \App\Models\User::where('username', $request->username)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return null;
            }

            // ⏳ Batas idle (misal 10 menit)
            $timeout = 10;

            if ($user->is_logged_in) {

                if ($user->last_activity && Carbon::parse($user->last_activity)->addMinutes($timeout)->isFuture()) {

                    throw ValidationException::withMessages([
                        'username' => 'Akun sedang aktif di perangkat lain.',
                    ]);
                }
            }

            // Tandai login
            $user->is_logged_in = true;
            $user->last_activity = now();
            $user->save();

            return $user;
        });
    }
}
