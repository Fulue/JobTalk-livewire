/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./database/factories/ProfessionFactory.php",
      "./database/factories/TagFactory.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

