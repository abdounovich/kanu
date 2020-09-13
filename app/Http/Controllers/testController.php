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
$all=Type::latest()->get();
 foreach ($all as $key ) {
  echo $key->type."<p></p>";
  
 } 
return;


return view('test');


     

  $total='600';
  $somme="0";
 $now=Carbon::now()->addMinute(60);
   $all_app=Appointment::where('ActiveType','1')->latest('created_at')->first();
   if($all_app){

      $all=Appointment::where('ActiveType','1')->get();
      foreach ($all as $al ) {
       $somme=$somme+$al->type->temps;}
      if ($somme<$total ){
         if ($now>$all_app->temps) {
         $temps=$now->addMinute(15);         } 
         else {           
         $start_time=$all_app->temps;
         $duration=$all_app->type->temps;
         $sec = $all_app->type->temps*60;
         $temps= date("Y-m-d H:i:s", (strtotime(date($start_time)) + $sec));}}
            else {echo"complet";return;}
         
         }
      else{
      $debut="09:00";
      if ($now>$debut) {
         $temps=$now->addMinute(15);         } 
         else{
      $start_time=date("Y-m-d ").$debut.":00";
      $this->temps=date("Y-m-d H:i:s",strtotime(date($start_time)));
      $start_time=date("Y-m-d")." 09:00:00";
      $temps=date("Y-m-d H:i:s",strtotime(date($start_time)));
   }  } 



   $min=date("Y-m-d")." 12:00".":00";
   $min=date("Y-m-d H:i:s",strtotime(date($min)));
  

   $max=date("Y-m-d")." 15:00".":00";
   $max=date("Y-m-d H:i:s",strtotime(date($max)));

   if ($min < $temps && $temps < $max) {
     $temps=$max;
     
   }
   $app=new Appointment();
   $app->facebook="Merahi-AbdelDjalil";
   $app->fb_id="3243262092379356";
   $app->type_id='1';
   $app->temps=$temps;
   $app->client_id='1';
   $app->ActiveType='1';
 $app->save();

  
}}



