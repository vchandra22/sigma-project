<section class="navbar-section-area">
    <nav
        class="fixed top-0 z-20 w-full border-b border-gray-200 shadow-sm bg-secondary dark:bg-neutral-900 start-0 dark:border-neutral-800">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
            <div class="flex flex-wrap justify-start">
                {{-- logo on navbar start --}}
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('frontend/assets/img/logo-sigmaLight.png') }}"
                        class="block h-8 lg:h-10 dark:hidden" alt="Sigma Logo" />
                    <img src="{{ asset('frontend/assets/img/logo-sigmaDark.png') }}"
                        class="hidden h-8 lg:h-10 dark:block" alt="Sigma Logo" />
                </a>
                {{-- logo on navbar end --}}

                {{-- list menu on navbar start --}}
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 md:mx-4 lg:mx-8"
                    id="navbar-cta">
                    <ul
                        class="flex flex-col p-4 mt-4 font-medium bg-transparent rounded-none lg:text-lg md:p-0 md:space-x-7 md:flex-row md:mt-0 md:border-0 md:bg-transparent lg:space-x-10 dark:bg-transparent md:dark:bg-transparent">
                        <li>
                            <a href="{{ url('/') }}"
                                class="block px-3 py-2 text-gray-900 md:p-0 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-500 dark:text-gray-200 dark:hover:text-secondary md:dark:hover:bg-transparent">Beranda</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.roleList') }}"
                                class="block px-3 py-2 text-gray-900 md:p-0 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-500 dark:text-gray-200 dark:hover:text-secondary md:dark:hover:bg-transparent">Internship
                                Role</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.publikasiList') }}"
                                class="block px-3 py-2 text-gray-900 md:p-0 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-500 dark:text-gray-200 dark:hover:text-secondary md:dark:hover:bg-transparent">Publikasi</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.faq') }}"
                                class="block px-3 py-2 text-gray-900 md:p-0 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-500 dark:text-gray-200 dark:hover:text-secondary md:dark:hover:bg-transparent">FAQ</a>
                        </li>
                    </ul>
                </div>
                {{-- list menu on navbar end --}}

            </div>

            <div class="flex space-x-1 justify-items-end md:order-1 md:space-x-1">
                @auth
                    <button type="button"
                        class="text-sm md:text-md lg:text-md text-primary-800 cursor-pointer hover:text-primary-500 dark:text-secondary dark:hover:text-white"
                        aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        Welcome, {{ auth()->user()->nama_lengkap }}
                    </button>
                    <div class="flex items-center ms-3">
                        <div class="z-50 hidden my-4 text-base list-none bg-secondary divide-y divide-gray-100 shadow dark:bg-neutral-800 dark:divide-gray-600"
                            id="dropdown-user">
                            <ul>
                                <li>
                                    <a href="{{ route('user.dashboard') }}"
                                        class="block px-4 py-3 text-primary-800 hover:bg-abu-500 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <div class="space-x-4 flex items-center justify-start text-sm">
                                            <i class="fa-solid fa-layer-group"></i>
                                            <span>Dashboard</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-3 text-primary-800 hover:bg-abu-500 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <div class="space-x-4 flex items-center justify-start text-sm">
                                            <i class="fa-solid fa-gear"></i>
                                            <span>Pengaturan</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('user.logout') }}" method="POST"
                                        class="block px-4 py-3 text-primary-800 hover:bg-abu-500 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                        @csrf
                                        <button type="submit">
                                            <div class="space-x-4 flex items-center justify-start text-sm">
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                <span>Logout</span>
                                            </div>
                                        </button>
                                    </form>
                                </li>
                                <li class="border border-t border-gray-100 dark:border-neutral-700">
                                    {{-- light mode / dark mode toggler start --}}
                                    <button id="theme-toggle" type="button"
                                        class="text-gray-500 px-4 hover:text-primary-800 dark:text-gray-400 focus:outline-none text-sm p-2.5">
                                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                            </path>
                                        </svg>
                                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                fill-rule="evenodd" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    {{-- light mode / dark mode toggler end --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    {{-- light mode / dark mode toggler start --}}
                    <button id="theme-toggle" type="button"
                        class="text-gray-500 hover:text-primary-800 dark:text-gray-400 focus:outline-none text-sm p-2.5">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    {{-- light mode / dark mode toggler end --}}
                    {{-- auth button start --}}
                    <a href="{{ route('auth.login') }}"
                        class="px-3 py-2 flex items-center text-sm font-medium text-center text-secondary bg-primary-800 md:px-4 lg:px-8 hover:bg-primary-500 focus:ring-1 focus:outline-none focus:ring-primary-500 dark:bg-secondary dark:text-neutral-900 dark:hover:bg-white dark:focus:ring-white dark:border">Login
                    </a>
                    <a href="{{ route('auth.register') }}"
                        class="px-3 py-2 flex items-center text-sm font-medium text-center dark:text-secondary bg-transparent border border-primary-800 text-primary-800 md:px-3 lg:px-6 hover:bg-primary-500 hover:text-secondary focus:ring-1 focus:outline-none focus:ring-white dark:bg-neutral-900 dark:hover:bg-secondary dark:hover:text-neutral-900 dark:focus:ring-secondary dark:border-secondary">Register
                    </a>
                    {{-- auth button end --}}
                @endauth

            </div>
        </div>

        {{-- bottom navbar: only show on small screen start --}}
        <div class="block md:hidden">
            <div
                class="fixed bottom-0 left-0 z-50 w-full h-16 bg-secondary border-t border-gray-200 dark:bg-neutral-900 dark:border-neutral-800">
                <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
                    <a href="{{ url('/') }}"
                        class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-secondary group">
                        <div
                            class="w-5 h-5 mb-2 text-primary-800 dark:text-secondary group-hover:text-primary-500 dark:group-hover:text-neutral-900">
                            <i class="fa-solid fa-house-chimney"></i>
                        </div>
                        <span
                            class="text-sm text-primary-800 dark:text-secondary group-hover:text-primary-500 dark:group-hover:text-neutral-900">Beranda</span>
                    </a>
                    <a href="{{ route('frontend.roleList') }}"
                        class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-secondary group">
                        <div
                            class="w-5 h-5 mb-2 text-primary-800 dark:text-secondary group-hover:text-primary-500 dark:group-hover:text-neutral-900">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <span
                            class="text-sm text-primary-800 dark:text-secondary group-hover:text-primary-500 dark:group-hover:text-neutral-900">Roles</span>
                    </a>
                    <a href="{{ route('frontend.publikasiList') }}"
                        class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-secondary group">
                        <div
                            class="w-5 h-5 mb-2 text-primary-800 dark:text-secondary group-hover:text-primary-500 dark:group-hover:text-neutral-900">
                            <i class="fa-solid fa-camera-retro"></i>
                        </div>
                        <span
                            class="text-sm text-primary-800 dark:text-secondary group-hover:text-primary-500 dark:group-hover:text-neutral-900">Publikasi</span>
                    </a>
                    <a href="{{ route('frontend.faq') }}"
                        class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-secondary group">
                        <div
                            class="w-5 h-5 mb-2 text-primary-800 dark:text-secondary group-hover:text-primary-500 dark:group-hover:text-neutral-900">
                            <i class="fa-solid fa-circle-question"></i>
                        </div>
                        <span
                            class="text-sm text-primary-800 dark:text-secondary group-hover:text-primary-500 dark:group-hover:text-neutral-900">FAQ</span>
                    </a>
                </div>
            </div>
        </div>
        {{-- bottom navbar: only show on small screen end --}}

    </nav>
</section>
