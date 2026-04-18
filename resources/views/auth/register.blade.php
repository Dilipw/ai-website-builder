@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center">

        <div class="w-full max-w-md bg-white/5 backdrop-blur border border-gray-700 p-8 rounded-lg shadow-lg">

            <h2 class="text-2xl font-bold mb-6 text-center text-white">
                Register
            </h2>

            <input id="name" placeholder="Name"
                class="w-full bg-transparent border border-gray-600 text-white p-3 mb-4 rounded focus:outline-none focus:border-green-500">

            <input id="email" type="email" placeholder="Email"
                class="w-full bg-transparent border border-gray-600 text-white p-3 mb-4 rounded focus:outline-none focus:border-green-500">

            <input id="password" type="password" placeholder="Password"
                class="w-full bg-transparent border border-gray-600 text-white p-3 mb-4 rounded focus:outline-none focus:border-green-500">

            <input id="password_confirmation" type="password" placeholder="Confirm Password"
                class="w-full bg-transparent border border-gray-600 text-white p-3 mb-4 rounded focus:outline-none focus:border-green-500">

            <button onclick="registerUser()"
                class="w-full bg-green-600 hover:bg-green-700 p-3 rounded transition shadow-lg shadow-green-500/30">
                Register
            </button>

        </div>

    </div>

    <script>
        function registerUser() {

            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;

            if (password !== confirm) {
                alert('Passwords do not match');
                return;
            }

            register(); 
        }
    </script>
@endsection
