@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('content')
    <div class="bg-secondary dark:bg-neutral-900">
        <div class="max-w-screen-xl min-h-screen mx-auto flex items-center justify-center">
            <div class="px-8 mx-auto text-center">
                <h1 class="mb-4 text-8xl font-bold text-primary-800 dark:text-secondary">
                    401
                </h1>
                <p
                    class="mb-12 max-w-screen-md text-sm md:text-lg lg:text-xl font-normal text-primary-800 dark:text-secondary">
                    {{ __('Maaf, hanya untuk mereka yang membawa kunci keajaiban yang tepat. Mungkin coba mantera kecil untuk membuka pintunya?') }}
                </p>
                <a href="{{ url('/') }}"
                    class="w-full px-12 py-3 text-sm md:text-md font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Kembali
                    ke halaman utama</a>
            </div>
        </div>
    </div>
@endsection
