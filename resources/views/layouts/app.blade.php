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
    <link rel="icon" type="image/png" href="/favicon.png">

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
