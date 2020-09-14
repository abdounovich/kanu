<html>
    <head>
        <title>App Name - @yield('title')</title>
        <meta charset="UTF-8">
        <meta  name="viewport" content="width=device-width">
    
       
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>      
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(https://smallenvelop.com/wp-content/uploads/2014/08/Preloader_11.gif) center no-repeat #fff;
    }
    </style>
    </head>
    <body dir="rtl">
        <div class="se-pre-con"></div>
        <div>   @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif</div>


<div class="p-2 m-5"> <a class="btn btn-dark rounded-circle text-success " ><i class=" p-1 fa fa-bars fa-4x " data-toggle="collapse" data-target="#demo"></i>
</a></div>
       
          <div id="demo" class="collapse m-4 p-4">
          
       <div class="container  ">
            <div class="row ">
              <div class="col p-4  ">
                <a class=" col col-2 btn btn-primary m-3 p-3 " style="font-size: 60px"   href="/home"><i class=" p-2 fa fa-home"></i> </a>

<a href="/types" class=" col col-2 text-white btn btn-success m-3 p-3" style="font-size: 60px"><i class=" p-2 fa fa-server"></i></a> 
            <a href="/clients" class="col col-2  text-white btn btn-info m-3 p-3" style="font-size: 60px"> <i class=" p-2 fa fa-users"></i></a> 
                      <a class=" col col-2 btn btn-danger m-3 p-3 " style="font-size: 60px"  onclick="return confirm('هل أنت متأكد ?')" href="/add"><i class=" p-2 fa fa-power-off"></i> </a>
            <a id="button" class="col col-2  text-white btn btn-warning m-3 p-3" style="font-size: 60px"> <i class=" p-2 fa fa-refresh"></i></a> 
            
          </div>
            </div>
          </div> </div>
        <div class="container">
            @yield('content')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs-/modernizr/2.8.3/modernizr.js"></script>
        <script>//paste this code under the head tag or in a separate js file.
            // Wait for window load
            $(window).load(function() {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");;
            });</script>
          <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    </body>
</html>