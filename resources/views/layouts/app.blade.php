<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">

        <!-- FIX: viewport already correct -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>AI Website Builder</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gradient-to-br from-black via-gray-900 to-gray-950 text-white font-sans min-h-screen">

        <!-- NAVBAR -->
        <nav
            class="sticky top-0 z-50 bg-black/40 backdrop-blur-lg border-b border-gray-800 px-6 py-4 flex justify-between items-center">

            <h1 class="font-bold text-xl md:text-2xl tracking-wide text-white">
                AI Builder
            </h1>

            <!-- Mobile Menu Toggle -->
            <button id="menu-btn" class="md:hidden text-white text-xl">
                ☰
            </button>

            <!-- NAV LINKS -->
            <div id="nav-links" class="hidden md:flex items-center gap-6 text-sm md:text-base"></div>
        </nav>

        <!-- MOBILE NAV -->
        <div id="mobile-menu" class="hidden flex-col bg-black/80 backdrop-blur p-4 space-y-3 md:hidden"></div>

        <!-- CONTENT -->
        <div class="px-4 md:px-10 py-8">
            @yield('content')
        </div>

        <script>
            function updateNavbar() {
                const token = localStorage.getItem('token');
                const nav = document.getElementById('nav-links');
                const mobile = document.getElementById('mobile-menu');

                if (token) {
                    nav.innerHTML = `
                    <a href="/dashboard" class="hover:text-blue-400">Dashboard</a>
                    <button onclick="logout()" class="text-red-400 hover:text-red-600">Logout</button>
                `;

                    mobile.innerHTML = `
                    <a href="/dashboard">Dashboard</a>
                    <button onclick="logout()" class="text-red-400">Logout</button>
                `;
                } else {
                    nav.innerHTML = `
                    <a href="/login">Login</a>
                    <a href="/register" class="text-green-400">Register</a>
                `;

                    mobile.innerHTML = `
                    <a href="/login">Login</a>
                    <a href="/register" class="text-green-400">Register</a>
                `;
                }
            }

            updateNavbar();

            // Mobile toggle
            document.getElementById('menu-btn').onclick = () => {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            };

            // Protection
            if (window.location.pathname === '/dashboard' && !localStorage.getItem('token')) {
                window.location.href = '/login';
            }
        </script>

    </body>

</html>
