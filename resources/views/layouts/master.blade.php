<html>
    <head>
        <title> @yield('title')</title>
        <meta charset="UTF-8">
        <meta  name="viewport" content="width= {screenWidth}">
    
       
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>      


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="{{ asset('js/app.js',true )}}" type="text/js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="{{ asset('css/app.css',true) }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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


     
<div class="p-2 m-5  d-flex justify-content-center"> <a class="btn btn-dark  rounded text-white " ><i class=" p-1 fa fa-arrow-down fa-4x " data-toggle="collapse" data-target="#demo"></i>
</a></div>
       
          <div id="demo" class="collapse m-5 p-4">
          
       <div class="container  ">
            <div class="row ">
              <div class="col p-4 btn-group ">
                <a class=" col col-2 btn btn-primary m-3 p-3 " style="font-size: 60px"   href="/"><i class=" p-2 fa fa-home"></i> </a>

<a href="/types" class=" col col-2 text-white btn btn-success m-3 p-3" style="font-size: 60px"><i class=" p-2 fa fa-server"></i></a> 
            <a href="/clients" class="col col-2  text-white btn btn-info m-3 p-3" style="font-size: 60px"> <i class=" p-2 fa fa-users"></i></a> 
                      <a class=" col col-2   text-white btn btn-danger m-3 p-3 " style="font-size: 60px" data-toggle="modal" data-target="#exampleModal" ><i class=" p-2 fa fa-power-off"></i> </a>
            <a id="button" class="col col-2  text-white btn btn-warning m-3 p-3"  style="font-size: 60px"> <i class=" p-2 fa fa-refresh"></i></a> 
            



          </div>
            </div>
          </div> </div>





          <!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">       

        <h5 class="modal-title" id="exampleModalLabel">   تأكيد العملية   </h5>
        </button>
      </div>
      <div class="modal-body  text-right">
         سيتم إفراغ جميع المواعيد المحجوزة لنهار اليوم   
      </div>
      <div class="modal-body text-right">
سيتم  منح الزبائن نقاطهم        </div>
      <div class="modal-footer align-items-center justify-content-center align-content-center">        
        <a href="/add" class="btn btn-danger">تــأكيد العملية</a>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغـــاء</button>
      </div>
    </div>
  </div>
</div>
        <div class="container">
            @yield('content')
        </div>





        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" integrity="sha512-lOtDAY9KMT1WH9Fx6JSuZLHxjC8wmIBxsNFL6gJPaG7sLIVoSO9yCraWOwqLLX+txsOw0h2cHvcUJlJPvMlotw==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" integrity="sha512-3n19xznO0ubPpSwYCRRBgHh63DrV+bdZfHK52b1esvId4GsfwStQNPJFjeQos2h3JwCmZl0/LgLxSKMAI55hgw==" crossorigin="anonymous"></script>      
          <script>//paste this code under the head tag or in a separate js file.
            // Wait for window load
            window.addEventListener("load", function(event) {
  $('.se-pre-con').delay(400).hide(500);
  // Do what you want, the window is entirely loaded and ready to use.
});
         </script>
         <script>
          $(document).ready(function(){
              $("#button").click(function(){
                  location.reload(true);
              });
          });
      </script>
      <script src="{{ asset('js/app.js') }}" type="text/js"></script>
     
    </body>
</html>