@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-6">Create Website</h2>

<input id="name" placeholder="Business Name" class="border p-2 mb-2 w-full">
<input id="type" placeholder="Business Type" class="border p-2 mb-2 w-full">
<textarea id="desc" class="border p-2 mb-2 w-full"></textarea>

<button onclick="createWebsite()" class="bg-green-600 text-white px-4 py-2 rounded">
    Create
</button>

<script>
function createWebsite() {
    fetch('/api/websites', {
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            business_name: document.getElementById('name').value,
            business_type: document.getElementById('type').value,
            description: document.getElementById('desc').value
        })
    })
    .then(() => window.location.href = '/websites');
}
</script>

@endsection