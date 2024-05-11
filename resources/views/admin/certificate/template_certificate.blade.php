<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Using Vite to manage resources like CSS and JavaScript --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Define your additional styles here */
        body {
            background-image: url('/storage/img/background-certificate.png');
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #FFFFFF;
        }
    </style>
</head>

<body>
    <div>
        <div class="flex justify-center mt-[150px]">
            <img src="{{ asset('/frontend/assets/img/logo-sigmaLight.png') }}" alt="Logo Sigma" class="w-80">
        </div>
        <div class="text-center">
            <h1 class="text-[58px] font-bold pt-[30px] text-primary-800">Certificate of Achievement</h1>
            <p class="text-[32px] text-black">
                Diberikan Kepada:
            </p>
            <p class="text-[48px] font-bold text-primary-800">
                Vincent Chandra Trie Novan
            </p>
            <p class="text-[28px] text-primary-800">
                213140714111186
            </p>

        </div>
    </div>
</body>

</html>
