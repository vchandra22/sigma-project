<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    {{-- Menggunakan Vite untuk mengelola sumber daya seperti CSS dan JavaScript --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Memuat font Hanuman dan Libre Baskerville dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/bfb24335ca.js" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    @yield('content')
</body>

</html>
