<x-guest-layout>

    <!-- Logo atau Judul Aplikasi (Sesuai tema login.blade.php) -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800 dark:text-textlight tracking-wider">
            Buat Akun <span class="text-primary-500 dark:text-primary-400">Baru</span>
        </h1>
    </div>

    <!-- Kartu Register (Sesuai tema login.blade.php) -->
    <div class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-card shadow-2xl overflow-hidden rounded-xl
                transform transition-all duration-500 hover:shadow-primary-500/50 hover:scale-[1.01]">

        <h2 class="text-2xl font-bold text-gray-800 dark:text-textlight mb-6 text-center border-b border-gray-200 dark:border-primary-500/50 pb-3">
            Formulir Pendaftaran
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name (Sesuai tema login.blade.php) -->
            <div class="mb-4">
                <x-input-label for="name" value="{{ __('Nama') }}" class="text-gray-700 dark:text-gray-400 font-medium" />
                <x-text-input
                    id="name"
                    class="block w-full mt-2 p-3 
                           border-gray-300 dark:border-gray-700 
                           bg-gray-50 dark:bg-secondary 
                           text-gray-900 dark:text-textlight 
                           rounded-lg shadow-inner
                           focus:border-primary-500 focus:ring-primary-500 transition duration-150"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Nama lengkap Anda"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address (Sesuai tema login.blade.php) -->
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
                    autocomplete="username"
                    placeholder="email@contoh.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password (Sesuai tema login.blade.php) -->
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
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password (Sesuai tema login.blade.php) -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" class="text-gray-700 dark:text-gray-400 font-medium" />
                <x-text-input
                    id="password_confirmation"
                    class="block w-full mt-2 p-3 
                           border-gray-300 dark:border-gray-700 
                           bg-gray-50 dark:bg-secondary 
                           text-gray-900 dark:text-textlight 
                           rounded-lg shadow-inner
                           focus:border-primary-500 focus:ring-primary-500 transition duration-150"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="Ulangi password"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>


            <!-- Link Login & Tombol Register (Sesuai tema login.blade.php) -->
            <div class="flex items-center justify-end mt-8">
                <a class="text-sm text-primary-600 dark:text-primary-500 
                          hover:text-primary-700 dark:hover:text-primary-400 
                          font-medium transition duration-150" 
                   href="{{ route('login') }}">
                    {{ __('Sudah terdaftar?') }}
                </a>

                <button
                    type="submit"
                    class="ms-4 flex justify-center py-3 px-8 border border-transparent rounded-lg shadow-lg
                           text-lg font-semibold text-white 
                           bg-primary-600 hover:bg-primary-700 
                           dark:bg-primary-600 dark:hover:bg-primary-700
                           focus:outline-none focus:ring-4 focus:ring-primary-500/50 
                           focus:ring-offset-2 dark:focus:ring-offset-secondary
                           transition duration-300 ease-in-out transform hover:scale-[1.01]"
                >
                    {{ __('Daftar') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>

<!-- 
    PENTING: 
    Blok <style> kustom dari file Anda sebelumnya telah dihapus 
    karena 'login.blade.php' tidak menggunakannya dan 
    kita ingin menjaga konsistensi.
-->