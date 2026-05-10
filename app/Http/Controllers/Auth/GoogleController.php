<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create new account if it doesn't exist
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt('google-user-access'), 
                    'role' => 'driver', 
                    'google_id' => $googleUser->getId(),
                    'is_approved' => false, 
                ]);
            } else {
                // Update Google ID if not set
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            }

            Auth::login($user);
            Session::regenerate();

            // HAND OFF TO REDIRECTOR: This stops the loop by using a consistent logic gate
            return redirect()->route('dashboard.redirect');

        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Google authentication failed.');
        }
    }
}