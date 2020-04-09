@extends('layouts.marketing')

@section('content')
  <div class="min-h-screen w-full flex flex-col items-center justify-center">
    <h1 class="text-5xl font-semibold text-gray-600 hover:text-gray-500 focus:text-gray-500 transition duration-300 ease-in-out transform hover:scale-105 active:scale-95">
      <a class="focus:outline-none" href="{{ route('landing') }}">
        {{ config('app.name') }}
      </a>
    </h1>

    @if (Route::has('login'))
      <div class="flex items-center -mx-2 mt-4">
        <a
          class="mx-2 inline-flex items-center justify-center uppercase font-semibold tracking-wide bg-gray-600 px-3 py-2 text-gray-900 rounded hover:bg-gray-500 transition duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:shadow-outline focus:bg-gray-500"
          href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
          <a
            class="mx-2 font-semibold uppercase tracking-wide px-3 text-gray-600 hover:text-gray-500 transition duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:text-gray-500"
            href="{{ route('register') }}">Register</a>
        @endif
      </div>
    @endif
  </div>
@endsection
