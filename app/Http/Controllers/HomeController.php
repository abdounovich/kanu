<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){

   $appointments=Appointment::all();
   $types=Types::all();
   $clients=Client::all();

return view('home')->with('clients',$clients)
->with('appointments',$appointments)
->with('types',$types);
    }
   
}
