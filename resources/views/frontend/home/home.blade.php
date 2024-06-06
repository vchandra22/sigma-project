@extends('frontend.layouts.app')

@section('meta')
    @php
        $metaData = getMeta('home');
    @endphp

    <meta name="description" content="{{ $metaData['meta_description'] }}">
    <meta name="keywords" content="{{ $metaData['meta_keyword'] }}">
    <meta name="author" content="DISKOMINFOTIK Kota Blitar">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="Internship">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $metaData['meta_title'] }}">
    <meta property="og:description" content="{{ $metaData['meta_description'] }}">
    <meta property="og:image" content="{{ __($metaData['og_image']) }}">
    <meta property="og:site_name" content="{{ get_app_name() }}">
    <!-- Twitter -->
    <meta property="twitter:card" content="Internship">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $metaData['meta_title'] }}">
    <meta property="twitter:description" content="{{ $metaData['meta_description'] }}">
    <meta property="twitter:image" content="{{ __($metaData['og_image']) }}">
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $metaData['meta_title'] }}">
    <meta itemprop="description" content="{{ $metaData['meta_description'] }}">
    <meta itemprop="image" content="{{ __($metaData['og_image']) }}">
@endsection

@section('content')

        {{-- jumbotron / hero homepage start --}}
        <div class="mt-[4.4rem] mx-auto h-96 md:h-full relative">
            <img src="{{ asset('frontend/assets/img/default-hero-image.webp') }}" width="100" height="100"
                class="object-cover w-full h-full" alt="Hero Image SIGMA">
            <div
                class="absolute top-0 flex flex-col items-center justify-center w-full h-full px-4 py-2 my-auto text-center lg:px-0 bg-opacity-80 bg-primary-800 lg:py-56 dark:bg-neutral-950 dark:bg-opacity-60">
                <h1
                    class="max-w-screen-lg text-3xl font-extrabold leading-none tracking-normal text-secondary md:mb-4 md:text-4xl lg:text-6xl lg:max-w-screen-xl">
                    {{ $homeData->heading }}
                </h1>
                <p
                    class="max-w-screen-lg my-2 text-xs font-normal leading-tight text-gray-300 lg:px-4 lg:text-xl lg:leading-tight">
                    {{ strip_tags($homeData->deskripsi_app) }}
                </p>
            </div>
        </div>
        {{-- jumbotron / hero homepage end --}}

        {{-- section what we need start --}}
        <div class="bg-secondary dark:bg-neutral-900">
            <div class="mx-auto">
                <div class="lg:grid lg:grid-cols-2 lg:gap-2 xl:grid xl:grid-cols-2 xl:gap-2">
                    <div class="px-4 pb-12 md:px-6 lg:pl-7 xl:pl-40">
                        <h2 class="w-1/2 pt-12 text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary">
                            What We Need.
                        </h2>
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-2 md:gap-2 mt-7">
                            @foreach ($requirementData as $requirement)
                                <div
                                    class="block p-6 border bg-secondary border-abu-500 hover:bg-gray-100 dark:bg-transparent dark:border-neutral-800 dark:hover:bg-secondary text-primary-800 dark:text-secondary dark:hover:text-neutral-900 cursor-pointer">
                                    <p class="text-lg font-paragraf">
                                        {{ strip_tags($requirement->content) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="hidden pt-24 lg:block">
                        <div class="relative w-full h-full">
                            <img src="{{ asset('frontend/assets/img/illustration-image-discuss.webp') }}"
                                class="object-cover w-full h-full" width="100" height="100"
                                alt="Illustration Image Discussion">
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-primary-800 bg-opacity-80 dark:bg-neutral-950 dark:bg-opacity-60">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- section what we need end --}}

        {{-- section what you will get start --}}
        <div class="bg-abu-500 dark:bg-neutral-800">
            <div class="max-w-screen-xl mx-auto px-4 md:px-8">
                <h2 class="pt-16 text-4xl text-center md:text-5xl font-bold text-primary-800 dark:text-secondary">
                    What You Will Get.
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 pt-7 pb-16">
                    @foreach ($benefitData as $benefit)
                        <div
                            class="p-4 md:p-6 text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-slate-200 dark:text-secondary dark:hover:text-neutral-800 dark:bg-transparent dark:hover:bg-secondary dark:border-neutral-700 cursor-pointer">
                            <span class="overflow-hidden fa-4x">
                                <i class="{{ $benefit->fa_icon }}"></i>
                            </span>
                            <h3 class="xl:h-20 mt-2 text-xl md:text-2xl font-bold">
                                {{ $benefit->title }}
                            </h3>
                            <p class="text-sm font-normal text-paragraf">
                                {{ strip_tags($benefit->detail) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- section what you will get end --}}

        {{-- section do you know start --}}
        <div class="bg-secondary dark:bg-neutral-900">
            <div class="max-w-screen-xl mx-auto px-4 md:px-8">
                <h2 class="pt-16 text-4xl text-center md:text-5xl font-bold text-primary-800 dark:text-secondary">
                    Do You Know?
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 pt-7 pb-16">
                    <div
                        class="p-4 md:p-6 my-auto items-center text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-gray-100 dark:text-secondary dark:hover:text-neutral-900 dark:bg-transparent dark:hover:bg-secondary dark:border-neutral-800 cursor-pointer">
                        <h3 class="text-8xl font-bold text-center">
                            {{ $countDiterima ?? null }}
                        </h3>
                        <h4 class="text-2xl font-bold text-paragraf text-center min-h-16">
                            Total Peserta Magang
                        </h4>
                    </div>
                    <div
                        class="p-4 md:p-6 my-auto text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-gray-100 dark:text-secondary dark:hover:text-neutral-900 dark:bg-transparent dark:hover:bg-secondary dark:border-neutral-800 cursor-pointer">
                        <h3 class="text-8xl font-bold text-center">
                            {{ $countSelesai ?? null }}
                        </h3>
                        <h4 class="text-2xl font-bold text-paragraf text-center my-auto min-h-16">
                            Total Peserta Selesai
                        </h4>
                    </div>
                    <div
                        class="p-4 md:p-6 my-auto text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-gray-100 dark:text-secondary dark:hover:text-neutral-900 dark:bg-transparent dark:hover:bg-secondary dark:border-neutral-800 cursor-pointer">
                        <h3 class="text-8xl font-bold text-center">
                            {{ $countMentor ?? null }}
                        </h3>
                        <h4 class="text-2xl font-bold text-paragraf text-center my-auto min-h-16">
                            Mentor
                        </h4>
                    </div>
                    <div
                        class="p-4 md:p-6 my-auto text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-gray-100 dark:text-secondary dark:hover:text-neutral-900 dark:bg-transparent dark:hover:bg-secondary dark:border-neutral-800 cursor-pointer">
                        <h3 class="text-8xl font-bold text-center">
                            {{ $countOffice ?? null }}
                        </h3>
                        <h4 class="text-2xl font-bold text-paragraf text-center my-auto min-h-16">
                            Instansi
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        {{-- section do you know end --}}

        {{-- section internship journey start --}}
        <div class="bg-krem dark:bg-neutral-800">
            <div class="mx-auto">
                <div class="grid grid-cols-1 md:grid md:grid-cols-2">
                    <div class="hidden md:block relative w-full h-72 md:h-[720px]">
                        <img src="{{ asset('frontend/assets/img/illustration-image-discuss-2.webp') }}"
                            class="object-cover w-full h-full" width="100" height="100"
                            alt="Illustration Image Discussion SIGMA">
                        <div
                            class="absolute top-0 right-0 w-full h-full bg-primary-800 bg-opacity-80 dark:bg-neutral-950 dark:bg-opacity-60">
                        </div>
                    </div>

                    <div class="max-w-screen-sm">
                        <div class="flex flex-row md:flex-row-reverse px-4 md:px-6">
                            <h2
                                class="pt-12 text-start md:text-end w-1/2 text-4xl md:w-full md:text-5xl lg:w-1/2 font-bold text-primary-800 dark:text-secondary">
                                Internship Journey.
                            </h2>
                        </div>

                        <div id="accordion-open" class="pt-8" data-accordion="collapse"
                            data-active-classes="bg-gray-100 dark:bg-neutral-600 text-primary-800 dark:text-secondary">

                            @foreach ($journeyData as $item)
                                <h3 id="accordion-open-heading-{{ $item->id }}">
                                    <button type="button"
                                        class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-l-0 border-b-0 border-abu-500 dark:border-neutral-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3"
                                        data-accordion-target="#accordion-open-body-{{ $item->id }}"
                                        aria-expanded="true" aria-controls="accordion-open-body-{{ $item->id }}">
                                        <span class="text-2xl font-bold">{{ $item->title }}</span>
                                        <span class="-m-[20px] p-4">
                                            <i class="fa-solid fa-arrow-right fa-3x -rotate-45"></i>
                                        </span>
                                    </button>
                                </h3>
                                <div id="accordion-open-body-{{ $item->id }}" class="hidden"
                                    aria-labelledby="accordion-open-heading-{{ $item->id }}">
                                    <div
                                        class="p-5 border border-b-0 border-gray-200 dark:border-neutral-500 dark:bg-neutral-500">
                                        <p
                                            class="mb-2 text-primary-800 font-paragraf text-lg leading-tight dark:text-secondary">
                                            {{ strip_tags($item->detail) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- section internship journey end --}}

        {{-- more info start --}}
        <div class="bg-secondary dark:bg-neutral-900">
            <div class="max-w-screen-xl mx-auto py-24 px-4">
                <h2
                    class="text-4xl text-center md:text-5xl lg:text-6xl md:leading-tight font-bold text-primary-800 dark:text-secondary">
                    Butuh informasi lain seputar kegiatan Internship di Kabupaten Blitar?
                </h2>
                <p class="text-center mt-4 text-2xl md:text-3xl text-primary-800 dark:text-secondary">
                    Kunjungi <a class="font-bold hover:text-primary-500 dark:hover:text-abu-500"
                        href="{{ $homeData->instagram_link }}" target="_blank">Instagram</a>
                    dan <a class="font-bold hover:text-primary-500 dark:hover:text-abu-500"
                        href="{{ $homeData->youtube_link }}" target="_blank">YouTube</a>
                    Kami
                    ya!
                </p>
            </div>
        </div>
        {{-- more info end --}}

        {{-- section internlife video start --}}
        <div class="bg-abu-500 dark:bg-neutral-800">
            <div class="max-w-screen-xl mx-auto py-16">
                <div class="flex flex-col md:flex-col lg:flex-row justify-between items-center px-12">
                    <h2
                        class="text-center lg:text-start text-5xl md:text-6xl font-bold md:leading-12 text-primary-800 dark:text-secondary">
                        Take a Look at Our #internlife
                    </h2>
                    <div class="w-full h-full mt-8 md:w-2/3">
                        <iframe class="w-full h-80" width="560" height="315"
                            src="https://www.youtube.com/embed/{{ $homeData->id_video }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        {{-- section internlife video end --}}

@endsection
