@extends('admin.layouts.app')

@section('content')
    <section class="bg-secondary dark:bg-neutral-900">

        <div class="max-w-screen-xl mx-auto px-4">
            @if (session()->has('loginError'))
                <div id="toast-danger"
                    class="fixed flex items-center w-full max-w-xs p-4 mb-4 text-primary-800 border border-gray-100 bg-white shadow-sm top-5 right-5 mt-[4.4rem] dark:text-secondary dark:bg-neutral-800 dark:border dark:border-neutral-700"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-transparent dark:text-red-500">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                        </svg>
                        <span class="sr-only">Error icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">{{ session('loginError') }}</div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-dismiss-target="#toast-danger" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('success'))
                <div id="toast-success"
                    class="fixed flex items-center w-full max-w-xs p-4 mb-4 text-primary-800 border border-gray-100 bg-white shadow-sm top-5 right-5 mt-[4.4rem] dark:text-secondary dark:bg-neutral-800 dark:border dark:border-neutral-700"
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
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
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

            {{-- login section start --}}
            <div class="max-w-screen-xl xl:min-h-screen mx-auto pb-16 pt-24">
                <section class="bg-transparent dark:bg-neutral-900">
                    <div class="py-8 px-4 md:px-16 mx-auto max-w-screen-xl lg:py-16 gap-0 lg:gap-16">
                        <div class="md:flex flex-col justify-center text-center lg:text-start">
                            <div>
                                <div
                                    class="mx-auto w-full lg:max-w-xl p-6 space-y-1 sm:py-12 bg-secondary border border-abu-500 dark:bg-neutral-800 dark:border-neutral-700">
                                    <h2 class="text-3xl text-center font-bold text-primary-800 dark:text-secondary">
                                        Admin
                                    </h2>

                                    <p
                                        class="mb-6 text-md text-center font-normal leading-5 md:leading-none font-paragraf text-primary-800 lg:text-lg dark:text-abu-800">
                                        Masukkan kredensial Anda di bawah ini untuk mengakses panel administrasi SIGMA</p>

                                    {{-- login form start --}}
                                    <form class="mt-8 space-y-6" action="{{ route('admin.authenticate') }}" method="POST">
                                        @csrf
                                        {{-- input username start --}}
                                        <div>
                                            <label for="username"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                                Username
                                            </label>
                                            <input type="username" name="username" id="username"
                                                class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                placeholder="Gunakan username" value="{{ old('username') }}" required
                                                autofocus />
                                        </div>
                                        {{-- input username end --}}

                                        {{-- input password start --}}
                                        <div>
                                            <label for="password"
                                                class="block mb-2 text-sm font-medium text-primary-800 dark:text-secondary">
                                                Password</label>
                                            <input type="password" name="password" id="password" placeholder="••••••••"
                                                class="bg-gray-100 border border-abu-800 text-primary-800 text-sm focus:ring-primary-800 focus:border-primary-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-700 dark:placeholder:text-neutral-400 dark:text-secondary dark:focus:ring-primary-800 dark:focus:border-accent"
                                                required />
                                        </div>
                                        {{-- input password end --}}


                                        <div class="flex items-center">
                                            {{-- remember me start --}}
                                            <div class="flex items-start h-5">
                                                <input id="remember" aria-describedby="remember" name="remember"
                                                    type="checkbox" value="1"
                                                    class="w-4 h-4 border-abu-800 bg-gray-100 focus:ring-3 focus:ring-primary-800 dark:focus:ring-neutral-600 dark:ring-offset-gray-800 dark:bg-neutral-700 dark:border-neutral-700" />
                                            </div>
                                            <div class="ms-3 text-sm">
                                                <label for="remember"
                                                    class="font-medium text-abu-800 dark:text-abu-800">Ingat
                                                    saya</label>
                                            </div>
                                            {{-- remember me end --}}

                                            {{-- forgot password start --}}
                                            <a href="#"
                                                class="ms-auto text-sm font-medium text-accent hover:text-primary-500 hover:underline dark:text-abu-500">Lupa
                                                Password?
                                            </a>
                                            {{-- forgot password end --}}
                                        </div>

                                        {{-- button login start --}}
                                        <button type="submit"
                                            class="w-full px-8 py-2 text-base font-medium text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">
                                            Login
                                        </button>
                                        {{-- button login end --}}

                                    </form>
                                    {{-- login form end --}}
                                </div>
                            </div>
                        </div>
                </section>
            </div>
            {{-- login section end --}}

        </div>
    </section>
@endsection
