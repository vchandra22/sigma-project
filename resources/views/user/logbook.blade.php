@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-950">
        <div class="p-1 md:p-4 mt-14">
            @if (session()->has('error'))
                <div id="toast-danger"
                    class="fixed flex items-center w-full max-w-xs p-4 mb-4 text-primary-800 border border-gray-100 bg-white shadow-sm top-5 right-5 mt-[4.4rem] dark:text-secondary dark:bg-neutral-800 dark:border dark:border-neutral-700"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-transparent dark:text-red-500">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                        </svg>
                        <span class="sr-only">Error icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
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
            @if (session('success'))
                <div id="toast-success"
                    class="fixed flex items-center w-full max-w-xs p-4 mb-4 text-primary-800 border border-gray-100 bg-white shadow-sm top-5 right-5 mt-[4.4rem] dark:text-secondary dark:bg-neutral-800 dark:border dark:border-neutral-700 z-50"
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
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-dismiss-target="#toast-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            @foreach ($userDetail as $item)
                @if ($item->status->status === 'menunggu' || $item->status->status === 'ditolak')
                    <div
                        class="min-h-screen flex items-center justify-center bg-gray-50 w-full border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                        <p class="text-md md:text-xl text-primary-800 text-center dark:text-white px-8">Status pendaftaran
                            anda masih dalam
                            tahap review atau ditolak, tidak dapat mengisi logbook
                        </p>
                    </div>
                @else
                    <div class="lg:grid lg:grid-cols-2 gap-2 sm:space-y-2 md:space-y-0">
                        <div>
                            <div
                                class="bg-gray-50 w-full border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                                <div class="px-6 py-8">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-8">Form
                                        Dailylog
                                    </h2>
                                    <form action="{{ route('user.storeLogbook') }}" method="POST" class="space-y-6">
                                        @csrf
                                        @foreach ($userDetail as $data)
                                            <div>
                                                <label for="nama_lengkap"
                                                    class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nama
                                                    Lengkap</label>
                                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                                    class="bg-gray-200 cursor-not-allowed border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                    value="{{ $data->user->nama_lengkap }}" required readonly />
                                            </div>

                                            <div>
                                                <label for="no_identitas"
                                                    class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nomor
                                                    Identitas</label>
                                                <input type="text" name="no_identitas" id="no_identitas"
                                                    class="bg-gray-200 cursor-not-allowed border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                    value="{{ $data->no_identitas }}" required readonly />
                                            </div>

                                            <div>
                                                <label for="instansi_asal"
                                                    class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Asal
                                                    Universitas atau SMK/SMA</label>
                                                <input type="text" name="instansi_asal" id="instansi_asal"
                                                    class="bg-gray-200 cursor-not-allowed border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                    value="{{ $data->instansi_asal }}" required readonly />
                                            </div>

                                            <div class="hidden">
                                                <label for="status_id"
                                                    class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Document
                                                    ID</label>
                                                <input type="text" name="status_id" id="status_id"
                                                    class="bg-gray-200 cursor-not-allowed border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                    value="{{ $data->id }}" required readonly />
                                            </div>
                                        @endforeach

                                        <div>
                                            <label for="jurusan"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Jurusan
                                            </label>
                                            <input type="text" name="jurusan" id="jurusan"
                                                class="bg-gray-200 cursor-not-allowed border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                value="{{ $data->jurusan }}" required readonly />
                                        </div>

                                        <div>
                                            <div class="md:grid md:grid-cols-3 md:gap-2 space-y-4 md:space-y-0">
                                                <div class="relative">
                                                    <label for="tgl_magang"
                                                        class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Tanggal
                                                        <span class="text-red-500">*</span>
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
                                                    <input name="tgl_magang" datepicker datepicker-buttons
                                                        datepicker-format="dd/mm/yyyy" datepicker-autoselect-today
                                                        type="text"
                                                        class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                        placeholder="Pilih tanggal" autofocus>
                                                    @error('tgl_magang')
                                                        <div class="mt-1 text-red-500 text-xs">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="jam_mulai"
                                                        class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Waktu
                                                        Mulai <span class="text-red-500">*</span></label>
                                                    <input type="time" name="jam_mulai" id="jam_mulai"
                                                        class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
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
                                                        Selesai <span class="text-red-500">*</span></label>
                                                    <input type="time" name="jam_selesai" id="jam_selesai"
                                                        class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
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
                                                Diskusi <span class="text-red-500">*</span></label>
                                            <textarea name="topik_diskusi" id="topik_diskusi" rows="8"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"></textarea>
                                            @error('topik_diskusi')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="arahan_pembimbing"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Arahan
                                                Pembimbing <span class="text-red-500">*</span></label>
                                            <textarea name="arahan_pembimbing" id="arahan_pembimbing" rows="4"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"></textarea>
                                            @error('arahan_pembimbing')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="bukti"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Bukti
                                                Dukung (link) <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="bukti" id="bukti"
                                                class="bg-white border border-abu-800 text-blue-500 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-blue-500 dark:focus:ring-primary-800 dark:focus:border-accent"
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

                        <div class="bg-gray-50 border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                            <div class="px-6 py-8">
                                <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-4">Riwayat
                                    Kegiatan
                                </h2>
                                <div class="text-sm font-normal text-abu-800 leading-tight dark:text-neutral-300">
                                    <p>Bila Seluruh Kegiatan Magang telah Selesai,
                                        @if ($logbookUser->isNotEmpty())
                                            <a href="{{ route('user.showLogbook', encrypt(Auth::user()->id)) }}"
                                                class="font-bold hover:text-primary-800 disabled"
                                                onclick="var newWindow = window.open('{{ route('user.showLogbook', encrypt(Auth::user()->id)) }}', 'newwindow', 'width=900,height=990'); newWindow.onload = function() { newWindow.print(); }; return false;"
                                                target="_blank">Cetak Logbook Anda </a>
                                        @else
                                            Cetak Logbook Anda
                                        @endif
                                        dan Mintakan Tanda Tangan Ke Pembimbing Lapang di Instansi Tempat Anda Magang
                                    </p>
                                </div>
                                @if ($logbookUser->isNotEmpty())
                                    <div class="flex items-center justify-start h-full gap-4">
                                        <a href="{{ route('user.showLogbook', encrypt(Auth::user()->id)) }}"
                                            onclick="var newWindow = window.open('{{ route('user.showLogbook', encrypt(Auth::user()->id)) }}', 'newwindow', 'width=900,height=990'); newWindow.onload = function() { newWindow.print(); }; return false;"
                                            target="_blank">
                                            @csrf
                                            <p class="py-2 text-center text-sm text-blue-500 hover:underline mt-5">
                                                Cetak Logbook
                                            </p>
                                        </a>
                                    </div>
                                @endif
                                <p class="text-red-500 text-sm font-normal leading-tight mt-4">Perhatian!!! data Logbook
                                    Kegiatan
                                    tidak bisa di ubah, pastikan Anda mengisi dengan Hati - Hati dan Teliti
                                </p>
                                <div class="relative overflow-x-auto mt-4">
                                    <table
                                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 z-10">
                                        <thead
                                            class="text-xs uppercase bg-gray-200 dark:bg-neutral-800 dark:text-secondary">
                                            <tr>
                                                <th scope="col"
                                                    class="px-8 py-6 w-1/3 text-primary-800 dark:text-secondary">
                                                    TANGGAL / WAKTU
                                                </th>
                                                <th scope="col"
                                                    class="px-8 py-6 w-full text-primary-800 dark:text-secondary">
                                                    RINCIAN KEGIATAN
                                                </th>
                                                <th scope="col"
                                                    class="px-8 py-6 w-1/3 text-primary-800 dark:text-secondary">
                                                    HAPUS
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logbookUser as $logbook)
                                                <tr
                                                    class="odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-slate-100 even:dark:bg-neutral-600 border-b dark:border-neutral-500">
                                                    <td class="px-8 py-4">
                                                        <p class="text-primary-800 dark:text-secondary">
                                                            {{ convertDate($logbook->tgl_magang) }}
                                                            <br>
                                                            {{ \Carbon\Carbon::parse($logbook->jam_mulai)->format('H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($logbook->jam_selesai)->format('H:i') }}

                                                        </p>
                                                    </td>
                                                    <td class="px-8 py-4">
                                                        <div class="mb-2">
                                                            <h5 class="font-bold text-primary-800 dark:text-secondary">
                                                                Topik
                                                                Diskusi: </h5>
                                                            <span class="dark:text-slate-300">
                                                                {{ strip_tags($logbook->topik_diskusi) }}
                                                            </span>
                                                        </div>
                                                        <div class="mb-2">
                                                            <h5 class="font-bold text-primary-800 dark:text-secondary">
                                                                Arahan
                                                                Pembimbing: </h5>
                                                            <span class="dark:text-slate-300">
                                                                {{ strip_tags($logbook->arahan_pembimbing) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <h5 class="font-bold text-primary-800 dark:text-secondary">
                                                                Bukti Dukung
                                                            </h5>
                                                            <a class="text-blue-400 hover:text-blue-500 hover:underline"
                                                                href="{{ $logbook->bukti }}">{{ $logbook->bukti }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="px-8 py-4">
                                                        <form id="delete-logbook-{{ $logbook->id }}"
                                                            action="{{ route('delete.logbook', ['id' => $logbook->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <div
                                                                class="px-4 py-2 text-xs bg-red-500 hover:bg-opacity-80 text-secondary">
                                                                <button class="delete-button"
                                                                    data-id="{{ $logbook->id }}" type="submit"
                                                                    value="Delete">Hapus </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-8">
                                        {{ $logbookUser->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="hidden justify-center m-5">
            <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                type="button">
            </button>
        </div>

        <!-- Main modal -->
        <div id="deleteModal" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex items-center justify-center">
            <!-- Background overlay with opacity -->
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <!-- Modal content -->
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative p-4 text-center bg-white rounded-sm shadow dark:bg-neutral-800 sm:p-5">
                    <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <i class="fa-solid fa-triangle-exclamation fa-4x text-red-500 py-4"></i>
                    <p class="mb-4 text-primary-500 dark:text-secondary font-paragraf text-md">Kamu akan menghapus item ini
                        selamanya. Apakah Kamu yakin?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button data-modal-hide="deleteModal" type="button"
                            class="py-2 px-6 text-sm font-medium text-primary-500 bg-white rounded-none border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-400 hover:text-primary-800 focus:z-10 dark:bg-neutral-800 dark:text-secondary dark:border-neutral-700 dark:hover:text-white dark:hover:bg-neutral-700 dark:focus:ring-gray-600">
                            Tidak, batalkan
                        </button>
                        <button id="confirm-delete-button" type="button"
                            class="py-2 px-6 text-sm font-medium text-center text-white bg-red-500 rounded-none hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Iya, Saya Yakin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const deleteButtons = document.querySelectorAll('.delete-button');
            const modal = document.getElementById('deleteModal');
            const confirmDeleteButton = document.getElementById('confirm-delete-button');
            let formToSubmit;

            // Show modal when delete button is clicked
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    formToSubmit = document.getElementById('delete-logbook-' + this.dataset.id);
                    modal.classList.remove('hidden');
                    modal.classList.add('flex'); // Ensure modal is displayed as flex to center it
                });
            });

            // Submit form when confirm delete button is clicked
            confirmDeleteButton.addEventListener('click', function() {
                formToSubmit.submit();
            });

            // Hide modal when cancel button is clicked or modal close button is clicked
            document.querySelectorAll('[data-modal-toggle="deleteModal"]').forEach(element => {
                element.addEventListener('click', function() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex'); // Hide the modal correctly
                });
            });
        });
    </script>

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
