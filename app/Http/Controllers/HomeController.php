<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

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
    public function index(Request $request)
    {
        if(Auth::check()) {
            if(Auth::user()->type == 'admin'){
                return view('dashboard');
            }elseif(Auth::user()->type == 'customer'){
                return redirect('myaccount');
            }else{
                return redirect('login_register');
            }
        }
    }
}
