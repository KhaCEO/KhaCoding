<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $title['title'] = 'Dashboard';

        switch (Auth::user()->user_role) {
            case 1:
                return view('dashboard', $title);
            break;

            case 2:
                return view('dashboard', $title);
            break;

            case 3:
                return view('dashboard', $title);
            break;

            case 4:
                return view('dashboard', $title);
            break;
        }
    }
}
