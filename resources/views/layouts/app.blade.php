<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>AI Website Builder</title>

        <!-- CSRF TOKEN (IMPORTANT) -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-100 font-sans">

        <nav class="bg-white shadow p-4 flex justify-between items-center">

            <h1 class="font-bold text-lg">AI Builder</h1>

            <div id="nav-links">
                <!-- JS will control this -->
            </div>

        </nav>

        <div class="p-6">
            @yield('content')
        </div>

        <script>
            function updateNavbar() {
                const token = localStorage.getItem('token');
                const nav = document.getElementById('nav-links');

                if (token) {
                    nav.innerHTML = `
            <a href="/dashboard" class="mr-4">Dashboard</a>
            <button onclick="logout()" class="text-red-500">Logout</button>
        `;
                } else {
                    nav.innerHTML = `
            <a href="/login" class="mr-4">Login</a>
            <a href="/register">Register</a>
        `;
                }
            }

            updateNavbar();



            if (window.location.pathname === '/dashboard' && !localStorage.getItem('token')) {
                window.location.href = '/login';
            }
        </script>

    </body>

</html>
