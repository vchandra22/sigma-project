@extends('frontend.layouts.app')

@section('content')
    <section class="bg-secondary dark:bg-neutral-900">
        <div class="mt-[4.4rem] max-w-screen-xl mx-auto px-4">
            {{-- breadcrums start --}}
            <nav class="flex px-4 py-8" aria-label="Breadcrumb">
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
                            <a href="{{ route('frontend.roleDetail') }}"
                                class="ms-1 text-lg font-bold text-primary-800 hover:text-primary-500 md:ms-2 dark:text-abu-500 dark:hover:text-secondary">{{ $pageTitle }}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
            {{-- breadcrums end --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 px-4 pb-12">
                <div class="relative w-full h-full dark:border dark:border-neutral-800">
                    <img src="{{ asset('frontend/assets/img/illustration-image-role-developer.webp') }}"
                        class="object-cover w-full h-full" alt="Illustration Image Developer">
                    <div
                        class="absolute top-0 right-0 w-full h-full bg-primary-800 bg-opacity-20 dark:bg-neutral-900 dark:bg-opacity-60">
                    </div>
                </div>
                <div class="grid grid-cols-1 content-between border border-l border-abu-500 dark:border-neutral-800">
                    <h2
                        class="p-6 text-3xl text-start border border-abu-500 md:text-4xl font-bold text-primary-800 dark:text-secondary dark:border-neutral-800">
                        Developer
                    </h2>
                    <h3 class="p-6 text-xl font-paragraf text-primary-800 dark:text-secondary">Job Description:</h3>
                    <ol
                        class="pl-12 pr-4 w-full space-y-2 font-paragraf text-xl leading-5 text-primary-800 list-decimal list-outside dark:text-secondary">
                        <li>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe dolores suscipit facilis eligendi
                            illo unde quis cupiditate quaerat vero distinctio repellat explicabo cumque nulla eius ad.
                        </li>
                        <li>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis sapiente porro ullam
                            aspernatur sunt doloremque ipsa fuga, quaerat, natus qui nesciunt, sit facere quam impedit
                            molestias quod! Provident sit exercitationem ad quaerat.
                        </li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit dicta repellendus, ut beatae
                            animi esse! Mollitia tenetur natus et explicabo! Eum quos corrupti ut!</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat corporis sunt eaque maxime
                            quis. Cum nulla quae dolore doloremque provident possimus quia quos dignissimos. Voluptates,
                            magni.</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi, reiciendis porro nulla suscipit
                            adipisci beatae, exercitationem libero deleniti placeat quaerat cum, labore ut vero impedit
                            inventore sunt pariatur rerum!</li>
                        <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus doloribus, labore sit adipisci
                            hic minus omnis similique dicta quaerat culpa?</li>
                    </ol>
                    <h3 class="mt-5 p-6 text-2xl font-bold text-primary-800 border border-t border-abu-500 dark:text-secondary dark:border-neutral-800">Skill yang diperlukan: Memahami bahasa pemograman seperti Java Script, React JS, Node JS, dll</h3>
                </div>
            </div>
        </div>
    </section>
@endsection
