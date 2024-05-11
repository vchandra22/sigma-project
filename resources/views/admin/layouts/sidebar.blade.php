<nav
    class="fixed top-0 z-50 w-full border-b border-gray-200 shadow-sm bg-secondary dark:bg-neutral-900 start-0 dark:border-neutral-800">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
                    aria-controls="default-sidebar" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <div class="hidden md:block px-2">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('frontend/assets/img/logo-sigmaLight.png') }}"
                            class="block h-8 lg:h-10 dark:hidden" alt="Sigma Logo" />
                        <img src="{{ asset('frontend/assets/img/logo-sigmaDark.png') }}"
                            class="hidden h-8 lg:h-10 dark:block" alt="Sigma Logo" />
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="text-sm md:text-md lg:text-md text-primary-800 cursor-pointer hover:text-primary-500 dark:text-secondary dark:hover:text-white"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            @auth
                                Welcome, {{ auth()->user()->nama_lengkap }}
                            @endauth
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-secondary divide-y divide-gray-100 shadow dark:bg-neutral-800 dark:divide-gray-600"
                        id="dropdown-user">
                        <ul>
                            <li>
                                <a href="{{ route('admin.settings') }}"
                                    class="block px-4 py-3 text-primary-800 hover:bg-abu-500 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <div class="space-x-4 flex items-center justify-start text-sm">
                                        <i class="fa-solid fa-gear"></i>
                                        <span>Pengaturan</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST"
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
            </div>
        </div>
    </div>
</nav>

<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-full pt-20 transition-transform -translate-x-full bg-secondary border-r border-gray-100 sm:translate-x-0 dark:bg-neutral-900 dark:border-neutral-800"
    aria-label="Sidebar">
    <div class="h-full flex flex-col justify-between px-3 pb-4 overflow-y-auto bg-secondary dark:bg-neutral-900">
        <ul class="space-y-4 font-normal">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 text-primary-800 rounded-lg dark:text-secondary hover:text-primary-500 dark:hover:text-white group">
                    <div
                        class="w-5 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-primary-800 dark:group-hover:text-secondary">
                        <i class="fa-solid fa-layer-group fa-lg"></i>
                    </div>
                    <span class="ms-4">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manageAdmin') }}"
                    class="flex items-center p-2 text-primary-800 rounded-lg dark:text-secondary hover:text-primary-500 dark:hover:text-white group">
                    <div
                        class="w-5 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-primary-800 dark:group-hover:text-secondary">
                        <i class="fa-solid fa-user-shield fa-lg"></i>
                    </div>
                    <span class="ms-4">Manage Admin</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manageUser') }}"
                    class="flex items-center p-2 text-primary-800 rounded-lg dark:text-secondary hover:text-primary-500 dark:hover:text-white group">
                    <div
                        class="w-5 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-primary-800 dark:group-hover:text-secondary">
                        <i class="fa-solid fa-users-gear fa-lg"></i>
                    </div>
                    <span class="ms-4">Manage User</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manageCertificate') }}"
                    class="flex items-center p-2 text-primary-800 rounded-lg dark:text-secondary hover:text-primary-500 dark:hover:text-white group">
                    <div
                        class="w-5 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-primary-800 dark:group-hover:text-secondary">
                        <i class="fa-solid fa-scroll fa-lg"></i>
                    </div>
                    <span class="ms-4">Sertifikat Peserta</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manageContent') }}"
                    class="flex items-center p-2 text-primary-800 rounded-lg dark:text-secondary hover:text-primary-500 dark:hover:text-white group">
                    <div
                        class="w-5 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-primary-800 dark:group-hover:text-secondary">
                        <i class="fa-solid fa-puzzle-piece fa-lg"></i>
                    </div>
                    <span class="ms-4">Manage Content</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manageTeacher') }}"
                    class="flex items-center p-2 text-primary-800 rounded-lg dark:text-secondary hover:text-primary-500 dark:hover:text-white group">
                    <div
                        class="w-5 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-primary-800 dark:group-hover:text-secondary">
                        <i class="fa-solid fa-school fa-lg"></i>
                    </div>
                    <span class="ms-4">Kontak Dosen/Guru</span>
                </a>
            </li>
        </ul>

        <div>
            <ul class="space-y-4 font-normal">
                <li>
                    <a href="{{ route('admin.settings') }}"
                        class="flex items-center p-2 text-primary-800 rounded-lg dark:text-secondary hover:text-primary-500 dark:hover:text-white group">
                        <div
                            class="w-5 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-primary-800 dark:group-hover:text-secondary">
                            <i class="fa-solid fa-gear fa-lg"></i>
                        </div>
                        <span class="ms-4">Pengaturan</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST"
                        class="flex items-center p-2 text-primary-800 rounded-lg dark:text-secondary hover:text-primary-500 dark:hover:text-white group">
                        @csrf
                        <button type="submit">
                            <div
                                class="w-full h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-primary-800 dark:group-hover:text-secondary">
                                <div>
                                    <i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i>
                                    <span class="ms-3">Logout</span>
                                </div>
                            </div>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
