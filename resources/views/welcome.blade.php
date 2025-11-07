<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Manajemen Waktu Cerdas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Style kustom sederhana untuk animasi -->
        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fadeIn 0.8s ease-out forwards;
            }
            .animate-delay-200 { animation-delay: 200ms; }
            .animate-delay-400 { animation-delay: 400ms; }
            .animate-delay-600 { animation-delay: 600ms; }
        </style>
    </head>
    <body class="font-sans antialiased bg-white dark:bg-secondary text-gray-800 dark:text-textlight">
        
        <div class="min-h-screen flex flex-col">
            <!-- Header Navigasi -->
            <header class="w-full z-10">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
                    <!-- Logo -->
                    <div>
                        <a href="/" class="text-2xl font-bold text-gray-900 dark:text-white">
                            AI Time <span class="text-primary-600 dark:text-primary-400">Manager</span>
                        </a>
                    </div>

                    <!-- Link Navigasi -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition duration-150">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition duration-150">Masuk</a>
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white 
                                          bg-primary-600 hover:bg-primary-700 
                                          focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500
                                          dark:focus:ring-offset-secondary
                                          transition duration-150">
                                    Daftar Gratis
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            </header>

            <!-- Main Content -->
            <main class="flex-grow">

                <!-- Hero Section -->
                <section class="py-24 md:py-32">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <div class="animate-fade-in" style="opacity: 0;">
                            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                                Lacak Progres. <span class="text-primary-600 dark:text-primary-400">Optimalkan Waktu.</span>
                            </h1>
                            <p class="mt-6 max-w-2xl mx-auto text-lg md:text-xl text-gray-600 dark:text-gray-300">
                                Manfaatkan kekuatan AI untuk memprediksi durasi tugas, memantau progres proyek, dan meningkatkan produktivitas tim Anda.
                            </p>
                            <div class="mt-10 flex justify-center items-center space-x-4">
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent rounded-md shadow-lg text-lg font-medium text-white 
                                          bg-primary-600 hover:bg-primary-700 
                                          focus:outline-none focus:ring-4 focus:ring-primary-500/50 
                                          dark:focus:ring-offset-secondary
                                          transition duration-300 transform hover:scale-105">
                                    Mulai Gratis
                                </a>
                                <a href="#features" class="inline-flex items-center justify-center px-8 py-3 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-lg font-medium 
                                          text-gray-800 dark:text-white 
                                          bg-white dark:bg-card 
                                          hover:bg-gray-50 dark:hover:bg-gray-700
                                          transition duration-300 transform hover:scale-105">
                                    Lihat Fitur
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Features Section -->
                <section id="features" class="py-24 bg-gray-50 dark:bg-secondary">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-16">
                            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white">
                                Fitur Unggulan Kami
                            </h2>
                            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                                Dirancang untuk tim yang serius dengan waktu mereka.
                            </p>
                        </div>

                        <div class="grid md:grid-cols-3 gap-8">
                            <!-- Feature 1 -->
                            <div class="bg-white dark:bg-card p-8 rounded-2xl shadow-xl animate-fade-in" style="opacity: 0; animation-delay: 200ms;">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pelacakan Real-time</h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Catat setiap menit yang dihabiskan untuk tugas spesifik. Lihat ke mana waktu Anda pergi dengan laporan yang akurat.
                                </p>
                            </div>
                            
                            <!-- Feature 2 -->
                            <div class="bg-white dark:bg-card p-8 rounded-2xl shadow-xl animate-fade-in" style="opacity: 0; animation-delay: 400ms;">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 0l-3-3m3 3l3-3m-3 3v4l3 3m-3-3V4m-3 3v4l-3 3m3-3V4m0 0l-3 3m3-3l3 3"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Prediksi Cerdas AI</h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    AI kami menganalisis data Anda untuk memberikan estimasi waktu yang lebih akurat untuk tugas-tugas di masa depan.
                                </p>
                            </div>

                            <!-- Feature 3 -->
                            <div class="bg-white dark:bg-card p-8 rounded-2xl shadow-xl animate-fade-in" style="opacity: 0; animation-delay: 600ms;">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h2m4 0h2m-4 0V9a2 2 0 00-2-2h-2a2 2 0 00-2 2v10m6 0h2"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Laporan Progres Visual</h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Dashboard yang indah dan mudah dipahami untuk memantau progres proyek, anggaran waktu, dan produktivitas tim.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Call to Action (CTA) Section -->
                <section class="py-24 bg-white dark:bg-card">
                    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white">
                            Siap Meningkatkan Produktivitas Anda?
                        </h2>
                        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                            Mulai lacak waktu Anda secara cerdas hari ini. Gratis untuk memulai.
                        </p>
                        <a href="{{ route('register') }}" class="mt-8 inline-flex items-center justify-center px-8 py-3 border border-transparent rounded-md shadow-lg text-lg font-medium text-white 
                                  bg-primary-600 hover:bg-primary-700 
                                  focus:outline-none focus:ring-4 focus:ring-primary-500/50 
                                  dark:focus:ring-offset-card
                                  transition duration-300 transform hover:scale-105">
                            Daftar Sekarang
                        </a>
                    </div>
                </section>

            </main>

            <!-- Footer -->
            <footer class="bg-gray-50 dark:bg-secondary border-t border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
        
    </body>
</html>