@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-950">
        <div class="p-4 mt-14">
            @if (session('success'))
                <div id="toast-success"
                    class="fixed flex items-center w-full max-w-xs p-4 mb-4 text-primary-800 border border-gray-100 bg-white shadow-sm top-5 right-5 mt-[4.4rem] dark:text-secondary dark:bg-neutral-800 dark:border dark:border-neutral-700 z-50"
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
            <div class="w-full">
                <div
                    class="bg-zinc-50 w-full min-h-screen border border-gray-100 dark:bg-neutral-900 dark:border-neutral-700">
                    <div class="px-6 py-8 md:px-8 md:py-10 lg:px-12 lg:py-16">
                        <div class="flex justify-between items-end">
                            <h2 class="text-4xl md:text-5xl font-bold text-primary-800 dark:text-secondary">
                                {{ $pageTitle }}
                            </h2>
                            <div>
                                <a href="{{ route('admin.createPosition') }}"
                                    class="w-full text-lg font-normal text-end text-primary-800 hover:underline rounded-none focus:ring-2 focus:ring-accent sm:w-auto dark:text-secondary dark:focus:ring-blue-800">Tambah
                                    Posisi Baru</a>
                            </div>
                        </div>

                        <div class="mt-12 grid md:grid-cols-1 lg:grid-cols-3 w-full gap-4">
                            @foreach ($positionData as $position)
                                <div
                                    class="p-8 bg-white border border-gray-100 hover:shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
                                    <div class="min-h-16 w-full">
                                        <div class="flex justify-between items-start">
                                            <a href="{{ route('admin.editPosition', $position->slug) }}">
                                                <h5
                                                    class="mb-2 text-2xl font-bold tracking-tight text-primary-800 dark:text-secondary">
                                                    {{ $position->role }}
                                                </h5>
                                            </a>
                                            <form id="delete-role-{{ $position->id }}"
                                                action="{{ route('admin.deletePosition', ['id' => $position->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <div class="px-4 py-2 text-sm text-red-500">
                                                    <button class="delete-button hover:underline"
                                                        data-id="{{ $position->id }}" type="submit" value="Delete">Hapus
                                                    </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="min-h-20 w-full mb-4">
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            {{ $position->deskripsi }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-start">
                                        <a href="{{ route('admin.editPosition', $position->slug) }}"
                                            class="w-full px-3 py-2 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Edit
                                            Content
                                        </a>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
