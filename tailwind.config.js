import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        'node_modules/preline/dist/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Inter"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                    DEFAULT: '#3370B9', //500
                    50: '#DCE7F5',
                    100: '#C8D9F0',
                    200: '#A0BEE5',
                    300: '#78A3DA',
                    400: '#5089CF',
                    500: '#3370B9',
                    600: '#285991',
                    700: '#1D4169',
                    800: '#122941',
                    900: '#071019',
                    950: '#010305'
                },
                'secondary': {
                    DEFAULT: '#FC8C1F', //500
                    50: '#FFF5EB',
                    100: '#FEEAD4',
                    200: '#FED4A7',
                    300: '#FDBD7A',
                    400: '#FDA54C',
                    500: '#FC8C1F',
                    600: '#EA7303',
                    700: '#BD5B03',
                    800: '#8F4402',
                    900: '#622E01',
                    950: '#4B2301'
                },
            },
        },
        // fontSize: {
        //     'sm'    : ['13px', '22px'],
        //     'base'  : ['16px', '27px'],
        //     'lg'    : ['20px', '32px'],
        //     'xl'    : ['26px', '41px'],
        //     '2xl'   : ['33px', '51px'],
        //     '3xl'   : ['42px', '64px'],
        //     '4xl'   : ['69px', '105px'],
        //     '5xl'   : ['112px', '171px'],
        // },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('preline/plugin'),
    ],
};
