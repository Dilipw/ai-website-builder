@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl mb-4">Login</h2>

    <input id="email" type="email" placeholder="Email" class="w-full border p-2 mb-3">
    <input id="password" type="password" placeholder="Password" class="w-full border p-2 mb-3">

    <button onclick="login()" class="bg-blue-500 text-white w-full p-2 rounded">
        Login
    </button>
</div>
@endsection