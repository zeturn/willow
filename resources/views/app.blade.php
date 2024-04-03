<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'memeGit') }}</title>

        <!-- Fonts -->
        <!-- 预连接到字体服务器 -->
        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>

        <!-- 预加载字体文件 -->
        <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">

        <!-- 使用JavaScript异步加载字体文件 -->
        <script>
        function loadCSS(href, callback) {
            var ss = document.createElement('link');
            var ref = document.querySelector('script');
            ss.rel = 'stylesheet';
            ss.href = href;
            // Optional: set media attribute for conditional loading
            // ss.media = 'only x';
            ref.parentNode.insertBefore(ss, ref);
            if (callback) {
            ss.onload = function() { callback(); };
            }
            return ss;
        }
        // Use the function to load the CSS file
        loadCSS("https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap");
        </script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
        @viteReactRefresh
        <!-- Styles -->
        @livewireStyles
        @inertiaHead
    </head>
    <body class="font-sans antialiased">

        @livewireScripts
        @inertia
    </body>
</html>
