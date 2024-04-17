@extends('frontend.layouts.app')

@section('content')
    <div class="mt-[4.4rem] relative w-full h-96">
        <img src="{{ asset('frontend/assets/img/illustration-image-discuss-2.webp') }}" class="object-cover w-full h-full"
            alt="Illustration Image Discussion">
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
                                    class="ms-1 text-lg font-bold w-full text-secondary overflow-hidden line-clamp-2 hover:text-white md:ms-2 dark:text-abu-500 dark:hover:text-secondary">
                                    {{ $pageTitle }}
                                </a>
                            </div>
                        </li>
                    </ol>
                </nav>
                {{-- breadcrums end --}}

                <div class="pb-20">
                    <h1 class="font-bold text-4xl text-start text-secondary overflow-hidden line-clamp-2">Judul Publikasi
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo voluptatem maiores sunt.</h1>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-secondary dark:bg-neutral-950">
        <div class="px-4 max-w-screen-xl mx-auto bg-secondary dark:bg-neutral-950 xl:min-h-screen">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <div class="col-span-2">
                    @foreach ($publikasiData as $data)
                        <div class="py-4 md:py-12 md:pr-12">
                            <div
                                class="hidden md:block text-2xl md:text-4xl font-bold text-primary-800 text-start leading-6 md:leading-9 dark:text-secondary">
                                <h2>
                                    {{ $data->judul }}
                                </h2>
                            </div>
                            <div
                                class="text-primary-800 text-justify leading-tight pt-8 text-balance text-md md:text-2xl font-paragraf dark:text-secondary">
                                {{ $data->content }}
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="flex flex-col gap-4 mb-20">
                    <h3 class="pt-12 pb-4 text-3xl font-bold text-primary-800 text-start leading-9 dark:text-secondary">
                        Publikasi Lainnya
                    </h3>

                    @foreach ($publikasiAll as $data)
                        <a href="{{ route('frontend.publikasiDetail', $data->slug) }}"
                            class="flex flex-col items-center bg-transparent border border-abu-500 md:flex-row hover:bg-gray-100 dark:bg-neutral-900 dark:border-neutral-800 dark:hover:bg-secondary">
                            <div class="relative w-1/3 h-44 lg:h-full">
                                <img src="{{ asset('frontend/assets/img/illustration-image-discuss.webp') }}"
                                    class="object-cover w-full h-full" alt="Illustration Image Discussion">
                                <div
                                    class="absolute top-0 left-0 w-full h-full bg-primary-800 bg-opacity-40 transition-transform duration-1000 hover:bg-opacity-40 dark:bg-neutral-950 dark:bg-opacity-60">
                                </div>
                            </div>
                            <div
                                class="flex flex-col justify-between w-2/3 p-6 leading-normal text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-neutral-900">
                                <h5 class="text-2xl font-bold tracking-tight leading-7 overflow-hidden line-clamp-3">
                                    {{ $data->judul }}
                                </h5>
                            </div>
                        </a>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection
