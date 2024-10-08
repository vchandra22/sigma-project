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
                            @if ($getCertificateId->no_sertifikat != null)
                                <p class="text-sm md:text-sm lg:text-md font-bold text-blue-500 dark:text-secondary">No.
                                    Sertifikat: {{ $getCertificateId->no_sertifikat }}</p>
                            @else
                                <div>
                                    <a href="{{ route('mentor.addPenilaian', Crypt::encryptString($getCertificateId->id)) }}"
                                        class="w-full text-md font-normal text-end text-primary-500 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Tambah
                                        Unsur Kompetensi
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="relative overflow-x-auto mt-4 md:mt-12">
                            <div>
                                <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-primary-800 dark:text-secondary">
                                    {{ $getUserData->user->nama_lengkap }}
                                </h2>
                                <h2
                                    class="text-md md:text-lg lg:text-xl font-regular text-primary-800 dark:text-secondary mb-4">
                                    {{ $getUserData->instansi_asal }}
                                </h2>
                            </div>
                            <table
                                class="border-collapse overflow-x-auto w-full text-sm text-left border border-gray-200 rtl:text-right text-gray-500 dark:text-gray-400 dark:border-neutral-700 z-10">
                                <thead class="text-xs uppercase bg-gray-200 dark:bg-neutral-900 dark:text-secondary">
                                    <tr>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            No.
                                        </th>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            Judul Kompetensi
                                        </th>
                                        <th scope="col"
                                            class="px-4 text-start py-6 text-primary-800 dark:text-secondary">
                                            Nilai
                                        </th>
                                        @if ($getCertificateId->no_sertifikat != null)
                                        @else
                                            <th scope="col"
                                                class="px-4 text-center py-6 text-primary-800 dark:text-secondary">
                                                Action
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($scoreDetail as $data)
                                        <tr
                                            class="odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-slate-100 even:dark:bg-neutral-600 border-b dark:border-neutral-500">
                                            <td class="px-4 py-4">
                                                <p class="text-primary-800 dark:text-secondary">
                                                    {{ $loop->iteration }}
                                                </p>
                                            </td>
                                            <td class="px-4 py-4">
                                                <p class="text-primary-800 dark:text-secondary">
                                                    {{ $data->judul_kompetensi }}
                                                </p>
                                            </td>
                                            <td class="px-4 py-4">
                                                <p class="text-primary-800 text-start dark:text-secondary">
                                                    {{ $data->nilai_uji }}
                                                </p>
                                            </td>
                                            @if ($getCertificateId->no_sertifikat != null)
                                            @else
                                                <td class="px-4 py-4">
                                                    <div class="flex justify-center items-center h-full gap-4">
                                                        <a href="{{ route('mentor.editPenilaian', $data->uuid) }}"
                                                            class="w-full text-md font-normal text-end text-primary-500 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">
                                                            Edit
                                                        </a>
                                                        <form id="delete-penilaian-{{ $data->id }}"
                                                            action="{{ route('mentor.deletePenilaian', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <div
                                                                class="py-2 text-center text-md text-red-500 hover:underline">
                                                                <button class="delete-button" data-id="{{ $data->id }}"
                                                                    type="submit" value="Delete">Hapus </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                            </div>
                            <div class="lg:max-w-1/2 py-4">
                                <p class="text-md text-start text-primary-800 dark:text-white font-semibold">Range Nilai:
                                </p>
                                <ul>
                                    <li class="text-md text-start text-primary-800 dark:text-white">Nilai Kurang: 0-65.0
                                    </li>
                                    <li class="text-md text-start text-primary-800 dark:text-white">Nilai Cukup: 65.01-75.0
                                    </li>
                                    <li class="text-md text-start text-primary-800 dark:text-white">Nilai Baik: 75.01-80.0
                                    </li>
                                    <li class="text-md text-start text-primary-800 dark:text-white">Nilai Baik Sekali:
                                        80.01-100.0</li>
                                    <li class="text-sm text-start text-red-500 dark:text-white mt-4">*Jika sertifikat telah diterbitkan, Anda tidak dapat mengubah data nilai peserta</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    formToSubmit = document.getElementById('delete-penilaian-' + this.dataset.id);
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
@endsection
