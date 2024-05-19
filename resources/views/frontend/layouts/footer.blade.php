<footer class="bg-secondary dark:bg-neutral-900 border border-t border-abu-500 dark:border-neutral-800">
    <div class="mx-auto w-full max-w-screen-xl p-8 md:px-8 lg:pt-12 md:pb-1 xl:px-12">
        <div class="md:flex md:justify-between">
            <div class="grid grid-cols-1 gap-4 sm:gap-6 md:grid-cols-3 mb-6 md:mb-0">
                {{-- logo on navbar start --}}
                <div class="flex flex-col justify-center" >
                    <a href="/" class="mb-5 md:mx-auto">
                        <img src="{{ asset('frontend/assets/img/logo-sigmaLight.png') }}"
                            class="block w-full h-12 lg:h-20 dark:hidden" width="100" height="100" title="Logo" alt="Sigma Logo" />
                        <img src="{{ asset('frontend/assets/img/logo-sigmaDark.png') }}"
                            class="hidden w-full h-12 lg:h-20 dark:block" width="100" height="100" title="Logo" alt="Sigma Logo" />
                    </a>
                    {{-- logo on navbar end --}}
                    <span class="font-paragraf text-sm md:text-md md:leading-6 text-primary-800 text-start dark:text-secondary">
                        <p>
                            {{ $homeData->alamat }}
                        </p>
                        <p>
                            {{ $homeData->email }}
                        </p>
                    </span>
                </div>
                <div>
                    <h2 class="mb-6 text-2xl font-semibold text-primary-800 capitalize dark:text-secondary">Follow Our
                        Social Media</h2>
                    <ul class="text-primary-800 dark:text-secondary font-medium">
                        <li
                            class="flex justify-start justify-items-center mb-4 gap-2 hover:text-primary-500 dark:hover:text-secondary">
                            <i class="fa-brands fa-instagram fa-2x w-10"></i>
                            <a href="{{ $homeData->instagram_link }}" target="_blank" class="font-paragraf text-md md:text-lg">{{ $homeData->instagram_username }}</a>
                        </li>
                        <li
                            class="flex justify-start justify-items-center mb-4 gap-2 hover:text-primary-500 dark:hover:text-secondary">
                            <i class="fa-brands fa-youtube fa-2x w-10"></i>
                            <a href="{{ $homeData->youtube_link }}" target="_blank" class="font-paragraf text-md md:text-lg">{{ $homeData->youtube_channel }}</a>
                        </li>
                        <li
                            class="flex justify-start justify-items-center mb-4 gap-2 hover:text-primary-500 dark:hover:text-secondary">
                            <i class="fa-solid fa-phone fa-2x w-10"></i>
                            <a href="tel:{{ $homeData->no_telp }}" class="font-paragraf text-md md:text-lg">{{ $homeData->no_telp }}</a>
                        </li>
                        <li
                            class="flex justify-start justify-items-center mb-4 gap-2 hover:text-primary-500 dark:hover:text-secondary">
                            <i class="fa-regular fa-envelope fa-2x w-10"></i>
                            <a href="mailto:{{ $homeData->email }}" target="_blank"
                                class="font-paragraf text-md md:text-lg">{{ $homeData->email }}</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-2xl font-semibold text-primary-800 capitalize dark:text-secondary">Lokasi Kantor
                    </h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe class="w-full h-full overflow-hidden"
                            src="{{ $homeData->gmaps_kantor }}"
                            width="600" height="550" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700" />
        <div class="flex items-center justify-center pb-12 lg:pb-1 lg:mb-2">
            <span class="text-sm text-gray-500 text-center dark:text-gray-400">
                <a href="{{ url('/') }}"
                    class="hover:underline">{{ "© " . get_copyright_year() }}  SIGMA (Sistem Informasi Kegiatan Magang), Dinas Komunikasi Informatika dan Statistik Kota Blitar
                </a>
            </span>
        </div>
    </div>
</footer>
