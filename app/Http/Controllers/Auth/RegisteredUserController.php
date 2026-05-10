<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDATION: Ensuring all driver-specific requirements are met
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:18'], // Added Age requirement
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,driver,student'], 
            'category' => ['required', 'in:student,senior,pwd,regular'], 
            'license_no' => ['required_if:role,driver', 'nullable', 'string', 'max:50', 'unique:users,license_no'], 
        ]);

        // 2. ARCHITECTURE LOGIC: Drivers start as 'is_approved = false'
        // This is the core of your "Requirements Needed" system flow.
        $isApproved = ($request->role === 'driver') ? false : true;

        // 3. DATABASE PERSISTENCE: Create user with sanitized data
        $user = User::create([
            'name' => trim(strip_tags($request->name)), 
            'age' => $request->age,
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'category' => $request->category,
            'license_no' => $request->license_no ? strtoupper(trim($request->license_no)) : null,
            'is_approved' => $isApproved,
        ]);

        // 4. INTEGRATION TRIGGER: Fire event for Gmail verification
        event(new Registered($user));

        Auth::login($user);

        // 5. SMART REDIRECTOR: Sends drivers to the "Pending" logic
        // This ensures unapproved drivers see the "Requirements Needed" page immediately.
        return redirect()->route('dashboard.redirect');
    }
}