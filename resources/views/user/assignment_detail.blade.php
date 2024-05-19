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

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                            @foreach ($assignmentData as $data)
                                <div
                                    class="lg:col-span-2 flex flex-col gap-4 w-full p-4 lg:p-6 border border-abu-500 rounded-none dark:bg-neutral-900 dark:border-neutral-800">
                                    <div class="text-primary-800 dark:text-secondary dark:hover:text-gray-50">
                                        <h3 class="text-lg md:text-2xl font-bold">
                                            {{ $data->judul }}
                                        </h3>
                                        <p class="font-regular text-md text-start text-primary-500 dark:text-secondary">
                                            Tugas dari: {{ $mentorData->nama_lengkap }}
                                        </p>
                                        <p class="font-regular text-md text-start text-abu-800 dark:text-abu-800">
                                            {{ convertDate($data->start_date) . ' - ' . convertDate($data->due_date) }}
                                        </p>
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
                                            Tugas Anda
                                        </h3>
                                        @if ($data->status == 'dikirim')
                                            <div class="text-red-500 p-1 w-auto">
                                                <p class="font-regular text-start capitalize">{{ __('Belum dikerjakan') }}
                                                </p>
                                            </div>
                                        @elseif ($data->status == 'selesai')
                                            <div class="text-green-500 p-1 w-auto">
                                                <p class="font-regular text-start capitalize">{{ $data->status }}</p>
                                            </div>
                                        @elseif ($data->status == 'terlambat')
                                            <div class="text-yellow-300 p-1 w-auto">
                                                <p class="font-regular text-start capitalize">{{ $data->status }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($data->doc_jawaban)
                                        <p for="doc_jawaban"
                                            class="block mb-2 text-md font-medium text-primary-800 dark:text-secondary">
                                            Dokumen Jawaban
                                        </p>
                                        <a href="{{ route('downloadJawaban', $data->uuid) }}"
                                            class="py-2 text-sm text-start text-blue-500 hover:underline">
                                            Download File Jawaban
                                        </a>
                                        <form action="{{ route('user.cancelAssignment', $data->id) }}"
                                            id="cancel-assignment-form" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" id="cancel-button"
                                                class="w-full px-8 py-3 text-sm font-normal text-center text-red-500 border border-red-500 hover:text-white bg-transparent rounded-none hover:bg-red-500 focus:ring-2 focus:ring-red-700 sm:w-auto dark:bg-red-500 dark:text-white dark:hover:bg-red-600 dark:focus:ring-red-800">Batal
                                                Kirim</button>
                                        </form>
                                    @else
                                        <form action="{{ route('user.updateAssignment', ['assignment' => $data->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
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
                                                    <li>Unggah file dengan format (.pdf, .zip, .rar, .docx, .xlsx, .xls,
                                                        .txt) (Max. 2MB)</li>
                                                    <li>Jika tugas tidak bersangkutan dengan dokumen silakan simpan tanpa
                                                        dokumen
                                                        untuk menandai telah menyelesaikan tugas</li>
                                                </ul>
                                            </div>
                                            <div class="flex flex-col items-end pt-8">
                                                <button type="submit"
                                                    class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Simpan
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <!-- Button to trigger modal (for testing purposes, you can remove this later) -->
                        <div class="hidden justify-center m-5">
                            <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                                class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                type="button">
                                Show delete confirmation
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
                                    <p class="mb-4 text-primary-500 dark:text-secondary font-paragraf text-md">Kamu akan
                                        menghapus item ini
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
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelButton = document.getElementById('cancel-button');
            const modal = document.getElementById('deleteModal');
            const confirmDeleteButton = document.getElementById('confirm-delete-button');
            let formToSubmit = document.getElementById('cancel-assignment-form');

            // Show modal when cancel button is clicked
            cancelButton.addEventListener('click', function(event) {
                event.preventDefault();
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });

            // Submit form when confirm delete button is clicked
            confirmDeleteButton.addEventListener('click', function() {
                formToSubmit.submit();
            });

            // Hide modal when cancel button or modal close button is clicked
            document.querySelectorAll('[data-modal-hide="deleteModal"]').forEach(element => {
                element.addEventListener('click', function() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });
            });

            // Hide modal when clicking outside the modal content
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    </script>
@endsection
