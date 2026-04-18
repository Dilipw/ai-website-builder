<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// session route
Route::post('/set-session', function (Request $request) {
    session(['token' => $request->token]);
    return response()->json(['status' => true]);
});

//  Guest routes (ONLY for non-logged users)
Route::middleware('frontend.guest')->group(function () {
    Route::view('/', 'landing');
    Route::view('/login', 'auth.login');
    Route::view('/register', 'auth.register');
});

Route::middleware('frontend.auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/websites', [DashboardController::class, 'websites']);
    Route::get('/websites/create', [DashboardController::class, 'create']);
    Route::get('/websites/{id}', [DashboardController::class, 'show']);
    Route::get('/websites/{id}/edit', [DashboardController::class, 'edit']);

    Route::get('/websites/{id}/preview', function ($id) {
        return view('dashboard.websites.preview', compact('id'));
    });
});

// logout
Route::get('/logout', function () {
    session()->forget('token');
    return redirect('/login');
});
