const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: { 
                danger: colors.rose,
                primary: colors.purple,
                success: colors.green,
                warning: colors.yellow,
                milk: {
                    100: '#fbfaf6',
                    200: '#ecf3f5',
                    900: '#5a585c'
                }


            }, 
        },
    },

    plugins: [require('@tailwindcss/forms')]
};
