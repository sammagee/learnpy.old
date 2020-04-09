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

                <h2 class="text-lg font-semibold text-gray-700">{{ __('Verify Email') }}</h2>
            </div>

            <div class="mt-4 w-full bg-gray-800 p-6 rounded-lg" method="POST" action="{{ route('login') }}">
                @if (session('resent'))
                    <div class="bg-green-200 text-green-900 px-3 py-2" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="inline-block" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center uppercase font-semibold tracking-wide bg-gray-600 px-3 py-2 text-gray-900 rounded hover:bg-gray-500 transition duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:shadow-outline focus:bg-gray-500">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
@endsection
