/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        sigma: {
          950: '#06172d',
          900: '#082044',
          800: '#0b2d60',
          700: '#0e4a9f',
          600: '#1265d8',
          500: '#2b7de9',
        },
      },
      boxShadow: {
        soft: '0 4px 18px rgba(15, 42, 78, .07)',
        card: '0 2px 10px rgba(15, 42, 78, .06)',
      },
    },
  },
  plugins: [],
};
