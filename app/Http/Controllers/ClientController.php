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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $client=Client::whereSlug($slug)->firstOrFail();
        
     $appointment=Appointment::where('facebook',$client->facebook)
     ->where('ActiveType','1')->first();

if (!$appointment) {
    $difmin='0';
}
else{
             $TheDi=$appointment->jour." ".$appointment->debut.":00";

            // 2012-01-31 00:00:00
            $aaa=new Carbon($TheDi);
            $restOfTimeInSeconds=Carbon::now('Africa/Algiers');


  $difmin=$aaa->diffInSeconds($restOfTimeInSeconds); // 0

 

}
$config=Config::get('botman.facebook.token');

     // shows the total amount of days (not divided into years, months and days like above)


        return view("client")->with('client',$client)
        ->with('appointment',$appointment)
        ->with('difmin',$difmin)
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
return view("clients")->with('clients',$clients)
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
