<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tutors = \App\Tutor::all();
        $requests = \App\Request::all();
        $specialities = \App\Speciality::all();
        return view('homepage.home', compact('tutors','specialities','requests'));
    }

}
