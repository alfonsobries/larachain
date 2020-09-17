const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    dark: 'class',

    experimental: {
        darkModeVariant: true
    },

    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './View/Components/*/*.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Kumbh Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        cursor: ['disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
