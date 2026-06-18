<?php

namespace App\Http\Middleware;

use App\Models\ManagementAccess\Route;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoutePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = Route::firstWhere('route', $request->route()?->getName());

        if (blank($route)) {
            return $next($request);
        }

        if (! $route->status) {
            abort(404);
        }

        if (blank($route->permission_name)) {
            return $next($request);
        }

        if (! $request->user()->can($route->permission_name)) {
            abort(404);
        }

        return $next($request);
    }
}
