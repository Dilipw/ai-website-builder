@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl mb-4">Register</h2>

        <input id="name" placeholder="Name" class="w-full border p-2 mb-3">
        <input id="email" placeholder="Email" class="w-full border p-2 mb-3">
        <input id="password" type="password" placeholder="Password" class="w-full border p-2 mb-3">

        <button onclick="register()" class="bg-green-500 text-white w-full p-2 rounded">
            Register
        </button>
    </div>
@endsection
