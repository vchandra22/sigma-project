<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- SEO Meta Tags -->
    @hasSection('meta')
        @yield('meta')
    @else
        @php
            $defaultMeta = getMeta('default');
        @endphp

        <meta name="description" content="{{ $defaultMeta['meta_description'] }}">
        <meta name="keywords" content="{{ $defaultMeta['meta_keyword'] }}">
        <meta name="author" content="DISKOMINFOTIK Kota Blitar">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $defaultMeta['meta_title'] }}">
        <meta property="og:description" content="{{ $defaultMeta['meta_description'] }}">
        <meta property="og:image" content="{{ $defaultMeta['og_image'] }}">
        <meta property="og:site_name" content="{{ get_app_name() }}">
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $defaultMeta['meta_title'] }}">
        <meta property="twitter:description" content="{{ $defaultMeta['meta_description'] }}">
        <meta property="twitter:image" content="{{ $defaultMeta['og_image'] }}">
        <!-- Google / Search Engine Tags -->
        <meta itemprop="name" content="{{ $defaultMeta['meta_title'] }}">
        <meta itemprop="description" content="{{ $defaultMeta['meta_description'] }}">
        <meta itemprop="image" content="{{ $defaultMeta['og_image'] }}">
    @endif

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
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Canonical Link -->
    <link rel="canonical" href="{{ url()->current() }}">


    {{-- Menggunakan Vite untuk mengelola sumber daya seperti CSS dan JavaScript --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Memuat font dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/bfb24335ca.js" crossorigin="anonymous"></script>

    <title>{{ get_app_name() }} - {{ __(@$pageTitle) }}</title>
</head>

<body>
    <!--Main Menu/Navbar Area Start -->
    @include('frontend.layouts.navbar')
    <!--Main Menu/Navbar Area Start -->

    <!-- Main Content Start-->
    <section class="antialiased">
        @yield('content')
    </section>
    <!-- Main Content End-->

    <!-- Footer Start -->
    @include('frontend.layouts.footer')
    <!-- Footer End -->
</body>

</html>
