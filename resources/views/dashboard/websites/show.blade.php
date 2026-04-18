@extends('layouts.dashboard')

@section('content')
    <div class="max-w-6xl mx-auto">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 gap-4">
            <h2 class="text-2xl md:text-3xl font-bold">Website Details</h2>

            <a href="/websites/{{ $id }}/preview" target="_blank"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow transition text-center">
                Preview Website
            </a>
        </div>

        <!-- CONTENT -->
        <div id="data"></div>

    </div>

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
                    document.getElementById('data').innerHTML =
                        `<p class="text-red-500">Failed to load data</p>`;
                    return;
                }

                let w = data.data;

                let servicesHtml = '';
                if (w.services && w.services.length > 0) {
                    servicesHtml = w.services.map(s => `
            <li class="flex items-center gap-2">
                <span class="text-blue-500">•</span> ${s}
            </li>
        `).join('');
                }

                document.getElementById('data').innerHTML = `

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT SIDE (MAIN CONTENT) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- TITLE CARD -->
            <div class="bg-white shadow rounded-xl p-6 border">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                    ${w.title}
                </h1>
                <p class="text-gray-500 italic">
                    ${w.tagline}
                </p>
            </div>

            <!-- ABOUT -->
            <div class="bg-white shadow rounded-xl p-6 border">
                <h3 class="text-lg font-semibold mb-3 border-b pb-2">
                    About Us
                </h3>
                <p class="text-gray-700 leading-relaxed">
                    ${w.about}
                </p>
            </div>

            <!-- SERVICES -->
            <div class="bg-white shadow rounded-xl p-6 border">
                <h3 class="text-lg font-semibold mb-3 border-b pb-2">
                    Services
                </h3>

                <ul class="space-y-2 text-gray-700">
                    ${servicesHtml || '<p class="text-gray-400">No services available</p>'}
                </ul>
            </div>

        </div>

        <!-- RIGHT SIDE (INFO PANEL) -->
        <div class="space-y-6">

            <div class="bg-white shadow rounded-xl p-6 border">
                <h3 class="text-lg font-semibold mb-3 border-b pb-2">
                    Business Info
                </h3>

                <div class="space-y-2 text-sm text-gray-700">
                    <p><strong>Name:</strong> ${w.business_name}</p>
                    <p><strong>Type:</strong> ${w.business_type}</p>
                    <p><strong>Description:</strong></p>
                    <p class="text-gray-600">${w.description}</p>
                </div>
            </div>

        </div>

    </div>
    `;
            })
            .catch(() => {
                document.getElementById('data').innerHTML =
                    `<p class="text-red-500">Server error</p>`;
            });
    </script>
@endsection
