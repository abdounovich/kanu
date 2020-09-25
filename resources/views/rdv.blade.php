
@extends('layouts.master')

@section('title', 'Home')



@section('content')




  




<div class="container">
  <div class="row mt-5">
    @if ($Today_appointments->count()=='0')
        <div  class="col col-12 bg-dark text-white mt-5  " style="opacity: 0.9"><h2 class="p-4 float-right">لا توجد مواعيد لنهار اليوم</h2></div>
   @else
    <h3 class="p-2 text-white">مواعيد اليوم </h3>
    <table class="table table-striped table-dark responsive"style="opacity:0.9">
      <thead class=" bg-success text-right">
        <tr>
          <th scope="col">#</th>          

          <th scope="col">الفيسبوك</th>
          <th scope="col">عدد النقاط </th>
          
          <th scope="col">نوع الحلاقة </th>

          <th scope="col">الموعد  </th>
          <th scope="col">تاريخ الحجز </th>
          <th scope="col">  </th>


        </tr>
      </thead>
      <tbody class=" text-right">
        @php
        $counter=0;
        date_default_timezone_set("Africa/Algiers");
           $actifTime=date('H:i');
        @endphp
        @foreach ($Today_appointments as $Today_appointment)
        @php
           $counter=$counter+1; 
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$Today_appointment->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp
        <tr  @if ($actifTime>=$Today_appointment->debut && $actifTime<$Today_appointment->fin)
             class="bg-info" 
        @endif>

      
          <th scope="row">{{$counter}}</th>
          <td class="align-middle"><img class="  border  rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$Today_appointment->facebook}}</td>
         
        <td class="align-middle">
          <span class="badge badge-success badge-pill p-2">{{$Today_appointment->client->points}}</span> 
        </td>
        <td class="align-middle">{{$Today_appointment->type->type}}</td>
         <td class="align-middle">@php $demain = date('H:i', strtotime($Today_appointment->debut));
          echo $demain;
          @endphp</td>
            <td class="align-middle"> @php  carbon\Carbon::setLocale('ar');
              echo $Today_appointment->created_at->addMinutes(60)->diffForHumans(); @endphp    
                
                
              <input  class="m-2 p-2" type="checkbox" id="cb{{$Today_appointment->id}}" @if ($Today_appointment->ActiveType=="2" )
checked 
@endif onchange="myFunction('{{$Today_appointment->id}}','cb{{$Today_appointment->id}}')"
 data-on="حاضر" data-off="غائب" data-onstyle="success"  
 data-offstyle="danger"  data-toggle="toggle">

              </td>

        </tr>
    
        @endforeach
      </tbody>
    </table> @endif
  </div>
</div>











<div class="container">
  <div class="row mt-5">
    @if ($Tomorow_appointments->count()=='0')
        <div  class="col col-12 bg-dark text-white mt-5  " style="opacity: 0.9"><h2 class="p-4 float-right">لا توجد مواعيد لنهار الغد</h2></div>
   @else
    <h3 class="p-2 text-white">مواعيد الغد </h3>
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
        @foreach ($Tomorow_appointments as $Tomorow_appointment)
        @php
           $counter=$counter+1; 
      
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$Tomorow_appointment->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp
        <tr>
          <th scope="row">{{$counter}}</th>
          <td class="align-middle"><img class="  border  rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$Tomorow_appointment->facebook}}</td>
         
        <td class="align-middle">
          <span class="badge badge-success badge-pill p-2">{{$Tomorow_appointment->client->points}}</span> 
        </td>
        <td class="align-middle">{{$Tomorow_appointment->type->type}}</td>
         <td class="align-middle">@php $demain = date('H:i', strtotime($Tomorow_appointment->debut));
          echo $demain;
          @endphp</td>
            <td class="align-middle"> @php  carbon\Carbon::setLocale('ar');
              echo $Tomorow_appointment->created_at->addMinutes(60)->diffForHumans(); @endphp    </td>

        </tr>
    
        @endforeach
      </tbody>
    </table> @endif
  </div>
</div>




<div class="container">
  <div class="row mt-5">
    @if ($AfterTomoro_appointments->count()=='0')
        <div  class="col col-12 bg-dark text-white mt-5  " style="opacity: 0.9"><h2 class="p-4 float-right">لا توجد مواعيد لبعد الغد</h2></div>
   @else
    <h3 class="p-2 text-white">مواعيد بعد غد </h3>
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
        @foreach ($AfterTomoro_appointments as $AfterTomoro_appointment)
        @php
           $counter=$counter+1; 
      
        ini_set("allow_url_fopen", 1);
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$AfterTomoro_appointment->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        @endphp
        <tr>
          <th scope="row">{{$counter}}</th>
          <td class="align-middle"><img class="  border  rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
            {{$AfterTomoro_appointment->facebook}}</td>
         
        <td class="align-middle">
          <span class="badge badge-success badge-pill p-2">{{$AfterTomoro_appointment->client->points}}</span> 
        </td>
        <td class="align-middle">{{$AfterTomoro_appointment->type->type}}</td>
         <td class="align-middle">@php $demain = date('H:i', strtotime($AfterTomoro_appointment->debut));
          echo $demain;
          @endphp</td>
            <td class="align-middle"> @php  carbon\Carbon::setLocale('ar');
              echo $AfterTomoro_appointment->created_at->addMinutes(60)->diffForHumans(); @endphp    </td>

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
          <td class="align-middle"><img class="  border  rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">
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



  <script>
  function myFunction($fid,$cbid) {
    var checkBox=document.getElementById($cbid);

   
/*     window.location = "/actif/"+$fid;
 */  
    

 if (checkBox.checked == true){
  window.location = "/actif/"+$fid+"/2";
  } else {
    window.location = "/actif/"+$fid+"/1";

 }

}

;</script>
@stop