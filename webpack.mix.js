const mix = require('laravel-mix');

mix.js('resources/js/index.js', 'public/js/app.js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss')
    ]);
