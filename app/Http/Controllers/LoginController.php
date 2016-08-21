<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            // Authentication passed...
            if (Auth::user()->active == 'yes') {
                return redirect()->intended('admin/dashboard');
            }
            else{
                return Redirect::back()->withErrors(['Your Account has been suspended by admin.', 'The Message']);
            }
        } else {
            return Redirect::back()->withErrors(['The username and password you entered did not match our records. Please double-check and try again.', 'The Message']);
        }
    }

    public function  getLogout()
    {
        Auth::logout();
        return redirect()->intended('admin/login');
    }
}
