<?php

namespace App\Http\Controllers;

use App\Type;
use App\Client;
use App\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){

   $appointments=Appointment::all();
   $types=Type::all();
   $clients=Client::all();

return view('home')->with('clients',$clients)
->with('appointments',$appointments)
->with('types',$types);
    }
   
}
