module.exports = {
  content: ["./**/*.php", "./layout/*.php", "./public/*.php", "./src/**/*.php"],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}