<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate input
        $request->validate([
            'role' => 'required|in:student,driver,admin',
            'category' => 'required|in:regular,pwd,senior,student'
        ]);

        // 2. Get logged-in user
        $user = auth()->user();

        // 3. Save role + category
        $user->role = $request->role;
        $user->category = $request->category;
        $user->save();

        // 4. Redirect based on role
        return match ($user->role) {
            'admin' => redirect('/admin'),
            'driver' => redirect('/driver'),
            default => redirect('/tracker'),
        };
    }
}