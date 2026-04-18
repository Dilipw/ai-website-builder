@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- HERO -->
        <section class="text-center py-16 md:py-24">

            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Build Websites with <span class="text-blue-500">AI Power</span>
            </h1>

            <p class="text-gray-400 text-base md:text-lg max-w-2xl mx-auto mb-8">
                Instantly generate complete website content using intelligent backend architecture.
                Fast, scalable, and built for real-world systems.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/login" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg shadow-lg transition">
                    Get Started
                </a>

                <a href="/register" class="border border-gray-600 hover:bg-white/10 px-6 py-3 rounded-lg transition">
                    Create Account
                </a>
            </div>
        </section>

        <!-- FEATURES -->
        <section class="grid gap-6 md:grid-cols-3 mb-20">

            <div class="bg-white/5 p-6 rounded-xl border border-gray-800 hover:scale-105 hover:border-blue-500 transition">
                <h3 class="text-lg font-semibold mb-2">AI Content Generation</h3>
                <p class="text-gray-400 text-sm">
                    Generate titles, taglines, services, and descriptions using custom AI logic.
                </p>
            </div>

            <div class="bg-white/5 p-6 rounded-xl border border-gray-800 hover:scale-105 hover:border-green-500 transition">
                <h3 class="text-lg font-semibold mb-2">Secure API System</h3>
                <p class="text-gray-400 text-sm">
                    Built with Laravel Sanctum for secure authentication and API handling.
                </p>
            </div>

            <div
                class="bg-white/5 p-6 rounded-xl border border-gray-800 hover:scale-105 hover:border-purple-500 transition">
                <h3 class="text-lg font-semibold mb-2">Scalable Architecture</h3>
                <p class="text-gray-400 text-sm">
                    Designed using service layer, caching, and rate limiting for production systems.
                </p>
            </div>

        </section>

        <!-- HOW IT WORKS -->
        <section class="mb-20">

            <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">
                How It Works
            </h2>

            <div class="grid gap-6 md:grid-cols-3">

                <div class="bg-white/5 p-6 rounded-lg border border-gray-800 hover:border-blue-500 transition">
                    <h4 class="font-semibold mb-2">1. Input Details</h4>
                    <p class="text-gray-400 text-sm">
                        Enter business name, type, and description.
                    </p>
                </div>

                <div class="bg-white/5 p-6 rounded-lg border border-gray-800 hover:border-blue-500 transition">
                    <h4 class="font-semibold mb-2">2. AI Processing</h4>
                    <p class="text-gray-400 text-sm">
                        System generates structured content using backend logic.
                    </p>
                </div>

                <div class="bg-white/5 p-6 rounded-lg border border-gray-800 hover:border-blue-500 transition">
                    <h4 class="font-semibold mb-2">3. Manage Content</h4>
                    <p class="text-gray-400 text-sm">
                        Edit, save, and manage your generated websites.
                    </p>
                </div>

            </div>
        </section>

        <!-- FOOTER -->
        <footer class="text-center text-gray-500 text-sm border-t border-gray-800 pt-6">
            Built with Laravel, Sanctum, Tailwind CSS & REST APIs
        </footer>

    </div>
@endsection
