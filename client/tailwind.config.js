/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        dmserif: ['"DM Serif Display"', 'serif'],
      },},
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: [
      {
        main_dark: {
          'primary': '#6B46C1', // Purple from hero shapes
          'secondary': '#F6AD55', // Yellow from hero shapes
          'accent': '#34D399', // Green from hero shapes
          'neutral': '#1A1A2E', // Match hero background
          'base-100': '#1A1A2E', // Background for components
          'base-content': '#FFFFFF', // White text for content
          'info': '#3ABFF8',
          'success': '#36D399',
          'warning': '#FBBD23',
          'error': '#F87272',
        },
      },
      {
        main_light: {
          'primary': '#6B46C1', // Same purple as main_dark for consistency
          'secondary': '#F6AD55', // Same yellow as main_dark
          'accent': '#34D399', // Same green as main_dark
          'neutral': '#D1D5DB', // Softer gray for cards/containers, distinct from background
          'base-100': '#F9FAFB', // Slightly warmer off-white for a clean, modern look
          'base-content': '#2D3748', // Softer dark gray for text, better contrast on light background
          'info': '#3ABFF8',
          'success': '#36D399',
          'warning': '#FBBD23',
          'error': '#F87272',
        },
      },
    ], // plusieurs thèmes dispo par défaut
  },
}
