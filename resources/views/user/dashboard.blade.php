@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 bg-abu-500 dark:bg-neutral-800">
        @foreach ($userData as $data)
            <div class="p-4 mt-14">
                <div
                    class="md:grid md:grid-cols-3 h-full mb-2 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border-neutral-600">
                    <div class="md:col-span-2 px-6 py-8">
                        <h2 class="text-2xl md:text-4xl font-bold text-primary-800 dark:text-secondary mb-2">Pengumuman</h2>
                        <p
                            class="text-primary-800 font-paragraf text-md md:text-lg dark:text-secondary leading-4 md:leading-5">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat consequatur deleniti repellat
                            fuga,
                            at facilis commodi obcaecati rerum tenetur sint saepe eum similique, illo vero ea sunt? Eum
                            repellendus repudiandae quibusdam molestias architecto assumenda corporis, cupiditate adipisci
                            deserunt nam laboriosam, quo, unde saepe. Atque numquam enim aspernatur eius non nostrum ad
                            cumque!
                        </p>
                    </div>
                    <div>
                        <div
                            class="hidden w-full h-full bg-primary-800 text-secondary md:flex items-center justify-center dark:bg-neutral-900">
                            <i class="fa-solid fa-bullhorn fa-6x"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="w-full h-full">
                        <div class="md:grid md:grid-cols-2 gap-2 space-y-2 md:space-y-0">
                            <div class="h-full w-full grid grid-rows-3 gap-2">
                                <div
                                    class="px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border-neutral-600">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">Nama
                                        Lengkap</h2>
                                    <p
                                        class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                        {{ Auth::user()->nama_lengkap }}</p>
                                </div>
                                <div
                                    class="px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border-neutral-600">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">
                                        Jurusan / Bidang Keahlian</h2>
                                    <p
                                        class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                        {{ $data->jurusan }}</p>
                                </div>
                                <div
                                    class="px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border-neutral-600">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">
                                        Instansi
                                        Tujuan</h2>
                                    <p
                                        class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                        Dinas Komunikasi Informatika dan Statistik Kota Blitar</p>
                                </div>
                            </div>
                            <div
                                class="h-full w-full px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border-neutral-600">
                                <h2
                                    class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-4 text-center">
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
                                    <p class="p-2 text-abu-800 text-sm text-justify leading-normal dark:text-gray-300">
                                        Sabar ya dek, masih di review
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="w-full h-full">
                        <div class="md:grid md:grid-cols-1 lg:grid-cols-3 gap-2 space-y-2 md:space-y-0">
                            <div
                                class="lg:col-span-2 h-full w-full px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border dark:border-neutral-600 lg:space-y-24">
                                <div>
                                    <h2 class="text-xl md:text-2xl font-bold text-abu-800 dark:text-gray-200 mb-4">Tanggal
                                        Magang yang Diajukan</h2>
                                    <div
                                        class="text-start font-bold text-2xl text-abu-800 md:text-3xl py-2 dark:text-gray-200 mb-4">
                                        <p>{{ $data->u_tgl_mulai }} - {{ $data->u_tgl_selesai }}</p>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-4">
                                        Tanggal
                                        Magang yang Disetujui</h2>
                                    <div
                                        class="text-start font-bold text-2xl text-primary-800 md:text-3xl py-2 dark:text-secondary mb-4">
                                        @if ($data->e_tgl_mulai != null && $data->status->status == 'diterima')
                                            <p>{{ $data->e_tgl_mulai }} - {{ $data->e_tgl_selesai }}</p>
                                        @else
                                            <p class="text-red-500">Data tidak ditemukan</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="h-full w-full grid grid-rows-2 gap-2">
                                <div
                                    class="p-4 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border dark:border-neutral-600">
                                    <form action="#" method="POST">
                                        <label for="laporan"
                                            class="block mb-2 text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary">
                                            Laporan Magang</label>
                                        <input
                                            class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                            id="laporan" type="file" name="laporan">
                                        <ul
                                            class="mt-1 pl-2 list-disc list-inside text-xs text-gray-500 dark:text-secondary">
                                            <li>Unggah file dengan format .pdf (Max. 2MB)</li>
                                        </ul>
                                        <div class="pt-2">
                                            <button type="submit"
                                                class="w-full px-12 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="p-4 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border dark:border-neutral-600">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">
                                        Certificate of Internship</h2>
                                    <p
                                        class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                        Sertifikat belum tersedia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
