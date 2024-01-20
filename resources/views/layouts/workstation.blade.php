<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('description', 'description1')">
        <meta name="keywords" content="@yield('keywords', 'memegit, Hollowdata')">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>@yield('title', config('app.name', 'memeGit'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <!-- Page Heading -->
            <x-standard-header2 />

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Page Footer -->
            <x-standard-footer2 />
            
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
