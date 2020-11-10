<?php

namespace App\Http\Controllers;

use App\Type;
use App\Client;
use App\Appointment;
use Illuminate\Http\Request;
use BotMan\Drivers\Facebook\FacebookDriver;

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

    public function func(){



        $botman = app('botman');
        date_default_timezone_set("Africa/Algiers");

        $date=date("Y-m-d H:i");
        $appointments=Appointment::where('ActiveType','1')->get();
        foreach ($appointments as $appointment ) {        
        $d=date("Y-m-d H:i", strtotime($appointment->jour." ".$appointment->debut.":00"));
        $date1=date('Y-m-d H:i', strtotime($date. '+'.'1 hours'));
        $ten=date('Y-m-d H:i', strtotime($date. '+'.'15 minutes'));
        $trnt=date('Y-m-d H:i', strtotime($date. '+'.'30 minutes'));






       
        if ($d==$date1) {
           
            
            $botman->say( "⏰ تذكير ⏰",$appointment->fb_id, FacebookDriver::class);
            $botman->say( "🙋‍♂️ مرحبا ".$appointment->facebook,$appointment->fb_id, FacebookDriver::class);
            $botman->say( " ⏳ تبقت ساعة واحدة على موعد حلاقتك ",$appointment->fb_id, FacebookDriver::class);
          
           
           
        }
    

        if ($d==$ten) {
           
      
              
            $botman->say( "⏰ تذكير ⏰",$appointment->fb_id, FacebookDriver::class);
            $botman->say( "🙋‍♂️ مرحبا ".$appointment->facebook,$appointment->fb_id, FacebookDriver::class);
            $botman->say( " ⏳ تبقت ربع ساعة على موعد حلاقتك ",$appointment->fb_id, FacebookDriver::class);
        }
        if ($d==$trnt) {
           
      
              
            $botman->say( "⏰ تذكير ⏰",$appointment->fb_id, FacebookDriver::class);
            $botman->say( "🙋‍♂️ مرحبا ".$appointment->facebook,$appointment->fb_id, FacebookDriver::class);
            $botman->say( " ⏳ تبقت نصف ساعة على موعد حلاقتك ",$appointment->fb_id, FacebookDriver::class);
        }

        }}

    public function index()
    {
        $clients=Client::all();
        $appointments=Appointment::all();
        $types=Type::all();
        return view('home')->with('clients',$clients)->with('appointments',$appointments)->with('types',$types);
    }
}
