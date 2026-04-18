@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-6">Websites</h2>

<a href="/websites/create" class="bg-blue-600 text-white px-4 py-2 rounded">
    + Create Website
</a>

<div id="list" class="grid md:grid-cols-3 gap-4 mt-6"></div>

<script>
fetch('/api/websites', {
    headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
})
.then(res => res.json())
.then(data => {

    let html = '';

    data.data.data.forEach(w => {
        html += `
            <div class="border p-4 rounded">
                <h4>${w.business_name}</h4>
                <p>${w.title}</p>

                <a href="/websites/${w.id}" class="text-blue-500">View</a>
                <a href="/websites/${w.id}/edit" class="text-yellow-500 ml-2">Edit</a>
            </div>
        `;
    });

    document.getElementById('list').innerHTML = html;
});
</script>

@endsection