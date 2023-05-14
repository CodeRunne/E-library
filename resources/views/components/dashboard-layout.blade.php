<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-library | {{ $title ?? "Home" }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        input:focus,
        button:focus {
            outline: none !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-milk-200">
    <main class="w-full lg:max-w-5xl py-3 mx-auto">
        <!-- Navigation -->
        <x-dashboard-navigation/>
        <!-- main section -->
        <section class="relative shadow bg-gray-50 shadow-md mt-3 py-5">
            {{ $slot }}
        </section>
        
        <footer></footer>
    </main>
</body>
</html>