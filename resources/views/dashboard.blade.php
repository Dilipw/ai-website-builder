@extends('layouts.dashboard')

@section('content')
    <!-- STATS -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-gray-500">Total Websites</h3>
            <p id="total" class="text-3xl font-bold mt-2">0</p>
        </div>

    </div>

    <!-- GENERATOR -->
    <div class="bg-white p-6 rounded-xl shadow mb-8">

        <h3 class="text-lg font-semibold mb-4">Generate Website</h3>

        <input id="name" placeholder="Business Name" class="border p-3 rounded w-full mb-2">
        <input id="type" placeholder="Business Type" class="border p-3 rounded w-full mb-2">
        <textarea id="desc" placeholder="Description" class="border p-3 rounded w-full mb-2"></textarea>

        <button onclick="generate()" class="bg-blue-600 text-white px-6 py-2 rounded">
            Generate
        </button>

    </div>

    <!-- LIST -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h3 class="text-lg font-semibold mb-4">Websites</h3>

        <div id="list" class="grid md:grid-cols-2 lg:grid-cols-3 gap-4"></div>

    </div>

    <!-- EDIT MODAL -->
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded w-full max-w-md">

            <h3 class="font-bold mb-4">Edit Website</h3>

            <input id="edit_name" class="border p-2 w-full mb-2">
            <input id="edit_type" class="border p-2 w-full mb-2">
            <textarea id="edit_desc" class="border p-2 w-full mb-2"></textarea>

            <div class="flex justify-end gap-2">
                <button onclick="closeModal()" class="px-4 py-2 border">Cancel</button>
                <button onclick="updateWebsite()" class="px-4 py-2 bg-blue-600 text-white rounded">
                    Update
                </button>
            </div>

        </div>
    </div>

    <script>
        let currentId = null;

        function getToken() {
            return localStorage.getItem('token');
        }


        // ================= FETCH =================
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
                <div class="border p-4 rounded hover:shadow-lg transition">
                    <h4 class="font-semibold">${w.business_name}</h4>
                    <p class="text-sm text-gray-500">${w.title}</p>

                    <div class="mt-3 flex gap-2">
                        <button onclick="viewWebsite(${w.id})" class="text-blue-500">View</button>
                        <button onclick="editWebsite(${w.id}, '${w.business_name}', '${w.business_type}', '${w.description}')" class="text-yellow-500">Edit</button>
                        <button onclick="deleteWebsite(${w.id})" class="text-red-500">Delete</button>
                    </div>
                </div>
            `;
                    });

                    document.getElementById('list').innerHTML = html;
                });
        }


        // ================= CREATE =================
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
                .then(res => res.json())
                .then(() => {
                    fetchWebsites();
                });
        }


        // ================= VIEW =================
        function viewWebsite(id) {
            fetch('/api/websites/' + id, {
                    headers: {
                        'Authorization': 'Bearer ' + getToken()
                    }
                })
                .then(res => res.json())
                .then(data => {
                    alert(JSON.stringify(data.data, null, 2));
                });
        }


        // ================= EDIT =================
        function editWebsite(id, name, type, desc) {
            currentId = id;

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_desc').value = desc;

            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function updateWebsite() {
            fetch('/api/websites/' + currentId, {
                    method: 'PUT',
                    headers: {
                        'Authorization': 'Bearer ' + getToken(),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        business_name: document.getElementById('edit_name').value,
                        business_type: document.getElementById('edit_type').value,
                        description: document.getElementById('edit_desc').value
                    })
                })
                .then(() => {
                    closeModal();
                    fetchWebsites();
                });
        }


        // ================= DELETE =================
        function deleteWebsite(id) {
            if (!confirm('Delete this website?')) return;

            fetch('/api/websites/' + id, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + getToken()
                    }
                })
                .then(() => fetchWebsites());
        }


        fetchWebsites();
    </script>
@endsection
