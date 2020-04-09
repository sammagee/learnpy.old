@extends('layouts.app')

@section('title', 'Editor')

@section('content')
    <div class="flex flex-col md:flex-row h-screen">
        <div class="flex flex-row md:flex-col flex-shrink-0 items-center justify-between bg-gray-800 h-16 md:h-full w-full md:w-16 px-2 md:py-2 z-50">
            <div>
                <a class="flex flex-col items-center justify-center border-2 border-gray-700 w-12 h-12 leading-none" href="{{ route('editor') }}">
                    <span class="text-xs font-semibold text-gray-700">learn</span>
                    <span class="text-2xl font-bold text-gray-600">Py</span>
                </a>
            </div>
            <div class="flex items-center md:justify-center">
                <button class="h-8 w-8 focus:outline-none focus:shadow-outline rounded-full mr-2 md:mr-0 md:mb-2">
                    <img
                        class="rounded-full"
                        src="{{ auth()->user()->gravatar }}"
                        alt="{{ auth()->user()->name }}" />
                </button>
            </div>
        </div>
        
        <editor></editor>
    </div>
@endsection
