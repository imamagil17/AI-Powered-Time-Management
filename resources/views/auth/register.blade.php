<x-guest-layout>
    <!--
        Implementasi desain Bersih/Modern (Light Gray & Purple)
        dengan tambahan animasi border bergerak dan shadow biru yang kuat saat focus.
    -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 font-sans">

        <!-- Logo atau Judul Aplikasi -->
        <div class="mb-8 sm:mt-10">
            <h1 class="text-5xl font-extrabold text-indigo-700 tracking-wider">
                Time Manager
            </h1>
        </div>

        <!-- Kartu Register Utama -->
        <div class="w-full sm:max-w-lg mx-auto px-8 py-10 bg-white shadow-xl overflow-hidden rounded-3xl
                    transform transition-all duration-300 hover:shadow-2xl">

            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center border-b border-gray-200 pb-4">
                Buat Akun Baru
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-5">
                    <x-input-label for="name" value="{{ __('Nama Lengkap') }}" class="text-gray-600 text-sm font-medium mb-2" />
                    <div class="relative">
                        <x-text-input
                            id="name"
                            class="block w-full p-4 border-gray-300 bg-indigo-50 text-gray-800 rounded-xl shadow-sm
                                   focus:ring-0 focus:border-gray-300 transition duration-300
                                   placeholder-gray-500
                                   input-border-animate input-shadow-animate"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Nama Anda"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
                </div>

                <!-- Email Address -->
                <div class="mt-5 mb-5">
                    <x-input-label for="email" value="{{ __('Alamat Email') }}" class="text-gray-600 text-sm font-medium mb-2" />
                    <div class="relative">
                        <x-text-input
                            id="email"
                            class="block w-full p-4 border-gray-300 bg-indigo-50 text-gray-800 rounded-xl shadow-sm
                                   focus:ring-0 focus:border-gray-300 transition duration-300
                                   placeholder-gray-500
                                   input-border-animate input-shadow-animate"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autocomplete="username"
                            placeholder="email@contoh.com"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div class="mt-5 mb-5">
                    <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="text-gray-600 text-sm font-medium mb-2" />
                    <div class="relative">
                        <x-text-input
                            id="password"
                            class="block w-full p-4 border-gray-300 bg-indigo-50 text-gray-800 rounded-xl shadow-sm
                                   focus:ring-0 focus:border-gray-300 transition duration-300
                                   placeholder-gray-500
                                   input-border-animate input-shadow-animate"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-5">
                    <x-input-label for="password_confirmation" value="{{ __('Konfirmasi Kata Sandi') }}" class="text-gray-600 text-sm font-medium mb-2" />
                    <div class="relative">
                        <x-text-input
                            id="password_confirmation"
                            class="block w-full p-4 border-gray-300 bg-indigo-50 text-gray-800 rounded-xl shadow-sm
                                   focus:ring-0 focus:border-gray-300 transition duration-300
                                   placeholder-gray-500
                                   input-border-animate input-shadow-animate"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi Kata Sandi"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                </div>

                <!-- Link Login & Tombol Register -->
                <div class="flex items-center justify-end mt-8">

                    <!-- Tautan Login -->
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 font-medium transition duration-300" href="{{ route('login') }}">
                        {{ __('Sudah terdaftar?') }}
                    </a>

                    <!-- Tombol Daftar -->
                    <button
                        type="submit"
                        class="ms-4 flex justify-center py-3 px-8 rounded-xl shadow-lg
                               text-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700
                               focus:outline-none focus:ring-4 focus:ring-indigo-500/50
                               transition duration-300 ease-in-out transform hover:scale-[1.005]"
                    >
                        {{ __('Daftar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

<!-- Custom CSS untuk Animasi Border dan Shadow -->
<style>
    /*
        Animasi Border Bergerak (Sesuai Video)
    */
    .input-border-animate {
        position: relative;
        z-index: 10;
        /* Default transition untuk semua properti */
        transition: all 0.3s ease-out;
    }

    .input-border-animate:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        background-color: #4f46e5; /* indigo-600 */
        height: 2px;
        width: 0%;
        transition: width 0.3s ease-out;
        z-index: 20;
    }

    .input-border-animate:focus:after {
        width: 100%;
    }

    /* Menambahkan padding pada input field agar border bergerak di luar area p-4 */
    .input-border-animate {
        padding-bottom: 15px !important; /* Tambahkan padding agar ada ruang untuk garis */
    }

    /*
        Animasi Bayangan Biru Jelas (Sesuai Permintaan)
    */
    .input-shadow-animate {
        /* Memastikan transisi bayangan berjalan mulus */
        transition: box-shadow 0.3s ease-out;
    }

    /* Bayangan Biru/Ungu yang sangat terlihat saat focus */
    .input-shadow-animate:focus {
        /*
          focus:ring-0 dan focus:border-gray-300 tetap dipertahankan di HTML
          untuk mengontrol tampilan border secara manual (melalui ::after).
          Di sini kita hanya menambahkan box-shadow.
        */
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.4), 0 0 15px rgba(99, 102, 241, 0.6) !important;
    }
</style>