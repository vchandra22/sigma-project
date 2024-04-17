@extends('frontend.layouts.app')

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
                                class="ms-1 items-center text-lg font-normal text-abu-800 hover:text-primary-500 dark:text-abu-800 dark:hover:text-secondary">Internship
                                Role
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-start">
                            <i class="fa-solid fa-chevron-right w-5 h-3 text-abu-800 pt-1"></i>
                            <a href="{{ url()->current() }}"
                                class="ms-1 text-lg font-bold text-primary-800 hover:text-primary-500 md:ms-2 dark:text-abu-500 dark:hover:text-secondary">
                                {{ $pageTitle }}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
            {{-- breadcrums end --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 pb-12">
                <div class="relative w-full h-full dark:border dark:border-neutral-900">
                    <img src="{{ asset('frontend/assets/img/illustration-image-role-developer.webp') }}"
                        class="object-cover w-full h-full" width="100" height="100" title="{{ $pageTitle }}"
                        alt="Gambar ilustrasi posisi {{ $pageTitle }}">
                    <div
                        class="absolute top-0 right-0 w-full h-full bg-primary-800 bg-opacity-20 dark:bg-neutral-900 dark:bg-opacity-60">
                    </div>
                </div>
                <div class="grid grid-cols-1 content-between border border-l border-abu-500 dark:border-neutral-800">
                    @foreach ($positionData as $data)
                        <h1 class="hidden">Lowongan Magang {{ $data->role }}</h1>
                        <h2
                            class="p-6 text-3xl text-start border border-abu-500 md:text-4xl font-bold text-primary-800 dark:text-secondary dark:border-neutral-800">
                            {{ $data->role }}
                        </h2>
                        <p class="p-6 text-xl font-paragraf text-primary-800 dark:text-secondary">Job Description:</p>
                        <ol
                            class="pl-12 pr-4 w-full space-y-2 font-paragraf text-xl leading-5 text-primary-800 list-decimal list-outside dark:text-secondary">
                            {{ $data->jobdesk }}
                        </ol>
                        <h3
                            class="mt-5 p-6 text-2xl font-bold text-primary-800 border border-t border-abu-500 dark:text-secondary dark:border-neutral-800">
                            Skill yang diperlukan: {{ $data->requirement }}
                        </h3>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
