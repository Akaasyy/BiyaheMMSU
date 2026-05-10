<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
{
    if (!Auth::check()) {
        return redirect('/admin/login');
    }

    $user = Auth::user();

    // If an admin accidentally hits a student route, send them to the dashboard
    if ($user->role === 'admin' && $role !== 'admin') {
        return redirect('/admin/dashboard');
    }

    // If a driver/student hits an admin route, send them to the tracker
    if ($user->role !== 'admin' && $role === 'admin') {
        return redirect('/tracker');
    }

    return $next($request);
}
}