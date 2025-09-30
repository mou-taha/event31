import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import aspectRatio from '@tailwindcss/aspect-ratio';


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                spin: {
                  '0%, 100%': { transform: 'rotate(0deg)' },
                  '50%': { transform: 'rotate(180deg)' },
                },
              },
              animation: {
                spin: 'spin 1s linear infinite',
              },
        },
    },

    plugins: [forms, aspectRatio],
};
