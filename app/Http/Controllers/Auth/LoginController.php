<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected function redirectTo()
    {

        if (Auth::check() && Auth::user()->role == 'admin') {
            return RouteServiceProvider::ADMIN;
        }
        return RouteServiceProvider::HOME;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
