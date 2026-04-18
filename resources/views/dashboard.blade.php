@extends('layouts.dashboard')

@section('content')
    <!-- STATS -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 animate-fade">

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500">Total Websites</h3>
            <p id="total" class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500">Status</h3>
            <p class="text-green-500 mt-2 font-semibold">Active</p>
        </div>

    </div>

    <!-- GENERATOR -->
    <div class="bg-white p-6 rounded-xl shadow mb-8 animate-fade">

        <h3 class="text-lg font-semibold mb-4">Generate Website</h3>

        <div class="grid md:grid-cols-2 gap-4">

            <input id="name" placeholder="Business Name"
                class="border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            <input id="type" placeholder="Business Type"
                class="border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

        </div>

        <textarea id="desc" placeholder="Description"
            class="w-full border border-gray-300 p-3 mt-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

        <button onclick="generate()"
            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded transition shadow">
            Generate
        </button>

    </div>

    <!-- LIST -->
    <div class="bg-white p-6 rounded-xl shadow animate-fade">

        <h3 class="text-lg font-semibold mb-4">Generated Websites</h3>

        <div id="list" class="grid md:grid-cols-2 lg:grid-cols-3 gap-4"></div>

    </div>

    <script>
        function getToken() {
            return localStorage.getItem('token');
        }

        function fetchWebsites() {
            fetch('/api/websites', {
                    headers: {
                        'Authorization': 'Bearer ' + getToken(),
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {

                    document.getElementById('total').innerText = data.data.total;

                    let html = '';

                    data.data.data.forEach(w => {
                        html += `
                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                    <h4 class="font-semibold">${w.business_name}</h4>
                    <p class="text-sm text-gray-500 mt-1">${w.title}</p>
                </div>
            `;
                    });

                    document.getElementById('list').innerHTML = html;
                });
        }

        function generate() {
            fetch('/api/websites', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        business_name: document.getElementById('name').value,
                        business_type: document.getElementById('type').value,
                        description: document.getElementById('desc').value
                    })
                })
                .then(() => fetchWebsites());
        }

        fetchWebsites();
    </script>
@endsection
