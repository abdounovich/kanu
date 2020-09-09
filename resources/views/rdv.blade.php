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
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@700&display=swap" rel="stylesheet">
  <style>
    body{


      font-family: 'El Messiri', sans-serif;

    }</style></head>
<body>




  <a href="/add" class="btn btn-primary"  type="button">Text</a>

    

<div class="container">
    <div class="content">

      <table dir="rtl" class="table table-striped table-dark ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">الإسم</th>
            <th scope="col">نوع الحلاقة</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          @php
                            $counter=0;

          @endphp
            @foreach ($Actif_appointments as $Actif_appointment)
           
    <tr>
            <th scope="row"  width="10%">@php
              $counter=$counter+1;
              echo $counter;
          @endphp</th>
          

        @php



        ini_set("allow_url_fopen", 1);
        
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$Actif_appointment->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        
        @endphp
                                      <td  width="60%"> 


                    <img class=" img-thumbnail border  rounded-circle ml-2" width="50" height="50" src="{{$picture}}" alt="">{{$Actif_appointment->facebook}}
                    <span class="badge badge-success badge-pill p-1 m-2">{{$Actif_appointment->id}}</span> 
</td>
     
                    <td class="p-1"> 
              
              {{$Actif_appointment->type->type}}


         </td>

<td>          @php

echo date("H:i:s", strtotime($Actif_appointment->temps));

  
@endphp
</td>          </tr>
          @endforeach
    





        </tbody>
      </table>





      

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>