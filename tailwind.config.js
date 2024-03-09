/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
            sans: ["Hanuman", "sans-serif"],
            paragraf: ["Libre Baskervile", "serif"],
            },
            colors: {
                primary: {
                800: "#243048",
                500: "#374A7B"
                },
                abu: {
                500:  "#E6EBEE",
                800: "#ABA7AF"
                },
                secondary: "#F5F5F5",
                accent: "#0F2885",
                krem: "#FAF5F1"
            }
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

