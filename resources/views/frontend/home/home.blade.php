@extends('frontend.layouts.app')

@section('content')
    {{-- jumbotron / hero homepage start --}}
    <div class="mt-[4.4rem] mx-auto h-96 md:h-full relative">
        <img src="{{ asset('frontend/assets/img/default-hero-image.webp') }}" class="object-cover w-full h-full"
            alt="Hero Image SIGMA">
        <div
            class="absolute top-0 flex flex-col items-center justify-center w-full h-full px-4 py-2 my-auto text-center lg:px-0 bg-opacity-80 bg-primary-800 lg:py-56 dark:bg-neutral-950 dark:bg-opacity-60">
            <h1
                class="max-w-screen-lg text-3xl font-extrabold leading-none tracking-normal text-secondary md:mb-4 md:text-4xl lg:text-6xl lg:max-w-screen-xl">
                Sistem Informasi Kegiatan Magang
            </h1>
            <p class="max-w-screen-lg my-2 text-xs font-normal leading-tight text-gray-300 lg:px-4 lg:text-xl lg:leading-tight">
                Temukan kesempatan magang yang sesuai dengan minat dan bakat Anda, ikuti proyek-proyek yang menarik, dan
                terhubunglah dengan profesional berpengalaman untuk memperluas jaringan dan pengalaman Anda. Mari
                bersama-sama membangun masa depan. Siap untuk menjadi bagian dari perubahan?
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
                        <div
                            class="block p-6 border bg-secondary border-abu-500 hover:bg-gray-100 dark:bg-transparent dark:border-secondary dark:hover:bg-secondary text-primary-800 dark:text-secondary dark:hover:text-neutral-900 cursor-pointer">
                            <p class="text-lg font-paragraf">
                                Mahasiswa aktif S1 (min.semester 6) atau D3 (min. semester 4) serta siswa siswi SMK
                            </p>
                        </div>
                        <div
                            class="block p-6 border bg-secondary border-abu-500 hover:bg-gray-100 dark:bg-transparent dark:border-secondary
                            dark:hover:bg-secondary text-primary-800 dark:text-secondary dark:hover:text-neutral-900 cursor-pointer">
                            <p class="text-lg font-paragraf">
                                Berkomitmen kerja penuh waktu (Senin-Jum’at dari 07.00 - 15.00) selama periode internship
                            </p>
                        </div>
                        <div
                            class="block p-6 border bg-secondary border-abu-500 hover:bg-gray-100 dark:bg-transparent dark:border-secondary
                            dark:hover:bg-secondary text-primary-800 dark:text-secondary dark:hover:text-neutral-900 cursor-pointer">
                            <p class="text-lg font-paragraf">
                                Mampu berkomunikasi dengan baik serta dapat bekerja dalam tim maupun mandiri
                            </p>
                        </div>
                        <div
                            class="block p-6 border bg-secondary border-abu-500 hover:bg-gray-100 dark:bg-transparent dark:border-secondary dark:hover:bg-secondary text-primary-800 dark:text-secondary dark:hover:text-neutral-900 cursor-pointer">
                            <p class="text-lg font-paragraf">
                                Mentaati seluruh peraturan yang telah ditetapkan
                            </p>
                        </div>
                    </div>
                </div>
                <div class="hidden pt-24 lg:block">
                    <div class="relative w-full h-full">
                        <img src="{{ asset('frontend/assets/img/illustration-image-discuss.webp') }}"
                            class="object-cover w-full h-full" alt="Illustration Image Discussion">
                        <div class="absolute top-0 left-0 w-full h-full bg-primary-800 bg-opacity-80 dark:bg-neutral-950 dark:bg-opacity-60"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- section what we need end --}}

    {{-- section what you will get start --}}
    <div class="bg-abu-500 dark:bg-neutral-800">
        <div class="max-w-screen-xl mx-auto px-4 md:px-6">
            <h2 class="pt-16 text-4xl text-center md:text-5xl font-bold text-primary-800 dark:text-secondary">
                What You Will Get.
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 pt-7 pb-16">
                <div
                    class="p-4 md:p-6 text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-slate-200 dark:text-secondary dark:hover:text-neutral-800 dark:bg-transparent dark:hover:bg-secondary dark:border-secondary cursor-pointer">
                    <span class="overflow-hidden fa-4x">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <h3 class="xl:h-20 mt-2 text-xl md:text-2xl font-bold">
                        Experience in Reputable Services
                    </h3>
                    <p class="text-sm font-normal text-paragraf">
                        Pengalaman internship di instansi terkemuka sebagai gerbang karir.</p>
                </div>
                <div
                    class="p-4 md:p-6 text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-slate-200 dark:text-secondary dark:hover:text-neutral-800 dark:bg-transparent dark:hover:bg-secondary dark:border-secondary cursor-pointer">
                    <span class="overflow-hidden fa-4x">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <h3 class="xl:h-20 mt-2 text-xl md:text-2xl font-bold">
                        Experience in Reputable Services
                    </h3>
                    <p class="text-sm font-normal text-paragraf">
                        Pengalaman internship di instansi terkemuka sebagai gerbang karir.</p>
                </div>
                <div
                    class="p-4 md:p-6 text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-slate-200 dark:text-secondary dark:hover:text-neutral-800 dark:bg-transparent dark:hover:bg-secondary dark:border-secondary cursor-pointer">
                    <span class="overflow-hidden fa-4x">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <h3 class="xl:h-20 mt-2 text-xl md:text-2xl font-bold">
                        Experience in Reputable Services
                    </h3>
                    <p class="text-sm font-normal text-paragraf">
                        Pengalaman internship di instansi terkemuka sebagai gerbang karir.</p>
                </div>
                <div
                    class="p-4 md:p-6 text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-slate-200 dark:text-secondary dark:hover:text-neutral-800 dark:bg-transparent dark:hover:bg-secondary dark:border-secondary cursor-pointer">
                    <span class="overflow-hidden fa-4x">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <h3 class="xl:h-20 mt-2 text-xl md:text-2xl font-bold">
                        Experience in Reputable Services
                    </h3>
                    <p class="text-sm font-normal text-paragraf">
                        Pengalaman internship di instansi terkemuka sebagai gerbang karir.</p>
                </div>
            </div>
        </div>
    </div>
    {{-- section what you will get end --}}

    {{-- section do you know start --}}
    <div class="bg-secondary dark:bg-neutral-900">
        <div class="max-w-screen-xl mx-auto px-4 md:px-6">
            <h2 class="pt-16 text-4xl text-center md:text-5xl font-bold text-primary-800 dark:text-secondary">
                Do You Know?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 pt-7 pb-16">
                <div
                    class="p-4 md:p-6 my-auto items-center text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-gray-100 dark:text-secondary dark:hover:text-neutral-900 dark:bg-transparent dark:hover:bg-secondary dark:border-secondary cursor-pointer">
                    <h3 class="text-8xl font-bold text-center">
                        116
                    </h3>
                    <h4 class="text-2xl font-bold text-paragraf text-center min-h-16">
                        Total Peserta Magang
                    </h4>
                </div>
                <div
                    class="p-4 md:p-6 my-auto text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-gray-100 dark:text-secondary dark:hover:text-neutral-900 dark:bg-transparent dark:hover:bg-secondary dark:border-secondary cursor-pointer">
                    <h3 class="text-8xl font-bold text-center">
                        19
                    </h3>
                    <h4 class="text-2xl font-bold text-paragraf text-center my-auto min-h-16">
                        Total Peserta Selesai
                    </h4>
                </div>
                <div
                    class="p-4 md:p-6 my-auto text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-gray-100 dark:text-secondary dark:hover:text-neutral-900 dark:bg-transparent dark:hover:bg-secondary dark:border-secondary cursor-pointer">
                    <h3 class="text-8xl font-bold text-center">
                        11
                    </h3>
                    <h4 class="text-2xl font-bold text-paragraf text-center my-auto min-h-16">
                        Mentor
                    </h4>
                </div>
                <div
                    class="p-4 md:p-6 my-auto text-center border bg-transparent border-primary-800 text-primary-800 hover:bg-gray-100 dark:text-secondary dark:hover:text-neutral-900 dark:bg-transparent dark:hover:bg-secondary dark:border-secondary cursor-pointer">
                    <h3 class="text-8xl font-bold text-center">
                        4
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
                        class="object-cover w-full h-full" alt="Illustration Image Discussion">
                    <div class="absolute top-0 right-0 w-full h-full bg-primary-800 bg-opacity-80 dark:bg-neutral-950 dark:bg-opacity-60"></div>
                </div>

                <div>
                    <div class="flex flex-row md:flex-row-reverse px-4 md:px-6">
                        <h2 class="pt-12 text-start md:text-end w-1/2 text-4xl md:w-full md:text-5xl lg:w-1/2 font-bold text-primary-800 dark:text-secondary">
                            Internship Journey.
                        </h2>
                    </div>

                    <div id="accordion-open" class="pt-8" data-accordion="collapse" data-active-classes="bg-gray-100 dark:bg-neutral-600 text-primary-800 dark:text-secondary">
                        <h3 id="accordion-open-heading-1">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-l-0 border-b-0 border-abu-500 dark:border-gray-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">
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

                        <h3 id="accordion-open-heading-2">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-l-0 border-b-0 border-abu-500 dark:border-gray-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-2" aria-expanded="false" aria-controls="accordion-open-body-2">
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

                        <h3 id="accordion-open-heading-3">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-l-0 border-b-0 border-abu-500 dark:border-gray-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-3" aria-expanded="false" aria-controls="accordion-open-body-3">
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

                        <h3 id="accordion-open-heading-4">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-l-0 border-b-0 border-abu-500 dark:border-gray-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-4" aria-expanded="false" aria-controls="accordion-open-body-4">
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

                        <h3 id="accordion-open-heading-5">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-300 bg-transparent border border-l-0 border-b-0 border-abu-500 dark:border-gray-700 dark:text-secondary hover:bg-gray-100 dark:hover:bg-neutral-600 gap-3" data-accordion-target="#accordion-open-body-5" aria-expanded="false" aria-controls="accordion-open-body-5">
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
    </div>
    {{-- section internship journey end --}}

    {{-- more info start --}}
    <div class="bg-secondary dark:bg-neutral-900">
        <div class="max-w-screen-xl mx-auto py-24 px-4">
            <h2 class="text-4xl text-center md:text-5xl lg:text-6xl md:leading-tight font-bold text-primary-800 dark:text-secondary">
                Butuh informasi lain seputar kegiatan Internship di Kabupaten Blitar?
            </h2>
            <p class="text-center mt-4 text-2xl md:text-3xl text-primary-800 dark:text-secondary">
                Kunjungi <a class="font-bold hover:text-primary-500 dark:hover:text-abu-500" href="#">Instagram</a> dan <a class="font-bold hover:text-primary-500 dark:hover:text-abu-500" href="#">YouTube</a> Kami ya!
            </p>
        </div>
    </div>
    {{-- more info end --}}

    {{-- section internlife video start --}}
    <div class="bg-abu-500 dark:bg-neutral-800">
        <div class="max-w-screen-xl mx-auto py-16">
            <div class="flex flex-col md:flex-col lg:flex-row justify-between items-center px-12">
                <h2 class="text-center lg:text-start text-5xl md:text-6xl font-bold md:leading-12 text-primary-800 dark:text-secondary">
                    Take a Look at Our #internlife
                </h2>
                <div class="w-full h-full mt-8 md:w-2/3">
                    <iframe class="w-full h-80" width="560" height="315" src="https://www.youtube.com/embed/NliKw6e0id8?si=p3kOKLLFsEZ8wmDM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    {{-- section internlife video end --}}

@endsection
