<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BotMan Studio</title>

    <!-- Fonts -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{URL::asset('js/jquery.knob.js')}}"></script>
    <script src="{{URL::asset('js/jquery.throttle.js')}}"></script>
    <link href="{{URL::asset('css/jquery.classycountdown.css')}}" rel="stylesheet">
<script src="{{URL::asset('js/jquery.classycountdown.js')}}"></script>
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
   

  
      
    
           

        


<div   id="countdown-container"></div>


   





           <input type="text" id="hidden" name="hidden" value="{{$difmin}}">

       




    <script> 
   $('#countdown-container').ClassyCountdown({
    theme: "white", // theme
    end: $.now() + 645600 // end time
});</script>


</body>
</html>