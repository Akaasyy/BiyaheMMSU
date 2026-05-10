<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DriverRequirementController extends Controller
{
    // THIS WAS MISSING: It shows the upload form
    public function create()
    {
        return view('auth.driver-requirements'); 
    }

    // Handles the actual file upload
    public function store(Request $request)
    {
        $request->validate([
            'license' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'orcr' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('license')) {
            // Optional: Delete old file if it exists
            if ($user->license_path) {
                Storage::disk('public')->delete($user->license_path);
            }
            $user->license_path = $request->file('license')->store('requirements', 'public');
        }

        if ($request->hasFile('orcr')) {
            // Optional: Delete old file if it exists
            if ($user->orcr_path) {
                Storage::disk('public')->delete($user->orcr_path);
            }
            $user->orcr_path = $request->file('orcr')->store('requirements', 'public');
        }

        // IMPORTANT: Clear the admin comment so the "re-upload" box disappears
        $user->admin_comment = null;
        $user->save();

        return redirect()->route('driver.status')->with('success', 'Requirements updated successfully!');
    }
}