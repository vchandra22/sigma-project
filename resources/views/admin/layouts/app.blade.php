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

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- DataTable --}}
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.js"></script>


    {{-- Memuat source WYSIWYG ckeditor5 --}}
    <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>

    <title>{{ get_app_name() }} - {{ __(@$pageTitle) }}</title>
</head>

<body>

    <!-- Main Content Start-->
    <section class="antialiased">
        @yield('content')
    </section>
    <!-- Main Content End-->

</body>

</html>
