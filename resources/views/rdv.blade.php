<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BotMan Studio</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
    <style>
      .page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green;
    border-color: green;
}
      body{
      
      background:url(https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599670310/1_zvsdhh.jpg) ;background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      font-family: 'Cairo', sans-serif;
      }
          
      </style>
     <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
     <script>
         $(document).ready(function(){
             $("#button").click(function(){
                 location.reload(true);
             });
         });
     </script>
    </head>
<body dir="rtl">



<div class="container">
  <div class="row">

    <div class="col p-4 ">
        <a class="btn btn-danger " onclick="return confirm('هل أنت متأكد ?')" href="/add">مسح المواعيد</a>

   
  <a id="button" class=" text-white btn btn-info"> 
    اعادة تحميل الصفحة
  </a> 
  <a  href="/types" class=" text-white btn btn-success"> 
أضف أنواع جديدة   </a> 
</div>
  </div>
</div>

 

  




<div class="container">
  <div class="row">
    @if ($Actif_appointments->count()=='0')
        <div  class="col col-12 badge-dark " style="opacity: 0.9"><h2 class="p-4 float-right">لا توجد مواعيد لنهار اليوم</h2></div>
   
       
   @else
       
  
    <h3 class="p-2 text-white">مواعيد اليوم </h3>
    <table class="table table-striped table-dark"style="opacity:0.9">
      <thead class=" bg-success text-right">
        <tr>
          <th scope="col">#</th>          

          <th scope="col">الفيسبوك</th>
          <th scope="col">عدد النقاط 
          </th>
          <th scope="col">الوقت </th>
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
         <td class="align-middle">{{$Actif_appointment->temps}}</td>

        </tr>
    
        @endforeach
      </tbody>
    </table> @endif
  </div>
</div>






<div class="container p-2">
  <div class="row">
    @if ($Inactif_appointments->count()=='0')
    <div  class="col col-12 badge-dark " style="opacity: 0.9"><h2 class="p-4 float-right">   لا توجد مواعيد سابقة </h2></div>

   
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
         <td class="align-middle">{{$Inactif_appointment->temps}}</td>

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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>