@extends('frontend.layouts.app')

@section('meta')
    <meta name="description" content="{{ $positionData->meta_description }}">
    <meta name="keywords" content="{{ $positionData->meta_keywords }}">

    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:type" content="Internship">
    <meta property="og:title" content="{{ $positionData->meta_title }}">
    <meta property="og:description" content="{{ $positionData->meta_description }}">
    <meta property="og:image" content="{{ getImageFile($positionData->og_image) }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta property="og:site_name" content="{{ get_app_name() }}">

    <!-- Twitter Card meta tags for Twitter sharing -->
    <meta name="twitter:card" content="Internship">
    <meta name="twitter:title" content="{{ $positionData->meta_title }}">
    <meta name="twitter:description" content="{{ $positionData->meta_description }}">
    <meta name="twitter:image" content="{{ getImageFile($positionData->og_image) }}">
@endsection

@section('content')
    <section class="bg-secondary dark:bg-neutral-950">
        <div class="mt-[4.4rem] max-w-screen-xl mx-auto px-4 xl:min-h-screen">
            {{-- breadcrums start --}}
            <nav class="flex py-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-4">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center text-lg font-normal text-abu-800 hover:text-primary-500 dark:text-abu-800 dark:hover:text-secondary">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-start">
                            <i class="fa-solid fa-chevron-right w-5 h-3 text-abu-800 pt-1"></i>
                            <a href="{{ route('frontend.roleList') }}"
                                class="ms-1 items-center overflow-hidden line-clamp-1 text-lg font-normal text-abu-800 hover:text-primary-500 dark:text-abu-800 dark:hover:text-secondary">
                                Posisi Pekerjaan
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-start">
                            <i class="fa-solid fa-chevron-right w-5 h-3 text-abu-800 pt-1"></i>

                            <a href="{{ url()->current() }}"
                                class="ms-1 text-lg font-bold text-primary-800 hover:text-primary-500 md:ms-2 dark:text-abu-500 dark:hover:text-secondary">
                                {{ $positionData->role }}
                            </a>

                        </div>
                    </li>
                </ol>
            </nav>
            {{-- breadcrums end --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 pb-12">

                <div class="relative w-full h-full dark:border dark:border-neutral-900">
                    <img src="{{ $positionData->gambar ? asset('storage/img/' . $positionData->gambar) : asset('frontend/assets/img/sigma-logo-full.png') }}"
                        class="object-cover w-full h-full" width="100" height="100" title="{{ $pageTitle }}"
                        alt="Gambar ilustrasi posisi {{ $pageTitle }}">
                    <div
                        class="absolute top-0 right-0 w-full h-full bg-primary-800 bg-opacity-20 dark:bg-neutral-900 dark:bg-opacity-60">
                    </div>
                </div>
                <div class="grid grid-cols-1 content-between border border-l border-abu-500 dark:border-neutral-800">
                    <h1 class="hidden">Lowongan Magang {{ $positionData->role }}</h1>
                    <h2
                        class="p-6 text-3xl text-start border border-abu-500 md:text-4xl font-bold text-primary-800 dark:text-secondary dark:border-neutral-800">
                        {{ $positionData->role }}
                    </h2>
                    <p class="p-6 text-xl font-paragraf text-primary-800 dark:text-secondary">Job Description:</p>
                    <div
                        class="pl-12 pr-4 w-full space-y-2 font-paragraf text-xl leading-7 text-primary-800 list-decimal list-outside dark:text-secondary">
                        {!! str_replace('<ol>', '<ol class="list-decimal pl-5">', $positionData->jobdesk) !!}
                    </div>
                    <h3
                        class="mt-5 p-6 text-2xl font-bold text-primary-800 border border-t border-abu-500 dark:text-secondary dark:border-neutral-800">
                        Skill yang diperlukan: {{ $positionData->requirement }}
                    </h3>
                </div>
            </div>
        </div>
    </section>
@endsection
