@extends('frontend.layouts.app')

@section('content')
    <section class="bg-secondary dark:bg-neutral-950">
        <div class="mt-[4.4rem] max-w-screen-xl mx-auto px-4 xl:min-h-screen">
            {{-- breadcrums start --}}
            <nav class="flex py-8 md:px-4" aria-label="Breadcrumb">
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
                                class="ms-1 text-lg font-bold text-primary-800 hover:text-primary-500 md:ms-2 dark:text-abu-500 dark:hover:text-secondary">
                                <h1>
                                    {{ $pageTitle }}
                                </h1>
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
            {{-- breadcrums end --}}

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pb-12 md:px-4">
                @foreach ($publikasiData as $data)
                    <div
                        class="w-full h-full bg-secondary border border-abu-500 dark:bg-neutral-900 dark:border-neutral-800">
                        <a href="{{ route('frontend.publikasiDetail', $data->slug) }}">
                            <div class="relative w-full h-44">
                                <img src="{{ $data->gambar ? asset('storage/img/' . $data->gambar) : asset('frontend/assets/img/logo-sigma-single.png') }}"
                                    class="object-cover w-full h-full" alt="Illustration Image Discussion">
                                <div
                                    class="absolute top-0 left-0 w-full h-full bg-primary-800 bg-opacity-80 transition-transform duration-1000 hover:bg-opacity-40 dark:bg-neutral-950 dark:bg-opacity-60">
                                </div>
                            </div>
                        </a>
                        <div class="p-5">
                            <a href="{{ route('frontend.publikasiDetail', $data->slug) }}">
                                <h2
                                    class="mb-2 text-2xl font-bold h-15 tracking-tight text-primary-800 hover:text-primary-500 overflow-hidden line-clamp-2 dark:text-white">
                                    {{ $data->judul }}
                                </h2>
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="mt-8">
                    {{ $publikasiData->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
