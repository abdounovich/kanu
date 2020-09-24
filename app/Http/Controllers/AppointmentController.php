<?php

namespace App\Http\Controllers;

use DateTime;
use App\Client;
use DateInterval;
use DateTimeZone;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;
use Config;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        date_default_timezone_set("Africa/Algiers");
$today=date("Y-m-d");
$Tommorow=date('Y-m-d', strtotime($today. ' + 1 day'));
$afterTommorow=date('Y-m-d', strtotime($today. ' + 2 day'));


       $Today_appointments=Appointment::where('ActiveType','1')->whereJour($today)->get();
       $Tomorow_appointments=Appointment::where('ActiveType','1')->whereJour($Tommorow)->orderBy('debut', 'asc')->get();
       $AfterTomoro_appointments=Appointment::where('ActiveType','1')->whereJour($afterTommorow)->orderBy('debut', 'asc')->get();



       $Inactif_appointments=Appointment::where('ActiveType','0')->latest()->paginate(5);
    $config=Config::get('botman.facebook.token');
 
       return view("rdv")
       ->with('Today_appointments',$Today_appointments)
       ->with('Tomorow_appointments',$Tomorow_appointments)
       ->with('AfterTomoro_appointments',$AfterTomoro_appointments)
       ->with('Inactif_appointments',$Inactif_appointments)
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
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }
   

    public function deleteFunction(){

         
    }


    public function AddPFunction(){
        $today=date("Y-m-d");

     $appointments=Appointment::where('ActiveType','1')->whereJour($today)->get();


     foreach ($appointments as $appointment) {
         $clients=Client::whereFacebook($appointment->facebook)->get();
     foreach ($clients as $client ) {
         $update = [
         'points'  => $client->points+$appointment->type->point
    ];           $client->update($update);

     }
       
}

$update = [
    'ActiveType'     => "0"
];
$appointments=Appointment::where('ActiveType','1')->whereJour($today)
->update($update);

 
 
 

return redirect('/rdv')->with('success', 'تم تجديد المواعيد ومنح النقاط للزبائن');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
