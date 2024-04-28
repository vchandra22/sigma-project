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
            <div class="w-full">
                <div
                    class="bg-zinc-50 w-full min-h-screen border border-gray-100 dark:bg-neutral-900 dark:border-neutral-700">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end">
                            <h2 class="text-xl md:text-2xl lg:text-4xl font-bold text-primary-800 dark:text-secondary">
                                {{ $pageTitle }}
                            </h2>
                            <div>
                                <a href="{{ route('mentor.createAssignment') }}"
                                    class="w-full text-md font-normal text-end text-primary-500 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Buat
                                    Tugas Baru
                                </a>
                            </div>
                        </div>

                        @forelse ($assignmentData as $data)
                            <div
                                class="flex flex-col gap-4 w-full p-4 lg:p-6 my-6 border border-abu-500 rounded-none dark:bg-neutral-900 dark:border-neutral-800">
                                <div class="block lg:flex justify-between items-center">
                                    <div>
                                        <a href="{{ route('mentor.detailAssignment', $data->slug) }}"
                                            class="text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-gray-50">
                                            <h3 class="text-lg md:text-2xl font-bold overflow-hidden line-clamp-2">
                                                {{ $data->judul }}
                                            </h3>
                                            <p class="font-bold text-start text-abu-800">
                                                {{ convertDate($data->start_date) . ' - ' . convertDate($data->due_date) }}
                                            </p>
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div>
                                            <a href="{{ route('mentor.detailAssignment', $data->slug) }}"
                                                class="text-sm font-normal text-end text-primary-800 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Detail
                                            </a>
                                        </div>
                                        <div>
                                            <form id="delete-assignment-{{ $data->id }}"
                                                action="{{ route('mentor.deleteAssignment', ['id' => $data->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <div class="text-sm text-red-500">
                                                    <button class="delete-button hover:underline"
                                                        data-id="{{ $data->id }}" type="submit" value="Delete">Hapus
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @if ($data->status == 'dikirim')
                                        <div class="bg-blue-500 p-1 w-auto md:w-56 lg:w-1/6">
                                            <p class="font-bold text-center text-white">{{ $data->status }}</p>
                                        </div>
                                    @elseif ($data->status == 'selesai')
                                        <div class="bg-green-500 p-1 w-auto md:w-56 lg:w-1/6">
                                            <p class="font-bold text-center text-white">{{ $data->status }}</p>
                                        </div>
                                    @elseif ($data->status == 'terlambat')
                                        <div class="bg-red-500 p-1 w-auto md:w-56 lg:w-1/6">
                                            <p class="font-bold text-center text-white">{{ $data->status }}</p>
                                        </div>
                                    @endif
                                    <div
                                        class="text-start text-primary-500 text-md dark:text-gray-200 overflow-hidden line-clamp-3">
                                        {{ Str::limit(strip_tags($data->pertanyaan), 500) }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="min-h-screen flex items-center justify-center w-full dark:bg-neutral-900">
                                <p class="text-md md:text-xl text-primary-800 text-center dark:text-white px-8">
                                    Tidak ada tugas yang dibuat
                                </p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
