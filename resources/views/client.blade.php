<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BotMan Studio</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
    <script src="{{URL::asset('js/jquery.throttle.js')}}"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/css/jquery.classycountdown.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/js/jquery.classycountdown.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">

<style>body{
background:url(https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599670310/1_zvsdhh.jpg) ;
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
font-family: 'Cairo', sans-serif;

}
  .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}



</style>

<!-- Optionally add this to use a skin : -->
    <!-- Styles -->
</head>
<body dir="rtl">

<div class="m-4">
    <div  class=" card bg-success text-white  justify-content-center align-self-center align-items-center" style="opacity: 0.9">
        @php


        ini_set("allow_url_fopen", 1);
        
                      $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$client->fb_id.'?fields=profile_pic&access_token='.$config);
                      $userInfo = json_decode($userInfoData, true);
                  $picture = $userInfo['profile_pic'] ;
        
        @endphp
        <img src="{{$picture}}" alt="John"  width="100" height="100" class=" align-self-center m-4 border border-white ">
        <h3 class="mt-2 bg-dark">{{$client->facebook}}</h3>
      
    <div><div class="h4">عدد نقاطي :            <span class="badge badge-dark">{{$client->points}} نقطة  </span></div>
</div>
           

          
      </div>
</div>
 @if ($difmin-3600 >'0')
      <div  class="card  mt-4 bg-success text-white " style="opacity: 0.9">
  
      
    
           

           
                <div class="m-3">الوقت المتبقي لموعدك : </div>
<div style="direction: ltr "  id="countdown-container"></div>
<p></p>
<p></p>
          
      </div>

          
      @else
      <div class="col col-12 bg-dark text-white m-2  " style="opacity: 0.9"><h4 class="p-4 text-right">لا توجد مواعيد لنهار اليوم</h4></div>
     
  @endif
    





           <input type="hidden" id="hidden" name="hidden" value="{{$difmin}}">

       




    <script> 
    str=parseInt(document.getElementById('hidden').value);

    
    $('#countdown-container').ClassyCountdown({


      // flat-colors, flat-colors-wide, flat-colors-very-wide, 
      // flat-colors-black, black, black-wide, black-very-wide, 
      // black-black, white, white-wide, 
      // white-very-wide or white-black
          theme: "white",
      
      // end time
          end: $.now() +str-3600,
          now: $.now(),
      
      // whether to display the days/hours/minutes/seconds labels.
          labels: true,
      
      // object that specifies different language phrases for says/hours/minutes/seconds as well as specific CSS styles.
          labelsOptions: {
              lang: {
                days:'يوم',
                  hours: 'ساعة ',
                  minutes: 'دقيقة',
                  seconds: 'ثانية'
              },
              style: 'font-size: 16px'
          },
      
      // custom style for the countdown
          style: {
              element: '',
              labels: true,
              textCSS: '',
              days: {
                  gauge: {
                    displayInput: false,
                      thickness: 0.1,
                      bgColor: 'rgba(0, 0, 0, 0)',
                      fgColor: 'rgba(0, 0, 0, 1)',
                      lineCap: 'butt',
                      
                  
                  },
                  textCSS: '',
                  
              },
              hours: {
                  gauge: {
                      thickness: 0.1,
                      bgColor: 'rgba(0, 0, 0, 0)',
                      fgColor: 'rgba(0, 0, 0, 1)',
                      lineCap: 'butt'
                  },
                  textCSS: ''
              },
              minutes: {
                  gauge: {
                      thickness: 0.1,
                      bgColor: 'rgba(0, 0, 0, 0)',
                      fgColor: 'rgba(0, 0, 0, 1)',
                      lineCap: 'butt'
                  },
                  textCSS: ''
              },
              seconds: {
                  gauge: {
                      thickness: 0.1,
                      bgColor: 'rgba(0, 0, 0, 0)',
                      fgColor: 'rgba(0, 0, 0, 1)',
                      lineCap: 'butt'
                  },
                  textCSS: ''
              }
          },
      
      // callback that is fired when the countdown reaches 0.
          onEndCallback: function () {
          }
      
      });</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>