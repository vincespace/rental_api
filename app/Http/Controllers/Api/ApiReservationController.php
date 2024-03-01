<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiReservationController extends Controller
{


    public function store(Request $request, $car_id)
    {
        $car = Car::findOrFail($car_id);

        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        if ($car->status === 'Reserved') {
            return response()->json(['message' => 'The selected car is already reserved'], 400);
        }


        if (Auth::user()->role !== 'client') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'payment_method' => ['required', 'in:debit_card,credit_card,cash'],
        ]);


        if ($validator->fails()) {
            $sampleData = [
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime('+1 day')),
                'payment_method' => 'credit_card',
            ];

            return response()->json(['message' => 'Validation failed!', 'sample_data' => $sampleData, 'errors' => $validator->errors(),], 400);
        }



        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $reservation = new Reservation();
        $reservation->user()->associate(Auth::user());
        $reservation->car()->associate($car);
        $reservation->start_date = $start;
        $reservation->end_date = $end;
        $reservation->days = $start->diffInDays($end);
        $reservation->price_per_day = $car->price_per_day;
        $reservation->total_price = $reservation->days * $reservation->price_per_day;
        $reservation->status = 'Pending';
        $reservation->payment_method = $request->payment_method;
        $reservation->save();

        $car->status = 'Reserved';
        $car->save();

        return response()->json(['message' => 'Reservation created successfully'], 201);
    }

    public function cancel(Request $request, $reservation_id)
    {
        // Find the reservation
        $reservation = Reservation::findOrFail($reservation_id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found!'], 404);
        }

        // Check if the authenticated user is the owner of the reservation
        if (Auth::user()->id !== $reservation->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        if (in_array($reservation->status, ['Cancelled', 'Active', 'Completed'])) {
            return response()->json(['message' => 'Reservation cannot be cancelled.'], 400);
        }


        // Delete the reservation from the database
        $reservation->delete();

        // Update the car status
        $car = $reservation->car;
        $car->status = 'Available';
        $car->save();




        return response()->json(['message' => 'Reservation cancelled successfully.'], 200);
    }


    public function showById($reservation_id)
    {

        // Find the reservation
        $reservation = Reservation::findOrFail($reservation_id);


        // Check if the authenticated user is the owner of the reservation
        if (Auth::user()->id !== $reservation->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found!'], 404);
        }

        // return a response json with message and the reservation
        return response()->json(['message' => 'Reservation found', 'reservation' => $reservation], 200);
    }

    public function showAllByUserId($user_id)
    {

        // if the role of the user is not admin and the user id is not the same as the authenticated user id return unauthorized
        if (Auth::user()->role !== 'admin' && Auth::user()->id !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Find the reservations of the user
        $reservations = Reservation::where('user_id', $user_id)->get();


        // Check if any reservations are found
        if ($reservations->isEmpty()) {
            return response()->json(['message' => 'No reservations found for the user'], 404);
        }

        // Return a response json with the reservations
        return response()->json(['message' => 'Reservations found', 'reservations' => $reservations], 200);
    }

    public function  showAllReservation()
    {


        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $reservations = Reservation::all();


        return response()->json(['message' => 'Reservations found', 'reservations' => $reservations], 200);
    }

    public function update(Request $request, $reservation_id)
    {
        // Find the reservation
        $reservation = Reservation::findOrFail($reservation_id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found!'], 404);
        }

        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($reservation->status === $request->status) {
            return response()->json(['message' => 'The status is the same, we can\'t update it'], 400);
        }

        // validate request if request body status is valid or not
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:Active,Cancelled,Completed'],
        ]);

        $sampleData = (object) [
            'status' => `Choose any of these statuses ['Active', 'Cancelled', 'Completed'].`,
        ];

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed!', 'sample_data' => $sampleData, 'errors' => $validator->errors(),], 400);
        }


        // Update the reservation status
        $reservation->status = $request->status;
        $car = $reservation->car;
        if ($request->status === 'Cancelled' || $request->status === 'Completed') {
            $car->status = 'Available';
            $car->save();
        }
        $reservation->save();

        return response()->json(['message' => 'Reservation status updated successfully'], 200);
    }

    public function destroy($reservation_id)
    {

        // both admin and client can delete a reservation
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'client') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Find the reservation
        $reservation = Reservation::findOrFail($reservation_id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found!'], 404);
        }

        // Retrieve the associated car
        $car = $reservation->car;

        // Delete the reservation
        $reservation->delete();

        // Make the car available again
        $car->status = 'Available';
        $car->save();

        return response()->json(['message' => 'Reservation deleted successfully'], 200);
    }
}
