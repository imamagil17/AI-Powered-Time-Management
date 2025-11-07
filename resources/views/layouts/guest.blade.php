<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <!-- 
        PERHATIKAN:
        Semua class layout (flex, justify-center, bg-color) ada di BODY.
        Ini akan mengisi seluruh layar dan menghilangkan "frame" putih.
    -->
    <body class="font-sans antialiased 
                 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 
                 bg-gray-100 dark:bg-secondary 
                 text-gray-900 dark:text-gray-300">
        
        <!-- 
            Konten dari login.blade.php akan dimasukkan di sini.
            Tidak ada 'div' pembungkus di sini.
        -->
        {{ $slot }}

    </body>
</html>