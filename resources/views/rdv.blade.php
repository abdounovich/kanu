
@extends('layouts.master')

@section('title', 'Home')



@section('content')




  




<div class="container">
  <div class="row mt-5">
    @if ($Actif_appointments->count()=='0')
        <div  class="col col-12 bg-dark text-white mt-5  " style="opacity: 0.9"><h2 class="p-4 float-right">لا توجد مواعيد لنهار اليوم</h2></div>
   
       
   @else
       
  
    <h3 class="p-2 text-white">مواعيد اليوم </h3>
    <table class="table table-striped table-dark"style="opacity:0.9">
      <thead class=" bg-success text-right">
        <tr>
          <th scope="col">#</th>          

          <th scope="col">الفيسبوك</th>
          <th scope="col">عدد النقاط </th>
          
          <th scope="col">نوع الحلاقة </th>

          <th scope="col">الموعد  </th>
          <th scope="col">تاريخ الحجز </th>

        </tr>
      </thead>
      <tbody class=" text-right">
        @php
        $counter=0;
        @endphp
        @foreach ($Actif_appointments as $Actif_appointment)
        @php
           $counter=$counter+1; 
      
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$Actif_appointment->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp
        <tr>
          <th scope="row">{{$counter}}</th>
          <td class="align-middle"><img class=" img-thumbnail border  rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$Actif_appointment->facebook}}</td>
         
        <td class="align-middle">
          <span class="badge badge-success badge-pill p-2">{{$Actif_appointment->client->points}}</span> 
        </td>
        <td class="align-middle">{{$Actif_appointment->type->type}}</td>
         <td class="align-middle">@php $demain = date('H:i', strtotime($Actif_appointment->temps));
          echo $demain;
          @endphp</td>
            <td class="align-middle"> @php  carbon\Carbon::setLocale('ar');
              echo $Actif_appointment->created_at->diffForHumans(); @endphp    </td>

        </tr>
    
        @endforeach
      </tbody>
    </table> @endif
  </div>
</div>





<div class="container p-2">
  <div class="row">
    @if ($Inactif_appointments->count()=='0')
    <div  class="col col-12 text-white bg-dark " style="opacity: 0.9"><h2 class="p-4 float-right">   لا توجد مواعيد سابقة </h2></div>

   
@else
    <h3 class="p-2 text-white">المواعيد السابقة :</h3>
    <table class="table table-striped table-dark"style="opacity:0.9">
      <thead class=" bg-success text-right">
        <tr>
          <th scope="col">#</th>          

          <th scope="col">الفيسبوك</th>
          <th scope="col">عدد النقاط</th>
          <th scope="col">الوقت </th>
        </tr>
      </thead>
      <tbody class=" text-right">
        @php
        $counter=0;
        @endphp
        @foreach ($Inactif_appointments as $Inactif_appointment)
        @php
           $counter=$counter+1; 
      
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$Inactif_appointment->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp
        <tr>
          <th scope="row">{{$counter}}</th>
          <td class="align-middle"><img class=" img-thumbnail border  rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$Inactif_appointment->facebook}}</td>
         
        <td class="align-middle">
          <span class="badge badge-success badge-pill p-2">{{$Inactif_appointment->client->points}}</span> 
        </td>
         <td class="align-middle"> @php  carbon\Carbon::setLocale('ar');
          echo $Inactif_appointment->created_at->diffForHumans(); @endphp    </td>

        </tr>
    
        @endforeach
      </tbody>
    </table>
   @endif
  </div>
</div>




<div class=" container">
     <div class="row">
     <div class=" justify-content-center">{{$Inactif_appointments->links()}}
    </div>
   </div> 
  </div>

@stop