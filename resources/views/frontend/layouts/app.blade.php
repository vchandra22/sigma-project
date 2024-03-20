<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    {{-- Menggunakan Vite untuk mengelola sumber daya seperti CSS dan JavaScript --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Memuat font Hanuman dan Libre Baskerville dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap"
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
