@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')

    <div class="p-4 sm:ml-64 bg-abu-500 dark:bg-neutral-950 min-h-screen">
        @foreach ($userData as $user)
            <div class="p-4 mt-14">
                <div
                    class="md:grid md:grid-cols-3 h-full mb-2 bg-secondary border border-gray-100 dark:bg-neutral-700 dark:border-neutral-600">
                    <div class="md:col-span-2 px-6 py-8">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-xl md:text-2xl lg:text-4xl font-bold text-primary-800 dark:text-secondary">
                                Pengumuman
                            </h2>
                            <div>
                                <a href="{{ route('admin.editAnnouncement', $announcementUuid->uuid) }}"
                                    class="w-full text-sm font-normal text-end text-primary-800 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Update
                                </a>
                            </div>
                        </div>
                        <p
                            class="text-primary-800 font-paragraf text-md md:text-lg dark:text-secondary leading-4 md:leading-5">
                            @foreach ($announcementData as $announcement)
                                {{ strip_tags($announcement->pengumuman) }}
                            @endforeach
                        </p>
                    </div>
                    <div>
                        <div
                            class="hidden w-full h-full bg-primary-800 text-secondary md:flex items-center justify-center dark:bg-neutral-900">
                            <i class="fa-solid fa-bullhorn fa-6x"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="w-full h-full">
                        <div class="md:grid lg:grid-cols-2 gap-2 space-y-2 md:space-y-0">
                            <div class="h-full w-full grid grid-rows-3 gap-2">
                                <div
                                    class="px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-900 dark:border-neutral-700">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">Nama
                                        Lengkap</h2>
                                    <p
                                        class="text-primary-800 font-paragraf capitalize text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                        {{ $user->nama_lengkap }}
                                    </p>
                                </div>
                                <div
                                    class="px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-800 dark:border-neutral-700">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">
                                        Role
                                    </h2>
                                    @foreach ($user->roles as $role)
                                        <p
                                            class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                            {{ ucfirst($role->name) }}
                                        </p>
                                    @endforeach
                                </div>
                                <div
                                    class="px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-800 dark:border-neutral-700">
                                    <h2 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-2">
                                        Instansi / OPD
                                    </h2>
                                    <p
                                        class="text-primary-800 font-paragraf text-lg md:text-xl dark:text-secondary leading-4 md:leading-5">
                                        @foreach ($getOffice as $office)
                                            {{ $office->nama_kantor }}
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            <div
                                class="h-full w-full px-6 py-8 bg-secondary border border-gray-100 dark:bg-neutral-900 dark:border-neutral-800">
                                <h2
                                    class="text-xl md:text-2xl font-bold text-primary-800 dark:text-secondary mb-4 text-center">
                                    Activity Log
                                </h2>
                                <div class="h-80 overflow-auto dark:border-neutral-500">
                                    <ol class="border-s border-gray-200 dark:border-neutral-800">
                                        @foreach ($activityLog as $log)
                                            <li class="mb-4 ms-6">
                                                <div
                                                    class="items-center justify-between p-2 bg-white border border-gray-200 lg:flex dark:bg-neutral-800 dark:border-neutral-700">
                                                    <time
                                                        class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">
                                                        {{ date('d-m-Y h:m:s'), strtotime($log->created_at) }}
                                                    </time>
                                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-300">
                                                        {{ ucfirst($log->description) }}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection