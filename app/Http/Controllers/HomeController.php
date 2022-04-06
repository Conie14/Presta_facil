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
        return view('welcome');
    }

    public function usuario()
    {
        return view('home');
    }

    public function update()
    {
        return view('update');
    }
    public function create()
    {
        return view('create');
    }

}
