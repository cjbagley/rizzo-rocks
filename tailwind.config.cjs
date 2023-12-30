/** @type {import('tailwindcss').Config} */
import forms from '@tailwindcss/forms';
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.svelte",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [forms],
    darkMode: 'class',
};
