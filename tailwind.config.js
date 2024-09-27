/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
      "./resources/**/*.blade.php",
      "./database/factories/ProfessionFactory.php",
      "./database/factories/TagFactory.php",
    ],
    theme: {
    extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('preline/plugin'),
    ],
}

