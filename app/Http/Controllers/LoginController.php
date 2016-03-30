<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            // Authentication passed...
            return redirect()->intended('admin/dashboard');
        }
    }

    public  function  getLogout (){
        Auth::logout();
        return redirect()->intended('admin/login');
    }
}
