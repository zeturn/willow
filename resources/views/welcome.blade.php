@extends('layouts.page')

@section('title')
    {{ __('Home') }} {{-- Translates "首页" into "Home" --}}
@endsection

@section('content')
    <div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
        <div class="flex flex-wrap -mx-4">
            <!-- Main Column -->
            <div class="w-full lg:w-3/4 px-4">
                <!-- Hero Section -->
                <section class="text-center bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white py-10 px-6 rounded-lg mb-8 shadow-xl">
                    <h1 class="text-6xl font-extrabold mb-6">{{ __('Welcome to memeGit DEV site') }}</h1>
                    <p class="text-xl mb-6">{{ __('Explore the world of development and innovation.') }}</p>
                    <a href="#" class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">{{ __('Learn More') }}</a>
                </section>

                <!-- Featured Section -->
                <section class="mb-8">
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Featured Projects') }}</h2>
                    <div class="flex flex-wrap -mx-2">
                        <!-- Sample Featured Project Card -->
                        <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                            <div class="bg-gradient-to-tr from-cyan-500 to-blue-700 rounded-lg shadow-lg p-6">
                                <h3 class="text-xl font-semibold text-white mb-2">{{ __('Project One') }}</h3>
                                <p class="text-white text-sm">{{ __('An innovative project description goes here.') }}</p>
                            </div>
                        </div>
                        <!-- Repeat for other featured projects -->
                    </div>
                </section>

                <!-- Artwork Grid -->
                <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Sample Card -->
                    <div class="bg-gradient-to-bl from-yellow-400 to-orange-500 h-64 rounded-lg shadow-lg overflow-hidden transform

hover:scale-105 transition duration-300">
                        <!-- Content can go here -->
                    </div>
                    <!-- Repeat for other cards -->
                </section>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
                <!-- Sidebar Content Section -->
                <section class="p-6 bg-gradient-to-br from-gray-700 to-gray-900 text-white rounded-lg shadow-md mb-6">
                    <h2 class="text-2xl font-bold mb-3">{{ __('Sidebar Title') }}</h2>
                    <p>{{ __('Additional sidebar content or widgets.') }}</p>
                </section>
                <!-- Additional sidebar sections -->

                <!-- News Section -->
                <section class="p-6 bg-gradient-to-br from-green-600 to-green-800 text-white rounded-lg shadow-md mb-6">
                    <h3 class="text-xl font-bold mb-3">{{ __('Latest News') }}</h3>
                    <ul class="list-disc list-inside">
                        <li>{{ __('News item one') }}</li>
                        <li>{{ __('News item two') }}</li>
                        <li>{{ __('More news items...') }}</li>
                    </ul>
                </section>

                <!-- Recent Blog Posts -->
                <section class="p-6 bg-gradient-to-br from-purple-600 to-purple-800 text-white rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-3">{{ __('Recent Blog Posts') }}</h3>
                    <ul class="list-disc list-inside">
                        <li>{{ __('Blog post title one') }}</li>
                        <li>{{ __('Another interesting post') }}</li>
                        <li>{{ __('More blog entries...') }}</li>
                    </ul>
                </section>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-16 p-6 bg-gradient-to-tl from-teal-500 to-green-500 text-white rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl">{{ __('Contact Us') }}</h2>
                    <p>{{ __('Email: example@example.com') }}</p>
                </div>
                <div>
                    <!-- Social Media Links -->
                </div>
            </div>
        </footer>
    </div>
@endsection
