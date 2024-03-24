<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('description', 'memegit page')">
        <meta name="keywords" content="@yield('keywords', 'memegit, Hollowdata')">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>@yield('title', config('app.name', 'memeGit')) - {{ config('app.name', 'memeGit') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="min-h-screen flex flex-col bg-[#f7fdff] text-white dark:bg-gray-900">

    <!-- Page Heading -->
    <x-standard-header4 />

    <!-- Page Content -->
    <main class="text-white flex-1">
        @yield('content')
    </main>

    <!-- Page Footer -->
    <x-standard-footer3 />

    @livewireScripts
    </body>

</html>
