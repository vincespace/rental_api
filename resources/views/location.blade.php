@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-24 items-center px-6 pt-12">
            <div class="md:order-last">
                <img loading="lazy" src="/images/location1.png" alt="SwiftDrive Car Rentals" class="rounded-lg shadow-lg">
            </div>
            <div>
                <h2 class="text-3xl font-car mb-4">Welcome to SwiftDrive Car Rentals!</h2>
                <p class="text-lg leading-relaxed">Experience the convenience of SwiftDrive Car Rentals, your premier destination for hassle-free car rentals in Dagupan City. Our centrally located shop provides easy access and seamless service for both locals and travelers.</p>
                <br>
                <p class="text-lg leading-relaxed">At SwiftDrive, we prioritize your comfort and satisfaction. Our dedicated team is committed to delivering exceptional customer service and ensuring a smooth rental experience from start to finish.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-24 items-center px-6 pt-12">
            <div>
                <h2 class="text-3xl font-car mb-4">SwiftDrive Accessibility</h2>
                <p class="text-lg leading-relaxed">Experience the convenience of SwiftDrive's easy online access. With our user-friendly website and mobile app, you can easily browse our wide selection of rental vehicles, make reservations, and manage your bookings from the comfort of your own home.</p>
                <br>
                <p class="text-lg leading-relaxed">Our online platform provides you with all the tools you need to plan your trip with ease. Whether you're in need of a compact car for a city adventure or a spacious SUV for a family road trip, SwiftDrive has got you covered. Book your next rental vehicle online today!</p>
            </div>
            <div class="md:order-last">
                <img loading="lazy" src="/images/location2.png" alt="Neighborhood" class="rounded-lg shadow-lg">
            </div>
        </div>
        <div class="px-6 pt-12">
            <h2 class="text-3xl font-car mb-4">Visit Us</h2>
            <div class="rounded-lg overflow-hidden shadow-lg">
                <!-- Embedded Google Map -->
                <iframe class="w-full h-96" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3703.6900564353995!2d120.33923951476057!3d16.041839988879748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3391a3cb04a6edc1%3A0x9f73f89aa0ae7ed3!2s307%20Arellano%20St%2C%20Pogo%2C%20Dagupan%2C%20Pangasinan!5e0!3m2!1sen!2sph!4v1645682298256!5m2!1sen!2sph" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
@endsection
