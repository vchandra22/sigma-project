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
                            <div>
                                <a href="{{ route('admin.createJourney') }}"
                                    class="w-full text-md font-normal text-end text-primary-500 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Tambah
                                    Journey Baru</a>
                            </div>
                        </div>

                        <div class="relative overflow-x-auto mt-12">
                            <table
                                class="w-full text-sm text-left border border-gray-200 rtl:text-right text-gray-500 dark:text-gray-400 dark:border-neutral-700 z-10">
                                <thead class="text-xs uppercase bg-gray-200 dark:bg-neutral-900 dark:text-secondary">
                                    <tr>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            No.
                                        </th>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            Judul
                                        </th>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            Content
                                        </th>
                                        <th scope="col"
                                            class="px-8 text-center py-6 text-primary-800 dark:text-secondary">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($journeyData as $data)
                                        <tr
                                            class="odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-slate-100 even:dark:bg-neutral-600 border-b dark:border-neutral-500">
                                            <td class="px-4 py-4">
                                                <p class="text-primary-800 dark:text-secondary">
                                                    {{ ($journeyData->currentPage() - 1) * $journeyData->perPage() + $loop->iteration }}
                                                </p>
                                            </td>
                                            <td class="px-4 py-4">
                                                <h5 class="font-bold text-primary-800 dark:text-secondary">
                                                    {{ $data->title }}
                                                </h5>
                                            </td>
                                            <td class="px-4 py-4">
                                                <h5 class="text-primary-800 dark:text-secondary">
                                                    {{ strip_tags($data->detail) }}
                                                </h5>
                                            </td>
                                            <td class="px-8">
                                                <div class="flex items-center h-full gap-4">
                                                    <a href="{{ route('admin.editJourney', $data->uuid) }}"
                                                        class="py-2 text-center text-md text-blue-500 hover:underline">
                                                        Edit
                                                    </a>
                                                    <form id="delete-journey-{{ $data->id }}"
                                                        action="{{ route('admin.deleteJourney', ['id' => $data->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="py-2 text-center text-md text-red-500 hover:underline">
                                                            <button class="delete-button" data-id="{{ $data->id }}"
                                                                type="submit" value="Delete">Hapus </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-8">
                                {{ $journeyData->links() }}
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
                    formToSubmit = document.getElementById('delete-journey-' + this.dataset.id);
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
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
                    modal.classList.remove('flex');
                });
            });
        });
    </script>
@endsection
