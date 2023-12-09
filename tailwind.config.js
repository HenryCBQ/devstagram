/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.js",
    "./resources/**/*.blade.php",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php", //Agregar estilos tailwin de paginación
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}