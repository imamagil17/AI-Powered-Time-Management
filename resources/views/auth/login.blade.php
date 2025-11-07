<x-guest-layout>

    <!-- Logo atau Judul Aplikasi (Perbaikan Light/Dark) -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800 dark:text-textlight tracking-wider">
            AI Powered Time Management <span class="text-primary-500 dark:text-primary-400">App</span>
        </h1>
    </div>

    <!-- Kartu Login (Perbaikan Light/Dark) -->
    <div class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-card shadow-2xl overflow-hidden rounded-xl
                transform transition-all duration-500 hover:shadow-primary-500/50 hover:scale-[1.01]">

        <h2 class="text-2xl font-bold text-gray-800 dark:text-textlight mb-6 text-center border-b border-gray-200 dark:border-primary-500/50 pb-3">
            Masuk ke Akun Anda
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-sm text-green-500" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address (Perbaikan Light/Dark) -->
            <div class="mb-4">
                <x-input-label for="email" value="{{ __('Email') }}" class="text-gray-700 dark:text-gray-400 font-medium" />
                <x-text-input
                    id="email"
                    class="block w-full mt-2 p-3 
                           border-gray-300 dark:border-gray-700 
                           bg-gray-50 dark:bg-secondary 
                           text-gray-900 dark:text-textlight 
                           rounded-lg shadow-inner
                           focus:border-primary-500 focus:ring-primary-500 transition duration-150"
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

            <!-- Password (Perbaikan Light/Dark) -->
            <div class="mb-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="text-gray-700 dark:text-gray-400 font-medium" />
                <x-text-input
                    id="password"
                    class="block w-full mt-2 p-3 
                           border-gray-300 dark:border-gray-700 
                           bg-gray-50 dark:bg-secondary 
                           text-gray-900 dark:text-textlight 
                           rounded-lg shadow-inner
                           focus:border-primary-500 focus:ring-primary-500 transition duration-150"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password (Perbaikan Light/Dark) -->
            <div class="flex items-center justify-between">
                <!-- Remember Me -->
                <label for="remember_me" class="inline-flex items-center select-none cursor-pointer">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="rounded-md 
                               bg-gray-200 dark:bg-secondary 
                               border-gray-300 dark:border-gray-600 
                               text-primary-600 dark:text-primary-500 
                               shadow-sm
                               focus:ring-primary-500 transition duration-150"
                        name="remember"
                    >
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-primary-600 dark:text-primary-500 
                              hover:text-primary-700 dark:hover:text-primary-400 
                              font-medium transition duration-150" 
                       href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            <!-- Tombol Login (Perbaikan Light/Dark) -->
            <div class="mt-8">
                <button
                    type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg
                           text-lg font-semibold text-white 
                           bg-primary-600 hover:bg-primary-700 
                           dark:bg-primary-600 dark:hover:bg-primary-700
                           focus:outline-none focus:ring-4 focus:ring-primary-500/50 
                           focus:ring-offset-2 dark:focus:ring-offset-secondary
                           transition duration-300 ease-in-out transform hover:scale-[1.01]"
                >
                    {{ __('Masuk') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Link ke Halaman Daftar (Perbaikan Light/Dark) -->
    @if (Route::has('register'))
        <p class="mt-6 text-sm text-center text-gray-500 dark:text-gray-400"> 
            Belum punya akun?
            <a class="text-primary-600 dark:text-primary-500 
                      hover:text-primary-700 dark:hover:text-primary-400 
                      font-semibold transition duration-150" 
               href="{{ route('register') }}">
                Daftar Sekarang
            </a>
        </p>
    @endif

</x-guest-layout>