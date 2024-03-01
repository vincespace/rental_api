<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;

class ApiclientCarController extends Controller
{
    /**
     * Display a listing of the available cars.
     */
    public function index()
    {
        $cars = Car::where('status', '=', 'available')->paginate(9);
        return response()->json($cars);
    }

    /**
     * Display the specified car.
     */
    public function show(string $id)
    {
        $car = Car::findOrFail($id);
        return response()->json($car);
    }
}
