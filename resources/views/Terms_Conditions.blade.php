@extends('layouts.myapp')

@section('content')
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-center mb-8">
                            <img src="/images/logos/logotext.png" alt="logotext" class="h-12 md:h-16">
                        </div>
                        <h2 class="text-3xl font-bold mb-8 text-center">Terms & Conditions</h2>
                        
                        <div class="text-gray-800">
                            <h3 class="text-xl font-semibold mb-4">Acceptance of Terms</h3>
                            <p class="mb-6">By using our Platform, you agree to comply with these Terms & Conditions. If you do not agree with any part of these terms, you must refrain from using the Platform.</p>

                            <h3 class="text-xl font-semibold mb-4">Use of the Platform</h3>
                            <p class="mb-6">The use of this Platform is at your own risk. We provide the Platform on an "as is" and "as available" basis, without any express or implied warranty of any kind.</p>

                            <h3 class="text-xl font-semibold mb-4">User Information</h3>
                            <p class="mb-6">Users are required to provide accurate and up-to-date information when using our platform, especially when registering for an account or making reservations. SwiftDrive reserves the right to verify user information and take necessary actions, including account suspension or termination, in case of fraudulent or inaccurate information.</p>

                            <h3 class="text-xl font-semibold mb-4">Booking and Reservations</h3>
                            <p class="mb-6">Users can make bookings and reservations through our platform, subject to availability. SwiftDrive reserves the right to cancel or modify bookings in case of unforeseen circumstances or events beyond our control. Users are responsible for providing accurate reservation details and adhering to the specified terms and conditions for each booking.</p>

                            <h3 class="text-xl font-semibold mb-4">Payment and Fees</h3>
                            <p class="mb-6">Payment for bookings and reservations is required at the time of booking or as specified in the payment terms. Users agree to pay all applicable fees and charges associated with their use of the platform, including but not limited to rental fees,charges, and any additional services availed. SwiftDrive reserves the right to modify pricing and fees at any time, with prior notice to users.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
