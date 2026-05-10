<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Contract\Database;

class DriverController extends Controller
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * Handle the submission of Driver License and Training Certificate (ORCR)
     */
    public function submitRequirements(Request $request)
    {
        // 1. Validate the incoming request
        // The names here must match the 'name' attribute in your HTML inputs
        $request->validate([
            'license' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'orcr'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $driver = Auth::user();

        // 2. Process and store the License file
        if ($request->hasFile('license')) {
            // Stores file in storage/app/public/uploads/licenses
            $licensePath = $request->file('license')->store('uploads/licenses', 'public');
            $driver->license = $licensePath;
        }

        // 3. Process and store the Training Certificate (ORCR) file
        if ($request->hasFile('orcr')) {
            // Stores file in storage/app/public/uploads/orcr
            $orcrPath = $request->file('orcr')->store('uploads/orcr', 'public');
            $driver->orcr = $orcrPath;
        }

        // 4. Update driver status (optional, based on your admin logic)
        $driver->is_approved = false; // Remains false until admin clicks approve
        $driver->save();

        return redirect()->back()->with('success', 'Requirements uploaded successfully. Please wait for admin approval.');
    }

    /**
     * Broadcast real-time location to Firebase
     */
    public function updateLocation(Request $request)
    {
        $driver = Auth::user();

        // Check if driver is approved and has a number assigned by the admin
        if (!$driver->is_approved || is_null($driver->jeep_number)) {
            return response()->json(['error' => 'Not authorized or no Jeep assigned.'], 403);
        }

        $updates = [
            'shuttle/locations/' . $driver->id => [
                'driver_id'   => (string) $driver->id,
                'driver_name' => $driver->name,
                'jeep_number' => (string) $driver->jeep_number, 
                'lat'         => $request->lat,
                'lng'         => $request->lng,
                'status'      => 'online',
                'timestamp'   => now()->timestamp * 1000
            ]
        ];

        $this->database->getReference()->update($updates);

        return response()->json(['success' => 'Broadcasted as Jeep #' . $driver->jeep_number]);
    }
}