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
                <div class="bg-secondary w-full border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary mb-8">
                            {{ $pageTitle }}
                        </h2>

                        <div class="grid grid-cols-3 gap-2">
                            <div
                                class="col-span-2 flex flex-col gap-4 w-full p-4 lg:p-6 border border-abu-500 rounded-none dark:bg-neutral-900 dark:border-neutral-800">
                                <a href="#"
                                    class="text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-gray-50">
                                    <h3 class="text-lg md:text-2xl font-bold">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                    </h3>
                                    <p class="font-regular text-start text-primary-800">24 April 2024 - 28 April 2024</p>
                                </a>
                                <div class="text-start text-primary-500 text-md dark:text-gray-200">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo alias veniam a velit
                                    voluptatibus iure aliquid minus, officia eius quia rem perferendis quam qui beatae neque
                                    reiciendis pariatur numquam? Dolore, iusto aperiam soluta vel facere cumque? Quam
                                    voluptatibus commodi recusandae?
                                </div>
                            </div>

                            <div
                                class="flex flex-col gap-4 w-full p-4 lg:p-6 border border-abu-500 rounded-none dark:bg-neutral-900 dark:border-neutral-800">
                                <a href="#"
                                    class="text-primary-800 hover:text-primary-500 dark:text-secondary dark:hover:text-gray-50">
                                    <h3 class="text-lg md:text-2xl font-bold">
                                        Tugas Anda
                                    </h3>
                                    <p class="font-regular text-start text-red-500">belum dikerjakan</p>
                                </a>
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <label for="doc_jawaban"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                            Dokumen Jawaban</label>
                                        <input
                                            class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-white hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                            id="doc_jawaban" type="file" name="doc_jawaban">
                                        @error('doc_jawaban')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul
                                            class="mt-1 pl-2 list-disc list-inside text-xs text-gray-500 dark:text-secondary">
                                            <li>Unggah file dengan format .pdf (Max. 2MB)</li>
                                        </ul>
                                    </div>
                                    <div class="flex flex-col items-end pt-8">
                                        <button type="submit"
                                            class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Simpan
                                        </button>
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
