<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiUserController extends Controller
{
    // Fetch list of clients
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $clients = User::where('role', 'client')->get();
        return response()->json(['message' => 'Clients retrieved successfully', 'clients' => $clients], 205);
    }

    // Fetch list of admins
    public function indexAdmins()
    {
        // make sure this user is an admin
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        $admins = User::where('role', 'admin')->get();
        return response()->json(['message' => 'Admins retrieved successfully', 'admins' => $admins], 205);
    }

    // fetch list of all users
    public function indexAll()
    {
        // make sure this user is an admin
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        $users = User::all();
        return response()->json(['message' => 'Users retrieved successfully', 'users' => $users], 205);
    }


    // Get details of a specific client
    public function show($user_id)
    {


        $client = User::findOrFail($user_id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }



        return response()->json(['message' => 'Client details retrieved successfully', 'client' => $client], 205);
    }

    // Create a new user
    public function store(Request $request)
    {


        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'role' => 'nullable|in:client,admin',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'Email already exists'], 400);
        }

        // Create the user
        $client = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'client', // Default role
        ]);

        return response()->json(['message' => 'Client created successfully', 'client' => $client], 201);
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        // Find the client
        $client = User::findOrFail($id);

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'role' => 'nullable|in:client,admin',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'Email already exists'], 400);
        }


        // Update client details
        $client->name = $request->name;
        $client->email = $request->email;
        if ($request->has('password')) {
            $client->password = bcrypt($request->password);
        }

        $client->save();

        return response()->json(['message' => 'Client updated successfully', 'client' => $client], 200);
    }


    // Delete a user
    public function destroy($user_id)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $client = User::findOrFail($user_id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client deleted successfully'], 200);
    }
}
