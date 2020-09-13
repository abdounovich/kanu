<!DOCclient html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport" content="width= {screenWidth}">

   
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>      
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
<style>
body{

background:url(https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599670310/1_zvsdhh.jpg) ;background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
font-family: 'Cairo', sans-serif;
}
    
</style>
</head>
<body  dir="rtl">
<div>   @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif</div>

    <div class=" container mt-5">
        <div class="row">
            <h2 class=" text-white p-2">قائمة الزبائن : </h2>
            <table class="table table-dark table-hover" style="opacity: 0.9 ">
 <thead class=" bg-success text-right">

                    <tr>
                   
                      <th> الفيسبوك </th>
                      <th> النقاط</th>
                      <th> </th>
                     
                   
                    </tr>
                  </thead>
                  <tbody class=" text-center">
                   @foreach ($clients as $client)
                    <tr class=" align-items-center text-center">
                    
                  
                        <td class="align-middle">   @php


                            ini_set("allow_url_fopen", 1);
                                          $userInfoData=file_get_contents('https://graph.facebook.com/v2.6/'.$client->fb_id.'?fields=profile_pic&access_token='.$config);
                                          $userInfo = json_decode($userInfoData, true);
                                      $picture = $userInfo['profile_pic'] ;
                            
                            @endphp
                            <img src="{{$picture}}" alt="John"  width="50" height="50" class=" float-right m-4 border border-white border-2 ">
                            {{$client->facebook}}<td>  
     <td class="align-middle"><span class=" badge badge-success p-2">{{$client->points}}</span></td>
                        


  

</td>
            
                    </tr> @endforeach 
                  </tbody>
                
            </table>
        </div>
    </div>









      

   

    <script src="{{ asset('js/app.js') }}" client="text/js"></script>


</body>
</html>