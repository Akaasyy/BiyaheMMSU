<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Handle the Admin Login Submission
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                $request->session()->regenerate();
                // Direct redirect to bypass 'intended' session memory
                return redirect('/admin/dashboard'); 
            }

            Auth::logout();
            return back()->with('error', 'Access denied. Administrators only.');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    /**
     * Display the Admin Dashboard
     */
    public function index()
    {
        // Fetch all driver accounts for stats and listing
        $drivers = User::where('role', 'driver')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin', compact('drivers'));
    }

    /**
     * Approve a driver and assign a sequential Jeep Number
     */
    public function approve(Request $request, $id)
    {
        $driver = User::findOrFail($id);
        
        // --- Sequential Jeep Number Logic ---
        if (is_null($driver->jeep_number)) {
            $maxJeepNumber = User::max('jeep_number');
            $driver->jeep_number = $maxJeepNumber ? $maxJeepNumber + 1 : 1;
        }

        $driver->update([
            'is_approved' => 1,
            'admin_comment' => null 
        ]);

        return back()->with('success', "Driver {$driver->name} approved as Jeep #{$driver->jeep_number}.");
    }

    /**
     * Reject or Update Feedback
     */
    public function reject(Request $request, $id)
    {
        $driver = User::findOrFail($id);

        $request->validate([
            'admin_comment' => 'required|string|max:500',
        ]);

        // We set is_approved to 0 and ensure a comment exists
        $driver->update([
            'is_approved' => 0, 
            'admin_comment' => $request->input('admin_comment')
        ]);

        return back()->with('success', 'Application rejected and feedback sent.');
    }

    /**
     * Reset driver to pending
     */
    public function pending($id)
    {
        $driver = User::findOrFail($id);
        
        $driver->update([
            'is_approved' => 0, 
            'admin_comment' => null
        ]);

        return back()->with('success', 'Driver status reset to pending.');
    }

    /**
     * Logout User (Admin, Driver, or Student)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirects to the role selection page for all user roles
        return redirect()->route('role.selection');
    }
}