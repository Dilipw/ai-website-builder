<?php
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

//  Protected routes
Route::middleware('frontend.auth')->group(function () {
    Route::view('/dashboard', 'dashboard');
});

// logout
Route::get('/logout', function () {
    session()->forget('token');
    return redirect('/login');
});