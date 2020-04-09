const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.js('resources/js/bootstrap.js', 'public/js/app.js')
   .postCss('resources/css/app.css', 'public/css', [
      require('tailwindcss')
   ]);

if (mix.inProduction()) {
   mix.purgeCss();
}
