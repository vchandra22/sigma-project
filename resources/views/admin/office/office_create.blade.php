@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-800">
        <div class="p-4 mt-14">
            <div class="w-full">
                <div>
                    <div class="bg-gray-50 w-full border border-gray-100 dark:bg-neutral-800 dark:border-neutral-700">
                        <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                            <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary mb-8">
                                {{ $pageTitle }}
                            </h2>

                            <div class="mt-12">

                                    <form action="{{ route('admin.storeOffice') }}" method="POST"
                                        class="space-y-6" enctype="multipart/form-data">
                                        @csrf
                                        <div>
                                            <label for="nama_kantor"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Instansi
                                                / OPD <span class="text-red-500">*</span></label>
                                            <input type="text" name="nama_kantor" id="nama_kantor"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required autofocus value="{{ old('nama_kantor') }}" />
                                            @error('nama_kantor')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <ul class="list-disc ms-5 text-gray-500">
                                                <li>
                                                    <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Masukkan
                                                        secara lengkap (tidak disingkat)</p>
                                                </li>
                                                <li>
                                                    <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Lengkapi
                                                        dengan daerah pemerintahan</p>
                                                </li>
                                            </ul>
                                        </div>

                                        <div>
                                            <label for="alamat"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Alamat
                                                Instansi / OPD
                                                <span class="text-red-500">*</span></label>
                                            <input type="text" name="alamat" id="alamat"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required autofocus value="{{ old('alamat') }}" />
                                            @error('alamat')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="nama_kepala"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nama
                                                Kepala Dinas Instansi / OPD <span class="text-red-500">*</span></label>
                                            <input type="text" name="nama_kepala" id="nama_kepala"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required autofocus value="{{ old('nama_kepala') }}" />
                                            @error('nama_kepala')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="nip_kepala"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">NIP
                                                Kepala Dinas Instansi / OPD <span class="text-red-500">*</span></label>
                                            <input type="text" name="nip_kepala" id="nip_kepala"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required autofocus value="{{ old('nip_kepala') }}" />
                                            @error('nip_kepala')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="ttd_kepala"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                                Foto Tanda Tangan Kepala Dinas</label>
                                            <input
                                                class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                                id="ttd_kepala" type="file" name="ttd_kepala"
                                                value="{{ old('ttd_kepala') }}">
                                            @error('ttd_kepala')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col items-end">
                                            <button type="submit"
                                                class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Simpan</button>
                                        </div>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
