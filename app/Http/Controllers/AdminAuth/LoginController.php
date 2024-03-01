<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard'; 

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.adminLogin'); 
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['role' => 'admin']);
    }

    public function username()
    {
        return 'email';
    }
}
