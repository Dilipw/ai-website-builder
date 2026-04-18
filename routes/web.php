<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;


// session route
Route::post('/set-session', function (Request $request) {
    session(['token' => $request->token]);
    return response()->json(['status' => true]);
});


Route::middleware('frontend.auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/websites', [DashboardController::class, 'websites']);
    Route::get('/websites/create', [DashboardController::class, 'create']);
    Route::get('/websites/{id}', [DashboardController::class, 'show']);
    Route::get('/websites/{id}/edit', [DashboardController::class, 'edit']);
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
