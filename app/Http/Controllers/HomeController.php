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
        date_default_timezone_set("Africa/Algiers");

        $date=date("Y-m-d H:i");
        $appointments=Appointment::where('ActiveType','1')->get();
        foreach ($appointments as $appointment ) {        
        $d=date("Y-m-d H:i", strtotime($appointment->jour." ".$appointment->debut.":00"));


        echo $date;
        echo "<p></p>";

        echo $ai;
        
        if ($ai==$date) {
           
       try {
            $botman->say( "تبقت ساعة واحدة على موعد حلاقتك ",$appointment->fb_id, FacebookDriver::class);
        } catch (\Exception $e) {
           
            echo $info=$e->getCode().': '.$e->getMessage();
        }  } 
    

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
