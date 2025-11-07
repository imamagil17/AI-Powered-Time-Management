<x-app-layout>
    {{-- Bagian Header Halaman --}}
    <x-slot name="header">
        <!-- 👇 Menambahkan class dark: -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-textlight leading-tight">
            {{ __('Proyek Saya') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <!-- 👇 Menambahkan class dark: (untuk bg-gray-50) -->
    <div class="py-12 bg-gray-50 dark:bg-secondary">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 👇 Menambahkan class dark: -->
            <div class="bg-white dark:bg-card overflow-hidden shadow-sm sm:rounded-lg">
                <!-- 👇 Menambahkan class dark: -->
                <div class="p-6 text-gray-900 dark:text-textlight">
                    
                    {{-- Tombol Tambah Proyek --}}
                    <!-- 👇 Mengganti warna tombol dengan 'primary' -->
                    <a href="#" class="mb-6 inline-flex items-center px-4 py-2 
                                   bg-primary-600 border border-transparent 
                                   rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                   hover:bg-primary-700 
                                   focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 
                                   dark:focus:ring-offset-secondary
                                   transition ease-in-out duration-150">
                        Tambah Proyek Baru
                    </a>

                    {{-- Grid untuk Kartu Proyek --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        {{-- Kita loop data palsu yang kita kirim dari route --}}
                        @foreach ($projects as $project)
                            
                            <!-- 👇 Menambahkan class dark: pada kartu -->
                            <div class="bg-white dark:bg-secondary border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-5 flex flex-col justify-between">
                                <div>
                                    <!-- 👇 Menambahkan class dark: -->
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-textlight mb-2">
                                        {{ $project['name'] }}
                                    </h3>

                                    <!-- 👇 Menambahkan class dark: pada status badge -->
                                    <div class="mb-3">
                                        @if ($project['status'] == 'Completed')
                                            <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                Completed
                                            </span>
                                        @elseif ($project['status'] == 'In Progress')
                                            <span class="inline-block bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                In Progress
                                            </span>
                                        @else
                                            <span class="inline-block bg-gray-100 text-gray-800 dark:bg-gray-700/50 dark:text-gray-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                Pending
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Progress Bar --}}
                                    <div class="mb-2">
                                        <div class="flex justify-between mb-1">
                                            <!-- 👇 Menambahkan class dark: -->
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Progres</span>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $project['progress'] }}%</span>
                                        </div>
                                        <!-- 👇 Menambahkan class dark: -->
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <!-- 👇 Mengganti warna bar dengan 'primary' -->
                                            <div class="bg-primary-600 h-2.5 rounded-full" style="width: {{ $project['progress'] }}%"></div>
                                        </div>
                                    </div>

                                    <!-- 👇 Menambahkan class dark: -->
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                        Tenggat: {{ \Carbon\Carbon::parse($project['due_date'])->format('d M Y') }}
                                    </p>
                                </div>

                                {{-- Tombol Aksi --}}
                                <div>
                                    <!-- 👇 Mengganti warna link dengan 'primary' -->
                                    <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>