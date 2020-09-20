<?php

namespace App\Http\Controllers;

use App\Type;
use App\Client;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class testController extends Controller
{




  public function bot(Request $request)
  {}

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
  public function sendTextMessage(Request $request)
  {


  


    $messageText=  $request->get('message');
    $Cid=$request->get('Cid');
    $id=$request->get('id');
    $debut=$request->get('debut'); 
    $type=$request->get('type');
    $username=$request->get('username');

   $fin=date("Y-m-d H:i:s", (strtotime(date($debut)) + $type*60));
   $fin=date("H:i", strtotime(date($fin)));
   $debut=date("H:i", strtotime(date($debut)));


$jour=$request->get('jour');



$addApp=new Appointment();
$addApp->facebook=$username;
$addApp->type_id="1";
$addApp->ActiveType="1";
$addApp->fb_id=$id;
$addApp->jour=$jour;
$addApp->debut=$debut;
$addApp->fin=$fin;
$addApp->client_id=$Cid;

$addApp->save();
$client=Client::find($Cid);




$config=Config::get('app.url');



      $messageData = [
          "recipient" => [
              "id" => $id,
          ],
          "message"=>[
            "attachment"=>[
        
              "type"=>"template",
              "payload"=>[
                "template_type"=>"button",
                "text"=>$messageText,
                "buttons"=>[
                  [
                    "type"=>"web_url",
                    "url"=>"$config/client/$client->slug",
                    "title"=>"تصفح  مواعيدي"
                  ],
                 
                  
                ]
              ]
            ]
          ],
      ];
      $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("FACEBOOK_TOKEN"));
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
      curl_exec($ch);
      curl_close($ch);

  }


   public function commande(Request $request){




      
    /*   $a=Artisan::call($request["commande"]);
      $a=Artisan::output();

     echo $a;
   dd(); */}



















   public function today($type,$username,$Cid)
   
   {
date_default_timezone_set("Africa/Algiers");
    $date=date("l");   

if ($date=='Friday') {
    $debut="09:00";
    $fin="22:00";
 }elseif($date=='Saturday'){
     $debut="09:00";
     $fin="22:00";
 }else{
     $debut="16:00";
     $fin="22:00";
 }
    $debut=date("Y-m-d ").$debut.":00";
    $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
    $fin=date("Y-m-d ").$fin.":00";
    $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
    $types=Type::whereId($type)->first();
    $pas=60*$types->temps;
    $arr=array();
    $arr2=array();
    $items=array();
    $arr4=array();
    $jour=date("Y-m-d");
    $Today_appointments=Appointment::where('ActiveType',"1")->whereJour($jour)->get();
    while ($debut < $fin )
    {
      $arr[]=$debut;  
      $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + $pas));
          }
          if (count($Today_appointments)>0) {
            foreach ($Today_appointments as $appointment ) {  
    for ($i=0; $i <count($arr) ; $i++) { 
    $d=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->debut.":00"));
    $f=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->fin.":00"));
    if ($arr[$i]>=$d && $arr[$i]<$f) {
      $arr2[]=$arr[$i];
    }
    else{
       $arr4[]= $arr[$i];}}
     
     
     }} else {
 
 
       for ($i=0; $i <count($arr) ; $i++) { 
       
            $arr4[]= $arr[$i];}
          }
foreach ($arr4 as $k ) {
    if (!in_array($k, $items)&&!in_array($k, $arr2) ) {
   $items[]=$k;}}
   $var=1;



   $type=Type::find($type);
   return view("test")->with('items',$items)
   ->with('var',$var)
   ->with('type',$types->id)
   ->with('jour',$jour)
   ->with('username',$username)
   ->with('Cid',$Cid);

    }





  
   public function tomorrow($type,$username,$Cid)
   {
date_default_timezone_set("Africa/Algiers");
$date=date("l");
    $date=date("l", strtotime($date. ' + 1 day'));


if ($date=='Friday') {
    $debut="09:00";
    $fin="22:00";
 }elseif($date=='Saturday'){
     $debut="09:00";
     $fin="22:00";
 }else{
     $debut="16:00";
     $fin="22:00";
 }

    $debut=date("Y-m-d ").$debut.":00";
    $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
    $fin=date("Y-m-d ").$fin.":00";
    $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
    $types=Type::whereId($type)->first();

    $pas=60*$types->temps;
    $arr=array();
    $arr2=array();
    $items=array();
    $arr4=array();
    $jour=date("Y-m-d");
    $tomorrow=date('Y-m-d', strtotime($jour. ' + 1 day'));
    $jour=$tomorrow;
    $Tomorrow_appointments=Appointment::where('ActiveType',"1")->whereJour($tomorrow)->get();
    while ($debut < $fin )
    {
      $arr[]=$debut;  
      $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + $pas));

          }
          
          if (count($Tomorrow_appointments)>0) {
            foreach ($Tomorrow_appointments as $appointment ) {  
    for ($i=0; $i <count($arr) ; $i++) { 
    $d=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->debut.":00"));
    $f=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->fin.":00"));
    if ($arr[$i]>=$d && $arr[$i]<$f) {
      $arr2[]=$arr[$i];
    }
    else{
       $arr4[]= $arr[$i];}}
     
     
     }} else {
 
 
       for ($i=0; $i <count($arr) ; $i++) { 
       
            $arr4[]= $arr[$i];}
          }
foreach ($arr4 as $k ) {


    if (!in_array($k, $items)&&!in_array($k, $arr2) ) {
   $items[]=$k;}}
   $var=2;
   $type=Type::find($type);
   return view("test")->with('items',$items)
   ->with('var',$var)
   ->with('type',$types->id)
   ->with('jour',$jour)
   ->with('username',$username)
   ->with('Cid',$Cid);  }







  public function afterTomorrow($type,$username,$Cid)
   
  {
$types=Type::whereId($type)->first();
date_default_timezone_set("Africa/Algiers");
$date=date("l");
    $date=date("l", strtotime($date. ' + 2 day'));
    if ($date=='Friday') {
   $debut="09:00";
   $fin="22:00";
}elseif($date=='Saturday'){
    $debut="09:00";
    $fin="22:00";
}else{
    $debut="16:00";
    $fin="22:00";
}
   $debut=date("Y-m-d ").$debut.":00";
   $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
   $fin=date("Y-m-d ").$fin.":00";
   $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
   $pas=60*$types->temps;
   $arr=array();
   $arr2=array();
   $items=array();
   $arr4=array();
   $jour=date("Y-m-d");
   $afterTommorow=date('Y-m-d', strtotime($jour. ' + 2 day'));
   $jour=$afterTommorow;
   $afterTommorow=Appointment::where('ActiveType',"1")->whereJour($afterTommorow)->get();
   while ($debut < $fin )
   {
     $arr[]=$debut;  
     $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + $pas));
         }

         if (count($afterTommorow)>0) {
           foreach ($afterTommorow as $appointment ) {  
   for ($i=0; $i <count($arr) ; $i++) { 
   $d=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->debut.":00"));
   $f=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->fin.":00"));
   if ($arr[$i]>=$d && $arr[$i]<$f) {
     $arr2[]=$arr[$i];
   }
   else{
      $arr4[]= $arr[$i];}}
    
    
    }} else {


      for ($i=0; $i <count($arr) ; $i++) { 
      
           $arr4[]= $arr[$i];}
         }
         
 
foreach ($arr4 as $k ) {
   if (!in_array($k, $items)&&!in_array($k, $arr2) ) {
  $items[]=$k;}}
  $var=3;
  $type=Type::find($type);
  return view("test")->with('items',$items)
  ->with('var',$var)
  ->with('type',$types->id)
  ->with('jour',$jour)
  ->with('username',$username)
  ->with('Cid',$Cid);}



}
















 

