<x-app-layout>
    <!-- Custom CSS for Animations -->
    <style>
        /* Keyframes 'Graceful Fade In Up' yang Mulus
            Kita hanya akan menggunakan SATU jenis animasi untuk konsistensi.
        */
        @keyframes gracefulFadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Class utilitas untuk animasi.
            Kita akan menerapkannya dengan 'animation-delay' inline.
        */
        .animate-graceful {
            animation: gracefulFadeInUp 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            opacity: 0; /* Mulai transparan agar tidak 'flash' */
        }

        /* Utilitas Kustom untuk Background Grid (Tetap sama) */
        .bg-grid-dots {
            background-image: radial-gradient(#d1d5db 1px, transparent 0); /* light: gray-300 */
            background-size: 20px 20px;
        }
        @media (prefers-color-scheme: dark) {
            .bg-grid-dots {
                background-image: radial-gradient(#374151 1px, transparent 0); /* dark: gray-700 */
            }
        }
    </style>

    <x-slot name="header">
        <!-- Terapkan animasi baru dengan delay pertama -->
        <div class="animate-graceful" style="animation-delay: 0s;">
            <h2 class="font-extrabold text-3xl text-indigo-700 dark:text-primary-400 leading-tight tracking-wide">
                {{ __('Dashboard Aktivitas') }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Selamat datang kembali di Time Manager Anda.</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-secondary min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- STATISTIK RINGKAS (3 KARTU) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <!-- Kartu 1: Total Proyek -->
                <div class="bg-white dark:bg-card p-6 shadow-xl rounded-2xl border-l-4 border-indigo-500 dark:border-primary-500 transform transition duration-300 hover:scale-[1.02] animate-graceful" style="animation-delay: 0.1s;">
                    <div class="flex justify-between items-center">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">{{ __('Total Proyek Aktif') }}</div>
                        <svg class="w-8 h-8 text-indigo-500 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    </div>
                    <div class="mt-3 text-4xl font-extrabold text-gray-900 dark:text-textlight">{{ $activeProjects }}</div>
                    <p class="text-sm text-indigo-600 dark:text-primary-500 mt-1">{{ __('Dari total ') . $totalProjects . ' proyek' }}</p>
                </div>

                <!-- Kartu 2: Waktu Terekam -->
                <div class="bg-white dark:bg-card p-6 shadow-xl rounded-2xl border-l-4 border-fuchsia-500 transform transition duration-300 hover:scale-[1.02] animate-graceful" style="animation-delay: 0.2s;">
                    <div class="flex justify-between items-center">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">{{ __('Waktu Terekam (Jam)') }}</div>
                        <svg class="w-8 h-8 text-fuchsia-500 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="mt-3 text-4xl font-extrabold text-gray-900 dark:text-textlight">{{ number_format($totalHoursThisWeek, 1) }}</div>
                    <p class="text-sm text-fuchsia-600 dark:text-fuchsia-500 mt-1">{{ __('Minggu ini') }}</p>
                </div>

                <!-- Kartu 3: Tugas Selesai -->
                <div class="bg-white dark:bg-card p-6 shadow-xl rounded-2xl border-l-4 border-teal-500 transform transition duration-300 hover:scale-[1.02] animate-graceful" style="animation-delay: 0.3s;">
                    <div class="flex justify-between items-center">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">{{ __('Tugas Selesai') }}</div>
                        <svg class="w-8 h-8 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="mt-3 text-4xl font-extrabold text-gray-900 dark:text-textlight">{{ $completedTasks }}</div>
                    <p class="text-sm text-teal-600 dark:text-teal-500 mt-1">{{ __('Tingkat penyelesaian ') . $completionRate . '%' }}</p>
                </div>
            </div>

            <!-- KONTEN UTAMA (TUGAS TERBARU DAN LOG) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Kolom Kiri (Tugas Terbaru & Logged In) -->
                <!-- Animasikan HANYA kartu kontainer ini -->
                <div class="lg:col-span-2 bg-white dark:bg-card p-8 shadow-2xl overflow-hidden rounded-3xl animate-graceful" style="animation-delay: 0.4s;">

                    <!-- Status Selamat Datang -->
                    <div class="mb-6">
                        <div class="p-4 bg-indigo-50 border border-indigo-200 rounded-lg text-indigo-700
                                    dark:bg-primary-900/50 dark:border-primary-700 dark:text-primary-300
                                    font-medium flex items-center space-x-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5a1.5 1.5 0 013 0m-3 0v-2.5a1.5 1.5 0 013 0m0 2.5v-2.5a1.5 1.5 0 013 0m0 2.5v-2.5a1.5 1.5 0 013 0M12 17.5a1.5 1.5 0 00-3 0v2.5a1.5 1.5 0 003 0v-2.5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.33 10.172a1.5 1.5 0 01-.256-1.025C4.28 8.13 5.79 7.5 7.5 7.5h6c1.71 0 3.22.63 3.426 1.647a1.5 1.5 0 01-.256 1.025c-1.138.996-2.61 1.62-4.17 1.776V17.5a1.5 1.5 0 01-3 0v-6.528c-1.56-.156-3.032-.78-4.17-1.776z"></path></svg>
                            <span>Selamat Datang Kembali, {{ Auth::user()->name }}!</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-b pb-4 mb-6 border-indigo-200 dark:border-primary-500/50">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-textlight">{{ __('Tugas Prioritas Terkini') }}</h3>
                        <a href="{{ route('tasks.create') }}"
                            class="flex items-center space-x-2 py-2 px-4 rounded-xl text-white
                                   bg-indigo-600 hover:bg-indigo-700
                                   dark:bg-primary-600 dark:hover:bg-primary-700
                                   shadow-md shadow-indigo-500/50
                                   transition duration-300 transform hover:scale-[1.03]
                                   focus:ring-4 focus:ring-indigo-300 dark:focus:ring-primary-500/50"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <span class="font-semibold">{{ __('Buat Tugas Baru') }}</span>
                        </a>
                    </div>

                    <!-- Daftar Tugas Real (Hapus animasi staggered dari sini) -->
                    <ul class="space-y-4">
                        @forelse($recentTasks as $task)
                            <li class="p-4 bg-gray-50 dark:bg-secondary rounded-xl shadow-lg border border-gray-100 dark:border-secondary flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-textlight">{{ $task->title }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Proyek: {{ $task->project->name }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($task->priority == 'high') 
                                        bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300
                                    @elseif($task->priority == 'medium') 
                                        bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-300
                                    @else 
                                        bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300
                                    @endif">
                                    @if($task->status == 'completed') 
                                        Selesai
                                    @elseif($task->status == 'in progress')
                                        Dalam Proses
                                    @else
                                        To Do
                                    @endif
                                </span>
                            </li>
                        @empty
                            <li class="p-4 bg-gray-50 dark:bg-secondary rounded-xl shadow-lg border border-gray-100 dark:border-secondary text-center text-gray-500 dark:text-gray-400">
                                Tidak ada tugas yang ditugaskan.
                            </li>
                        @endforelse
                    </ul>
                </div>

                <!-- Kolom Kanan (Aktivitas Terbaru) -->
                <!-- Animasikan HANYA kartu kontainer ini -->
                <div class="lg:col-span-1 bg-white dark:bg-card p-8 shadow-2xl overflow-hidden rounded-3xl h-full animate-graceful" style="animation-delay: 0.5s;">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-textlight border-b border-gray-200 dark:border-gray-700 pb-4 mb-6">{{ __('Aktivitas Terbaru') }}</h3>

                    <!-- Log Aktivitas Real (Hapus animasi staggered dari sini) -->
                    <ul class="space-y-4">
                        @forelse($recentTimeEntries as $timeEntry)
                            <li class="p-4 bg-gray-50 dark:bg-secondary rounded-xl shadow-lg border border-gray-100 dark:border-secondary flex items-center">
                                <div class="flex items-center space-x-3 text-sm">
                                    <span class="text-indigo-600 dark:text-primary-400 font-bold">{{ $timeEntry->created_at->format('H:i') }}</span>
                                    <span class="text-gray-600 dark:text-gray-400">
                                        Mencatat {{ $timeEntry->duration_minutes / 60 }} jam untuk tugas "{{ $timeEntry->task->title }}" di proyek "{{ $timeEntry->task->project->name }}".
                                    </span>
                                </div>
                            </li>
                        @empty
                            <li class="p-4 bg-gray-50 dark:bg-secondary rounded-xl shadow-lg border border-gray-100 dark:border-secondary text-center text-gray-500 dark:text-gray-400">
                                Tidak ada aktivitas terbaru.
                            </li>
                        @endforelse
                    </ul>

                    <div class="mt-8 text-center">
                        <a href="{{ route('time-entries.index') }}" class="text-indigo-600 hover:text-indigo-800 dark:text-primary-400 dark:hover:text-primary-300 font-medium text-sm underline">{{ __('Lihat Semua Log') }}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>