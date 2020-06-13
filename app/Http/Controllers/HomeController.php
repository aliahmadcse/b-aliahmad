<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the Home view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('email', '=', 'aliahmaddev@gmail.com')->first();
        return view('about', compact('user'));
    }
}
