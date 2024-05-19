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
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-white inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
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
                        <div class="flex items-end justify-between">
                            <div>
                                <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary">
                                    {{ $pageTitle }}
                                </h2>
                            </div>
                            <div>
                                <div>
                                    @foreach ($userData as $data)
                                        <form id="delete-admin-{{ $data->uuid }}"
                                            action="{{ route('admin.deleteAdmin', ['uuid' => $data->uuid]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="px-0 text-sm text-red-500">
                                                <button class="delete-button hover:underline" data-id="{{ $data->uuid }}"
                                                    type="submit" value="Delete">Hapus
                                                </button>
                                            </div>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @foreach ($userData as $data)
                            <div class="mt-8">
                                <form action="{{ route('admin.updateAdmin', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="space-y-6">
                                        <div>
                                            <label for="nama_lengkap"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nama
                                                Lengkap <span class="text-red-500">*</span></label>
                                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                placeholder="Vincent Chandra Trie Novan" required autofocus
                                                value="{{ old('nama_lengkap', $data->nama_lengkap) }}" />
                                            @error('nama_lengkap')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="username"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Username<span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" name="username" id="username"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                placeholder="Masukkan Username" required
                                                value="{{ old('username', $data->username) }}" />
                                            @error('username')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="jenis_kelamin"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Jenis
                                                Kelamin <span class="text-red-500">*</span></label>
                                            <select type="text" name="jenis_kelamin" id="jenis_kelamin"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                                <option value="Laki - Laki"
                                                    {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Laki - Laki' ? 'selected' : '' }}>
                                                    Laki - Laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="mt-1 text-red-500 text-xs">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="nip"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">NIP
                                                <span class="text-red-500">*</span></label>
                                            <input type="text" name="nip" id="nip"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required value="{{ old('nip', $data->nip) }}" />
                                            @error('nip')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Alamat
                                                Email <span class="text-red-500">*</span></label>
                                            <input type="email" name="email" id="email"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required value="{{ old('email', $data->email) }}" />
                                            @error('email')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div>
                                            <label for="no_hp"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">No.Handphone
                                                <span class="text-red-500">*</span></label>
                                            <input type="text" name="no_hp" id="no_hp"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required value="{{ old('no_hp', $data->no_hp) }}" />
                                            @error('no_hp')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="office_id"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Instansi
                                                / OPD <span class="text-red-500">*</span></label>
                                            <select type="text" name="office_id" id="office_id"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                                @foreach ($officeList as $office)
                                                    <option value="{{ $office->id }}"
                                                        {{ old('office_id', $data->office_id ?? null) == $office->id ? 'selected' : '' }}>
                                                        {{ $office->nama_kantor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('office_id')
                                                <div class="mt-1 text-red-500 text-xs">{{ $message }}</div>
                                            @enderror
                                            <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan
                                                instansi
                                                bekerja</p>
                                        </div>

                                        <div>
                                            <label for="roles"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                                Role <span class="text-red-500">*</span>
                                            </label>
                                            <select type="text" name="roles" id="roles"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                                @foreach ($roleList as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ old('roles', $data->getRoleNames()->first() ?? null) == $role->name ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('roles')
                                                <div class="mt-1 text-red-500 text-xs">{{ $message }}</div>
                                            @enderror
                                            <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan
                                                instansi
                                                bekerja</p>
                                        </div>

                                        <div
                                            class="flex flex-col lg:flex-row justify-end items-end gap-4 pt-4 lg:pt-[5.5rem]">
                                            <div class="flex justify-end mt-8">
                                                <a href="{{ route('admin.forceResetPassword', $data->uuid) }}"
                                                    class="w-full px-11 py-3 text-lg font-normal text-center text-primary-800 bg-transparent rounded-none border border-primary-800 hover:bg-primary-500 hover:text-secondary focus:ring-2 focus:ring-accent sm:w-auto dark:bg-transparent dark:text-secondary dark:border-secondary dark:hover:text-neutral-900 dark:hover:bg-white dark:focus:ring-blue-800">
                                                    Ganti Password
                                                </a>
                                            </div>
                                            <button type="submit"
                                                class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Update
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
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
                    formToSubmit = document.getElementById('delete-admin-' + this.dataset.id);
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
