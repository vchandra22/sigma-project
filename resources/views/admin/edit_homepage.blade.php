@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-950">
        <div class="p-4 mt-14">
            <div class="w-full">
                <div>
                    <div class="bg-gray-50 w-full border border-gray-100 dark:bg-neutral-900 dark:border-neutral-700">
                        <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                            <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary mb-8">
                                {{ $pageTitle }}
                            </h2>

                            @foreach ($homepageData as $homepage)
                                <form action="{{ route('admin.updateHomepage', $homepage->id) }}" method="POST"
                                    class="space-y-6" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div>
                                        <label for="heading"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Heading
                                            / Judul Halaman <span class="text-red-500">*</span></label>
                                        <input type="text" name="heading" id="heading"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->heading }}" />
                                        @error('heading')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="deskripsi_app"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                                            Aplikasi <span class="text-red-500">*</span></label>
                                        <textarea name="deskripsi_app" id="deskripsi_app" rows="4"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">{{ $homepage->deskripsi_app }}</textarea>
                                        @error('deskripsi_app')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul class="list-disc ms-5 text-gray-500">
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Menjelaskan
                                                    deskripsi singkat aplikasi</p>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <label for="instagram_username"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Username
                                            Instagram <span class="text-red-500">*</span></label>
                                        <input type="text" name="instagram_username" id="instagram_username"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->instagram_username }}" />
                                        @error('instagram_username')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul class="list-disc ms-5 text-gray-500">
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Masukkan username
                                                    akun instagram. Contoh: (<span
                                                        class="font-semibold">application_sigma</span>)</p>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <label for="instagram_link"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Link
                                            Akun Instagram <span class="text-red-500">*</span></label>
                                        <input type="text" name="instagram_link" id="instagram_link"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->instagram_link }}" />
                                        @error('instagram_link')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul class="list-disc ms-5 text-gray-500">
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Masukkan link
                                                    valid. Contoh: (<span
                                                        class="font-semibold">https://www.instagram.com/application_sigma?igsh=MTV5ZTA1dXVmcHgybA==</span>)
                                                </p>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <label for="youtube_channel"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Youtube
                                            Channel <span class="text-red-500">*</span></label>
                                        <input type="text" name="youtube_channel" id="youtube_channel"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->youtube_channel }}" />
                                        @error('youtube_channel')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul class="list-disc ms-5 text-gray-500">
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Masukkan nama
                                                    channel Youtube. Contoh: (<span
                                                        class="font-semibold">PemkotBlitar</span>)
                                                </p>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <label for="youtube_link"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Link
                                            Channel Youtube <span class="text-red-500">*</span></label>
                                        <input type="text" name="youtube_link" id="youtube_link"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->youtube_link }}" />
                                        @error('youtube_link')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul class="list-disc ms-5 text-gray-500">
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Masukkan link
                                                    channel Youtube pada URL Contoh: (<span
                                                        class="font-semibold">https://www.youtube.com/@PemkotBlitarJatim</span>)
                                                </p>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <label for="id_video"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">ID
                                            Video Embed <span class="text-red-500">*</span></label>
                                        <input type="text" name="id_video" id="id_video"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->id_video }}" />
                                        @error('id_video')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul class="list-disc ms-5 text-gray-500">
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Masukkan ID Video
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">ID Video berupa
                                                    text random/acak di akhir URL video
                                                </p>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <label for="alamat"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Alamat
                                            Kantor Utama <span class="text-red-500">*</span></label>
                                        <input type="text" name="alamat" id="alamat"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->alamat }}" />
                                        @error('alamat')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Alamat
                                            email <span class="text-red-500">*</span></label>
                                        <input type="text" name="email" id="email"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->email }}" />
                                        @error('email')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="no_telp"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">No.
                                            Telepon <span class="text-red-500">*</span></label>
                                        <input type="text" name="no_telp" id="no_telp"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->no_telp }}" />
                                        @error('no_telp')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="gmaps_kantor"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Link
                                            Google Maps (src) <span class="text-red-500">*</span></label>
                                        <input type="text" name="gmaps_kantor" id="gmaps_kantor"
                                            class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required autofocus value="{{ $homepage->gmaps_kantor }}" />
                                        @error('gmaps_kantor')
                                            <div class="mt-1 text-red-500 text-xs">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <ul class="list-disc ms-5 text-gray-500">
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Cari alamat dari
                                                    Google Map
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Klik menu <span
                                                        class="font-semibold">Share</span>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Kemudian, pilih
                                                    <span class="font-semibold">"Embed a
                                                        map"</span>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-secondary">Copy hanya alamat
                                                    url. <span class="font-semibold">Contoh:
                                                        (https://www.google.com/maps/embed?...)
                                                    </span>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>

                                    @foreach ($metaData as $item)
                                        <div>
                                            <label for="meta_title"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Meta
                                                Title <span class="text-red-500">*</span></label>
                                            <input type="text" name="meta_title" id="meta_title"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                value="{{ old('meta_title', $item->meta_title) }}" />
                                            @error('meta_title')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="meta_description"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                                Description <span class="text-red-500">*</span></label>
                                            <textarea name="meta_description" id="meta_description" rows="4"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 text-start dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent">{{ old('meta_description', $item->meta_description) }}</textarea>
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
                                            <label for="meta_keyword"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Meta
                                                Keyword <span class="text-red-500">*</span></label>
                                            <input type="text" name="meta_keyword" id="meta_keyword"
                                                class="bg-white border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                value="{{ old('meta_keyword', $item->meta_keyword) }}" />
                                            @error('meta_keyword')
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
                                            <div class="upload-img-box h-auto w-full md:max-w-sm">
                                                @if ($item->og_image != null && $item->og_image != '')
                                                    <img class="h-56 w-full overflow-y-hidden border-abu-500 rounded-sm border-2"
                                                        src="{{ getImageFile($item->og_image) }}">
                                                @else
                                                    <img src="">
                                                @endif
                                                <input type="file" name="og_image" id="og_image" accept="image/*"
                                                    class="mt-2 block w-full text-sm text-primary-800 border border-abu-800 cursor-pointer bg-gray-100 hover:bg-gray-50 dark:text-secondary focus:ring-primary-800 focus:border-primary-500 dark:bg-neutral-700 dark:placeholder:text-neutral-400 dark:border-none dark:focus:ring-primary-800 dark:focus:border-accent"
                                                    value="{{ $item->og_image }}" onchange="previewFile(this)">
                                            </div>
                                            @error('og_image')
                                                <div class="mt-1 text-red-500 text-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    @endforeach

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
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi_app'))
            .catch(error => {
                console.error(error);
            });
    </script>

    @push('script')
        <script src="{{ asset('assets/js/custom/image-preview.js') }}"></script>
    @endpush
@endsection
