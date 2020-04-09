module.exports = {
  theme: {
    extend: {
      cursor: {
        'col-resize': 'col-resize',
        'row-resize': 'row-resize',
      },
      fontFamily: {
        mono: ['Fira Code', 'Menlo', 'Monaco', 'Consolas', '"Liberation Mono"', '"Courier New"', 'monospace'],
      },
    },
  },
  variants: {
    scale: ['responsive', 'hover', 'focus', 'active'],
  },
  plugins: [
    require('@tailwindcss/custom-forms'),
  ]
}
