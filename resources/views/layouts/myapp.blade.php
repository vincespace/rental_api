<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link rel="icon" type="image/x-icon" href="/images/logos/logo.png">
    @vite('node_modules/flowbite/dist/flowbite.min.js')
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-sec-400">

    {{-- -------------------------------------------------------------- Header -------------------------------------------------------------- --}}
    @guest
        <header>
            <nav class="bg-gray-800 border-gray-200 px-4 lg:px-6 py-4 dark:bg-gray-800 ">
                <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl drop-shadow-2xl">
                    {{-- LOGO --}}
                    <a class="flex items-center">
                        <img loading="lazy" src="/images/logos/logotextdarkmode.png" class="mr-3 h-12" alt="Flowbite Logo" />
                    </a>

                    {{-- login & Register buttons --}}
                    <div class="flex items-center  lg:order-2">
                        <a href="{{ route('login') }}">
                            <button type="button"
                                class="px-4 lg:px-5 py-2 lg:py-2.5 mr-2 text-black bg-white font-medium rounded-lg text-sm">
                                Login
                            </button>

                        </a>
                        <a href="{{ route('register') }}">
                            <button
                                class= "px-4 lg:px-5 py-2 lg:py-2.5 mr-2 text-black bg-white font-medium rounded-lg text-sm">
                                    Register
                            </button>

                        </a>

                        {{-- Mobile menu --}}
                        <button data-collapse-toggle="mobile-menu-2" type="button"
                            class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            aria-controls="mobile-menu-2" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    {{-- Menu --}}
                    <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                        <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="/">
                                    <div class="group text-center">
                                        <div class="text-white group-hover:cursor-pointer">Home</div>
                                        <div
                                            class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                        </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cars') }}">
                                    <div class="group text-center">
                                        <div class="text-white group-hover:cursor-pointer">Cars</div>
                                        <div
                                            class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>

                                        </div>
                                </a>
                            </li>
                            <li>
                                <a href="/location">
                                    <div class="group text-center">
                                        <div class=" text-white group-hover:cursor-pointer">Location</div>
                                        <div
                                            class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                        </div>
                                </a>
                            </li>
                            <li>
                                <a href="/privacy_policy">
                                    <div class="group text-center">
                                        <div class="text-white group-hover:cursor-pointer">Privacy Policy</div>
                                        <div
                                            class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                        </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    @else
        <header>
            <nav class="bg-gray-800 border-gray-200 px-4 lg:px-6 py-4 dark:bg-gray-800">
                <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                    {{-- LOGO --}}
                    <a class="flex items-center">
                        <img loading="lazy" src="/images/logos/logotextdarkmode.png" class="mr-3 h-12" alt="LOGO" />
                    </a>

                    {{-- Dropdown button --}}


                    @if (Auth::user()->role == 'admin')
                   <div class="hidden justify-between items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                     <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
            <a href='{{ route('adminDashboard') }}'>
                <div class="group text-center">
                    <div class=" text-white group-hover:cursor-pointer">Dashboard</div>
                    <div class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                </div>
            </a>
        </li>

        <li class="items-center">
            <a href="{{ route('cars.index') }}">
                <div class="group text-center">
                    <div class="text-white group-hover:cursor-pointer">Cars</div>
                    <div class="block invisible bg-white w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                </div>
            </a>
        </li>

        <li class="items-center">
            <a href="{{ route('users') }}">
                <div class="group text-center">
                    <div class="text-white group-hover:cursor-pointer">Users</div>
                    <div class="block invisible bg-white w-10 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                </div>
            </a>
        </li>
    </ul>
</div>
<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black bg-zinc-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center" type="button">
    <img loading="lazy" src="/images/user.png" width="24" alt="user icon" class="mr-3">
    <p> Admin ( {{ Auth::user()->name }} ) </p>
    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg>
</button>
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        <li>
            <a href="{{ route('adminDashboard') }}" class="block px-4 py-2 hover:bg-pr-200 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
        </li>
        <li>
            <a class="block px-4 py-2 hover:bg-pr-200 " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </li>
    </ul>
</div>
                    @else
                        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                                <li>

                                    <a href="/">
                                        <div class="group text-center">
                                            <div class="text-white group-hover:cursor-pointer">Home</div>
                                            <div
                                                class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                            </div>
                                        </div>
                                    </a>



                                </li>
                                <li>
                                    <a href="{{ route('cars') }}">
                                        <div class="group text-center">
                                            <div class="text-white group-hover:cursor-pointer">Cars</div>
                                            <div
                                                class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                <a href="/location">
                                        <div class="group text-center">
                                            <div class="text-white group-hover:cursor-pointer">Location</div>
                                            <div
                                                class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                            </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="/privacy_policy">
                                        <div class="group text-center">
                                            <div class="text-white group-hover:cursor-pointer">Privacy Policy</div>
                                            <div
                                                class="block invisible bg-white w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                            </div>
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="text-black bg-white hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center "
                            type="button">
                            <img loading="lazy" src="/images/user.png" width="24" alt="user icon" class="mr-3">
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">

                                <li>
                                    <a href="{{ route('clientReservation') }}"
                                        class="block px-4 py-2 hover:bg-pr-200 ">Reservations</a>
                                </li>

                                <li>
                                    <a class="block px-4 py-2 hover:bg-pr-200 " href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="hidden">
                                        @csrf
                                    </form>

                                </li>
                            </ul>
                        </div>
                    @endif
                    {{-- Mobile menu --}}
                    <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    {{-- Menu --}}

                </div>
            </nav>
        </header>
    @endguest

    {{-- --------------------------------------------------------------- Main  --------------------------------------------------------------- --}}
    <main>
        @yield('content')
    </main>
    {{-- --------------------------------------------------------------- Footer  --------------------------------------------------------------- --}}
    @if (Auth::check() && Auth::user()->role == 'admin')
    <footer class="px-4 h-[100px] sm:p-6 bg-gray-800 flex justify-center items-center">
        <p class="text-gray-100 font-car font-small text-1xl ">2024 SwiftDrive All Rights Reserved</p>
    </footer>
@else
    <footer class="px-4 sm:p-6 bg-gray-800">
    <div class="pt-10 mx-auto max-w-screen-xl relative">
        <div class="md:flex md:justify-between">
            <div class="mb-12 md:mb-0 flex justify-center ">
                <a href="" class="flex items-center">
                    <img loading="lazy" src="/images/logos/logotextdarkmode.png" class="mr-3 h-24" alt="Logo" />
                </a>
            </div>

            <div class="grid grid-cols-3 gap-8">
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Follow </h2>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <a href="https://github.com" class="hover:underline " target='_blank'>Github</a>
                        </li>
                        <li class="mb-4">
                            <a href="https://www.linkedin.com" class="hover:underline" target='_blank'>Linkedin</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Resources</h2>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <a href="https://laravel.com/" target='_blank'="hover:underline">Laravel</a>
                        </li>
                        <li>
                            <a href="https://tailwindcss.com/" target='_blank' class="hover:underline">Tailwind CSS</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Agreement</h2>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <a href="{{route('contact_us')}}" class="hover:underline">Contact us</a>
                        </li>
                        <li>
                            <a href="{{route('terms_conditions')}}" class="hover:underline">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8" />

        <div class="sm:flex sm:items-center sm:justify-between md:ms-0 pb-4 ms-32">
            <span class="text-sm sm:text-center text-gray-400 md:ms-0 -ms-8">© 2024 <a href="" target='_blank' class="hover:underline"></a>All Rights Reserved.</span>
          
        </div>
    </div>
</footer>

@endif
</body>
</html>



