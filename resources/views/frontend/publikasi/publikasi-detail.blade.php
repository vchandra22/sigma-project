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
                                <a href="{{ route('frontend.roleList') }}"
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

    <div class="bg-secondary dark:bg-neutral-900">
        <div class="px-4 max-w-screen-xl mx-auto bg-secondary dark:bg-neutral-900">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <div class="col-span-2">
                    <div class="pr-6 py-12 w-full">
                        <div class="text-4xl font-bold text-primary-800 text-start leading-9 dark:text-secondary">
                            <h2>
                                Judul Publikasi
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo voluptatem maiores sunt.
                            </h2>
                        </div>
                        <div
                            class="text-primary-800 leading-tight pt-8 text-balance text-2xl font-paragraf dark:text-secondary">
                            Dalam dunia pendidikan dan industri, magang memiliki peran yang krusial dalam membekali
                            mahasiswa
                            dengan pengalaman praktis yang diperlukan untuk sukses di dunia kerja. Namun, seringkali
                            pengawasan
                            dan pemantauan terhadap kegiatan magang bisa menjadi tantangan tersendiri bagi institusi
                            pendidikan
                            maupun tempat magang itu sendiri. Untungnya, dengan kemajuan teknologi, solusi baru telah muncul
                            dalam bentuk aplikasi monitoring kegiatan magang yang inovatif.
                            Aplikasi ini dirancang untuk memudahkan koordinasi antara pemimpin tim, pembimbing magang, dan
                            mahasiswa magang, dengan menyediakan platform terpadu untuk melacak, mengevaluasi, dan mengelola
                            semua aspek kegiatan magang.
                            <br>
                            Berikut adalah beberapa fitur utama yang ditawarkan oleh aplikasi ini:
                            Pelacakan Aktivitas: Aplikasi ini memungkinkan mahasiswa untuk mencatat kegiatan mereka secara
                            real-time, baik itu proyek yang sedang dikerjakan, lokasi tempat magang, atau pertemuan dengan
                            pembimbing. Ini membantu pembimbing untuk mendapatkan pemahaman yang jelas tentang perkembangan
                            magang setiap mahasiswa.
                            <br>
                            Jadwal dan Pengingat: Dengan fitur jadwal yang terintegrasi, mahasiswa dapat mengatur jadwal
                            kegiatan magang mereka dengan mudah. Pengingat otomatis juga membantu mengingatkan mereka
                            tentang
                            tenggat waktu proyek atau pertemuan penting.
                            Evaluasi Kinerja: Pembimbing dapat memberikan umpan balik langsung melalui aplikasi ini, baik
                            dalam
                            bentuk teks maupun evaluasi formal. Ini membantu mahasiswa untuk terus meningkatkan kinerja
                            mereka
                            berdasarkan umpan balik yang diberikan.
                            Dokumentasi Proyek: Aplikasi ini menyediakan ruang penyimpanan yang aman untuk dokumen dan
                            laporan
                            proyek. Mahasiswa dapat dengan mudah mengunggah dokumen-dokumen terkait proyek mereka,
                            memudahkan
                            pembimbing untuk mengakses dan meninjau mereka.
                            Kolaborasi Tim: Untuk proyek yang melibatkan kolaborasi antar-mahasiswa, aplikasi ini
                            memungkinkan
                            untuk berbagi informasi dan berkomunikasi secara efektif antar anggota tim. Ini membantu
                            mempromosikan kerja sama dan koordinasi dalam tim.
                            Keunggulan utama dari aplikasi ini adalah kemudahannya dalam penggunaan dan fleksibilitasnya
                            dalam
                            memenuhi kebutuhan berbagai jenis program magang. Baik itu program magang di perusahaan besar,
                            institusi pemerintah, atau lembaga non-profit, aplikasi ini dapat disesuaikan untuk
                            mengakomodasi
                            kebutuhan unik dari setiap konteks.
                            Dengan adanya aplikasi monitoring kegiatan magang ini, diharapkan dapat meningkatkan efisiensi
                            dan
                            efektivitas dalam manajemen magang, serta memastikan pengalaman magang yang bermutu bagi para
                            mahasiswa. Sebagai hasilnya, hal ini dapat memberikan kontribusi yang lebih besar terhadap
                            persiapan
                            mereka untuk memasuki dunia kerja yang kompetitif.
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-4 mb-20">
                    <h3 class="pt-12 pb-4 text-3xl font-bold text-primary-800 text-start leading-9 dark:text-secondary">
                        Publikasi
                        Lainnya</h3>

                    <a href="{{ route('frontend.publikasiDetail') }}"
                        class="flex flex-col items-center bg-transparent border border-abu-500 md:flex-row hover:bg-gray-100 dark:border-neutral-800 dark:hover:bg-secondary">
                        <div class="relative w-full h-44 lg:h-full">
                            <img src="{{ asset('frontend/assets/img/illustration-image-role-developer.webp') }}"
                                class="object-cover w-full h-full" alt="Illustration Image Discussion">
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-primary-800 bg-opacity-40 transition-transform duration-1000 hover:bg-opacity-40 dark:bg-neutral-950 dark:bg-opacity-60">
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between p-6 leading-normal text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-neutral-900">
                            <h5 class="text-2xl font-bold tracking-tight leading-7 overflow-hidden line-clamp-3">
                                Judul Publikasi Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, molestias?
                            </h5>
                        </div>
                    </a>

                    <a href="{{ route('frontend.publikasiDetail') }}"
                        class="flex flex-col items-center bg-transparent border border-abu-500 md:flex-row hover:bg-gray-100 dark:border-neutral-800 dark:hover:bg-secondary">
                        <div class="relative w-full h-44 lg:h-full">
                            <img src="{{ asset('frontend/assets/img/illustration-image-discuss.webp') }}"
                                class="object-cover w-full h-full" alt="Illustration Image Discussion">
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-primary-800 bg-opacity-40 transition-transform duration-1000 hover:bg-opacity-40 dark:bg-neutral-950 dark:bg-opacity-60">
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between p-6 leading-normal text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-neutral-900">
                            <h5 class="text-2xl font-bold tracking-tight leading-7 overflow-hidden line-clamp-3">
                                Judul Publikasi Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, molestias?
                            </h5>
                        </div>
                    </a>

                    <a href="{{ route('frontend.publikasiDetail') }}"
                        class="flex flex-col items-center bg-transparent border border-abu-500 md:flex-row hover:bg-gray-100 dark:border-neutral-800 dark:hover:bg-secondary">
                        <div class="relative w-full h-44 lg:h-full">
                            <img src="{{ asset('frontend/assets/img/illustration-image-discuss.webp') }}"
                                class="object-cover w-full h-full" alt="Illustration Image Discussion">
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-primary-800 bg-opacity-40 transition-transform duration-1000 hover:bg-opacity-40 dark:bg-neutral-950 dark:bg-opacity-60">
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between p-6 leading-normal text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-neutral-900">
                            <h5 class="text-2xl font-bold tracking-tight leading-7 overflow-hidden line-clamp-3">
                                Judul Publikasi Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, molestias?
                            </h5>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
