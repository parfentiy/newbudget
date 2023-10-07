<<<<<<< HEAD
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
=======
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
<<<<<<< HEAD
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
=======
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
            },
        },
    },

<<<<<<< HEAD
    plugins: [forms],
=======
    plugins: [require('@tailwindcss/forms')],
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
};
