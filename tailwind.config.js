import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f5f7ff', // Warna paling terang
                    100: '#e0e7ff', // Warna terang
                    200: '#c7d2fe', // Warna sedang
                    300: '#a5b4fc', // Warna agak gelap
                    400: '#818cf8', // Warna gelap
                    500: '#6366f1', // Warna utama
                    600: '#4f46e5', // Warna lebih gelap
                    700: '#4338ca', // Warna lebih gelap lagi
                    800: '#3730a3', // Warna sangat gelap
                    900: '#1e1a78', // Warna paling gelap
                },
                // Anda bisa menambahkan warna lain di sini
            },
        },
    },
    plugins: [],
};