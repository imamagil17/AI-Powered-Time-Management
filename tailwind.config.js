import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    
    // 👇 1. MENAMBAHKAN TEMA DINAMIS
    darkMode: 'media',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // (Ini adalah font default Anda dari Breeze, kita pertahankan)
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // 👇 2. MENAMBAHKAN SKEMA WARNA KUSTOM KITA
            colors: {
                primary: {
                    50: '#eef2ff',
                    100: '#e0e7ff',
                    200: '#c7d2fe',
                    300: '#a5b4fc',
                    400: '#818cf8',
                    500: '#6366f1', 
                    600: '#4f46e5',
                    700: '#4338ca',
                    800: '#3730a3',
                    900: '#312e81',
                    950: '#1e1b4b',
                },
                secondary: '#1e293b', 
                card: '#2d3748', 
                textlight: '#f8fafc',
                textdark: '#1f2937', 
            },
        },
    },

    plugins: [forms],
};