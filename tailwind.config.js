/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.vue",
      "./resources/**/*.js",
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
        colors:{
            'logo-green': '#0BBF64',
        },
    },
  },
  plugins: [
      require('@tailwindcss/forms')({
          strategy: 'class',
    }),
  ],
}

