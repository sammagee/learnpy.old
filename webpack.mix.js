const mix = require('laravel-mix');

mix.js('resources/js/bootstrap.js', 'public/js/app.js')
   .sass('resources/sass/app.scss', 'public/css');
