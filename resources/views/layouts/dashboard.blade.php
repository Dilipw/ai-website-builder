<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-100 text-gray-800 font-sans">

        <!-- HEADER -->
        <header class="bg-white border-b shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex justify-between items-center">

                <!-- LOGO -->
                <h1 class="text-lg md:text-xl font-bold">
                    AI Builder
                </h1>

                <!-- DESKTOP NAV -->
                <div class="hidden md:flex items-center gap-6 text-sm">

                    <a href="/dashboard" class="hover:text-blue-600 transition">
                        Dashboard
                    </a>

                    <a href="/websites" class="hover:text-blue-600 transition">
                        Websites
                    </a>

                    <a href="/websites/create"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition shadow">
                        + Create
                    </a>

                    <button onclick="logout()" class="text-red-500 hover:text-red-700 transition">
                        Logout
                    </button>

                </div>

                <!-- MOBILE MENU BUTTON -->
                <button id="menu-btn" class="md:hidden text-xl">
                    ☰
                </button>

            </div>

            <!-- MOBILE MENU -->
            <div id="mobile-menu" class="hidden md:hidden flex flex-col px-4 pb-4 space-y-3 bg-white border-t text-sm">

                <a href="/dashboard" class="hover:text-blue-600">
                    Dashboard
                </a>

                <a href="/websites" class="hover:text-blue-600">
                    Websites
                </a>

                <a href="/websites/create" class="bg-blue-600 text-white px-3 py-2 rounded text-center">
                    + Create
                </a>

                <button onclick="logout()" class="text-red-500 text-left">
                    Logout
                </button>

            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="max-w-7xl mx-auto px-4 md:px-6 py-6">
            @yield('content')
        </main>

        <!-- SCRIPT -->
        <script>
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        </script>

    </body>

</html>
