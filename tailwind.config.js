const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            backgroundColor: ['checked'],
            borderColor: ['checked'],
        },
    },

    checkbox:{
        color: defaultTheme.colors.green,
        backgroundColor: defaultTheme.colors.green[500],
        borderColor: defaultTheme.borderColor.default,
        '&:checked': {
            borderColor: 'transparent',
            backgroundColor: defaultTheme.colors.green[500],
            backgroundSize: '100% 100%',
            backgroundPosition: 'center',
            backgroundRepeat: 'no-repeat',
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
