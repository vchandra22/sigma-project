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
                <div class="bg-secondary w-full border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary mb-8">
                            {{ $pageTitle }}
                        </h2>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                            @foreach ($assignmentData as $data)
                                <div
                                    class="lg:col-span-2 flex flex-col gap-4 w-full p-4 lg:p-6 border border-abu-500 rounded-none dark:bg-neutral-900 dark:border-neutral-800">
                                    <div class="text-primary-800 dark:text-secondary dark:hover:text-gray-50">

                                        <div class="block lg:flex justify-between items-center">
                                            <div>
                                                <h3
                                                    class="text-lg md:text-2xl font-bold text-primary-800 dark:text-secondary">
                                                    {{ $data->judul }}
                                                </h3>
                                                <p
                                                    class="font-regular text-md text-start text-primary-800 dark:text-secondary">
                                                    {{ $userData->user->nama_lengkap }}</p>
                                                <p class="font-regular text-md text-start text-abu-800 dark:text-abu-800">
                                                    {{ convertDate($data->start_date) . ' - ' . convertDate($data->due_date) }}
                                                </p>
                                            </div>
                                            @if ($data->status !== 'selesai')
                                                <a href="{{ route('mentor.editAssignment', $data->slug) }}"
                                                    class="text-sm font-normal text-end text-primary-800 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Edit
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="text-start text-primary-500 text-md dark:text-gray-200">
                                        {{ strip_tags($data->pertanyaan) }}
                                    </div>
                                    @if ($data->doc_pertanyaan)
                                        <a href="{{ route('downloadPertanyaan', $data->uuid) }}"
                                            class="py-2 text-md text-start text-blue-500 hover:underline">
                                            Download File Pertanyaan
                                        </a>
                                    @else
                                    @endif
                                </div>

                                <div
                                    class="flex flex-col gap-4 w-full p-4 lg:p-6 border border-abu-500 rounded-none dark:bg-neutral-900 dark:border-neutral-800">
                                    <div class="text-primary-800 dark:text-secondary dark:hover:text-gray-50">
                                        <h3 class="text-lg md:text-2xl font-bold">
                                            Jawaban Peserta
                                        </h3>
                                        @if ($data->status == 'dikirim')
                                            <div class="text-blue-500 p-1 w-auto">
                                                <p class="font-regular text-start capitalize">{{ __('Tugas Dikirim') }}
                                                </p>
                                            </div>
                                        @elseif ($data->status == 'selesai')
                                            <div class="text-green-500 p-1 w-auto">
                                                <p class="font-regular text-start capitalize">{{ $data->status }}</p>
                                            </div>
                                        @elseif ($data->status == 'terlambat')
                                            <div class="text-red-500 p-1 w-auto">
                                                <p class="font-regular text-start capitalize">{{ $data->status }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($data->doc_jawaban)
                                        <a href="{{ route('downloadJawaban', $data->uuid) }}"
                                            class="py-2 text-md text-start text-blue-500 hover:underline">
                                            Download File Jawaban
                                        </a>
                                    @elseif ($data->status === 'dikirim')

                                        <div>
                                            <p for="doc_jawaban"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                                Peserta belum menyelesaikan tugas
                                            </p>
                                        </div>
                                    @else
                                        <div>
                                            <p for="doc_jawaban"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                                Peserta telah menyelesaikan tugas
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
