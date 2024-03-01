@extends('layouts.myapp')
@section('content')
    <main>



        <div class="bg-sec-100 ">
            {{-- hero --}}
            <div class="flex justify-center md:py-28 py-12 mx-auto max-w-screen-xl">
                <div class="flex  flex-col justify-center md:w-3/5  mx-12 md:ms-20 md:mx-0">
                    <h1 class=" md:text-start text-center  font-car font-bold text-gray-900 mb-8  md:text-7xl text-4xl "><span class="text-gray-900"> SWIFT
                        </span>RIDE SMOOTH JOURNEY
                        </h1>
                    <div class="md:w-3/5 md:hidden  ">
                        <img loading="lazy" src="/images/home car.png" alt="home car">
                    </div>
                    <p class="text-justify md:mx-0 mx-8 ">Embark on a journey where smooth travels meet swift destinations. We ensure your rental experience is seamless making every mile an effortless adventure. With us, your journey is not just about reaching the destination, but enjoying a hassle-free ride every step of the way.</p>
                    <div class="flex justify-center md:justify-start mt-12 md:w-2/3 me-12 md:-ms-12">
                        <a href="/cars">
                            <button
                                class="bg-slate-900 p-2 border-2 border-white rounded-md text-white hover:bg-gray-800 w-32 md:me-12 md:mx-12 mx-7 font-bold">CARS</button>
                        </a>
                        <a href="/location">
                            <button class="bg-slate-900 p-2 border-2 border-white rounded-md text-white hover:bg-gray-800 w-32 font-bold">LOCATION</button>
                        </a>
                    </div>
                </div>
                <div class="md:w-3/5 hidden md:block  ">
                    <img loading="lazy" src="/images/home car.png" alt="home car">
                </div>

            </div>

        </div>
    </main>
@endsection
