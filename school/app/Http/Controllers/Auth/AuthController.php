<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if(!empty(Auth::check()))
        {
            return redirect()->route('dashboard');
        }
        return view('Auth.login');
    }

    public function login(Request $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            if(Auth::user()->user_role == 1)
            {
                return redirect()->route('dashboard');
            }
            elseif(Auth::user()->user_role == 2)
            {
                return redirect()->route('teacher.dashboard');
            }
            // elseif(Auth::user()->user_role == 3)
            // {
            //     return redirect()->route('dashboard');
            // }
            // elseif(Auth::user()->user_role == 4)
            // {
            //     return redirect()->route('dashboard');
            // }
        }
        else
        {
            return redirect()->back()->with('error','Invalidate email and password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('info', "You're Logout is Success");
    }
}
