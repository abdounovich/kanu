<?php

namespace App\Http\Controllers;

use DateTime;
use App\Client;
use DateInterval;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ClientController extends Controller
{



      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMessageToClient(Request $request){
        $clients=Client::all();
        $botman = app('botman');
        $message=$request->get('message');
        
        /* foreach ($clients as $client ) {
                $botman->say( $message,$client->fb_id, FacebookDriver::class);
             
        } */
        

        try {
            $botman->say($message,332598655416389, FacebookDriver::class);
            echo "تم إرسال ";
        } catch (\Exception $e) {
           echo ('FAIL sending message to '.$user->fb_id);
           echo ($e->getCode().': '.$e->getMessage());
        }
        
              
            }


            public function sendMessageToClientView( ){
               
                $clients=Client::all();
                $config=Config::get('botman.facebook.token');
        return view("sendMessageToClients")->with('clients',$clients)
        ->with('config',$config);
                    }
        



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $client=Client::whereSlug($slug)->firstOrFail();
        
     $appointment=Appointment::where('facebook',$client->facebook)
     ->where('ActiveType','1')->first();
     $yawm="";

if (!$appointment) {
    $difmin='0';
     
   

}
else{


    $date=date_create($appointment->jour);
    $yawm=date_format($date,"l");
    
    
    switch ($yawm) {
      case "Friday":
      $yawm="الجمعة";break;
      case "Saturday":
      $yawm="السبت";break;
      case "Sunday":
      $yawm="الأحد ";break;
      case "Monday":
      $yawm="الإثــنين ";break;
      case "Tuesday":
      $yawm="الثلاثاء";break;
      case "Wednesday":
      $yawm="الأربعاء";break;
      case "Thursday":
      $yawm="الخميس";
      
    }
             $TheDi=$appointment->jour." ".$appointment->debut.":00";
           

            // 2012-01-31 00:00:00
            $aaa=new Carbon($TheDi);
            $restOfTimeInSeconds=Carbon::now('Africa/Algiers');


  $difmin=$restOfTimeInSeconds->diffInSeconds($aaa,false);


}
$config=Config::get('botman.facebook.token');

     // shows the total amount of days (not divided into years, months and days like above)


        return view("client")->with('client',$client)
        ->with('appointment',$appointment)
        ->with('difmin',$difmin)
        ->with('yawm',$yawm)
        ->with('config',$config);



 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        
        $clients=Client::latest()->paginate(10); 
        $config=Config::get('botman.facebook.token');
        $appointment=Appointment::where("ActiveType",1)->first();
return view("clients")->with('clients',$clients)->with('appointment',$appointment)
->with('config',$config);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
