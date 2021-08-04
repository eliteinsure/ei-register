const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Quattrocento Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'shark': { DEFAULT: '#2B3036' },
                'lmara': { DEFAULT: '#0081B8' },
                'tblue': { DEFAULT: '#0F6497' },
                'dsgreen': { DEFAULT: '#0C4664' },
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
