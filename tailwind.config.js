const {fontFamily} = require('tailwindcss/defaultTheme');
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./app/**/*.php",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                default: ['Inter', ...fontFamily.sans],
                intro: ['Intro', ...fontFamily.sans],
                bookmanos: ['Bookman old style', ...fontFamily.sans]
            }
        },
    },
    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["[data-theme=light]"],
                    primary: "#2563eb",
                    'primary-content': '#ffffff',
                    'secondary-content': '#ffffff',
                    secondary: "#e11d48",
                    error: "#b91c1c"
                },
            },
        ],
    },

    plugins: [require("@tailwindcss/typography"), require("@tailwindcss/line-clamp"), require("daisyui")],
}
