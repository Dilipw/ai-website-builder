@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Websites</h2>

        <a href="/websites/create" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
            + Create Website
        </a>
    </div>

    <!-- Loader -->
    <div id="loader" class="text-center py-10 text-gray-500">
        Loading websites...
    </div>

    <!-- Empty State -->
    <div id="empty" class="hidden text-center py-10 text-gray-400">
        No websites found. Create your first one 🚀
    </div>

    <!-- List -->
    <div id="list" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>

    <script>
        const token = localStorage.getItem('token');

        function loadWebsites() {
            fetch('/api/websites', {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                .then(res => res.json())
                .then(data => {

                    document.getElementById('loader').style.display = 'none';

                    if (!data.data.data.length) {
                        document.getElementById('empty').classList.remove('hidden');
                        return;
                    }

                    let html = '';

                    data.data.data.forEach(w => {
                        html += `
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 border border-gray-100">

                        <div class="mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">
                                ${w.business_name}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                ${w.title}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 mt-4">
                            <a href="/websites/${w.id}"
                                class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition">
                                View
                            </a>

                            <a href="/websites/${w.id}/edit"
                                class="px-3 py-1 text-sm bg-yellow-100 text-yellow-600 rounded hover:bg-yellow-200 transition">
                                Edit
                            </a>

                            <button onclick="deleteWebsite(${w.id})"
                                class="px-3 py-1 text-sm bg-red-100 text-red-600 rounded hover:bg-red-200 transition">
                                Delete
                            </button>
                        </div>

                    </div>
                `;
                    });

                    document.getElementById('list').innerHTML = html;
                })
                .catch(() => {
                    document.getElementById('loader').innerText = 'Failed to load data';
                });
        }

        function deleteWebsite(id) {

            if (!confirm('Are you sure you want to delete this website?')) {
                return;
            }

            fetch(`/api/websites/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {

                    if (data.status) {
                        // Smooth reload instead of full refresh
                        loadWebsites();
                    } else {
                        alert('Delete failed');
                    }
                })
                .catch(() => {
                    alert('Something went wrong');
                });
        }

        // Initial load
        loadWebsites();
    </script>
@endsection
