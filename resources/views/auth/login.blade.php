@extends('frontend.layouts.app')

@section('content')
    <section class="bg-secondary dark:bg-neutral-900">
        <div class="mt-[4.4rem] max-w-screen-xl mx-auto px-4">
            {{-- breadcrums start --}}
            <nav class="flex py-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-4">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center text-lg font-normal text-abu-800 hover:text-primary-500 dark:text-abu-800 dark:hover:text-secondary">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-start">
                            <i class="fa-solid fa-chevron-right w-5 h-3 text-abu-800 pt-1"></i>
                            <a href="{{ route('frontend.roleList') }}"
                                class="ms-1 text-lg font-bold text-primary-800 hover:text-primary-500 md:ms-2 dark:text-abu-500 dark:hover:text-secondary">
                                <h1>
                                    {{ $pageTitle }}
                                </h1>
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
            {{-- breadcrums end --}}

            <div class="max-w-screen-xl xl:min-h-screen mx-auto pb-16">
                <section class="bg-gray-100 dark:bg-neutral-900">
                    <div
                        class="py-8 px-4 md:px-16 mx-auto max-w-screen-xl border border-abu-500 lg:py-16 grid lg:grid-cols-2 gap-8 lg:gap-16 dark:border dark:border-1 dark:border-neutral-800">
                        <div class="flex flex-col justify-center text-center lg:text-start">
                            <h1
                                class="mb-1 md:mb-4 text-4xl font-bold tracking-tight leading-none text-primary-800 md:text-5xl lg:text-6xl dark:text-secondary">
                                Mulai Pengalaman Magangmu Bareng SIGMA</h1>
                            <p class="mb-6 text-lg font-normal leading-5 md:leading-none font-paragraf text-gray-500 lg:text-xl dark:text-abu-800">
                                Yuk, cari tahu kesempatan magang keren di instansi pemerintahan bareng kita!</p>
                        </div>
                        <div>
                            <div
                                class="w-full lg:max-w-xl p-6 space-y-4 sm:py-12 bg-secondary border border-abu-500 dark:bg-neutral-800 dark:border-neutral-700">
                                <h2 class="text-3xl font-bold text-primary-800 dark:text-secondary">
                                    Login
                                </h2>
                                <form class="mt-8 space-y-6" action="#" method="POST">
                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Alamat Email</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            placeholder="name@company.com" required />
                                    </div>
                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">Your
                                            password</label>
                                        <input type="password" name="password" id="password" placeholder="••••••••"
                                            class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                            required />
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex items-start h-5">
                                            <input id="remember" aria-describedby="remember" name="remember"
                                                type="checkbox"
                                                class="w-4 h-4 border-abu-800 bg-gray-100 focus:ring-3 focus:ring-primary-800 dark:focus:ring-neutral-600 dark:ring-offset-gray-800 dark:bg-neutral-700 dark:border-neutral-700"
                                                required />
                                        </div>
                                        <div class="ms-3 text-sm">
                                            <label for="remember"
                                                class="font-medium text-abu-800 dark:text-abu-800">Remember this
                                                device</label>
                                        </div>
                                        <a href="#"
                                            class="ms-auto text-sm font-medium text-accent hover:text-primary-500 hover:underline dark:text-abu-500">Lupa
                                            Password?</a>
                                    </div>
                                    <button type="submit"
                                        class="w-full px-8 py-2 text-base font-medium text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Login</button>
                                    <div class="text-sm font-medium text-primary-800 dark:text-secondary">
                                        Tidak punya akun? <a href="#"
                                            class="text-accent hover:text-primary-500 hover:underline dark:text-abu-500">Register</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
