<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    // cek apakah sudah login atau belum
    if (Auth::user() != null) {
        return redirect()->intended('/dashboard');
    }
    return view('auth.login');
});

Route::middleware(['web', 'role:super-admin', 'auth', 'update.activity', 'route_permission'])->group(function () {
    Route::resource('user', App\Http\Controllers\ManagementAccess\UserController::class);
    Route::resource('permission', App\Http\Controllers\ManagementAccess\PermissionController::class);
    Route::resource('role', App\Http\Controllers\ManagementAccess\RoleController::class);
    Route::resource('route', App\Http\Controllers\ManagementAccess\RouteController::class);
    Route::resource('company', App\Http\Controllers\WorkUnit\CompanyController::class);
    Route::resource('menu', App\Http\Controllers\ManagementAccess\MenuGroupController::class);
    Route::resource('menu.item', App\Http\Controllers\ManagementAccess\MenuItemController::class);
    Route::resource('activity-log', App\Http\Controllers\ActivityLogController::class)->only(['index']);
    Route::get('system-logs', [App\Http\Controllers\ActivityLogController::class, 'systemLogs'])->name('system-logs');
});

Route::middleware(['web', 'auth', 'update.activity', 'route_permission'])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard.index');

    Route::resource('location', App\Http\Controllers\MasterData\LocationController::class);

});
