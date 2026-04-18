@extends('layouts.dashboard')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Create Website</h2>

    <!-- ERROR BOX -->
    <div id="errorBox" class="hidden bg-red-100 text-red-700 p-3 rounded mb-4"></div>

    <input id="name" placeholder="Business Name" class="border p-3 mb-2 w-full rounded">

    <input id="type" placeholder="Business Type" class="border p-3 mb-2 w-full rounded">

    <textarea id="desc" placeholder="Description" class="border p-3 mb-2 w-full rounded"></textarea>

    <button onclick="createWebsite()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded transition">
        Create
    </button>

    <script>
        function showError(message) {
            const box = document.getElementById('errorBox');
            box.classList.remove('hidden');
            box.innerText = message;
        }

        function clearError() {
            document.getElementById('errorBox').classList.add('hidden');
        }

        function createWebsite() {

            clearError();

            const name = document.getElementById('name').value.trim();
            const type = document.getElementById('type').value.trim();
            const desc = document.getElementById('desc').value.trim();

            // 🔐 FRONTEND VALIDATION
            if (!name || !type || !desc) {
                showError('All fields are required');
                return;
            }

            fetch('/api/websites', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        business_name: name,
                        business_type: type,
                        description: desc
                    })
                })
                .then(async res => {
                    const data = await res.json();

                    // ❌ HANDLE VALIDATION / RATE LIMIT / SERVER ERROR
                    if (!res.ok) {
                        showError(data.message || 'Something went wrong');
                        return;
                    }

                    // ✅ SUCCESS
                    window.location.href = '/websites';
                })
                .catch(() => {
                    showError('Server error, please try again');
                });
        }
    </script>
@endsection
