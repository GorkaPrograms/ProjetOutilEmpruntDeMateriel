/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.vue",
      "./resources/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms')({
          strategy: 'class',
    }),
  ],
}

