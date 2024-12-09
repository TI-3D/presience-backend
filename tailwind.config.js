/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
        extend: {
          colors: {
            'neutral-50': '#F6F6F6',
        'neutral-100': '#E7E7E7',
        'neutral-200': '#D1D1D1',
        'neutral-300': '#B0B0B0',
        'neutral-400': '#888888',
        'neutral-500': '#6D6D6D',
        'neutral-600': '#5D5D5D',
        'neutral-700': '#4F4F4F',
        'neutral-800': '#454545',
        'neutral-900': '#3D3D3D',
        'neutral-black': '#1B1B1B',

        'purple-50': '#EEF1FF',
        'purple-100': '#E0E6FF',
        'purple-200': '#C7CFFE',
        'purple-300': '#A5B0FC',
        'purple-400': '#8186F8',
        'purple-500': '#6763F1',
        'purple-600': '#5646E5',
        'purple-700': '#4A38CA',
        'purple-800': '#3C30A3',
        'purple-900': '#352E81',
        'purple-950': '#2B2464',
          },
          fontFamily: {
            interTight: ["Inter Tight", 'ui-sans-serif']
          },
          fontWeight: {
            'regular':'400',
            'medium':'500',
          }
        },
    },
    plugins: [],
   
};


