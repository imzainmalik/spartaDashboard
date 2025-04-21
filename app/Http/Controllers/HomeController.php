<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function custom_middleware()
    {
        if (Auth::check()) {
            if (auth()->user()->role == 0) {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome to the admin dashboard');
            } else {
                if (auth()->user()->is_active == 0) {
                    return redirect()->route('employee.dashboard')->with('success', 'Welcome to the employees dashboard');
                } else {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Your account is inactive. Please contact the administrator.');
                }
            }
        }
    }
}
