@extends('mentor.layouts.app')

@section('content')
    @include('mentor.layouts.sidebar')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-950">
        <div class="p-1 md:p-4 mt-14">
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
            <div class="w-full">
                <div
                    class="bg-zinc-50 w-full min-h-screen border border-gray-100 dark:bg-neutral-900 dark:border-neutral-700">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-start">
                            <h2 class="text-xl md:text-2xl lg:text-4xl font-bold text-primary-800 dark:text-secondary">
                                {{ $pageTitle }}
                            </h2>
                        </div>

                        <div>
                            <div class="w-full mt-12">
                                <div class="bg-gray-50 border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                                    <h3
                                        class="text-xl md:text-2xl p-4 lg:text-4xl font-bold text-primary-800 dark:text-secondary">
                                        {{ $userData->nama_lengkap }}
                                    </h3>
                                    <div class="px-6 py-2">
                                        @if ($logbookUser->isNotEmpty())
                                            <div class="flex items-center justify-start h-full gap-4">
                                                <a href="{{ route('mentor.showLogbook', ['id' => encrypt($userData->status_id)]) }}"
                                                    onclick="var newWindow = window.open('{{ route('mentor.showLogbook', ['id' => encrypt($userData->status_id)]) }}', 'newwindow', 'width=900,height=990'); newWindow.onload = function() { newWindow.print(); }; return false;"
                                                    target="_blank">
                                                    @csrf
                                                    <p class="text-center text-sm text-blue-500 hover:underline">
                                                        Cetak Logbook
                                                    </p>
                                                </a>
                                            </div>
                                        @endif
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
                                                            ACTION
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
                                                                    <h5
                                                                        class="font-bold text-primary-800 dark:text-secondary">
                                                                        Topik
                                                                        Diskusi: </h5>
                                                                    <span class="dark:text-slate-300">
                                                                        {{ strip_tags($logbook->topik_diskusi) }}
                                                                    </span>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <h5
                                                                        class="font-bold text-primary-800 dark:text-secondary">
                                                                        Arahan
                                                                        Pembimbing: </h5>
                                                                    <span class="dark:text-slate-300">
                                                                        {{ strip_tags($logbook->arahan_pembimbing) }}
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <h5
                                                                        class="font-bold text-primary-800 dark:text-secondary">
                                                                        Bukti Dukung
                                                                    </h5>
                                                                    <a class="text-blue-400 hover:text-blue-500 hover:underline"
                                                                        href="{{ asset('storage/img/bukti/' . $logbook->bukti) }}"
                                                                        target="_blank">
                                                                        {{ asset('storage/img/bukti/' . $logbook->bukti) }}
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td class="px-8 py-6 flex justify-start items-center gap-4">
                                                                @if ($logbook->status === 'menunggu')
                                                                    <form
                                                                        action="{{ route('mentor.updateLogbook', ['logbook' => encrypt($logbook->id)]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="py-2 px-2 text-xs bg-green-500 hover:bg-opacity-80 text-secondary">
                                                                            Setujui
                                                                        </button>
                                                                    </form>
                                                                @elseif ($logbook->status === 'disetujui')
                                                                    <form
                                                                        action="{{ route('mentor.updateLogbook', ['logbook' => encrypt($logbook->id)]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="py-2 px-2 text-xs bg-orange-500 hover:bg-opacity-80 text-secondary">
                                                                            Batalkan
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                <div>
                                                                    <form id="delete-logbook-{{ $logbook->id }}"
                                                                        action="{{ route('mentor.deleteLogbook', ['id' => $logbook->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <div
                                                                            class="py-2 px-2 text-xs bg-red-500 hover:bg-opacity-80 text-secondary">
                                                                            <button class="delete-button"
                                                                                data-id="{{ $logbook->id }}"
                                                                                type="submit" value="Delete">Hapus
                                                                            </button>
                                                                    </form>
                                                                </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
