import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            colors: {
                'primary-100': '#D7DBFF',
                'primary-200': '#B0B7FF',
                'primary-300': '#8992FF',
                'primary-400': '#6C76FF',
                'primary-500': '#3B48FF',
                'primary-600': '#2B35DB',
                'primary-700': '#1D25B7',
                'primary-800': '#121893',
                'primary-900': '#0B0F7A',
        
                'success-100': '#E9FCD8',
                'success-200': '#CEF9B1',
                'success-300': '#A8EF88',
                'success-400': '#84E067',
                'success-500': '#51CC39',
                'success-600': '#35AF29',
                'success-700': '#1D921C',
                'success-800': '#127618',
                'success-900': '#0A6117',
        
                'info-100': '#CCFCFF',
                'info-200': '#99F2FF',
                'info-300': '#66E2FF',
                'info-400': '#3FCEFF',
                'info-500': '#00AEFF',
                'info-600': '#0087DB',
                'info-700': '#0065B7',
                'info-800': '#004793',
                'info-900': '#00337A',
        
                'warning-100': '#FFFACC',
                'warning-200': '#FFF499',
                'warning-300': '#FFEC67',
                'warning-400': '#FFE541',
                'warning-500': '#FFD902',
                'warning-600': '#DBB701',
                'warning-700': '#B79601',
                'warning-800': '#937600',
                'warning-900': '#7A6000',
        
                'danger-100': '#FFE7D5',
                'danger-200': '#FFC8AC',
                'danger-300': '#FFA382',
                'danger-400': '#FF8063',
                'danger-500': '#FF4530',
                'danger-600': '#DB2623',
                'danger-700': '#B71821',
                'danger-800': '#930F22',
                'danger-900': '#7A0922',

                transparent: 'transparent',
                current: 'currentColor',
                black: colors.black,
                blue: colors.blue,
                cyan: colors.cyan,
                emerald: colors.emerald,
                fuchsia: colors.fuchsia,
                slate: colors.slate,
                gray: colors.gray,
                neutral: colors.neutral,
                stone: colors.stone,
                green: colors.green,
                indigo: colors.indigo,
                lime: colors.lime,
                orange: colors.orange,
                pink: colors.pink,
                purple: colors.purple,
                red: colors.red,
                rose: colors.rose,
                sky: colors.sky,
                teal: colors.teal,
                violet: colors.violet,
                yellow: colors.amber,
                white: colors.white,

              },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
