@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-950">
        <div class="p-1 md:p-4 mt-14">
            @if (session('success'))
                <div id="toast-success"
                    class="fixed flex items-center w-full max-w-xs p-4 mb-4 text-primary-800 border border-gray-100 bg-white shadow-sm top-5 right-5 mt-[4.4rem] dark:text-secondary dark:bg-neutral-800 dark:border dark:border-neutral-700 z-50"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-transparent dark:text-green-500">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="sr-only">Check icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-dismiss-target="#toast-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="w-full">
                <div
                    class="bg-zinc-50 w-full min-h-screen border border-gray-100 dark:bg-neutral-900 dark:border-neutral-700">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary">
                            {{ $pageTitle }}
                        </h2>

                        <div class="mt-12 grid md:grid-cols-1 lg:grid-cols-3 w-full gap-4">

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.manageHomepage', $homepageUuid->uuid) }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            Homepage
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan konten pada halaman beranda.
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.manageHomepage', $homepageUuid->uuid) }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.managePosition') }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            Posisi Pekerjaan
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan konten pada halaman internship roles dan requirements.
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.managePosition') }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.managePublication') }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            Publikasi
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan konten pada halaman publikasi.
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.managePublication') }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.manageFaq') }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            FAQ Content
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan konten pada halaman beranda.
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.manageFaq') }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.manageOffice') }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            Instansi Magang
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan pilihan instansi tempat magang atau kantor.
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.manageOffice') }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.manageJourney') }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            Internship Journey
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan tahapan / step untuk dapat mulai mengikuti kegiatan magang.
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.manageJourney') }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.manageBenefit') }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            Benefits
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan benefits / keuntungan mengikuti kegiatan magang.
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.manageBenefit') }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.manageRequirement') }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            Requirement
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan requirement / kebutuhan calon peserta mengikuti kegiatan magang.
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.manageRequirement') }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                            <div
                                class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="min-h-16 w-full">
                                    <a href="{{ route('admin.manageRequirement') }}">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                            Terms & Condition
                                        </h5>
                                    </a>
                                </div>
                                <div class="min-h-20 w-full mb-4">
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Pengaturan konten mengenai syarat dan ketentuan pengguna
                                    </p>
                                </div>

                                <div class="flex flex-col items-start">
                                    <a href="{{ route('admin.manageTerms', Crypt::encryptString($termsId->id)) }}"
                                        class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                        Content</a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
