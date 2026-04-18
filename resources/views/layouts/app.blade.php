<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AI Website Builder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<nav class="bg-white shadow p-4 flex justify-between">
    <h1 class="font-bold">AI Builder</h1>
    <div>
        <a href="/login" class="mr-4">Login</a>
        <a href="/register">Register</a>
    </div>
</nav>

<div class="p-6">
    @yield('content')
</div>

</body>
</html>