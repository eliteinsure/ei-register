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
        },
        colors: {
            'shark': { DEFAULT: '#2B3036', '50': '#CCD1D6', '100': '#B8BFC7', '200': '#909BA7', '300': '#6A7785', '400': '#4B535E', '500': '#2B3036', '600': '#22262B', '700': '#191C1F', '800': '#101214', '900': '#070809' },
            'lmara': { DEFAULT: '#0081B8', '50': '#9FE2FF', '100': '#85DBFF', '200': '#52CBFF', '300': '#1FBCFF', '400': '#00A5EB', '500': '#0081B8', '600': '#005D85', '700': '#003952', '800': '#00161F', '900': '#000000' },
            'tblue': { DEFAULT: '#0F6497', '50': '#97D1F5', '100': '#80C7F2', '200': '#51B3EE', '300': '#239FE9', '400': '#1483C5', '500': '#0F6497', '600': '#0A4569', '700': '#06273A', '800': '#01080C', '900': '#000000' },
            'dsgreen': { DEFAULT: '#0C4664', '50': '#69C0ED', '100': '#52B6EA', '200': '#24A3E5', '300': '#1786BF', '400': '#116692', '500': '#0C4664', '600': '#072636', '700': '#010609', '800': '#000000', '900': '#000000' },
        }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
