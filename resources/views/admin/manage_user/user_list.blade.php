@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-950">
        <div class="p-4 mt-14">
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
            <div class="w-full">
                <div
                    class="bg-zinc-50 w-full min-h-screen border border-gray-100 dark:bg-neutral-900 dark:border-neutral-700">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <div class="flex justify-between items-end">
                            <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary">
                                {{ $pageTitle }}
                            </h2>
                            <div>
                                <a href="#"
                                    class="w-full text-lg font-normal text-end text-primary-800 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Tambah
                                    Mentor
                                </a>
                            </div>
                        </div>

                        <div class="relative overflow-x-auto mt-12">
                            <table
                                class="overflow-x-auto w-full text-sm text-left border border-gray-200 rtl:text-right text-gray-500 dark:text-gray-400 dark:border-neutral-700 z-10">
                                <thead class="text-xs uppercase bg-gray-200 dark:bg-neutral-900 dark:text-secondary">
                                    <tr>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            No.
                                        </th>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            Nama Lengkap
                                        </th>
                                        <th scope="col"
                                            class="px-4 text-center py-6 text-primary-800 dark:text-secondary">
                                            No. HP
                                        </th>
                                        <th scope="col"
                                            class="px-4 text-center py-6 text-primary-800 dark:text-secondary">
                                            Gender
                                        </th>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            Asal Instansi
                                        </th>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            Instansi Tujuan Magang
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-6 text-center text-primary-800 dark:text-secondary">
                                            Tanggal Rencana Mulai
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-6 text-center text-primary-800 dark:text-secondary">
                                            Tanggal Magang Disetujui
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-6 text-center text-primary-800 dark:text-secondary">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-8 text-center py-6 text-primary-800 dark:text-secondary">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allUser as $document)
                                        <tr
                                            class="odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-slate-100 even:dark:bg-neutral-600 border-b dark:border-neutral-700">
                                            <td class="px-4 py-4">
                                                <p class="text-primary-800 dark:text-secondary">{{ $loop->iteration }}</p>
                                            </td>
                                            <td class="px-4 py-4 w-1/6">
                                                <h5 class="font-bold text-primary-800 dark:text-secondary">
                                                    {{ $document->user->nama_lengkap }}
                                                </h5>
                                                <h5 class="text-primary-800 dark:text-secondary">
                                                    {{ $document->no_identitas }}
                                                </h5>
                                            </td>
                                            <td class="px-4 py-4">
                                                <h5 class="text-primary-800 dark:text-secondary">
                                                    {{ $document->user->no_hp }}
                                                </h5>
                                            </td>
                                            <td class="px-4 py-4">
                                                <h5 class="text-primary-800 text-center dark:text-secondary">
                                                    {{ substr($document->user->jenis_kelamin, 0, 1) }}
                                                </h5>
                                            </td>
                                            <td class="px-4 py-4">
                                                <h5 class="text-primary-800 dark:text-secondary">
                                                    {{ $document->instansi_asal }}
                                                </h5>
                                            </td>
                                            <td class="px-4 py-4">
                                                <h5 class="text-primary-800 font-bold dark:text-secondary">
                                                    {{ $document->office->nama_kantor }}
                                                </h5>
                                                <h5 class="text-primary-800 dark:text-secondary">
                                                    {{ $document->position->role }}
                                                </h5>
                                            </td>
                                            <td class="px-4 py-4">
                                                <h5 class="text-primary-800 text-center dark:text-secondary">
                                                    {{ convertDate($document->u_tgl_mulai) }}
                                                    <br> - <br>
                                                    {{ convertDate($document->u_tgl_selesai) }}
                                                </h5>
                                            </td>
                                            <td class="px-4 py-4">
                                                <h5 class="text-primary-800 font-bold text-center dark:text-secondary">
                                                    @if ($document->e_tgl_mulai && $document->e_tgl_selesai)
                                                        {{ convertDate($document->e_tgl_mulai) }} <br> - <br>
                                                        {{ convertDate($document->e_tgl_selesai) }}
                                                    @else
                                                        <span class="font-normal text-xs text-abu-800">
                                                            belum diatur
                                                        </span>
                                                    @endif
                                                </h5>
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="bg-yellow-300 px-4 py-2 pointer-events-none rounded-sm">
                                                    <h5 class="text-secondary capitalize text-center font-bold">
                                                        {{ $document->status->status }}
                                                    </h5>
                                                </div>
                                            </td>
                                            <td class="px-8">
                                                <div class="flex items-center h-full gap-4">
                                                    <a href="#" class="py-2 text-md text-blue-500 hover:underline">
                                                        Detail
                                                    </a>
                                                    {{-- <form id="delete-publication-#" action="#" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="py-2 text-md text-red-500 hover:underline">
                                                        <button class="delete-button" data-id="#" type="submit"
                                                            value="Delete">Hapus </button>
                                                </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
