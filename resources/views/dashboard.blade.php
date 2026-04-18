@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h3>Total Websites</h3>
            <p id="total" class="text-2xl font-bold">0</p>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h3 class="mb-3">Generate Website</h3>

        <input id="name" placeholder="Business Name" class="w-full border p-2 mb-2">
        <input id="type" placeholder="Business Type" class="w-full border p-2 mb-2">
        <textarea id="desc" placeholder="Description" class="w-full border p-2 mb-2"></textarea>

        <button onclick="generate()" class="bg-blue-500 text-white px-4 py-2 rounded">
            Generate
        </button>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="mb-3">Websites</h3>
        <div id="list"></div>
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
                        html += `<div class="border p-2 mb-2">
                        <b>${w.business_name}</b><br>
                        ${w.title}
                    </div>`;
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
