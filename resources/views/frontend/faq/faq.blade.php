@extends('frontend.layouts.app')

@section('content')
    <section class="bg-secondary dark:bg-neutral-900">
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
                                class="ms-1 text-lg font-bold text-primary-800 hover:text-primary-500 md:ms-2 dark:text-abu-500 dark:hover:text-secondary">{{ $pageTitle }}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
            {{-- breadcrums end --}}

            <div class="max-w-screen-xl mx-auto pb-16">
                <h1 class="pt-8 text-4xl md:text-6xl text-center font-bold text-primary-800 leading-none dark:text-secondary">Halo, ada yang bisa dibantu?</h1>
                <p class="text-center font-paragraf text-md md:text-2xl text-primary-800 dark:text-secondary">Tidak menemukan jawaban?
                    Klik
                    <a href="#" class="text-primary-800 font-bold hover:text-primary-500 dark:text-secondary dark:hover:text-abu-800">
                        disini
                    </a>
                    untuk bertanya lebih lanjut.
                </p>
                <div class="mt-12 flex flex-col " id="accordion-open" data-accordion="collapse" data-active-classes="bg-gray-100 dark:bg-neutral-600 text-primary-800 dark:text-secondary">
                        
                    <div class="w-full">
                        <h3 id="accordion-open-heading-1">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-b-0 border-abu-500 dark:border-neutral-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">
                                <span class="text-2xl font-bold">Registration</span>
                                <span class="-m-[20px] p-4">
                                    <i class="fa-solid fa-arrow-right fa-3x -rotate-45"></i>
                                </span>
                            </button>
                        </h3>
                        <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-neutral-500 dark:bg-neutral-500">
                                <p class="mb-2 text-primary-800 font-paragraf text-lg leading-tight dark:text-secondary">
                                    Kamu harus melakukan pendaftaran Internship dengan melengkapi form pendaftaran pada menu “Register”
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <h3 id="accordion-open-heading-2">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-b-0 border-abu-500 dark:border-neutral-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-2" aria-expanded="false" aria-controls="accordion-open-body-2">
                                <span class="text-2xl font-bold">Administration</span>
                                <span class="-m-[20px] p-4">
                                    <i class="fa-solid fa-arrow-right fa-3x -rotate-45"></i>
                                </span>
                            </button>
                        </h3>
                        <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-neutral-500 dark:bg-neutral-500">
                                <p class="mb-2 text-primary-800 font-paragraf text-lg leading-tight dark:text-secondary">
                                    Kamu harus melakukan pendaftaran Internship dengan melengkapi form pendaftaran pada menu “Register”
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <h3 id="accordion-open-heading-3">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-b-0 border-abu-500 dark:border-neutral-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-3" aria-expanded="false" aria-controls="accordion-open-body-3">
                                <span class="text-2xl font-bold">Review</span>
                                <span class="-m-[20px] p-4">
                                    <i class="fa-solid fa-arrow-right fa-3x -rotate-45"></i>
                                </span>
                            </button>
                        </h3>
                        <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-neutral-500 dark:bg-neutral-500">
                                <p class="mb-2 text-primary-800 font-paragraf text-lg leading-tight dark:text-secondary">
                                    Kamu harus melakukan pendaftaran Internship dengan melengkapi form pendaftaran pada menu “Register”
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <h3 id="accordion-open-heading-4">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-b-0 border-abu-500 dark:border-neutral-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-4" aria-expanded="false" aria-controls="accordion-open-body-4">
                                <span class="text-2xl font-bold">On Job</span>
                                <span class="-m-[20px] p-4">
                                    <i class="fa-solid fa-arrow-right fa-3x -rotate-45"></i>
                                </span>
                            </button>
                        </h3>
                        <div id="accordion-open-body-4" class="hidden" aria-labelledby="accordion-open-heading-4">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-neutral-500 dark:bg-neutral-500">
                                <p class="mb-2 text-primary-800 font-paragraf text-lg leading-tight dark:text-secondary">
                                    Kamu harus melakukan pendaftaran Internship dengan melengkapi form pendaftaran pada menu “Register”
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <h3 id="accordion-open-heading-5">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-b-0 border-abu-500 dark:border-neutral-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-5" aria-expanded="false" aria-controls="accordion-open-body-5">
                                <span class="text-2xl font-bold">Graduate</span>
                                <span class="-m-[20px] p-4">
                                    <i class="fa-solid fa-arrow-right fa-3x -rotate-45"></i>
                                </span>
                            </button>
                        </h3>
                        <div id="accordion-open-body-5" class="hidden" aria-labelledby="accordion-open-heading-5">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-neutral-500 dark:bg-neutral-500">
                                <p class="mb-2 text-primary-800 font-paragraf text-lg leading-tight dark:text-secondary">
                                    Kamu harus melakukan pendaftaran Internship dengan melengkapi form pendaftaran pada menu “Register”
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

        </div>
    </section>
@endsection
