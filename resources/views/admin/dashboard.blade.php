@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')

    <div class="p-4 sm:ml-64 bg-abu-500 dark:bg-neutral-950 min-h-screen">
        <div class="p-4 mt-14">
            <div
                class="md:grid md:grid-cols-3 h-full mb-2 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border-neutral-600">
                <div class="md:col-span-2 px-6 py-8">
                    <h2 class="text-2xl md:text-4xl font-bold text-primary-800 dark:text-secondary mb-2">Pengumuman</h2>
                    <p class="text-primary-800 font-paragraf text-md md:text-lg dark:text-secondary leading-4 md:leading-5">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat consequatur deleniti repellat
                        fuga,
                        at facilis commodi obcaecati rerum tenetur sint saepe eum similique, illo vero ea sunt? Eum
                        repellendus repudiandae quibusdam molestias architecto assumenda corporis, cupiditate adipisci
                        deserunt nam laboriosam, quo, unde saepe. Atque numquam enim aspernatur eius non nostrum ad
                        cumque!
                    </p>
                </div>
                <div>
                    <div
                        class="hidden w-full h-full bg-primary-800 text-secondary md:flex items-center justify-center dark:bg-neutral-900">
                        <i class="fa-solid fa-bullhorn fa-6x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
