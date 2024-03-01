<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ApiCarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        $cars = Car::paginate(8);
        return response()->json($cars);
    }

    public function store(Request $request)
    {

        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'engine' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', Rule::in(['available', 'unavailable'])],
            'reduce' => ['required', 'numeric', 'min:0', 'max:100'],
            'stars' => ['required', 'integer', 'min:0', 'max:5'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

        $car = new Car;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->engine = $request->engine;
        $car->quantity = $request->quantity;
        $car->price_per_day = $request->price_per_day;
        $car->status = $request->status;
        $car->reduce = $request->reduce;
        $car->stars = $request->stars;

        if ($request->hasFile('image')) {
            $imageName = $request->brand . '-' . $request->model . '-' . $request->engine . '-' . Str::random(10) . '.' . $request->file('image')->extension();
            $image = $request->file('image');
            $path = $image->storeAs('images/cars', $imageName);
            $car->image = '/' . $path;
        }
        $car->save();

        return response()->json(['message' => 'Car created successfully', 'car' => $car], 201);
    }

    public function show(Car $car_id)
    {
        $car =  Car::findOrFail($car_id);
        // validate if the car exists
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        return response()->json(['message' => 'Car found successfully', 'car' =>   $car]);
    }

    public function update(Request $request, Car $car_id)
    {

        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $car = Car::findOrFail($car_id);

        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }



        $validator = Validator::make($request->all(), [
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'engine' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', Rule::in(['Available', 'Unavailable'])],
            'reduce' => ['required', 'numeric', 'min:0', 'max:100'],
            'stars' => ['required', 'integer', 'min:0', 'max:5'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

        $car->update($request->all());

        $updatedCar = Car::find($car->id);

        return response()->json(['message' => 'Car updated successfully', 'car' => $updatedCar]);
    }

    public function destroy(Car $car_id)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $car = Car::findOrFail($car_id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        $car->delete();
        Storage::delete($car->image);


        if (Car::where('id', $car_id)->exists()) {
            return response()->json(['message' => 'Car not deleted'], 400);
        }


        return response()->json(['message' => 'Car deleted successfully']);
    }
}
