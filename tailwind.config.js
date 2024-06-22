/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,php,js}"],
  theme: {
    extend: {
      backgroundImage: {
        main: "url(./public/assets/jungle.jpg)",
      },
      fontFamily: {
        manrope: ["Manrope", "sans-serif"],
      },
    },

    colors: {
      green: {
        50: "#f0fdf4",
        100: "#dcfce7",
        200: "#bbf7d0",
        300: "#86efac",
        400: "#4ade80",
        500: "#22c55e",
        600: "#16a34a",
        700: "#15803d",
        800: "#166534",
        900: "#14532d",
        950: "#052e16",
      },
      characters: {
        pokemon: "#ee1515",
        rickymorty: "#35c9dd",
        breakingbad: "#00BE59",
        chucknorris: "#FFE81F",
        themealdb: "#FF7F3E",
      },
      main: {
        maingreen: "#00BE59",
        mainblack: "#000000",
        mainwhite: "#FFFFFF",
        maingray: "#252525",
      },
      error: {
        main: "#C73E1D",
      },
    },
  },
  plugins: [],
};
