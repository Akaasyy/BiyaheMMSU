<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDriverStatus
{
    // app/Http/Middleware/CheckDriverStatus.php

public function handle(Request $request, Closure $next)
{
    $user = $request->user();

    // Check if the user is a driver and not yet approved
    if ($user && $user->role === 'driver' && $user->is_approved != 1) {
        
        // If there is no admin comment, they are purely "Pending"
        if (is_null($user->admin_comment)) {
            return response()->view('auth.driver-pending'); // Points to your file in resources/views/auth/
        } 
        
        // If there IS an admin comment and they aren't approved, they are "Rejected"
        return response()->view('auth.driver-requirements'); // Assuming this is where they re-upload
    }

    return $next($request);
}
}