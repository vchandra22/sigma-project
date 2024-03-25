@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-800">
        <div class="p-4 mt-14">
            @if (session('success'))
                <div id="toast-success"
                    class="fixed flex items-center w-full max-w-xs p-4 mb-4 text-primary-800 border border-gray-100 bg-secondary shadow-sm top-5 right-5 mt-[4.4rem] dark:text-secondary dark:bg-neutral-800 dark:border dark:border-neutral-700"
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
                        class="ms-auto -mx-1.5 -my-1.5 bg-secondary text-primary-800 hover:text-primary-500 focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-secondary dark:hover:text-white dark:bg-transparent"
                        data-dismiss-target="#toast-danger" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="md:grid md:grid-cols-2 gap-2">
                <div>
                    <div class="bg-secondary w-full border border-gray-100 dark:bg-neutral-800 dark:border-neutral-700">
                        <div class="px-6 py-8">
                            <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-8">Form
                                Dailylog
                            </h2>

                            <form action="{{ route('user.logbook') }}" method="POST" class="space-y-6">
                                @csrf
                                @foreach ($userDetail as $data)
                                    <div>
                                        <label for="nama_lengkap"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nama
                                            Lengkap</label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                                            class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            value="{{ $data->nama_lengkap }}" required readonly />
                                    </div>

                                    <div>
                                        <label for="no_identitas"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nomor
                                            Identitas</label>
                                        <input type="text" name="no_identitas" id="no_identitas"
                                            class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            value="{{ $data->document->no_identitas }}" required readonly />
                                    </div>

                                    <div>
                                        <label for="instansi_asal"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Asal
                                            Universitas atau SMK/SMA</label>
                                        <input type="text" name="instansi_asal" id="instansi_asal"
                                            class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            value="{{ $data->document->instansi_asal }}" required readonly />
                                    </div>

                                    <div>
                                        <label for="status_id"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Document ID</label>
                                        <input type="text" name="status_id" id="status_id"
                                            class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            value="{{ $data->document->id }}" required readonly />
                                    </div>
                                @endforeach

                                <div>
                                    <label for="jurusan"
                                        class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Jurusan
                                    </label>
                                    <input type="text" name="jurusan" id="jurusan"
                                        class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                        value="Rekayasa Perangkat Lunak" required readonly />
                                </div>

                                <div>
                                    <div class="md:grid md:grid-cols-3 md:gap-2 space-y-4 md:space-y-0">
                                        <div class="relative">
                                            <label for="tgl_magang"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Tanggal
                                            </label>
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="mt-6 w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input name="tgl_magang" datepicker datepicker-autohide type="text"
                                                class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                placeholder="Select date">
                                            @error('tgl_magang')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="jam_mulai"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Waktu
                                                Mulai</label>
                                            <input type="time" name="jam_mulai" id="jam_mulai"
                                                class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required />
                                            @error('jam_mulai')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="jam_selesai"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Waktu
                                                Selesai</label>
                                            <input type="time" name="jam_selesai" id="jam_selesai"
                                                class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required />
                                            @error('jam_selesai')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="topik_diskusi"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Topik
                                        Diskusi</label>
                                    <textarea name="topik_diskusi" id="topik_diskusi" rows="8"
                                        class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"></textarea>
                                    @error('topik_diskusi')
                                        <div class="mt-1 text-red-500 text-xs">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="arahan_pembimbing"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Arahan
                                        Pembimbing</label>
                                    <textarea name="arahan_pembimbing" id="arahan_pembimbing" rows="4"
                                        class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"></textarea>
                                    @error('arahan_pembimbing')
                                        <div class="mt-1 text-red-500 text-xs">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="bukti"
                                        class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Bukti
                                        Dukung (link)
                                    </label>
                                    <input type="text" name="bukti" id="bukti"
                                        class="bg-gray-50 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                        required />
                                    @error('bukti')
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

                <div class="bg-secondary border border-gray-100 dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="px-6 py-8">
                        <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-4">Riwayat
                            Kegiatan
                        </h2>
                        <div class="text-sm font-normal text-abu-800 leading-tight dark:text-neutral-300">
                            <p>Bila Seluruh Kegiatan Magang telah Selesai, <a href="#"
                                    class="font-bold hover:text-primary-800">Cetak Logbook Anda</a> dan Mintakan Tanda
                                Tangan Ke Pembimbing Lapang di Instansi Tempat Anda Magang</p>
                        </div>
                        <p class="text-red-500 text-sm font-normal leading-tight mt-4">Perhatian!!! data Logbook Kegiatan
                            tidak bisa di ubah, pastikan Anda mengisi dengan Hati - Hati dan Teliti</p>

                        <div class="relative overflow-x-auto mt-4">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            TANGGAL / WAKTU
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            RINCIAN KEGIATAN
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            HAPUS
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            Silver
                                        </td>
                                        <td class="px-6 py-4">
                                            Laptop
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            White
                                        </td>
                                        <td class="px-6 py-4">
                                            Laptop PC
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            Black
                                        </td>
                                        <td class="px-6 py-4">
                                            Accessories
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            Gray
                                        </td>
                                        <td class="px-6 py-4">
                                            Phone
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4">
                                            Red
                                        </td>
                                        <td class="px-6 py-4">
                                            Wearables
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#topik_diskusi'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#arahan_pembimbing'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
