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
        $clients=Client::all();
        $appointments=Appointment::all();
        $types=Types::all();
                return view('home')->with('clients',$clients)->with('appointments',$appointments)->with('types',$types);
    }
}
