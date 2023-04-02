/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./app/views/**/*.{php,html,js}'],
  theme: {
    container: {
      center: true,
      padding: '16px',
    },
    extend: {
      screens: {
        '2xl': '1320px'
      },
      colors: {
        'green': '#b3903e',
        'lightgreen': '#efd26e',
        'darkgreen': '#004d47',
        'darkgray': '#042036',
        'lightgray': 'rgb(107 114 128)'
      }
    },
  },
  plugins: [],
}
