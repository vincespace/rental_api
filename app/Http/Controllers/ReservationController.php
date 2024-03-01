<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create($car_id)
    {
        $user = auth()->user();



        // Check if the user has the "client" role
        if ($user->role !== 'client') {
            return redirect()->back()->with('error', 'Only clients can create reservations.');
        }

        $car = Car::find($car_id);

        // Check if the car is already reserved
        if ($car->status === 'Reserved') {
            return redirect()->back()->with('error', 'The selected car is already reserved.');
        }

        return view('reservation.create', compact('car', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $car_id)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'payment_method' => 'required|in:debit_card,credit_card,cash',
        ]);

        $user = auth()->user();

        // Check if the user has the "client" role
        if ($user->role !== 'client') {
            return redirect()->back()->with('error', 'Only clients can create reservations.');
        }

        $car = Car::find($car_id);
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $reservation = new Reservation();
        $reservation->user()->associate($user);
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

        return view('thankyou', ['reservation' => $reservation]);
    }

  /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }


    // Edit and Update Reservation Status
    public function editStatus(Reservation $reservation)
    {
        $reservation = Reservation::find($reservation->id);
        return view('admin.updateStatus', compact('reservation'));
    }

    public function updateStatus(Reservation $reservation, Request $request)
    {
        $reservation = Reservation::find($reservation->id);
        $reservation->status = $request->status;
        $car = $reservation->car;
        if($request->status == 'Ended' || $request->status == 'Cancelled' ){
            $car->status = 'Available';
            $car->save();
        }
        $reservation->save();
        return redirect()->route('adminDashboard');
    }


    public function update(Request $request, Reservation $reservation)
    {

    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->status === 'Active' || $reservation->status === 'Ended') {
            return redirect()->back()->with('error', 'You can\'t cancel your reservation. It is activated or ended!');
        }


        if ($reservation->status === 'Pending') {
            // Update the reservation status to Cancelled
            $reservation->status = 'Cancelled';
            $reservation->save();

            return redirect()->back()->with('success', 'Reservation cancelled successfully.');
        }
    }

    public function destroy(Reservation $reservation)
    {
        // Retrieve the associated car
        $car = $reservation->car;

        // Delete the reservation
        $reservation->delete();

        // Make the car available again
        $car->status = 'Available';
        $car->save();

        // Redirect back to the admin dashboard
        return redirect()->route('adminDashboard')->with('success', 'Reservation deleted successfully.');
    }

}
