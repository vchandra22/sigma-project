@extends('frontend.layouts.app')

@section('meta')
    <meta name="description" content="{{ $publikasiData->meta_description }}">
    <meta name="keywords" content="{{ $publikasiData->meta_keywords }}">

    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:type" content="Internship">
    <meta property="og:title" content="{{ $publikasiData->meta_title }}">
    <meta property="og:description" content="{{ $publikasiData->meta_description }}">
    <meta property="og:image" content="{{ getImageFile($publikasiData->og_image) }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta property="og:site_name" content="{{ get_app_name() }}">

    <!-- Twitter Card meta tags for Twitter sharing -->
    <meta name="twitter:card" content="Internship">
    <meta name="twitter:title" content="{{ $publikasiData->meta_title }}">
    <meta name="twitter:description" content="{{ $publikasiData->meta_description }}">
    <meta name="twitter:image" content="{{ getImageFile($publikasiData->og_image) }}">
@endsection

@section('content')
    <div class="mt-[4.4rem] relative w-full h-96">
        <img src="{{ $publikasiData->gambar ? asset('storage/img/' . $publikasiData->gambar) : asset('frontend/assets/img/sigma-logo-full.png') }}"
            class="object-cover w-full h-full" width="100" height="100" alt="{{ $publikasiData->judul }}">
        <div
            class="absolute top-0 right-0 w-full h-full bg-primary-800 bg-opacity-80 dark:bg-neutral-950 dark:bg-opacity-60">
            <div class="max-w-screen-xl px-4 mx-auto text-start grid grid-cols-1 content-between h-full">
                {{-- breadcrums start --}}
                <nav class="flex py-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-4">
                        <li class="inline-flex items-center">
                            <a href="{{ url('/') }}"
                                class="inline-flex items-center text-lg font-normal text-abu-800 hover:text-secondary dark:text-abu-800 dark:hover:text-secondary">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <div class="flex items-start">
                                <i class="fa-solid fa-chevron-right w-5 h-3 text-abu-800 pt-1"></i>
                                <a href="{{ route('frontend.publikasiList') }}"
                                    class="ms-1 text-lg font-normal text-abu-800 hover:text-white md:ms-2 dark:text-abu-800 dark:hover:text-secondary">
                                    Publikasi
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-start">
                                <i class="fa-solid fa-chevron-right w-5 h-3 text-secondary pt-1"></i>
                                <a href="{{ url()->current() }}"
                                    class="ms-1 text-lg font-bold w-full text-secondary overflow-hidden line-clamp-1 hover:text-white md:ms-2 dark:text-abu-500 dark:hover:text-secondary">
                                    @php
                                        $content = $publikasiData->judul;
                                        $strippedContent = strip_tags($content);
                                        $limitedContent = \Illuminate\Support\Str::limit($strippedContent, 80);
                                    @endphp
                                    {{ $limitedContent }}
                                </a>
                            </div>
                        </li>
                    </ol>
                </nav>
                {{-- breadcrums end --}}

                <div class="pb-20">
                    <h1 class="font-bold text-4xl text-start text-secondary overflow-hidden line-clamp-2">
                        {{ $publikasiData->judul }}
                    </h1>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-secondary dark:bg-neutral-950">
        <div class="px-4 max-w-screen-xl mx-auto bg-secondary dark:bg-neutral-950 xl:min-h-screen">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <div class="col-span-2">
                    <div class="py-4 md:py-12 md:pr-12">
                        <div
                            class="block text-2xl md:text-4xl font-bold text-primary-800 text-start leading-7 md:leading-10 dark:text-secondary">
                            <h2>
                                {{ $publikasiData->judul }}
                            </h2>
                            <div class="my-8 w-full">
                                <img src="{{ $publikasiData->gambar ? asset('storage/img/' . $publikasiData->gambar) : asset('frontend/assets/img/sigma-logo-full.png') }}"
                                    class="object-cover w-full h-full" width="100" height="100"
                                    alt="{{ $publikasiData->judul }}">
                            </div>
                        </div>
                        <article class="prose lg:prose-xl dark:prose-invert">
                            {!! $publikasiData->content !!}
                        </article>
                    </div>
                </div>

                <div class="flex flex-col gap-4 mb-20">
                    <h3 class="pt-12 pb-4 text-3xl font-bold text-primary-800 text-start leading-9 dark:text-secondary">
                        Publikasi Lainnya
                    </h3>

                    @forelse ($publikasiAll as $data)
                        <a href="{{ route('frontend.publikasiDetail', $data->slug) }}"
                            class="flex flex-col items-center bg-transparent border border-abu-500 md:flex-row hover:bg-gray-100 dark:bg-neutral-900 dark:border-neutral-800 dark:hover:bg-secondary">
                            <div class="relative w-full h-32 md:w-1/3 md:h-44 lg:h-full">
                                <img src="{{ $data->gambar ? asset('storage/img/' . $data->gambar) : asset('frontend/assets/img/sigma-logo-full.png') }}"
                                    class="object-cover w-full h-full" width="100" height="100"
                                    alt="{{ $data->judul }}">
                                <div
                                    class="absolute top-0 left-0 w-full h-full bg-primary-800 bg-opacity-40 transition-transform duration-1000 hover:bg-opacity-40 dark:bg-neutral-950 dark:bg-opacity-60">
                                </div>
                            </div>
                            <div
                                class="flex flex-col justify-between md:w-2/3 p-6 leading-normal text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-neutral-900">
                                <p
                                    class="text-2xl font-bold text-start tracking-tight leading-7 overflow-hidden line-clamp-3">
                                    {{ strip_tags($data->judul) }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <p>Tidak ada data publikasi lain</p>
                    @endforelse
                    <div class="mt-8">
                        {{ $publikasiAll->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
