<?php

namespace App\Http\Controllers;

use App\Type;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class testController extends Controller
{


   public function commande(Request $request){
      
      $a=Artisan::call($request["commande"]);
      $a=Artisan::output();

     echo $a;
   dd();}
   public function index(){
      date_default_timezone_set("Africa/Algiers");

$debut="16:00";
$fin="22:00";
/* return view('test'); */
$debut = Carbon::createFromFormat('H:i:s', $debut.":00");
$fin = Carbon::createFromFormat('H:i:s', $fin.":00");
$pas="30";
$f="0";
$arr=array();




 do {
  $arr[]=$debut;
$debut=$debut->addMinute($pas);  
 } while ($debut < $fin) ;




  foreach ($arr as $key ) { 
  echo $key."<p></p>";
} 
}}



