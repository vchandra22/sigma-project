@extends('layouts.app')

@section('content')
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
                <div class="bg-gray-50 w-full border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-8">
                            <div>
                                <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary">
                                    {{ $pageTitle }}
                                </h2>
                            </div>
                            <div class="flex justify-end">
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
                                            <a href="{{ route('user.assignmentBelumDikerjakan') }}"
                                                class="btn btn-primary">Belum dikerjakan</a>
                                        </li>
                                        <li class="px-4 py-2 hover:text-primary-500 hover:font-bold">
                                            <a href="{{ route('user.assignmentstatusSelesai') }}"
                                                class="btn btn-primary">Selesai</a>
                                        </li>
                                        <li class="px-4 py-2 hover:text-primary-500 hover:font-bold">
                                            <a href="{{ route('user.assignmentstatusTerlambat') }}"
                                                class="btn btn-primary">Terlambat</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @forelse ($assignmentData as $data)
                            <div
                                class="flex flex-col gap-4 w-full p-4 lg:p-6 my-6 border border-abu-500 bg-gray-50 rounded-none dark:bg-neutral-900 dark:border-neutral-800">
                                <div class="md:flex justify-between items-start gap-2">
                                    <a href="{{ route('user.editAssignment', $data->slug) }}"
                                        class="text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-gray-50">
                                        <h3 class="text-lg md:text-2xl font-bold overflow-hidden line-clamp-2">
                                            {{ $data->judul }}
                                        </h3>
                                        <p class="font-regular text-md text-start text-primary-500 dark:text-secondary">
                                            {{-- Tugas dari: {{ $mentorData->nama_lengkap }} --}}
                                        </p>
                                        <p class="font-regular text-md text-start text-abu-800 dark:text-abu-800">
                                            {{ convertDate($data->start_date) . ' - ' . convertDate($data->due_date) }}
                                        </p>
                                    </a>
                                    <a href="{{ route('user.editAssignment', $data->slug) }}"
                                        class="hidden lg:block text-sm font-normal text-end text-primary-800 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Detail</a>
                                </div>
                                @if ($data->status == 'dikirim')
                                    <div class="bg-red-500 p-1 w-auto md:w-56 lg:w-1/6 mb-4">
                                        <p class="font-bold text-center capitalize text-white">{{ __('Belum dikerjakan') }}
                                        </p>
                                    </div>
                                @elseif ($data->status == 'selesai')
                                    <div class="bg-green-500 p-1 w-auto md:w-56 lg:w-1/6 mb-4">
                                        <p class="font-bold text-center capitalize text-white">{{ $data->status }}</p>
                                    </div>
                                @elseif ($data->status == 'terlambat')
                                    <div class="bg-yellow-300 p-1 w-auto md:w-56 lg:w-1/6 mb-4">
                                        <p class="font-bold text-center capitalize text-white">{{ $data->status }}</p>
                                    </div>
                                @endif
                                <div
                                    class="text-start text-primary-500 text-md dark:text-gray-200 overflow-hidden line-clamp-3">
                                    {{ Str::limit(strip_tags($data->pertanyaan), 500) }}
                                </div>
                            </div>
                        @empty
                            <div
                                class="min-h-screen flex items-center justify-center w-full border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                                <p class="text-md md:text-xl text-primary-800 text-center dark:text-white px-8">
                                    Belum ada tugas untukmu!
                                </p>
                            </div>
                        @endforelse
                        <div class="mt-8">
                            {{ $assignmentData->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
