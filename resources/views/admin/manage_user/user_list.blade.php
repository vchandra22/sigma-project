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
                        <div class="flex flex-row lg:flex-row justify-between items-end lg:items-end">
                            <h2 class="text-xl md:text-2xl lg:text-4xl font-bold text-primary-800 dark:text-secondary">
                                {{ $pageTitle }}
                            </h2>
                            <div>
                                <a href="{{ route('admin.createUser') }}"
                                    class="w-full text-md font-normal text-end text-primary-500 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Tambah
                                    User
                                </a>
                            </div>
                        </div>


                        <div class="relative overflow-x-auto mt-6">
                            <div class="flex justify-end mb-4">
                                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                    class="text-white bg-primary-500 hover:bg-primary-800 text-sm px-8 py-2.5 text-center inline-flex items-center dark:bg-secondary dark:hover:bg-neutral-900 dark:hover:border dark:text-neutral-900 dark:hover:text-white"
                                    type="button">Filter Status<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="dropdown"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 w-44 dark:bg-neutral-950">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownDefaultButton">
                                        <li class="px-4 py-2 hover:text-primary-500 hover:font-bold">
                                            <button onclick="filterByStatus(' ')">Semua</button>
                                        </li>
                                        <li class="px-4 py-2 hover:text-primary-500 hover:font-bold">
                                            <button onclick="filterByStatus('menunggu')">Menunggu</button>
                                        </li>
                                        <li class="px-4 py-2 hover:text-primary-500 hover:font-bold">
                                            <button onclick="filterByStatus('diterima')">Diterima</button>
                                        </li>
                                        <li class="px-4 py-2 hover:text-primary-500 hover:font-bold">
                                            <button onclick="filterByStatus('ditolak')">Ditolak</button>
                                        </li>
                                        <li class="px-4 py-2 hover:text-primary-500 hover:font-bold">
                                            <button onclick="filterByStatus('selesai')">Selesai</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" id="searchTableUser" value="{{ route('admin.tableUser') }}">
                            </div>
                            <table id="tableManageUser"
                                class="border-collapse overflow-x-auto w-full text-sm text-left border border-gray-200 rtl:text-right text-gray-500 dark:text-gray-400 dark:border-neutral-700 z-10">
                                <thead
                                    class="text-xs uppercase bg-gray-200 dark:bg-neutral-800 dark:text-secondary">
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
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            Posisi Pekerjaan
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function filterByStatus(status) {
            // Use DataTables API to filter data by status
            $('#tableManageUser').DataTable().column('status.status:name').search(status).draw();
        }
    </script>
    @push('data-table')
        @once
            <script type="text/javascript" src="{{ asset('assets/js/data-table-user.js') }}"></script>
        @endonce
    @endpush
@endsection
