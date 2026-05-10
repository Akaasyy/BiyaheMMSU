<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverRequirementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'drivers_license' => 'required|image|max:2048',
            'training_certificate' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('drivers_license')) {
            // Save file and update database
            $path = $request->file('drivers_license')->store('licenses', 'public');
            $user->license_path = $path;
        }

        $user->save();

        // Send back to redirector - it will now see license_path is full and send to 'pending'
        return redirect()->route('dashboard.redirect')->with('success', 'Upload successful!');
    }
}