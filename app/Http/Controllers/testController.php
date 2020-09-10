<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class testController extends Controller
{
   public function index(){

   


$full_name='Merahi-AbdelDjalil';
$OneApp=Appointment::where('facebook',$full_name)
->where('ActiveType','1')->count();
if ($OneApp>0) {
echo('عذرا , لقد حجزت موعد من قبل لا يمكنك حجز أكثر من موعد في نفس اليوم');}
else{}
   }



}



