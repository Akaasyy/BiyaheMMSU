<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DriverRequirementController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| PUBLIC LANDING & ROLE SELECTION
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.redirect');
    }
    return view('welcome'); 
})->name('landing');

Route::get('/select-role', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.redirect');
    }
    return view('auth.select-role');
})->name('role.selection');

Route::get('/gps', fn() => redirect()->route('student.dashboard'));

/*
|--------------------------------------------------------------------------
| STUDENT TRACKER
|--------------------------------------------------------------------------
*/
Route::get('/tracker', fn() => view('passenger'))->name('student.dashboard');

Route::get('/api/shuttle-locations', function () {
    return User::where('role', 'driver')
        ->where('is_broadcasting', 1)
        ->select('id', 'name', 'latitude', 'longitude')
        ->get();
});

/*
|--------------------------------------------------------------------------
| GUEST / AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/admin/verify', fn() => view('auth.admin-verify'))->name('admin.verify');
    Route::post('/admin/verify/submit', function (Request $request) {
        if ($request->code === '1234') return redirect()->route('admin.login');
        return back()->with('error', 'The access code you entered is incorrect.');
    })->name('admin.verify.submit');

    Route::get('/admin/login', fn() => view('auth.login-admin'))->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

    Route::get('/login/driver', fn() => view('auth.login-driver'))->name('login');
    Route::post('/login/driver', function (Request $request) {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.redirect');
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    })->name('driver.login.submit');

    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED REDIRECTS & ACTIONS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Central Hub for Logins
    Route::get('/redirect-dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');
        
        if ($user->role === 'driver') {
            // Check if they uploaded requirements yet
            if (empty($user->license_path)) return redirect()->route('driver.upload-requirements');
            
            // Check if Admin has approved them
            if ($user->is_approved != 1) return redirect()->route('driver.status');

            return redirect()->route('driver.dashboard');
        }
        
        return redirect()->route('student.dashboard');
    })->name('dashboard.redirect');

    /*
    | ADMIN ACTIONS
    */
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/driver/{id}/approve', [AdminController::class, 'approve'])->name('admin.driver.approve');
    Route::post('/admin/driver/{id}/reject', [AdminController::class, 'reject'])->name('admin.driver.reject');
    Route::post('/admin/driver/{id}/pending', [AdminController::class, 'pending'])->name('admin.driver.pending');

    /*
    | DRIVER ACTIONS
    */
    // This shows the upload form
    Route::get('/driver/upload-requirements', [DriverRequirementController::class, 'create'])
        ->name('driver.upload-requirements');

    // This is the status page (waiting room)
    Route::get('/driver/status', function() {
        return view('auth.driver-pending'); 
    })->name('driver.status');

    // Secure Dashboard check
    Route::get('/driver/dashboard', function () {
        if (Auth::user()->role === 'driver' && Auth::user()->is_approved != 1) {
            return redirect()->route('driver.status');
        }
        return view('driver-dashboard');
    })->name('driver.dashboard');

    Route::post('/driver/submit-requirements', [DriverRequirementController::class, 'store'])
        ->name('driver.upload.submit');

    // Global Logout
   Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});