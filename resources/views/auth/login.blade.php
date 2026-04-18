@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center">

        <div class="w-full max-w-md bg-white/5 backdrop-blur border border-gray-700 p-8 rounded-lg shadow-lg">

            <h2 class="text-2xl font-bold mb-6 text-center text-white">
                Login
            </h2>

            <input id="email" type="email" placeholder="Email"
                class="w-full bg-transparent border border-gray-600 text-white p-3 mb-4 rounded focus:outline-none focus:border-blue-500">

            <input id="password" type="password" placeholder="Password"
                class="w-full bg-transparent border border-gray-600 text-white p-3 mb-4 rounded focus:outline-none focus:border-blue-500">

            <button onclick="login()"
                class="w-full bg-blue-600 hover:bg-blue-700 p-3 rounded transition shadow-lg shadow-blue-500/30">
                Login
            </button>

        </div>

    </div>
@endsection
