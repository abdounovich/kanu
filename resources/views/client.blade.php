<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BotMan Studio</title>

    <!-- Fonts -->


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js" integrity="sha512-JZSo0h5TONFYmyLMqp8k4oPhuo6yNk9mHM+FY50aBjpypfofqtEWsAgRDQm94ImLCzSaHeqNvYuD9382CEn2zw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.js" integrity="sha512-5ITfxARa+VowWr2W6H+oCSKk1t3q4pqFoiU4or3whS4VkaOF6N+QFNAQFZeMBMM/9CT4TeFiRPFJDuFFNfXkZA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/css/jquery.classycountdown.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery.classycountdown@1.0.1/js/jquery.classycountdown.min.js"></script>
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
    str=parseInt(document.getElementById('hidden').value);

    
    $('#countdown-container').ClassyCountdown({
    theme: "dark", // theme
    end: $.now() +2874804 // end time
});</script>


</body>
</html>