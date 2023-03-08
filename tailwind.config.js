/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      'blue-120': '#0d1b31',
      'blue-100':'#173259',
      'blue-50':'#5a6d88',
      'blue-40':'#8895a9',
      'blue-30':'#ccd1d9',
      'blue-20':'#e2e5e9',
      'turquoise-120':'#24b69b',
      'turquoise-110':'#26cfad',
      'turquoise-100':'#29ddb9',
      'turquoise-30':'#b1efe3',
      'turquoise-20':'#daf5f0',
      'turquoise-10':'#f1fffd',
      'grey-130':'#1a1a1a',
      'grey-100':'#797a7a',
      'grey-50':'#b6b8b8',
      'grey-40':'#dfe0e0',
      'grey-20':'#f3f5f5',
      'grey-10':'#f8fafa',
      'grey-5':'#fdfdfd',
      'white':'#fff',
      'red-110':'#f36053',
      'red-100':'#fa7064',
      'red-20':'#fdc6c1',
      'red-10':'#fbeae8',
      'green-100':'#b7d135',
      'green-30':'#ccde71',
      'green-20':'#e2edad',
      'yellow-100':'#e9c05c',
      'yellow-20':'#f3e0a5',
      'yellow-10':'#faf3db',
      'blue-focus':'#0066fb',
    },
    fontFamily: {
      'mulish': ['"Mulish"'],
    },
    extend: {},
  },
  plugins: [],
}