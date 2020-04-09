@extends('layouts.app')

@section('title', 'Editor')

@section('content')
    <div class="flex h-screen">
        <div class="flex flex-col flex-shrink-0 items-center justify-between bg-gray-800 w-16 py-2 z-50">
            <div>
                <a class="flex flex-col items-center justify-center border-2 border-gray-700 w-12 h-12 leading-none" href="{{ route('editor') }}">
                    <span class="text-xs font-semibold text-gray-700">learn</span>
                    <span class="text-2xl font-bold text-gray-600">Py</span>
                </a>
            </div>
            <div>
                <button class="h-8 w-8 focus:outline-none focus:shadow-outline rounded-full">
                    <img
                        class="rounded-full mb-2"
                        src="{{ auth()->user()->gravatar }}"
                        alt="{{ auth()->user()->name }}" />
                </button>
            </div>
        </div>
        
        <editor></editor>
    </div>
@endsection
