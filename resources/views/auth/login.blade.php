<x-guest-layout>
    <!--
        Modifikasi ini menggunakan skema warna Dark Mode yang elegan
        dengan fokus pada kartu login yang menonjol (card shadow/depth)
        serta animasi transisi untuk kesan 'mewah'.
        Asumsi: x-guest-layout sudah mengatur latar belakang seluruh halaman
        (misalnya, gelap atau dengan gradien).
    -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <!-- Logo atau Judul Aplikasi (Opsional) -->
        <div class="mb-8">
            <h1 class="text-4xl font-extrabold text-white tracking-wider">
                <span class="text-indigo-400">Time Manager
            </h1>
        </div>

        <!-- Kartu Login Utama -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-xl
                    transform transition-all duration-500 hover:shadow-indigo-500/50 hover:scale-[1.01]">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center border-b border-indigo-500/50 pb-3">
                Masuk ke Akun Anda
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-sm text-green-500" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" value="{{ __('Email') }}" class="text-gray-600 dark:text-gray-300 font-medium" />
                    <x-text-input
                        id="email"
                        class="block w-full mt-2 p-3 border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100 rounded-lg shadow-inner
                               focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 transition duration-150"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="email@contoh.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="text-gray-600 dark:text-gray-300 font-medium" />
                    <x-text-input
                        id="password"
                        class="block w-full mt-2 p-3 border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100 rounded-lg shadow-inner
                               focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 transition duration-150"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <!-- Remember Me -->
                    <label for="remember_me" class="inline-flex items-center select-none cursor-pointer">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded-md dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-indigo-500 shadow-sm
                                   focus:ring-indigo-500 dark:focus:ring-indigo-600 transition duration-150"
                            name="remember"
                        >
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition duration-150" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>

                <!-- Tombol Login -->
                <div class="mt-8">
                    <button
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg
                               text-lg font-semibold text-white bg-indigo-600 hover:bg-indigo-700
                               focus:outline-none focus:ring-4 focus:ring-indigo-500/50 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                               transition duration-300 ease-in-out transform hover:scale-[1.01]"
                    >
                        {{ __('Masuk') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Link ke Halaman Daftar (Jika ada) -->
        @if (Route::has('register'))
            <p class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                Belum punya akun?
                <a class="text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold transition duration-150" href="{{ route('register') }}">
                    Daftar Sekarang
                </a>
            </p>
        @endif

    </div>
</x-guest-layout>