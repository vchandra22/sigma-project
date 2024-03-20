@extends('frontend.layouts.app')

@section('content')
    <section class="bg-secondary dark:bg-neutral-900">
        <div class="mt-[4.4rem] max-w-screen-xl mx-auto px-4">
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

            <div class="max-w-screen-xl xl:min-h-screen mx-auto pb-16">
                <section class="bg-gray-100 dark:bg-neutral-800">
                    <div
                        class="py-8 px-4 md:px-16 mx-auto max-w-screen-xl border border-abu-500 lg:py-20 dark:border dark:border-1 dark:border-neutral-700">
                        <div class="flex flex-col justify-center text-center">
                            <h1
                                class="mb-1 md:mb-4 text-4xl font-bold tracking-tight leading-none text-primary-800 md:text-5xl lg:text-6xl dark:text-secondary">
                                Register</h1>
                            <p
                                class="mb-6 text-lg font-normal leading-5 md:leading-none font-paragraf text-gray-500 lg:text-xl dark:text-abu-800">
                                Bergabunglah Sekarang dan Lengkapi Form Berikut! Mulailah Pengalaman Magang yang Luar Biasa!
                            </p>
                        </div>
                        <div class="mt-12">
                            <form class="grid lg:grid-cols-2 gap-8 lg:gap-16" action="#" method="post">
                                <div class="space-y-6">
                                    <div>
                                        <label for="nama_lengkap"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nama
                                            Lengkap <span class="text-red-500">*</span></label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="Vincent Chandra Trie Novan" required autofocusa />
                                    </div>

                                    <div>
                                        <label for="no_identitas"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nomor
                                            Identitas <span class="text-red-500">*</span></label>
                                        <input type="text" name="no_identitas" id="no_identitas"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="350518888888" required />

                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Nomor identitas dapat
                                            diisikan
                                            dengan NIS/NIM/NIK.</p>
                                    </div>

                                    <div>
                                        <label for="no_hp"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">No.Handphone
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" name="no_hp" id="no_hp"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="081555555555" required />
                                    </div>

                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Alamat
                                            Email <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="name@company.com" required />
                                    </div>

                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Password
                                            <span class="text-red-500">*</span></label>
                                        <input type="password" name="password" id="password" placeholder="••••••••"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required />
                                    </div>

                                    <div>
                                        <label for="password_confirmation"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Ulangi
                                            Password
                                            <span class="text-red-500">*</span></label>
                                        <input type="password_confirmation" name="password_confirmation"
                                            id="password_confirmation" placeholder="••••••••"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required />
                                    </div>

                                    <div>
                                        <label for="instansi_asal"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Instansi
                                            Asal <span class="text-red-500">*</span></label>
                                        <input type="text" name="instansi_asal" id="instansi_asal"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="SMKN 1 Blitar" required />

                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan nama
                                            Universitas
                                            atau SMA/SMK kalian.</p>
                                    </div>

                                    <div>
                                        <label for="jurusan"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Jurusan
                                            / Konsentrasi Bidang Keahlian <span class="text-red-500">*</span></label>
                                        <input type="text" name="jurusan" id="jurusan"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="Rekayasa Perangkat Lunak" required />

                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan jurusan atau
                                            bidang keahlian yang kalian ambil.</p>
                                    </div>

                                </div>

                                <div class="space-y-6">
                                    <div>
                                        <label for="instansi_tujuan"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Instansi
                                            Tujuan <span class="text-red-500">*</span>
                                        </label>
                                        <select name="instansi_tujuan" id="instansi_tujuan"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                            <option selected>
                                                Dinas Komunikasi Informatika dan Statistik Kota Blitar
                                            </option>
                                            <option value="#">
                                                Dinas Komunikasi Informatika dan Statistik Kota Blitar
                                            </option>
                                            <option value="#">
                                                Dinas Komunikasi Informatika dan Statistik Kota Blitar
                                            </option>
                                        </select>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan instansi
                                            tujuan
                                            melakukan kegiatan magang</p>
                                    </div>

                                    <div>
                                        <label for="start"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Rencana
                                            Pelaksanaan <span class="text-red-500">*</span></label>
                                        <div date-rangepicker class="flex items-center">
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input name="start" type="text"
                                                    class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                    placeholder="Tanggal Mulai" required>
                                            </div>
                                            <span
                                                class="mx-3 text-primary-800 text-sm text-center dark:text-secondary">sampai</span>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input name="end" type="text"
                                                    class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                    placeholder="Tanggal Selesai" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="surat_pengantar"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                            Surat Pengantar <span class="text-red-500">*</span></label>
                                        <input
                                            class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                            id="surat_pengantar" type="file" name="surat_pengantar">
                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Unggah file dengan format
                                            .pdf (Max. 2MB)</p>
                                    </div>

                                    <div>
                                        <label for="surat_kesbang"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                            Surat Rekomendasi BAKESBANGPOL</label>
                                        <input
                                            class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                            id="surat_kesbang" type="file" name="surat_kesbang">
                                        <ul
                                            class="mt-1 pl-2 list-disc list-inside text-xs text-gray-500 dark:text-secondary">
                                            <li>Wajib bagi mahasiswa yang akan melakukan penelitian</li>
                                            <li>Unggah file dengan format .pdf (Max. 2MB)</li>
                                        </ul>
                                    </div>

                                    <div>
                                        <label for="surat_pendukung"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                            Dokumen Pendukung</label>
                                        <input
                                            class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                            id="surat_pendukung" type="file" name="surat_pendukung">
                                        <ul
                                            class="mt-1 pl-2 list-disc list-inside text-xs text-gray-500 dark:text-secondary">
                                            <li>Proposal Penelitian / CV jika kamu merupakan siswa SMA/SMK dengan format
                                                .pdf</li>
                                            <li>Unggah file dengan format .pdf (Max. 2MB)</li>
                                        </ul>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="terms" aria-describedby="terms" type="checkbox"
                                                class="w-4 h-4 border-abu-800 bg-gray-100 focus:ring-3 focus:ring-primary-800 dark:focus:ring-neutral-600 dark:ring-offset-gray-800 dark:bg-neutral-700 dark:border-neutral-700"
                                                required="">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">Saya
                                                menyatakan memahami dan setuju dengan <a
                                                    class="text-primary-800 hover:underline hover:text-primary-500 dark:text-gray-100"
                                                    href="#">Kebijakan Privasi registrasi akun Internship
                                                    SIGMA</a></label>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end pt-4 lg:pt-[5.5rem]">
                                        <button type="submit"
                                            class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Register</button>
                                        {{-- <p class="text-sm mt-3 font-light text-end text-primary-800 dark:text-secondary">
                                            Sudah punya akun?<a href="{{ route('auth.login') }}"
                                                class="font-medium text-primary-600 hover:underline dark:text-gray-100"> Login</a>
                                        </p> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
