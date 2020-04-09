<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-gray-900 font-sans">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
      @hasSection('title')
        @yield('title') -
      @endif

      {{ config('app.name') }}
    </title>

    <base href="/">

    <script src="{{ mix('js/app.js') }}" type="text/javascript" defer></script>

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet">
  </head>
  <body class="antialiased">
    <div id="app">
      @yield('content')
    </div>
  </body>
</html>
