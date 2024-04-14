@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-950">
        <div class="p-4 mt-14">
            <div class="w-full">
                <div>
                    <div class="bg-secondary w-full border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                        <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                            <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary mb-8">
                                {{ $pageTitle }}
                            </h2>

                            <form action="{{ route('user.update-profile', Auth::user()->id) }}" method="POST"
                                class="space-y-6">
                                @csrf
                                @foreach ($userDetail as $user)
                                    <div>
                                        <label for="nama_lengkap"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Nama
                                            Lengkap <span class="text-red-500">*</span></label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ old('nama_lengkap', $user->nama_lengkap) }}" />
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
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required value="{{ old('no_identitas', $user->document->no_identitas) }}" />
                                        @error('no_identitas')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Nomor identitas dapat
                                            diisikan
                                            dengan NIS/NIM/NIK.</p>
                                    </div>

                                    <div>
                                        <label for="jenis_kelamin"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Jenis
                                            Kelamin <span class="text-red-500">*</span>
                                        </label>
                                        <select type="text" name="jenis_kelamin" id="jenis_kelamin"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                            <option value="Laki - Laki"
                                                {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Laki - Laki' ? 'selected' : '' }}>
                                                Laki - Laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="hidden">
                                        <label for="username"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Username<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="username" id="username"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="Otomatis diisi dari No. Identitas" required
                                            value="{{ $user->username }}" />
                                        @error('username')
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
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required value="{{ old('email',$user->email) }}" />
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
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required value="{{ old('no_hp',$user->no_hp) }}" />
                                        @error('no_hp')
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
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required value="{{ old('instansi_asal',$user->document->instansi_asal) }}" />

                                        @error('instansi_asal')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan nama
                                            Universitas
                                            atau SMA/SMK kalian.</p>
                                    </div>

                                    <div>
                                        <label for="jurusan"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Jurusan
                                            / Konsentrasi Bidang Keahlian <span class="text-red-500">*</span></label>
                                        <input type="text" name="jurusan" id="jurusan"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required value="{{ old('jurusan', $user->document->jurusan) }}" />

                                        @error('jurusan')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Isikan dengan jurusan
                                            atau
                                            bidang keahlian yang kalian ambil.</p>
                                    </div>
                                @endforeach

                                <div class="flex flex-col items-end">
                                    <button type="submit"
                                        class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Simpan</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        const no_identitas = document.querySelector('#no_identitas');
        const username = document.querySelector('#username');

        function isiUsername() {
            username.value = no_identitas.value;
        }

        no_identitas.addEventListener('input', isiUsername);
    </script>
@endsection
