@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')
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
            <div class="w-full">
                <div
                    class="bg-zinc-50 w-full min-h-screen border border-gray-100 dark:bg-neutral-900 dark:border-neutral-700">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end">
                            <h2 class="text-xl md:text-2xl lg:text-4xl font-bold text-primary-800 dark:text-secondary">
                                {{ $pageTitle }}
                            </h2>
                            <button id="exportPDFButton"
                                class="text-white bg-red-500 hover:bg-red-600 text-sm px-8 py-2.5 text-center inline-flex items-center dark:bg-red-500 dark:hover:bg-red-600 dark:hover:border dark:text-neutral-900 dark:hover:text-white gap-2">
                                <span>
                                    <i class="fa-solid fa-file-pdf fa-lg"></i>
                                </span>
                                Export PDF
                            </button>
                        </div>

                        <div class="relative overflow-x-auto mt-6">
                            <input type="hidden" id="searchTableCertificate" value="{{ route('admin.tableCertificate') }}">
                            <table id="tableManageCertificate"
                                class="border-collapse overflow-x-auto w-full text-sm text-left border border-gray-200 rtl:text-right text-gray-500 dark:text-gray-400 dark:border-neutral-700 z-10">
                                <thead class="text-xs uppercase bg-gray-200 dark:bg-neutral-900 dark:text-secondary">
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>
                                            No. Identitas
                                        </th>
                                        <th>
                                            Nama Peserta
                                        </th>
                                        <th>
                                            Instansi
                                        </th>
                                        <th>
                                            Posisi
                                        </th>
                                        <th>
                                            Tanggal Magang
                                        </th>
                                        <th>
                                            No. Sertifikat
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            document.getElementById('exportPDFButton').addEventListener('click', function() {
                window.location.href = "{{ route('admin.exportCertificatePDF') }}";
            });
        </script>
    @endpush
@endsection
