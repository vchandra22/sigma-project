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
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end">
                            <div>
                                <h2 class="text-4xl mb-8 md:text-5xl font-bold text-primary-800 dark:text-secondary">
                                    {{ $pageTitle }}
                                </h2>
                            </div>
                            <div>
                                @foreach ($userData as $data)
                                    <form id="delete-user-{{ $data->user->id }}"
                                        action="{{ route('admin.deleteUser', ['id' => $data->user->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <div class="px-0 text-sm text-red-500">
                                            <button class="delete-button hover:underline" data-id="{{ $data->user->id }}"
                                                type="submit" value="Delete">Hapus
                                            </button>
                                        </div>
                                    </form>
                                @endforeach
                            </div>
                        </div>

                        @foreach ($userData as $data)
                            <form class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16"
                                action="{{ route('admin.updatePeserta', ['document' => $data->id]) }}" method="POST"
                                enctype="multipart/form-data">
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
                                            value="{{ old('nama_lengkap', $data->user->nama_lengkap) }}" />
                                        @error('nama_lengkap')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="no_identitas"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nomor
                                            Identitas <span class="text-red-500">*</span></label>
                                        <input type="text" name="no_identitas" id="no_identitas"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required value="{{ old('no_identitas', $data->no_identitas) }}" />
                                        @error('no_identitas')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Nomor identitas dapat
                                            diisikan
                                            dengan NIS/NIM/NIK.
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Jika No. Identitas
                                            diganti, username otomatis menggunakan No. Identitas baru
                                        </p>
                                    </div>

                                    <div>
                                        <label for="jenis_kelamin"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Jenis
                                            Kelamin <span class="text-red-500">*</span></label>
                                        <select type="text" name="jenis_kelamin" id="jenis_kelamin"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                            <option value="Laki - Laki"
                                                {{ old('jenis_kelamin', $data->user->jenis_kelamin ?? '') == 'Laki - Laki' ? 'selected' : '' }}>
                                                Laki - Laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin', $data->user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="mt-1 text-red-500 text-xs">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="hidden">
                                        <label for="username"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Username<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="username" id="username"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="Otomatis diisi dari No. Identitas" required
                                            value="{{ $data->user->username }}" />
                                        @error('username')
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
                                            required value="{{ old('no_hp', $data->user->no_hp) }}" />
                                        @error('no_hp')
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
                                            required value="{{ old('email', $data->user->email) }}" />
                                        @error('email')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="instansi_asal"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Instansi
                                            Asal <span class="text-red-500">*</span></label>
                                        <input type="text" name="instansi_asal" id="instansi_asal"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required value="{{ old('instansi_asal', $data->instansi_asal) }}" />

                                        @error('instansi_asal')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan nama
                                            Universitas
                                            atau SMA/SMK.</p>
                                    </div>

                                    <div>
                                        <label for="jurusan"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Jurusan
                                            / Konsentrasi Bidang Keahlian <span class="text-red-500">*</span></label>
                                        <input type="text" name="jurusan" id="jurusan"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="Rekayasa Perangkat Lunak" required
                                            value="{{ old('jurusan', $data->jurusan) }}" />

                                        @error('jurusan')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan jurusan
                                            atau
                                            bidang keahlian yang sedang ambil.</p>
                                    </div>

                                    <div>
                                        <label for="office_id"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Instansi
                                            Tujuan <span class="text-red-500">*</span></label>
                                        <select type="text" name="office_id" id="office_id"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                            @foreach ($officeList as $office)
                                                <option value="{{ $office->id }}"
                                                    {{ old('office_id', $data->office->id ?? null) == $office->id ? 'selected' : '' }}>
                                                    {{ $office->nama_kantor }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('office_id')
                                            <div class="mt-1 text-red-500 text-xs">{{ $message }}</div>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan instansi
                                            tujuan melakukan kegiatan magang</p>
                                    </div>

                                    <div>
                                        <label for="position_id"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Posisi
                                            Pekerjaan <span class="text-red-500">*</span></label>
                                        <select type="text" name="position_id" id="position_id"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                            @foreach ($positionList as $position)
                                                <option value="{{ $position->id }}"
                                                    {{ old('position_id', $data->position->id ?? null) == $position->id ? 'selected' : '' }}>
                                                    {{ $position->role }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                            <div class="mt-1 text-red-500 text-xs">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="nama_pembimbing"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nama
                                            Guru / Dosen Pembimbing <span class="text-red-500">*</span></label>
                                        <input type="text" name="nama_pembimbing" id="nama_pembimbing"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="Hardianto" required
                                            value="{{ old('nama_pembimbing', $data->nama_pembimbing) }}" />

                                        @error('nama_pembimbing')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="no_hp_pembimbing"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">No.HP
                                            Guru / Dosen Pembimbing <span class="text-red-500">*</span></label>
                                        <input type="text" name="no_hp_pembimbing" id="no_hp_pembimbing"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="081255555555" required
                                            value="{{ old('no_hp_pembimbing', $data->no_hp_pembimbing) }}" />

                                        @error('no_hp_pembimbing')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan teliti,
                                            pastikan nomor dapat dihubungi!</p>
                                    </div>

                                </div>
                                <div class="space-y-6">

                                    <div>
                                        <label
                                            class="block mb-4 text-sm font-medium text-primary-800 dark:text-secondary">Dokumen
                                            Calon Peserta
                                        </label>
                                        <table
                                            class="border-collapse overflow-x-auto w-full text-sm text-left border border-gray-200 rtl:text-right text-gray-500 dark:text-gray-400 dark:border-neutral-700 z-10">
                                            <thead
                                                class="text-xs uppercase bg-gray-200 dark:bg-neutral-900 dark:text-secondary">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-4 py-6 text-primary-800 dark:text-secondary">
                                                        No.
                                                    </th>
                                                    <th scope="col"
                                                        class="px-4 py-6 text-primary-800 dark:text-secondary">
                                                        Dokumen Peserta
                                                    </th>
                                                    <th scope="col"
                                                        class="px-4 text-center py-6 text-primary-800 dark:text-secondary">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    class="odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-slate-100 even:dark:bg-neutral-600 border-b dark:border-neutral-700">
                                                    <td class="px-4 py-4">
                                                        <p class="text-primary-800 dark:text-secondary">
                                                            1
                                                        </p>
                                                    </td>
                                                    <td class="px-4 py-4">
                                                        <p class="text-primary-800 dark:text-secondary">Surat Pengantar</p>
                                                    </td>
                                                    <td class="px-4 py-4">
                                                        <div class="flex justify-center items-center h-full gap-4">
                                                            <a href="{{ route('admin.downloadDocuments', $data->doc_pengantar) }}"
                                                                class="py-2 text-md text-center text-blue-500 hover:underline">
                                                                Download
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @if ($data->doc_kesbang !== null)
                                                    <tr
                                                        class="odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-slate-100 even:dark:bg-neutral-600 border-b dark:border-neutral-700">
                                                        <td class="px-4 py-4">
                                                            <p class="text-primary-800 dark:text-secondary">
                                                                2
                                                            </p>
                                                        </td>
                                                        <td class="px-4 py-4">
                                                            <p class="text-primary-800 dark:text-secondary">Surat Pengantar
                                                                (BAKESBANGPOL)
                                                            </p>
                                                        </td>
                                                        <td class="px-4 py-4">
                                                            <div class="flex justify-center items-center h-full gap-4">
                                                                <a href="{{ route('admin.downloadDocuments', $data->doc_kesbang) }}"
                                                                    class="py-2 text-md text-center text-blue-500 hover:underline">
                                                                    Download
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="3" class="px-4 py-4 text-center">
                                                            Pendaftar tidak
                                                            mengunggah dokumen (BAKESBANGPOL)</td>
                                                    </tr>
                                                @endif
                                                @if ($data->doc_proposal !== null)
                                                    <tr
                                                        class="odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-slate-100 even:dark:bg-neutral-600 border-b dark:border-neutral-700">
                                                        <td class="px-4 py-4">
                                                            <p class="text-primary-800 dark:text-secondary">
                                                                3
                                                            </p>
                                                        </td>
                                                        <td class="px-4 py-4">
                                                            <p class="text-primary-800 dark:text-secondary">Dokumen Lain
                                                            </p>
                                                        </td>
                                                        <td class="px-4 py-4">
                                                            <div class="flex justify-center items-center h-full gap-4">
                                                                <a href="{{ route('admin.downloadDocuments', $data->doc_proposal) }}"
                                                                    class="py-2 text-md text-center text-blue-500 hover:underline">
                                                                    Download
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="3" class="px-4 py-4 text-center">Pendaftar tidak
                                                            mengunggah dokumen</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        <label for="u_tgl_mulai"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Rencana
                                            Pelaksanaan </label>
                                        <div class="flex items-center">
                                            <div class="relative w-full">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input name="u_tgl_mulai" id="u_tgl_mulai" type="text" readonly
                                                    value="{{ date('d/m/Y', strtotime($data->u_tgl_mulai)) }}"
                                                    class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                                @error('u_tgl_mulai')
                                                    <div
                                                        class="mt-1
                                                    text-red-500 text-xs">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <span
                                                class="mx-3 text-primary-800 text-sm text-center dark:text-secondary">sampai
                                            </span>

                                            <div class="relative w-full">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input name="u_tgl_selesai" id="u_tgl_selesai" type="text" readonly
                                                    value="{{ date('d/m/Y', strtotime($data->u_tgl_selesai)) }}"
                                                    class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                                @error('u_tgl_selesai')
                                                    <div class="mt-1 text-red-500 text-xs">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="e_tgl_mulai"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Tanggal
                                            disetujui <span class="text-red-500">*</span></label>
                                        <div class="flex items-center">
                                            <div class="relative w-full">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input datepicker-format="dd/mm/yyyy" name="e_tgl_mulai" id="e_tgl_mulai"
                                                    datepicker type="text" placeholder="Pilih tanggal"
                                                    value="{{ date('d/m/Y', strtotime($data->e_tgl_mulai ?? $data->u_tgl_mulai)) }}"
                                                    class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                                @error('e_tgl_mulai')
                                                    <div
                                                        class="mt-1
                                                    text-red-500 text-xs">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <span
                                                class="mx-3 text-primary-800 text-sm text-center dark:text-secondary">sampai
                                            </span>

                                            <div class="relative w-full">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input datepicker-format="dd/mm/yyyy" name="e_tgl_selesai"
                                                    id="e_tgl_selesai" type="text" placeholder="Pilih tanggal"
                                                    value="{{ date('d/m/Y', strtotime($data->e_tgl_selesai ?? $data->u_tgl_selesai)) }}"
                                                    datepicker
                                                    class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                                @error('e_tgl_selesai')
                                                    <div class="mt-1 text-red-500 text-xs">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="status"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Status
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <select type="text" name="status" id="status"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                            <option value="menunggu"
                                                {{ $data->status->status === 'menunggu' ? 'selected' : '' }}>
                                                Menunggu
                                            </option>
                                            <option value="diterima"
                                                {{ $data->status->status === 'diterima' ? 'selected' : ($data->status->status === 'menunggu' ? 'selected' : '') }}>
                                                Diterima
                                            </option>
                                            <option value="ditolak"
                                                {{ $data->status->status === 'ditolak' ? 'selected' : '' }}>
                                                Ditolak
                                            </option>
                                            <option value="selesai"
                                                {{ $data->status->status === 'selesai' ? 'selected' : '' }}>
                                                Selesai
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="mt-1 text-red-500 text-xs">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="keterangan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan
                                        </label>
                                        <textarea name="keterangan" id="keterangan" rows="8"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">{{ old('keterangan', $data->status->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="doc_balasan"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                            Surat Balasan</label>
                                        <input
                                            class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-white hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                            id="doc_balasan" type="file" name="doc_balasan" value="">
                                        @error('doc_balasan')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul
                                            class="mt-1 pl-2 list-disc list-inside text-xs text-gray-500 dark:text-secondary">
                                            <li>Unggah file dengan format .pdf (Max. 2MB)</li>
                                        </ul>
                                    </div>
                                    <div class="flex flex-col lg:flex-row justify-end items-end gap-4 pt-4 lg:pt-[5.5rem]">
                                        <div class="flex justify-end mt-8">
                                            <a href="{{ route('admin.forceResetUserPassword', $data->user->uuid) }}"
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
                    formToSubmit = document.getElementById('delete-user-' + this.dataset.id);
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
    <script>
        const no_identitas = document.querySelector('#no_identitas');
        const username = document.querySelector('#username');

        function isiUsername() {
            username.value = no_identitas.value;
        }

        no_identitas.addEventListener('input', isiUsername);
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#keterangan'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
