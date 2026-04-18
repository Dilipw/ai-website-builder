<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-50 text-gray-800 font-sans">

        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

                <h1 class="text-lg font-bold">AI Builder</h1>

                <div class="flex items-center gap-6 text-sm">

                    <a href="/dashboard" class="hover:text-blue-600">Dashboard</a>

                    <a href="/websites" class="hover:text-blue-600">Websites</a>

                    <a href="/websites/create" class="bg-blue-600 text-white px-3 py-1 rounded">
                        + Create
                    </a>

                    <button onclick="logout()" class="text-red-500 hover:text-red-700">
                        Logout
                    </button>

                </div>

            </div>
        </header>

        <main class="max-w-7xl mx-auto p-6">
            @yield('content')
        </main>

    </body>

</html>
