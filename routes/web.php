<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');
Route::view('/dashboard', 'dashboard');
