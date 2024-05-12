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
                        <h2 class="text-4xl mb-8 md:text-5xl font-bold text-primary-800 dark:text-secondary">
                            {{ $pageTitle }}
                        </h2>

                        <form action="{{ route('mentor.storePenilaian') }}" method="POST">
                            @csrf
                            <div class="py-8">
                                <label for="certificate_id"
                                    class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Pilih
                                    Peserta <span class="text-red-500">*</span></label>
                                <select type="text" name="certificate_id" id="certificate_id"
                                    class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">


                                    @foreach ($userData as $data)
                                        <option value="{{ $data->status->certificate->id }}"
                                            {{ old('certificate_id', $data->status->certificate->id ?? null) == $data->status->certificate->id ? 'selected' : '' }}>
                                            {{ $data->user->nama_lengkap . ' - ' . $data->instansi_asal . ' ' . '(' . $data->no_identitas . ')' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('certificate_id')
                                    <div class="mt-1 text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="grid grid-cols-4 gap-2" id="inputFieldsContainer">
                                <div class="col-span-3 py-3" id="kompetensi">
                                    <label for="judul_kompetensi"
                                        class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                        Judul Kompetensi
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="judul_kompetensi[]" id="judul_kompetensi"
                                        placeholder="Memiliki Ketekunan Bekerja" value="{{ old('judul_kompetensi[]') }}"
                                        required autofocus
                                        class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                    @error('judul_kompetensi[]')
                                        <div class="mt-1 text-red-500 text-xs">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="py-3">
                                    <label for="nilai_uji"
                                        class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                        Nilai
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nilai_uji[]" id="nilai_uji" placeholder="80.78"
                                        value="{{ old('nilai_uji[]') }}" required autofocus
                                        class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">
                                    @error('nilai_uji[]')
                                        <div class="mt-1 text-red-500 text-xs">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <button type="button" id="addInputFields" class="text-blue-500 hover:underline text-md py-6">
                                Tambah Kompetensi
                            </button>

                            <div class="flex flex-col items-end pt-4 lg:pt-[5.5rem]">
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

    <script>
        document.getElementById('addInputFields').addEventListener('click', function() {
            var inputFieldsContainer = document.getElementById('inputFieldsContainer');

            // Create new div to hold label and input fields
            var newInputKompetensi = document.createElement('div');
            newInputKompetensi.classList.add('col-span-3', 'py-3');

            // Create label for "Judul Kompetensi"
            var judulKompetensiLabel = document.createElement('label');
            judulKompetensiLabel.setAttribute('for', 'judul_kompetensi');
            judulKompetensiLabel.classList.add('mb-2', 'text-sm', 'font-medium', 'text-primary-800',
                'dark:text-secondary');
            judulKompetensiLabel.innerHTML = 'Judul Kompetensi <span class="text-red-500">*</span>';

            // Create input field for "Judul Kompetensi"
            var judulKompetensiInput = document.createElement('input');
            judulKompetensiInput.setAttribute('type', 'text');
            judulKompetensiInput.setAttribute('name', 'judul_kompetensi[]');
            judulKompetensiInput.setAttribute('placeholder', 'Memiliki Ketekunan Bekerja');
            judulKompetensiInput.classList.add('bg-white', 'border', 'border-abu-800', 'text-primary-800',
                'text-sm', 'focus:ring-primary-800', 'focus:border-primary-500', 'w-full', 'p-2.5',
                'dark:bg-neutral-700', 'dark:border-neutral-700', 'dark:placeholder:text-neutral-400',
                'dark:text-secondary', 'dark:focus:ring-primary-800', 'dark:focus:border-accent');


            var newInputNilai = document.createElement('div');
            newInputNilai.classList.add('py-3');
            // Create label for "Nilai Uji"
            var nilaiUjiLabel = document.createElement('label');
            nilaiUjiLabel.setAttribute('for', 'nilai_uji');
            nilaiUjiLabel.classList.add('mb-2', 'text-sm', 'font-medium', 'text-primary-800',
                'dark:text-secondary');
            nilaiUjiLabel.innerHTML = 'Nilai <span class="text-red-500">*</span>';

            // Create input field for "Nilai Uji"
            var nilaiUjiInput = document.createElement('input');
            nilaiUjiInput.setAttribute('type', 'text');
            nilaiUjiInput.setAttribute('name', 'nilai_uji[]');
            nilaiUjiInput.setAttribute('placeholder', '80.50');
            nilaiUjiInput.classList.add('bg-white', 'border', 'border-abu-800', 'text-primary-800', 'text-sm',
                'focus:ring-primary-800', 'focus:border-primary-500', 'block', 'w-full', 'p-2.5',
                'dark:bg-neutral-700', 'dark:border-neutral-700', 'dark:placeholder:text-neutral-400',
                'dark:text-secondary', 'dark:focus:ring-primary-800', 'dark:focus:border-accent');

            // Append label and input fields to the new div
            newInputKompetensi.appendChild(judulKompetensiLabel);
            newInputKompetensi.appendChild(judulKompetensiInput);
            newInputNilai.appendChild(nilaiUjiLabel);
            newInputNilai.appendChild(nilaiUjiInput);

            // Append the new div to the container
            inputFieldsContainer.appendChild(newInputKompetensi);
            inputFieldsContainer.appendChild(newInputNilai);
        });
    </script>
@endsection
