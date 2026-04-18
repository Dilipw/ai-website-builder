@extends('layouts.dashboard')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Dashboard Overview</h2>

    <!-- STATS -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-gray-500">Total Websites</h3>
            <p id="total" class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-gray-500">Today's Usage</h3>
            <p id="todayCount" class="text-3xl font-bold mt-2">0 / 5</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-gray-500">Status</h3>
            <p class="text-green-600 font-semibold mt-2">Active</p>
        </div>

    </div>

    <!-- RECENT WEBSITES -->
    <div class="bg-white p-6 rounded-xl shadow mb-8">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Recent Websites</h3>
            <a href="/websites" class="text-blue-600">View All</a>
        </div>

        <div id="recentList" class="space-y-3"></div>

    </div>

    <!-- PLATFORM INFO -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h3 class="text-lg font-semibold mb-4">Platform Info</h3>

        <ul class="text-gray-600 space-y-2 text-sm">
            <li>You can generate maximum <b>5 websites per day</b></li>
            <li>Duplicate requests are optimized using <b>caching</b></li>
            <li>All generated content is stored securely</li>
            <li>You can manage (edit/delete) all your websites</li>
            <li>API is protected using token-based authentication</li>
        </ul>

    </div>

    <script>
        const token = localStorage.getItem('token');

        fetch('/api/websites', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {

                const websites = data.data.data;

                // total
                document.getElementById('total').innerText = data.data.total;

                // today count
                let today = new Date().toISOString().slice(0, 10);

                let countToday = websites.filter(w =>
                    w.created_at.startsWith(today)
                ).length;

                document.getElementById('todayCount').innerText = countToday + ' / 5';

                // latest 5
                let html = '';

                if (websites.length === 0) {
                    html = `
            <p class="text-gray-400 text-sm">
                No websites created yet.
            </p>
        `;
                } else {
                    websites.slice(0, 5).forEach(w => {
                        html += `
            <div class="border rounded-lg p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3 hover:shadow transition">

                <!-- LEFT -->
                <div>
                    <p class="font-semibold text-gray-800">${w.business_name}</p>
                    <p class="text-sm text-gray-500">${w.title}</p>
                </div>

                <!-- RIGHT ACTIONS -->
                <div class="flex gap-3 text-sm">

                    <a href="/websites/${w.id}"
                       class="px-3 py-1 rounded border text-blue-600 hover:bg-blue-50 transition">
                        View
                    </a>

                    <a href="/websites/${w.id}/preview" target="_blank"
                       class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700 transition">
                        Preview
                    </a>

                </div>

            </div>
            `;
                    });
                }

                document.getElementById('recentList').innerHTML = html;
            });
    </script>
@endsection
