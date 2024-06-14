@extends('layouts.app')

@section('content')
    <div class="p-1 md:p-4 sm:ml-64 bg-abu-500 dark:bg-neutral-950">
        @foreach ($userData as $data)
            <div class="p-4 mt-14">
                <div
                    class="md:grid md:grid-cols-3 h-full bg-secondary border border-gray-200 dark:border-neutral-700 dark:bg-neutral-900">
                    <div class="md:col-span-2 px-6 py-8">
                        <h2 class="text-2xl md:text-4xl font-bold text-primary-800 dark:text-secondary mb-2">Pengumuman</h2>
                        @foreach ($announcementData as $announcement)
                            <span class="w-full text-primary-800 dark:text-secondary">
                                {!! $announcement->pengumuman !!}
                            </span>
                            @if ($announcement->file !== null)
                                <br>
                                <a href="{{ route('downloadFileAnnouncement', ['announcement' => $announcement->file]) }}"
                                    class="mt-4 text-blue-500 text-md hover:underline" style="margin-top: 20px">Unduh File
                                    Pengumuman
                                </a>
                            @else
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <div
                            class="hidden w-full h-full bg-primary-800 text-secondary md:flex items-center justify-center dark:bg-neutral-900">
                            <i class="fa-solid fa-bullhorn fa-6x"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="w-full h-full">
                        <div class="md:grid lg:grid-cols-2 md:space-y-0">
                            <div class="h-full w-full grid grid-rows-3 border border-gray-200 border-b-0 dark:border-neutral-700">
                                <div
                                    class="px-6 py-8 bg-secondary dark:bg-neutral-900 dark:border-neutral-700">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">Nama
                                        Lengkap</h2>
                                    <p
                                        class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                        {{ Auth::user()->nama_lengkap }}</p>
                                </div>
                                <div
                                    class="px-6 py-8 bg-secondary dark:bg-neutral-900 dark:border-neutral-700">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">
                                        Jurusan / Bidang Keahlian</h2>
                                    <p
                                        class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                        {{ $data->jurusan }}</p>
                                </div>
                                <div
                                    class="px-6 py-8 bg-secondary dark:bg-neutral-900 dark:border-neutral-700">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">
                                        Instansi
                                        Tujuan
                                    </h2>
                                    <div class="flex justify-start">
                                        <div class="border border-gray-300 w-auto">
                                            <p
                                                class="text-primary-800 p-4 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                                {{ $data->position->role }}
                                            </p>
                                        </div>
                                        <div class="border border-gray-300 w-auto xl:w-full">
                                            <p
                                                class="text-primary-800 p-4 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                                {{ $data->office->nama_kantor }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="h-full w-full px-6 py-8 bg-secondary border border-gray-200 border-b-0 dark:border-neutral-700 dark:bg-neutral-900">
                                <h2
                                    class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-4 text-start">
                                    Status Pendaftaran</h2>
                                @if ($data->status->status == 'menunggu')
                                    <div
                                        class="text-center font-bold uppercase text-2xl md:text-3xl bg-yellow-300 rounded py-2 text-secondary mb-4">
                                        <p class="align-baseline mt-2">{{ $data->status->status }}</p>
                                    </div>
                                @elseif ($data->status->status == 'diterima')
                                    <div
                                        class="text-center font-bold uppercase text-2xl md:text-3xl bg-green-500 rounded py-2 text-secondary mb-4">
                                        <p class="align-baseline mt-2">{{ $data->status->status }}</p>
                                    </div>
                                @elseif ($data->status->status == 'ditolak')
                                    <div
                                        class="text-center font-bold uppercase text-2xl md:text-3xl bg-red-500 rounded py-2 text-secondary mb-4">
                                        <p class="align-baseline mt-2">{{ $data->status->status }}</p>
                                    </div>
                                @elseif ($data->status->status == 'selesai')
                                    <div
                                        class="text-center font-bold uppercase text-2xl md:text-3xl bg-blue-500 rounded py-2 text-secondary mb-4">
                                        <p class="align-baseline mt-2">{{ $data->status->status }}</p>
                                    </div>
                                @endif
                                <h3 class="text-lg md:text-xl text-primary-800 dark:text-secondary mb-1">Keterangan: </h3>
                                <div class="border border-primary-500 border-dashed min-h-32 dark:border-neutral-500">
                                    @if ($data->status->status !== 'menunggu')
                                        <p
                                            class="p-2 text-primary-800 text-sm text-justify leading-normal dark:text-gray-300">
                                            {{ strip_tags($data->status->keterangan) }}
                                        </p>
                                    @elseif ($data->status->status === 'menunggu')
                                        <p class="p-2 text-abu-800 text-sm text-justify leading-normal dark:text-gray-300">
                                            Sabar ya dek, masih di review
                                        </p>
                                    @endif
                                </div>
                                @if ($data->status->doc_balasan !== null)
                                    <div>
                                        <h2
                                            class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary my-4 text-center">
                                            Surat Balasan
                                        </h2>
                                        <a href="{{ route('user.downloadDocuments', $data->status->doc_balasan) }}"
                                            class="align-baseline mt-2">
                                            <div
                                                class="text-center font-bold capitalize text-2xl md:text-3xl bg-primary-800 hover:bg-primary-500 rounded py-2 text-secondary mb-4 w-full">
                                                Download Dokumen
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <h2
                                        class="lg:pt-6 text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary my-4 text-start">
                                        Surat Balasan
                                    </h2>
                                    <p class="text-start text-primary-500">
                                        Belum ada dokumen balasan
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="w-full h-full">
                        <div class="md:grid md:grid-cols-1 lg:grid-cols-2 md:space-y-0">
                            <div
                                class="lg:col-span-1 h-full w-full px-6 py-8 bg-secondary border border-gray-200 border-t-0 dark:border-neutral-700 dark:bg-neutral-900 dark:border lg:space-y-16">
                                <div>
                                    <h2 class="text-xl md:text-2xl font-bold text-abu-800 dark:text-gray-200 mb-4">Tanggal
                                        Magang yang Diajukan</h2>
                                    <div
                                        class="text-start font-bold text-2xl text-abu-800 md:text-3xl py-2 dark:text-gray-200 mb-4">
                                        <p>{{ convertDate($data->u_tgl_mulai) }} -
                                            {{ convertDate($data->u_tgl_selesai) }}</p>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-4">
                                        Tanggal
                                        Magang yang Disetujui</h2>
                                    <div
                                        class="text-start font-bold text-2xl text-primary-800 md:text-3xl py-2 dark:text-secondary mb-4">
                                        @if (($data->e_tgl_mulai != null && $data->status->status == 'diterima') || $data->status->status == 'selesai')
                                            <p>{{ convertDate($data->e_tgl_mulai) }} -
                                                {{ convertDate($data->e_tgl_selesai) }}</p>
                                        @else
                                            <p class="text-red-500">Data tidak ditemukan</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="h-full w-full grid grid-rows-2">
                                <div
                                    class="p-4 bg-secondary border border-gray-200 border-t-0 border-b-0 dark:border-neutral-700 dark:bg-neutral-900 dark:border">
                                    @if ($data->status->status === 'diterima' || $data->status->status === 'selesai')
                                        @if ($data->doc_laporan)
                                            <p for="doc_laporan"
                                                class="block mb-2 text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary">
                                                Laporan Magang
                                            </p>
                                            <p
                                                class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                                Kamu sudah mengunggah laporan
                                            </p>
                                            <br>
                                            <a class="hover:underline text-blue-500"
                                                href="{{ route('user.downloadLaporan', $data->uuid) }}">
                                                <div
                                                    class="capitalize mx-auto text-start py-2 pointer-events-none text-blue-500  hover:text-blue-800">
                                                    Download Laporan
                                                </div>
                                            </a>
                                        @else
                                            <form action="{{ route('user.storeLaporan', ['id' => $data->user_id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <label for="doc_laporan"
                                                    class="block mb-2 text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary">
                                                    Laporan Magang</label>
                                                <input
                                                    class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-900 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                                    id="doc_laporan" type="file" name="doc_laporan">
                                                @error('doc_laporan')
                                                    <div class="mt-1 text-red-500 text-xs">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <ul
                                                    class="mt-1 pl-2 list-disc list-inside text-xs text-gray-500 dark:text-secondary">
                                                    <li>Unggah file dengan format .pdf (Max. 2MB)</li>
                                                </ul>
                                                <div class="pt-2">
                                                    <button type="submit"
                                                        class="w-full px-12 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Kirim</button>
                                                </div>
                                            </form>
                                        @endif
                                    @else
                                        <p for="doc_laporan"
                                            class="block mb-2 text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary">
                                            Laporan Magang
                                        </p>
                                        <p
                                            class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                            Kamu belum berhak mengisi
                                        </p>
                                    @endif
                                </div>
                                <div
                                    class="p-4 bg-secondary border border-gray-200 border-t-0 dark:border-neutral-700 dark:bg-neutral-900 dark:border">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">
                                        Certificate of Internship</h2>
                                    @if ($data->status->certificate)
                                        @if ($data->status->certificate->doc_sertifikat)
                                            <a
                                                href="{{ route('downloadFileCertificate', $data->status->certificate->uuid) }}">
                                                <div
                                                    class="mt-6 text-center font-bold capitalize text-2xl md:text-2xl bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl rounded py-2 text-secondary mb-4 w-full">
                                                    Download Sertifikat
                                                </div>
                                            </a>
                                        @else
                                            <p
                                                class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                                Sertifikat belum tersedia
                                            </p>
                                        @endif
                                    @else
                                        <p
                                            class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                            Belum berhak mendapat sertifikat
                                        </p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
