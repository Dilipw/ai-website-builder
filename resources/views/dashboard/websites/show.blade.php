@extends('layouts.dashboard')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Website Details</h2>

    <div id="data" class="space-y-6"></div>

    <script>
        fetch('/api/websites/{{ $id }}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {

                if (!data.status) {
                    document.getElementById('data').innerHTML = `<p class="text-red-500">Failed to load data</p>`;
                    return;
                }

                let w = data.data;

                let servicesHtml = '';
                if (w.services && w.services.length > 0) {
                    servicesHtml = w.services.map(s => `<li class="mb-1">• ${s}</li>`).join('');
                }

                document.getElementById('data').innerHTML = `
    
    <div class="bg-white shadow rounded p-6">
        
        <!-- TITLE -->
        <h1 class="text-3xl font-bold text-gray-800 mb-2">${w.title}</h1>
        
        <!-- TAGLINE -->
        <p class="text-gray-600 italic mb-4">${w.tagline}</p>

        <hr class="my-4">

        <!-- BUSINESS INFO -->
        <div class="mb-4">
            <p><strong>Business Name:</strong> ${w.business_name}</p>
            <p><strong>Business Type:</strong> ${w.business_type}</p>
            <p><strong>Description:</strong> ${w.description}</p>
        </div>

        <!-- ABOUT -->
        <div class="mb-4">
            <h3 class="text-xl font-semibold mb-2">About Us</h3>
            <p class="text-gray-700">${w.about}</p>
        </div>

        <!-- SERVICES -->
        <div>
            <h3 class="text-xl font-semibold mb-2">Services</h3>
            <ul class="text-gray-700">
                ${servicesHtml}
            </ul>
        </div>

    </div>
    `;
            })
            .catch(() => {
                document.getElementById('data').innerHTML = `<p class="text-red-500">Server error</p>`;
            });
    </script>
@endsection
