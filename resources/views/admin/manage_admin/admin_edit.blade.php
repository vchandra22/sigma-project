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
                        <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary">
                            {{ $pageTitle }}
                        </h2>
                        @foreach ($userData as $data)
                            <form id="delete-admin-{{ $data->uuid }}"
                                action="{{ route('admin.deleteAdmin', ['uuid' => $data->uuid]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <div class="px-0 text-sm text-red-500">
                                    <button class="delete-button hover:underline" data-id="{{ $data->uuid }}"
                                        type="submit" value="Delete">Hapus
                                    </button>
                            </form>
                        @endforeach
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
                                                Instansi / OPD <span class="text-red-500">*</span>
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
    </div>
@endsection
