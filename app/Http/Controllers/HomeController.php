<?php

namespace App\Http\Controllers;

use App\Type;
use Exception;
use App\Client;
use App\Appointment;
use Illuminate\Http\Request;
use BotMan\Drivers\Facebook\FacebookDriver;

class HomeController extends Controller
{



    
    public function func(){



        $botman = app('botman');



        

        try {
            $botman->say('Hey ', 3243262092379356, FacebookDriver::class);
        } catch (\Exception $e) {
           
            echo $info=$e->getCode().': '.$e->getMessage();
        }
    






dd();



    }
    public function index(){

   $appointments=Appointment::all();
   $types=Type::all();
   $clients=Client::all();

return view('home')->with('clients',$clients)
->with('appointments',$appointments)
->with('types',$types);
    }
   
}
