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
                                class="ms-1 text-lg font-bold text-primary-800 hover:text-primary-500 md:ms-2 dark:text-abu-500 dark:hover:text-secondary">{{ $pageTitle }}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
            {{-- breadcrums end --}}

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pb-12">

                <a href="{{ route('frontend.roleDetail') }}"
                    class="block w-full px-6 py-12 text-primary-800 shadow-sm bg-transparent border border-abu-500 hover:bg-abu-500 dark:bg-neutral-900 dark:border-neutral-800 dark:hover:bg-abu-500 dark:text-secondary dark:hover:text-neutral-800">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight">
                        Developer
                    </h5>
                    <p class="font-normal">
                        Front End, Back End, Document Engineer, Quality Assurance (Web/Mobile for iOS/Android)
                    </p>
                </a>


                <a href="#"
                    class="block w-full px-6 py-12 text-primary-800 shadow-sm bg-transparent border border-abu-500 hover:bg-abu-500 dark:bg-neutral-900 dark:border-neutral-800 dark:hover:bg-abu-500 dark:text-secondary dark:hover:text-neutral-800">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight">Engineer</h5>
                    <p class="font-normal">Internet of Things, IT Security, Network
                    </p>
                </a>


                <a href="#"
                    class="block w-full px-6 py-12 text-primary-800 shadow-sm bg-transparent border border-abu-500 hover:bg-abu-500 dark:bg-neutral-900 dark:border-neutral-800 dark:hover:bg-abu-500 dark:text-secondary dark:hover:text-neutral-800">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight">
                        General
                    </h5>
                    <p class="font-normal">Administrative and Operation, Public
                        Relation,
                        Partnership Management, Event Management</p>
                </a>

                <a href="#"
                    class="block w-full px-6 py-12 text-primary-800 shadow-sm bg-transparent border border-abu-500 hover:bg-abu-500 dark:bg-neutral-900 dark:border-neutral-800 dark:hover:bg-abu-500 dark:text-secondary dark:hover:text-neutral-800">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight">
                        Broadcasting
                    </h5>
                    <p class="font-normal">Camera Person, Sound Engineer, Presenter,
                        Script
                        Writer</p>
                </a>


            </div>
        </div>
    </section>
@endsection
