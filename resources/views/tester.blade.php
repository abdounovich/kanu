<!DOCTYPE html>
<html>
<body>




  @php
/* $type="1";
date_default_timezone_set("Africa/Algiers");
$arr2=array();

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
 }else{
     $debut="16:00";
     $fin="22:00";
     $d_pause="00:00";
     $f_pause="00:01";
 }
    $debut=date("Y-m-d ").$debut.":00";
    $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
    $fin=date("Y-m-d ").$fin.":00";
    $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
    $types=App\Type::whereId($type)->first();
    $pas=60*$types->temps;
    $arr=array();
    $items=array();
    $arr4=array();
    $jour=date("Y-m-d");

    $d_pause=$jour." ".$d_pause.":00";
    $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
    $f_pause=$jour." ".$f_pause.":00";
    $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 
    $Today_appointments=App\Appointment::where('ActiveType',"1")->whereJour($jour)->get();
    while ($debut < $fin )
    {
      
      $arr[]=$debut;  
      $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 15*60));
          }
          if (count($Today_appointments)>0) {
            foreach ($Today_appointments as $appointment ) {  
    for ($i=0; $i <count($arr) ; $i++) { 
    $d=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->debut.":00"));
    $f=date("Y-m-d H:i:s", strtotime($appointment->date." ".$appointment->fin.":00"));
    if ($arr[$i]>=$d && $arr[$i]<$f) {
      if ($arr[$i]>=$d_pause && $arr[$i]<$f_pause) {

      $arr2[]=$arr[$i];}
      else{  $arr2[]=$arr[$i];}
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
   $var=1;



   $type=App\Type::find($type);




   foreach ($items as $item ) {
      echo $item."<p></p>" ;} 
      dd();



 */



























date_default_timezone_set("Africa/Algiers");
$date=date("l");
    $date=date("l", strtotime($date. ' + 1 day'));

$date="Friday";

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
   }else{
       $debut="16:00";
       $fin="22:00";
       $d_pause="00:00";
       $f_pause="00:01";
   }
   $jour=date("Y-m-d");
   $tomorrow=date('Y-m-d', strtotime($jour. ' + 1 day'));
   $jour=$tomorrow;

    $debut=$jour." ".$debut.":00";
    $debut=date("Y-m-d H:i:s", strtotime(date($debut)));  
    $fin=$jour." ".$fin.":00";
    $fin=date("Y-m-d H:i:s", strtotime(date($fin)));
    $types=App\Type::whereId("1")->first();

    $pas=60*$types->temps;
    $arr=array();
    $arr2=array();
    $items=array();
    $arr4=array();
    
    
    $d_pause=$jour." ".$d_pause.":00";
    $d_pause=date("Y-m-d H:i:s", strtotime(date($d_pause)));  
    $f_pause=$jour." ".$f_pause.":00";
    $f_pause=date("Y-m-d H:i:s", strtotime(date($f_pause))); 

    $Tomorrow_appointments=App\Appointment::where('ActiveType',"1")->whereJour($jour)->get();
    
    while ($debut < $fin )
    {
      $arr[]=$debut;  
      $debut=date("Y-m-d H:i:s", (strtotime(date($debut)) + 15*60));

          }
          
          if (count($Tomorrow_appointments)>0) {
            foreach ($Tomorrow_appointments as $appointment ) {  

             
    for ($i=0; $i <count($arr) ; $i++) { 
    $d=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->debut.":00"));
    $f=date("Y-m-d H:i:s", strtotime($appointment->jour." ".$appointment->fin.":00"));
    $ai=date('Y-m-d H:i:s', strtotime($arr[$i]. '+ '.$pas.' seconds'));
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

  
   $var=2;
   $type=App\Type::find("1");
   
    foreach ($items as $item ) {
      echo $item."<p></p>" ;} 
      dd();
   
    @endphp

</body>
</html>
