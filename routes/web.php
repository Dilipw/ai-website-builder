<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/set-session', function (Request $request) {
    session(['token' => $request->token]);
    return response()->json(['status' => true]);
});

Route::view('/', 'landing');
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

Route::middleware('frontend.auth')->group(function () {
    Route::view('/dashboard', 'dashboard');
});
