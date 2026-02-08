import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
            colors: {
                olive: {
                    50: '#f7f8f0',
                    100: '#eef0e0',
                    200: '#dde1c2',
                    300: '#c4cb98',
                    400: '#a9b36e',
                    500: '#8d9a4f',
                    600: '#6f7b3c',
                    700: '#566031',
                    800: '#464e2a',
                    900: '#3c4327',
                    950: '#1f2312',
                },
                earth: {
                    50: '#faf6f1',
                    100: '#f3ebe0',
                    200: '#e6d4be',
                    300: '#d6b896',
                    400: '#c69a6e',
                    500: '#ba8354',
                    600: '#ad7049',
                    700: '#905a3e',
                    800: '#744a38',
                    900: '#5f3e30',
                    950: '#331f18',
                },
            },
        },
    },

    plugins: [forms],
};
