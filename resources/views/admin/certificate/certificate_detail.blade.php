@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.sidebar')
    <div class="p-4 sm:ml-64 min-h-screen bg-abu-500 dark:bg-neutral-950">
        <div class="p-1 md:p-4 mt-14">
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
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end">
                            <h2 class="text-xl md:text-2xl lg:text-4xl font-bold text-primary-800 dark:text-secondary">
                                {{ $pageTitle }}
                            </h2>
                            @if ($getCertificateId->doc_sertifikat)
                                <form id="delete-certificate-{{ $getCertificateId->id }}"
                                    action="{{ route('admin.deleteCertificate', ['certificate' => $getCertificateId->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="px-0 text-sm text-red-500">
                                        <button data-id="{{ $getCertificateId->id }}" type="submit" value="Delete">
                                            <div
                                                class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-red-500 rounded-none hover:bg-red-600 focus:ring-2 focus:ring-red-500 sm:w-auto dark:bg-red-500 dark:text-secondary dark:hover:bg-red-600 dark:focus:ring-red-500">
                                                Batal Generate Sertifikat
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div>
                                    <a href="{{ route('admin.generateCertificate', Crypt::encryptString($getCertificateId->id)) }}"
                                        class="w-full px-20 py-3 text-lg font-normal text-center text-gray-100 bg-primary-800 rounded-none hover:bg-primary-500 focus:ring-2 focus:ring-accent sm:w-auto dark:bg-secondary dark:text-neutral-800 dark:hover:bg-white dark:focus:ring-blue-800">Generate
                                        Certificate
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="relative overflow-x-auto mt-12">
                            <div>
                                <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-primary-800 dark:text-secondary">
                                    {{ $getUserData->user->nama_lengkap }}
                                </h2>
                                <h2
                                    class="text-md md:text-lg lg:text-xl font-regular text-primary-800 dark:text-secondary mb-4">
                                    {{ $getUserData->instansi_asal }}
                                </h2>
                            </div>
                            {{-- <input type="hidden" id="searchTableTeacher" value="{{ route('admin.tableTeacher') }}"> --}}
                            <table id="tableManageTeacher"
                                class="border-collapse overflow-x-auto w-full text-sm text-left border border-gray-200 rtl:text-right text-gray-500 dark:text-gray-400 dark:border-neutral-700 z-10">
                                <thead class="text-xs uppercase bg-gray-200 dark:bg-neutral-900 dark:text-secondary">
                                    <tr>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            No.
                                        </th>
                                        <th scope="col" class="px-4 py-6 text-primary-800 dark:text-secondary">
                                            Judul Kompetensi
                                        </th>
                                        <th scope="col"
                                            class="px-4 text-start py-6 text-primary-800 dark:text-secondary">
                                            Nilai
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($scoreDetail as $data)
                                        <tr
                                            class="odd:bg-gray-100 odd:dark:bg-neutral-700 even:bg-slate-100 even:dark:bg-neutral-600 border-b dark:border-neutral-500">
                                            <td class="px-4 py-4">
                                                <p class="text-primary-800 dark:text-secondary">
                                                    {{ $loop->iteration }}
                                                </p>
                                            </td>
                                            <td class="px-4 py-4">
                                                <p class="text-primary-800 dark:text-secondary">
                                                    {{ $data->judul_kompetensi }}
                                                </p>
                                            </td>
                                            <td class="px-4 py-4">
                                                <p class="text-primary-800 text-start dark:text-secondary">
                                                    {{ $data->nilai_uji }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                            </div>
                            <div class="lg:max-w-1/2 py-4">
                                <p class="text-md text-start text-primary-800 dark:text-white font-semibold">Range Nilai:
                                </p>
                                <ul>
                                    <li class="text-md text-start text-primary-800 dark:text-white">Nilai Kurang: 0-65.0
                                    </li>
                                    <li class="text-md text-start text-primary-800 dark:text-white">Nilai Cukup: 65.01-75.0
                                    </li>
                                    <li class="text-md text-start text-primary-800 dark:text-white">Nilai Baik: 75.01-80.0
                                    </li>
                                    <li class="text-md text-start text-primary-800 dark:text-white">Nilai Baik Sekali:
                                        80.01-100.0</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
