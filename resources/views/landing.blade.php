@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center text-center">

        <!-- HERO -->
        <div class="mb-16 animate-fade">
            <h1 class="text-5xl font-bold mb-4 text-white">
                AI Website Builder
            </h1>

            <p class="text-gray-400 text-lg max-w-xl mx-auto mb-6">
                Generate complete website content instantly using intelligent backend logic.
                Built with scalable architecture and real-world API design.
            </p>

            <div>
                <a href="/login"
                    class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded mr-3 transition shadow-lg shadow-blue-500/30">
                    Get Started
                </a>

                <a href="/register" class="bg-white/10 backdrop-blur px-6 py-3 rounded hover:bg-white/20 transition">
                    Create Account
                </a>
            </div>
        </div>

        <!-- FEATURES -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl w-full">

            <div class="bg-white/5 backdrop-blur p-6 rounded-lg border border-gray-700 hover:border-blue-500 transition">
                <h3 class="font-semibold text-lg mb-2 text-white">AI Content Generation</h3>
                <p class="text-gray-400 text-sm">
                    Automatically generate titles, taglines, about sections, and services using custom AI logic.
                </p>
            </div>

            <div class="bg-white/5 backdrop-blur p-6 rounded-lg border border-gray-700 hover:border-green-500 transition">
                <h3 class="font-semibold text-lg mb-2 text-white">Secure API System</h3>
                <p class="text-gray-400 text-sm">
                    Built with Laravel Sanctum, ensuring secure and authenticated API access.
                </p>
            </div>

            <div class="bg-white/5 backdrop-blur p-6 rounded-lg border border-gray-700 hover:border-purple-500 transition">
                <h3 class="font-semibold text-lg mb-2 text-white">Scalable Architecture</h3>
                <p class="text-gray-400 text-sm">
                    Designed with service layer, caching, and rate limiting for real-world scalability.
                </p>
            </div>

        </div>

        <!-- HOW IT WORKS -->
        <div class="mt-20 max-w-5xl w-full">

            <h2 class="text-2xl font-bold mb-8 text-white">How It Works</h2>

            <div class="grid md:grid-cols-3 gap-6 text-left">

                <div class="bg-white/5 p-5 rounded border border-gray-700 hover:border-blue-500 transition">
                    <h4 class="font-semibold mb-2 text-white">1. Input Details</h4>
                    <p class="text-sm text-gray-400">
                        Provide business name, type, and description.
                    </p>
                </div>

                <div class="bg-white/5 p-5 rounded border border-gray-700 hover:border-blue-500 transition">
                    <h4 class="font-semibold mb-2 text-white">2. AI Processing</h4>
                    <p class="text-sm text-gray-400">
                        System generates structured content using intelligent templates.
                    </p>
                </div>

                <div class="bg-white/5 p-5 rounded border border-gray-700 hover:border-blue-500 transition">
                    <h4 class="font-semibold mb-2 text-white">3. Manage Content</h4>
                    <p class="text-sm text-gray-400">
                        Save, update, and manage generated websites easily.
                    </p>
                </div>

            </div>
        </div>

        <!-- FOOTER -->
        <div class="mt-20 text-gray-500 text-sm">
            Built with Laravel, Sanctum, Tailwind CSS and REST API architecture
        </div>

    </div>
@endsection
