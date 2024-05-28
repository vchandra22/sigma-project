@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-800">
        <div class="p-4 mt-14">
            <div class="w-full">
                <div>
                    <div class="bg-gray-50 w-full border border-gray-100 dark:bg-neutral-800 dark:border-neutral-700">
                        <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                            <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary mb-8">
                                {{ $pageTitle }}
                            </h2>

                            <div class="mt-12">
                                @foreach ($publicationData as $publication)
                                    <form action="{{ route('admin.updatePublication', $publication->id) }}" method="POST"
                                        class="space-y-6" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div>
                                            <label for="judul"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Judul
                                                <span class="text-red-500">*</span></label>
                                            <input type="text" name="judul" id="judul"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required autofocus value="{{ $publication->judul }}" />
                                            @error('judul')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="content"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konten
                                                <span class="text-red-500">*</span></label>
                                            <textarea name="content" id="content" rows="4"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">{{ $publication->content }}</textarea>
                                            @error('content')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="gambar"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                                Foto / Gambar Publikasi</label>
                                            <input
                                                class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                                id="gambar" type="file" name="gambar"
                                                value="{{ $publication->gambar }}">
                                            @error('gambar')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="pt-8">
                                            <label for="meta_title"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Meta
                                                Title</label>
                                            <input type="text" name="meta_title" id="meta_title"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                value="{{ old('meta_title', $publication->meta_title) }}" />
                                            @error('meta_title')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="meta_description"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                                Description</label>
                                            <textarea name="meta_description" id="meta_description" rows="4"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 text-start dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">{{ old('meta_description', $publication->meta_description) }}</textarea>
                                            @error('meta_description')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <ul class="list-disc ms-5 text-gray-500">
                                                <li>
                                                    <p class="mt-1 text-xs text-gray-500 dark:text-secondary">
                                                        Google hanya menampilkan panjang karakter 155 - 160 karaketer.
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>

                                        <div>
                                            <label for="meta_keywords"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Meta
                                                Keyword</label>
                                            <input type="text" name="meta_keywords" id="meta_keywords"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                value="{{ old('meta_keywords', $publication->meta_keywords) }}" />
                                            @error('meta_keywords')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <ul class="list-disc ms-5 text-gray-500">
                                                <li>
                                                    <p class="mt-1 text-xs text-gray-500 dark:text-secondary">
                                                        Pisahkan dengan tanda koma (,) per-keyword
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mt-1 text-xs text-gray-500 dark:text-secondary">
                                                        Contoh: lowongan magang, magang kominfo kota blitar, informasi
                                                        magang, pengembangan keterampilan,
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>

                                        <div>
                                            <label for="og_image"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                                OG Image</label>
                                            <input
                                                class="block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                                id="og_image" type="file" name="og_image">
                                            @error('og_image')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="flex flex-col items-end">
                                            <button type="submit"
                                                class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Simpan</button>
                                        </div>
                                    </form>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
