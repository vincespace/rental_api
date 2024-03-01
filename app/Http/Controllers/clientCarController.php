<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class clientCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::where('status', '=', 'available')->paginate(9);
        return view('cars.cars', compact('cars'));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
