<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthenticatingUserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        if (!$user) {
            Log::error('User not found');
            return response()->json(['message' => 'User not found'], 404);
        }

        Log::info('User found', ['user' => $user]);

        $accessToken = $user->createToken('auth_token');
        $user->remember_token = $accessToken->plainTextToken;
        $user->save();

        $role = $user->role;

        return response()->json(['user' => $user, 'role' => $role, 'token' => $accessToken->plainTextToken], 200);
    }

   public function logout(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('remember_token', $request->token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid token'], 401);
        }


        $user->remember_token = null;
        $user->save();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}
