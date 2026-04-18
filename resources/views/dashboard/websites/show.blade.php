@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-6">Website Details</h2>

<div id="data"></div>

<script>
fetch('/api/websites/{{ $id }}', {
    headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
})
.then(res => res.json())
.then(data => {

    let w = data.data;

    document.getElementById('data').innerHTML = `
        <h3>${w.business_name}</h3>
        <p>${w.about}</p>
    `;
});
</script>

@endsection