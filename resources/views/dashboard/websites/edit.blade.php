@extends('layouts.dashboard')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Edit Website</h2>

    <input id="name" class="border p-2 mb-2 w-full">
    <input id="type" class="border p-2 mb-2 w-full">
    <textarea id="desc" class="border p-2 mb-2 w-full"></textarea>

    <button onclick="update()" class="bg-blue-600 text-white px-4 py-2 rounded">
        Update
    </button>

    <script>
        let id = {{ $id }};

        // load data
        fetch('/api/websites/' + id, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                let w = data.data;

                document.getElementById('name').value = w.business_name;
                document.getElementById('type').value = w.business_type;
                document.getElementById('desc').value = w.description;
            });

        function update() {
            fetch('/api/websites/' + id, {
                    method: 'PUT',
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
