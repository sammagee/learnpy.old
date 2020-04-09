@extends('layouts.marketing')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen w-full flex flex-col items-center justify-center">
        <div class="w-full max-w-xs">
            <div class="flex items-center justify-between mx-6">
                <h1 class="text-xl font-semibold text-gray-600 hover:text-gray-500 focus:text-gray-500 transition duration-300 ease-in-out transform hover:scale-105 active:scale-95">
                    <a class="focus:outline-none" href="{{ route('landing') }}">
                        {{ config('app.name') }}
                    </a>
                </h1>

                <h2 class="text-lg font-semibold text-gray-700">{{ __('Login') }}</h2>
            </div>

            <form class="mt-4 w-full bg-gray-800 p-6 rounded-lg" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="block">
                    <input
                        id="email"
                        type="email"
                        class="form-input block w-full bg-gray-700 text-white border-transparent @error('email') border-red-500 @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="{{ __('Email') }}"
                        required
                        autocomplete="email"
                        autofocus />

                    @error('email')
                        <span class="text-xs text-red-500 font-normal" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="block mt-2">
                    <input
                        id="password"
                        type="password"
                        class="form-input block w-full bg-gray-700 text-white border-transparent @error('password') border-red-500 @enderror"
                        name="password"
                        placeholder="{{ __('Password') }}"
                        required
                        autocomplete="current-password" />

                    @error('password')
                        <span class="text-xs text-red-500 font-normal" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="block mt-2">
                    <label class="flex items-center">
                        <input
                            id="remember"
                            type="checkbox"
                            class="form-checkbox border-0 bg-gray-700"
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }} />

                        <span class="ml-2 text-gray-500">{{ __('Remember Me') }}</span>
                    </label>
                </div>

                <div class="block mt-2">
                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center uppercase font-semibold tracking-wide bg-gray-600 px-3 py-2 text-gray-900 rounded hover:bg-gray-500 transition duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:shadow-outline focus:bg-gray-500">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="block mt-2 text-center">
                    @if (Route::has('password.request'))
                        <a class="text-gray-500 focus:outline-none" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
