<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class ApiLoginController extends Controller
{
    use HasApiTokens;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // if the credentials are invalid return a 401 response
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // if the credentials are valid, return a 200 response with the user's details and token
        $user = Auth::user();
        $token = HasApiTokens::createToken($user->id, ['auth_token'])->plainTextToken;

        // return response()->json(['user' => $user, 'token' => $token], 200);
        return response()->json(['message' => "Yow"], 200);
    }


    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the user
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
