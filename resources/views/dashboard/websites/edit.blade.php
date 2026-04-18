@extends('layouts.dashboard')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Edit Website</h2>

    <!-- ERROR -->
    <div id="errorBox" class="hidden bg-red-100 text-red-700 p-3 rounded mb-4"></div>

    <!-- SUCCESS -->
    <div id="successBox" class="hidden bg-green-100 text-green-700 p-3 rounded mb-4"></div>

    <input id="name" placeholder="Business Name" class="border p-3 mb-2 w-full rounded">

    <input id="type" placeholder="Business Type" class="border p-3 mb-2 w-full rounded">

    <textarea id="desc" placeholder="Description" class="border p-3 mb-2 w-full rounded"></textarea>

    <button id="updateBtn" onclick="updateWebsite()"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded transition">
        Update
    </button>

    <script>
        let id = {{ $id }};
        const token = localStorage.getItem('token');

        function showError(msg) {
            const box = document.getElementById('errorBox');
            box.classList.remove('hidden');
            box.innerText = msg;
        }

        function showSuccess(msg) {
            const box = document.getElementById('successBox');
            box.classList.remove('hidden');
            box.innerText = msg;
        }

        function clearMessages() {
            document.getElementById('errorBox').classList.add('hidden');
            document.getElementById('successBox').classList.add('hidden');
        }


        // ================= LOAD DATA =================
        fetch('/api/websites/' + id, {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {

                if (!data.status) {
                    showError(data.message || 'Failed to load data');
                    return;
                }

                let w = data.data;

                document.getElementById('name').value = w.business_name;
                document.getElementById('type').value = w.business_type;
                document.getElementById('desc').value = w.description;
            });


        // ================= UPDATE =================
        function updateWebsite() {

            clearMessages();

            const name = document.getElementById('name').value.trim();
            const type = document.getElementById('type').value.trim();
            const desc = document.getElementById('desc').value.trim();

            //  FRONTEND VALIDATION
            if (!name || !type || !desc) {
                showError('All fields are required');
                return;
            }

            // disable button
            const btn = document.getElementById('updateBtn');
            btn.innerText = 'Updating...';
            btn.disabled = true;

            fetch('/api/websites/' + id, {
                    method: 'PUT',
                    headers: {
                        'Authorization': 'Bearer ' + token,
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

                    if (!res.ok) {
                        showError(data.message || 'Update failed');
                        btn.innerText = 'Update';
                        btn.disabled = false;
                        return;
                    }

                    showSuccess('Website updated successfully');

                    setTimeout(() => {
                        window.location.href = '/websites';
                    }, 1000);
                })
                .catch(() => {
                    showError('Server error, try again');
                    btn.innerText = 'Update';
                    btn.disabled = false;
                });
        }
    </script>
@endsection
