<x-app-layout>
    <!-- Custom CSS for Animations -->
    <style>
        /* Keyframes untuk Animasi */
        @keyframes slideDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }
        @keyframes slideInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Classes Animasi dengan Delay Staggered */
        .animate-slide-down { animation: slideDown 0.8s ease-out forwards; }
        .animate-fade-in { animation: fadeIn 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
        .animate-slide-in-up { animation: slideInUp 0.7s ease-out forwards; }

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
        <div class="animate-slide-down">
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
                <div class="bg-white dark:bg-card p-6 shadow-xl rounded-2xl border-l-4 border-indigo-500 dark:border-primary-500 transform transition duration-300 hover:scale-[1.02] animate-fade-in" style="animation-delay: 0s;">
                    <div class="flex justify-between items-center">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">{{ __('Total Proyek Aktif') }}</div>
                        <svg class="w-8 h-8 text-indigo-500 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    </div>
                    <div class="mt-3 text-4xl font-extrabold text-gray-900 dark:text-textlight">12</div>
                    <p class="text-sm text-indigo-600 dark:text-primary-500 mt-1">{{ __('2 proyek baru bulan ini') }}</p>
                </div>

                <!-- Kartu 2: Waktu Terekam -->
                <div class="bg-white dark:bg-card p-6 shadow-xl rounded-2xl border-l-4 border-fuchsia-500 transform transition duration-300 hover:scale-[1.02] animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="flex justify-between items-center">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">{{ __('Waktu Terekam (Jam)') }}</div>
                        <svg class="w-8 h-8 text-fuchsia-500 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="mt-3 text-4xl font-extrabold text-gray-900 dark:text-textlight">45.5</div>
                    <p class="text-sm text-fuchsia-600 dark:text-fuchsia-500 mt-1">{{ __('Meningkat 8% dari minggu lalu') }}</p>
                </div>

                <!-- Kartu 3: Tugas Selesai -->
                <div class="bg-white dark:bg-card p-6 shadow-xl rounded-2xl border-l-4 border-teal-500 transform transition duration-300 hover:scale-[1.02] animate-fade-in" style="animation-delay: 0.4s;">
                    <div class="flex justify-between items-center">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">{{ __('Tugas Selesai') }}</div>
                        <svg class="w-8 h-8 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="mt-3 text-4xl font-extrabold text-gray-900 dark:text-textlight">95</div>
                    <p class="text-sm text-teal-600 dark:text-teal-500 mt-1">{{ __('Tingkat penyelesaian 92%') }}</p>
                </div>
            </div>

            <!-- KONTEN UTAMA (TUGAS TERBARU DAN LOG) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Kolom Kiri (Tugas Terbaru & Logged In) -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-card p-8 shadow-2xl overflow-hidden rounded-3xl animate-slide-in-up" style="animation-delay: 0.6s;">
                        
                        <!-- 
                            👇 PERUBAHAN DIMULAI DI SINI 
                            Blok 'Selamat Datang' dipindahkan ke atas dan diubah.
                        -->
                        <div class="mb-6"> <!-- Dihapus: mt-8 pt-4 border-t -->
                            <div class="p-4 bg-indigo-50 border border-indigo-200 rounded-lg text-indigo-700 
                                        dark:bg-primary-900/50 dark:border-primary-700 dark:text-primary-300 
                                        font-medium flex items-center space-x-3 animate-fade-in" style="animation-delay: 0.6s;">
                                <!-- Ikon diubah menjadi 'tangan melambai' -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5a1.5 1.5 0 013 0m-3 0v-2.5a1.5 1.5 0 013 0m0 2.5v-2.5a1.5 1.5 0 013 0m0 2.5v-2.5a1.5 1.5 0 013 0M12 17.5a1.5 1.5 0 00-3 0v2.5a1.5 1.5 0 003 0v-2.5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.33 10.172a1.5 1.5 0 01-.256-1.025C4.28 8.13 5.79 7.5 7.5 7.5h6c1.71 0 3.22.63 3.426 1.647a1.5 1.5 0 01-.256 1.025c-1.138.996-2.61 1.62-4.17 1.776V17.5a1.5 1.5 0 01-3 0v-6.528c-1.56-.156-3.032-.78-4.17-1.776z"></path></svg>
                                <!-- Teks diubah untuk menyertakan nama pengguna -->
                                <span>Selamat Datang Kembali, {{ Auth::user()->name }}!</span>
                            </div>
                        </div>
                        <!-- 👆 PERUBAHAN BERAKHIR DI SINI -->

                        <div class="flex justify-between items-center border-b pb-4 mb-6 border-indigo-200 dark:border-primary-500/50">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-textlight">{{ __('Tugas Prioritas Terkini') }}</h3>
                            <button
                                class="flex items-center space-x-2 py-2 px-4 rounded-xl text-white 
                                       bg-indigo-600 hover:bg-indigo-700 
                                       dark:bg-primary-600 dark:hover:bg-primary-700
                                       shadow-md shadow-indigo-500/50 
                                       transition duration-300 transform hover:scale-[1.03] 
                                       focus:ring-4 focus:ring-indigo-300 dark:focus:ring-primary-500/50"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <span class="font-semibold">{{ __('Buat Tugas Baru') }}</span>
                            </button>
                        </div>

                        <!-- Daftar Tugas Mockup -->
                        <ul class="space-y-4">
                            <!-- Tugas 1 -->
                            <li class="p-4 bg-white dark:bg-secondary rounded-xl shadow-lg border border-indigo-100 dark:border-secondary flex justify-between items-center animate-fade-in" style="animation-delay: 0.8s;">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-textlight">Integrasi API Pembayaran</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Proyek: E-Commerce Platform</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300">Deadline: 3 Hari</span>
                            </li>
                            <!-- Tugas 2 -->
                            <li class="p-4 bg-white dark:bg-secondary rounded-xl shadow-lg border border-indigo-100 dark:border-secondary flex justify-between items-center animate-fade-in" style="animation-delay: 1.0s;">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-textlight">Revisi Desain Halaman Landing</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Proyek: Corporate Website</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-300">Di Tinjau</span>
                            </li>
                            <!-- Tugas 3 -->
                            <li class="p-4 bg-white dark:bg-secondary rounded-xl shadow-lg border border-indigo-100 dark:border-secondary flex justify-between items-center animate-fade-in" style="animation-delay: 1.2s;">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-textlight">Rapat Koordinasi Mingguan</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Proyek: Internal</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300">Selesai</span>
                            </li>
                        </ul>

                        <!-- 
                            👇 BLOK STATUS LOGGED IN DIHAPUS DARI SINI 
                            (Sudah dipindahkan ke atas)
                        -->

                    </div>
                </div>

                <!-- Kolom Kanan (Aktivitas Terbaru) -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-card p-8 shadow-2xl overflow-hidden rounded-3xl h-full animate-slide-in-up" style="animation-delay: 0.8s;">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-textlight border-b border-gray-200 dark:border-gray-700 pb-4 mb-6">{{ __('Aktivitas Terbaru') }}</h3>
                        
                        <ul class="space-y-4">
                            <!-- Log 1 -->
                            <li class="p-4 bg-white dark:bg-secondary rounded-xl shadow-lg border border-indigo-100 dark:border-secondary flex items-center animate-fade-in" style="animation-delay: 1.0s;">
                                <div class="flex items-center space-x-3 text-sm">
                                    <span class="text-indigo-600 dark:text-primary-400 font-bold">14:30</span>
                                    <span class="text-gray-600 dark:text-gray-400">{{ __('Memperbarui status tugas "Desain Halaman Landing" menjadi Di Tinjau.') }}</span>
                                </div>
                            </li>
                            <!-- Log 2 -->
                            <li class="p-4 bg-white dark:bg-secondary rounded-xl shadow-lg border border-indigo-100 dark:border-secondary flex items-center animate-fade-in" style="animation-delay: 1.2s;">
                                <div class="flex items-center space-x-3 text-sm">
                                    <span class="text-indigo-600 dark:text-primary-400 font-bold">11:00</span>
                                    <span class="text-gray-600 dark:text-gray-400">{{ __('Mencatat waktu 3 jam untuk Proyek E-Commerce.') }}</span>
                                </div>
                            </li>
                            <!-- Log 3 -->
                            <li class="p-4 bg-white dark:bg-secondary rounded-xl shadow-lg border border-indigo-100 dark:border-secondary flex items-center animate-fade-in" style="animation-delay: 1.4s;">
                                <div class="flex items-center space-x-3 text-sm">
                                    <span class="text-indigo-600 dark:text-primary-400 font-bold">09:00</span>
                                    <span class="text-gray-600 dark:text-gray-400">{{ __('Membuat tugas baru "Integrasi API Pembayaran".') }}</span>
                                </div>
                            </li>
                            <!-- Log 4 -->
                            <li class="p-4 bg-white dark:bg-secondary rounded-xl shadow-lg border border-indigo-100 dark:border-secondary flex items-center animate-fade-in" style="animation-delay: 1.6s;">
                                <div class="flex items-center space-x-3 text-sm">
                                    <span class="text-indigo-600 dark:text-primary-400 font-bold">08:00</span>
                                    <span class="text-gray-600 dark:text-gray-400">{{ __('Anda login ke sistem.') }}</span>
                                </div>
                            </li>
                        </ul>

                        <div class="mt-8 text-center animate-fade-in" style="animation-delay: 1.8s;">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 dark:text-primary-400 dark:hover:text-primary-300 font-medium text-sm underline">{{ __('Lihat Semua Log') }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>