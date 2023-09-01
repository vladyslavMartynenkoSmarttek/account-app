const defaultTheme = require('tailwindcss/defaultTheme');
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    // enable dark mode via class strategy
    darkMode: ['class', '[data-mode="dark"]'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [// include Flowbite as a plugin in your Tailwind CSS project
        require('flowbite/plugin'),
        require('tailwind-scrollbar'),
    ],
};
