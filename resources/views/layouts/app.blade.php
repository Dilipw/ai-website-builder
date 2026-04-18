<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>AI Website Builder</title>

        <!-- CSRF -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white font-sans min-h-screen">

        <!-- NAVBAR -->
        <nav class="bg-white/5 backdrop-blur-md border-b border-gray-700 p-4 flex justify-between items-center">

            <h1 class="font-bold text-xl tracking-wide">
                AI Builder
            </h1>

            <div id="nav-links" class="flex items-center gap-4"></div>

        </nav>

        <!-- CONTENT -->
        <div class="p-6">
            @yield('content')
        </div>

        <!-- SCRIPT -->
        <script>
            function updateNavbar() {
                const token = localStorage.getItem('token');
                const nav = document.getElementById('nav-links');

                if (token) {
                    nav.innerHTML = `
                    <a href="/dashboard" class="hover:text-blue-400 transition">Dashboard</a>
                    <button onclick="logout()" class="text-red-400 hover:text-red-600 transition">
                        Logout
                    </button>
                `;
                } else {
                    nav.innerHTML = `
                    <a href="/login" class="hover:text-blue-400 transition">Login</a>
                    <a href="/register" class="hover:text-green-400 transition">Register</a>
                `;
                }
            }

            updateNavbar();

            // Extra frontend protection
            if (window.location.pathname === '/dashboard' && !localStorage.getItem('token')) {
                window.location.href = '/login';
            }
        </script>

    </body>

</html>
