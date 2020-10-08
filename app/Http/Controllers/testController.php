<?php

namespace App\Http\Controllers;

use App\Type;
use App\Client;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use BotMan\Drivers\Facebook\FacebookDriver;

class testController extends Controller
{






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
    $type=Type::find($type);
    $username=$request->get('username');
    $type_time=$type->temps-1;
   $fin=date("Y-m-d H:i:s", (strtotime(date($debut)) +  $type_time*60));
   $fin=date("H:i", strtotime(date($fin)));
   $debut=date("H:i", strtotime(date($debut)));


$jour=$request->get('jour');

$a=Appointment::whereJour($jour)->whereDebut($debut)->get()->count();


if ($a>0) {
  $botman = app('botman');
  $botman->say( "حدث خطأ نرجو إعادة المحاولة ",$id, FacebookDriver::class);
  return;

} else {

$addApp=new Appointment();
$addApp->facebook=$username;
$addApp->type_id= $type->id;
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
                    "title"=>" 📅 تصفح  مواعيدي",
                    "webview_height_ratio"=>"tall",
                    "messenger_extensions"=>"true"


                  ],
                  [
                    "type"=>"web_url",
                    "url"=>"$config/client/$client->slug",
                    "title"=>" 🎁 رصيدي    ",
                    "webview_height_ratio"=>"tall",
                    "messenger_extensions"=>"true"
                    

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

    }  }


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
      $d_pause="12:00";
      $f_pause="15:00";
     
   }elseif($date=='Saturday'){
       $debut="09:00";
       $fin="22:00"; 
       $d_pause="12:00";
       $f_pause="13:00";
   }elseif($date=='Tuesday'){
       $debut="00:01";
       $fin="00:03";
       $d_pause="00:00";
       $f_pause="00:01";
   }

   else{ $debut="10:00";
    $fin="22:00";
    $d_pause="14:00";
    $f_pause="15:00";}


   $jour=date("Y-m-d");

    $debut=$jour." ".$debut.":00";
    $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
    $fin=$jour." ".$fin.":00";
    $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
    $types=Type::find($type);
    

    $pas=$types->temps-1;
    $arr=array();
    $arr2=array();
    $items=array();
    $arr4=array();
    
    
    $d_pause=$jour." ".$d_pause.":00";
    $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
    $f_pause=$jour." ".$f_pause.":00";
    $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 

    $Today_appointments=Appointment::whereJour($jour)->where('ActiveType',"1")->Orwhere('ActiveType',"2")->get();
    while ($debut < $fin )
    {
      $arr[]=$debut;  
      $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 900));

          }
          
          if (count($Today_appointments)>0) {
            for ($i=0; $i <count($arr) ; $i++) { 
               $ai=Carbon::createFromFormat('Y-m-d H:i:s', $arr[$i]); 
              $ai->toDateTimeString();
              $ai->addMinutes($pas); 

            foreach ($Today_appointments as $appointment ) {      
    $d=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->debut.":00"));
    $f=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->fin.":00"));


    
    if ($arr[$i]>=$d && $arr[$i]<$f) {
     

      $arr2[]=$arr[$i];}

    elseif ($ai>=$d && $ai<$f) {
      $arr2[]=$arr[$i];
    }
    
    else{
  
       $arr4[]= $arr[$i];
      
     }}
     
     }} else {
 
 
       for ($i=0; $i <count($arr) ; $i++) { 
       
            $arr4[]= $arr[$i];}
          }


foreach ($arr4 as $k ) {


    if (!in_array($k, $items)&&!in_array($k, $arr2) ) {

if ($d_pause<=$k && $k<$f_pause) {
}
else{
 
   $items[]=$k;

   
}
  
  }}

  

 
   $var=1;
   $type=Type::find($type);
   return view("test")->with('items',$items)
   ->with('var',$var)
   ->with('type',$type)
   ->with('jour',$jour)
   ->with('username',$username)
   ->with('Cid',$Cid);  }



  
   public function tomorrow($type,$username,$Cid)
   {
date_default_timezone_set("Africa/Algiers");
$date=date("l");
    $date=date("l", strtotime($date. ' + 1 day'));


    if ($date=='Friday') {
      $debut="09:00";
      $fin="22:00";
      $d_pause="12:00";
      $f_pause="15:00";
     
   }elseif($date=='Saturday'){
       $debut="09:00";
       $fin="22:00"; 
       $d_pause="12:00";
       $f_pause="13:00";
   }elseif($date=='Tuesday'){
       $debut="00:00";
       $fin="00:00";
       $d_pause="00:00";
       $f_pause="00:01";
   }

   else{ $debut="10:00";
    $fin="22:00";
    $d_pause="14:00";
    $f_pause="15:00";}

   $jour=date("Y-m-d");
   $tomorrow=date('Y-m-d', strtotime($jour. ' + 1 day'));
   $jour=$tomorrow;

    $debut=$jour." ".$debut.":00";
    $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
    $fin=$jour." ".$fin.":00";
    $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
    $types=Type::whereId($type)->first();

    $pas=$types->temps-1;
    $arr=array();
    $arr2=array();
    $items=array();
    $arr4=array();
    
    
    $d_pause=$jour." ".$d_pause.":00";
    $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
    $f_pause=$jour." ".$f_pause.":00";
    $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 

    $Tomorrow_appointments=Appointment::whereJour("2020-10-09")->where('ActiveType',"1")->Orwhere('ActiveType',"2")->get();
    while ($debut < $fin )
    {
      $arr[]=$debut;  
      $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 900));

          }
          
          if (count($Tomorrow_appointments)>0) {
            foreach ($arr as $key) { 
              
              $ai=Carbon::createFromFormat('Y-m-d H:i:s',$key); 
              $ai->toDateTimeString();
              $av=$ai->addMinutes(90); 
              echo $av; 
              echo"<br>";
            
            foreach ($Tomorrow_appointments as $appointment ) {    

    echo $d=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->debut.":00"));
    echo"<br>";
    echo $f=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->fin.":00"));
    echo"<br>";

              
             



    
    if ($key>=$d && $key<$f) {
      $arr2[]=$key;}

    elseif ($ai>=$d && $ai<$f) {
      $arr2[]=$key;
    }

    elseif ($ai>$fin) {
      $arr2[]=$key;
    }
    elseif ($ai>$f_pause) {
      $arr2[]=$key;
    }
    
    else{
  
       $arr4[]= $key;}}
     
     }} else {
 
 
       for ($i=0; $i <count($arr) ; $i++) { 
       
            $arr4[]= $arr[$i];}
          }


foreach ($arr4 as $k ) {


    if (!in_array($k, $items)&&!in_array($k, $arr2) ) {

if ($d_pause<=$k && $k<$f_pause) {
}
else{

   $items[]=$k;

   
}
  
  }}

  
   $var=2;
   $type=Type::find($type);
   return view("test")->with('items',$items)
   ->with('var',$var)
   ->with('type',$type)
   ->with('jour',$jour)
   ->with('username',$username)
   ->with('Cid',$Cid);  }







  public function afterTomorrow($type,$username,$Cid)
   
  {
$types=Type::find($type);
date_default_timezone_set("Africa/Algiers");
$date=date("l");
    $date=date("l", strtotime($date. ' + 2 day'));

  if ($date=='Friday') {
      $debut="09:00";
      $fin="22:00";
      $d_pause="12:00";
      $f_pause="15:00";
     
   }elseif($date=='Saturday'){
       $debut="09:00";
       $fin="22:00"; 
       $d_pause="12:00";
       $f_pause="13:00";
   }elseif($date=='Tuesday'){
       $debut="00:01";
       $fin="00:03";
       $d_pause="00:00";
       $f_pause="00:01";
   }

   else{ $debut="10:00";
    $fin="22:00";
    $d_pause="14:00";
    $f_pause="15:00";}
   $jour=date("Y-m-d");
   $afterTommorow=date('Y-m-d', strtotime($jour. ' + 2 day'));
   $jour=$afterTommorow;
   $debut=$jour." ".$debut.":00";
   $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
   $fin=$jour." ".$fin.":00";
   $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
   $pas=$types->temps-1;
   $arr=array();
   $arr2=array();
   $items=array();
   $arr4=array();
 
   $d_pause=$jour." ".$d_pause.":00";
    $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
    $f_pause=$jour." ".$f_pause.":00";
    $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 
   $afterTommorow=Appointment::whereJour($jour)->where('ActiveType',"1")->Orwhere('ActiveType',"2")->get();
   while ($debut < $fin )
    {
      $arr[]=$debut;  
      $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 900));

          }
          
          if (count($afterTommorow)>0) {
            for ($i=0; $i <count($arr) ; $i++) { 
               $ai=Carbon::createFromFormat('Y-m-d H:i:s', $arr[$i]); 
              $ai->toDateTimeString();
              $ai->addMinutes($pas); 

            foreach ($afterTommorow as $appointment ) {      
    $d=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->debut.":00"));
    $f=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->fin.":00"));


    
    if ($arr[$i]>=$d && $arr[$i]<$f) {
          
                $arr2[]=$arr[$i];}
          
              elseif ($ai>=$d && $ai<$f) {
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
      
      if ($d_pause<=$k && $k<$f_pause) {
      }
      else{
      
         $items[]=$k;
      
         
      }
        
        }}
  $var=3;
  $type=Type::find($type);
  return view("test")->with('items',$items)
  ->with('var',$var)
  ->with('type',$type)
  ->with('jour',$jour)
  ->with('username',$username)
  ->with('Cid',$Cid);}




  public function try()

  {
 




    $type="1";
    $username="Merahi-AbdelDjalil";
    $Cid="3";
    date_default_timezone_set("Africa/Algiers");
$date=date("l");



    if ($date=='Friday') {
      $debut="09:00";
      $fin="22:00";
      $d_pause="12:00";
      $f_pause="15:00";
     
   }elseif($date=='Saturday'){
       $debut="09:00";
       $fin="22:00"; 
       $d_pause="12:00";
       $f_pause="13:00";
   }elseif($date=='Tuesday'){
       $debut="00:01";
       $fin="00:03";
       $d_pause="00:00";
       $f_pause="00:01";
   }

   else{ $debut="10:00";
    $fin="22:00";
    $d_pause="14:00";
    $f_pause="15:00";}


   $jour=date("Y-m-d");

    $debut=$jour." ".$debut.":00";
    $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
    $fin=$jour." ".$fin.":00";
    $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
    $types=Type::find($type);
    

    $pas=$types->temps-1;
    $arr=array();
    $arr2=array();
    $items=array();
    $arr4=array();
    
    
    $d_pause=$jour." ".$d_pause.":00";
    $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
    $f_pause=$jour." ".$f_pause.":00";
    $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 

    $Today_appointments=Appointment::whereJour($jour)->where('ActiveType',"1")->Orwhere('ActiveType',"2")->get();
    while ($debut < $fin )
    {
      $arr[]=$debut;  
      $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 15*60));

          }
          
          if (count($Today_appointments)>0) {
            foreach ($Today_appointments as $appointment ) { 
                   $d=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->debut.":00"));
    $f=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->fin.":00"));

              foreach ($arr as $key) { 
                echo $ai=Carbon::createFromFormat('Y-m-d H:i:s', $key); 
                $ai->toDateTimeString();
                $ai->addMinutes($pas); 
                echo $ai;                   
    if ($key>=$d && $key<$f) {
     

      $arr2[]=$key;}

    elseif ($ai>=$d && $ai<$f) {
      $arr2[]=$key;
    }
    
    else{
  
       $arr4[]= $key;
      
     }}
     
     }} else {
 
 
       foreach ($arr as $key) { 
       
            $arr4[]= $key;}
          }


foreach ($arr4 as $k ) {


    if (!in_array($k, $items)&&!in_array($k, $arr2) ) {

if ($d_pause<=$k && $k<$f_pause) {
}
else{
   $items[]=$k;

   
}
  
  }}

  

 
   $var=1;
   $type=Type::find($type);
   return view("test")->with('items',$items)
   ->with('var',$var)
   ->with('type',$type)
   ->with('jour',$jour)
   ->with('username',$username)
   ->with('Cid',$Cid); }





}
















 

