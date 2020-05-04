@extends('layouts.app')

@section('title', 'Editor')

@section('content')
    <div class="flex flex-col md:flex-row h-screen">
        <div class="flex flex-row md:flex-col flex-shrink-0 items-center justify-between bg-gray-800 h-16 md:h-full w-full md:w-16 px-2 md:py-2 z-50">
            <div class="flex flex-row md:flex-col flex-shrink-0 items-center space-x-4 md:space-y-4 md:space-x-0">
                <a class="flex flex-col items-center justify-center border-2 border-gray-700 w-12 h-12 leading-none focus:outline-none focus:shadow-outline transition ease-in-out duration-150" href="{{ route('editor') }}">
                    <span class="text-xs font-semibold text-gray-700">learn</span>
                    <span class="text-2xl font-bold text-gray-600">Py</span>
                </a>
            </div>

            <div class="flex items-center md:justify-center">
                <dropdown
                    dropdown-class="origin-top-right md:origin-bottom-left absolute right-0 md:right-auto md:left-full md:bottom-0 mt-2 md:mt-0 md:ml-2 w-48"
                    dropdown-inner-class="bg-gray-700">
                    <template v-slot:trigger="dropdown">
                        <div class="flex items-center md:justify-center">
                            <button
                                class="h-8 w-8 focus:outline-none focus:shadow-outline rounded-full mr-2 md:mr-0 md:mb-2 transition ease-in-out duration-150"
                                @click="dropdown.toggle">
                                <img
                                    class="rounded-full"
                                    src="{{ auth()->user()->gravatar }}"
                                    alt="{{ auth()->user()->name }}" />
                            </button>
                        </div>
                    </template>

                    <a
                        class="block px-4 py-2 text-sm text-gray-900 hover:text-gray-600 hover:bg-gray-800 font-semibold"
                        role="menuitem"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form class="hidden" id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </dropdown>
            </div>
        </div>
        
        <editor></editor>
    </div>
@endsection
