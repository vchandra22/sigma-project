<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Your website description goes here">
    <meta name="keywords" content="magang, kota blitar, pkl">
    <meta name="author" content="DISKOMINFOTIK Kota Blitar">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('main.index') }}">
    <meta property="og:title" content="Your Website Title">
    <meta property="og:description" content="Your website description goes here">
    <meta property="og:image" content="{{ asset('frontend/assets/img/logo-sigmaLight.png') }}">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://www.example.com/">
    <meta property="twitter:title" content="Your Website Title">
    <meta property="twitter:description" content="Your website description goes here">
    <meta property="twitter:image" content="https://www.example.com/image.jpg">
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="Your Website Title">
    <meta itemprop="description" content="Your website description goes here">
    <meta itemprop="image" content="https://www.example.com/image.jpg">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Canonical Link -->
    <link rel="canonical" href="{{ route('main.index') }}">

    {{-- Menggunakan Vite untuk mengelola sumber daya seperti CSS dan JavaScript --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Memuat font Hanuman dan Libre Baskerville dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    {{-- Fontawesome icon CDN --}}
    <script src="https://kit.fontawesome.com/bfb24335ca.js" crossorigin="anonymous"></script>

    {{-- Memuat source WYSIWYG ckeditor5 --}}
    <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>

    <title>{{ get_app_name() }} - {{ __(@$pageTitle) }}</title>
</head>

<body>
    <!--Main Menu/Navbar Area Start -->
    @include('layouts.sidebar')
    <!--Main Menu/Navbar Area Start -->

    <!-- Main Content Start-->
    <section class="antialiased">
        @yield('content')
    </section>
    <!-- Main Content End-->

</body>

</html>
