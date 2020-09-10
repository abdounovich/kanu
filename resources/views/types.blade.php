<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" /> 

   
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>      
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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



    <div class=" container mt-5">
        <div class="row">
            <h2 class=" text-white p-2">أنواع الحلاقة :</h2>
            <table class="table table-dark table-hover" style="opacity: 0.9 ">
 <thead class=" bg-success text-center">

                    <tr>
                      <th>نوع الحلاقة </th>
                      <th>السعر </th>
                      <th>المدة </th>
                      <th>عدد النقاط</th>
                      <th> الصورة</th>
                     
                   
                    </tr>
                  </thead>
                  <tbody class=" text-center">
                   @foreach ($types as $type)
                    <tr class=" align-items-center text-center">
                    
                         <td class="align-middle">{{$type->type}}</td>
                         <td class="align-middle">{{$type->prix}} دج </td>
                         <td class="align-middle">{{$type->temps}} دقيقة </td>
                         <td class="align-middle">{{$type->point}}</td>
                         <td class="align-middle"><img class="img border  border-white" width="100" height="100"  src="{{$type->photo}}" alt=""></td>

            
                    </tr> @endforeach 
                  </tbody>
                
            </table>
        </div>
    </div>









        <div class="container">
            <div class="card mt-5 mb-5" style="opacity: 0.9"  >
                <div class="card-header  bg-success text-white ">           <h4 class=" text-center p-2 ">أضف نوع جديد </h4>
                </div>
                <div class="card-body bg-dark text-white"> <div>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                      <form method="post" action="/types" role="form" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">    
                              <label for="type" class=" float-right">  نوع الحلاقة :</label>
                              <input type="text" class="form-control" name="type"/>
                          </div>
                
                          <div class="form-group">
                              <label for="prix" class=" float-right">السعر: </label>
                              <input type="text" class="form-control" name="prix"/>
                          </div>
                
                          <div class="form-group">
                              <label for="temps" class=" float-right">الوقت:</label>
                              <input type="text" class="form-control" name="temps"/>
                          </div>
                          <div class="form-group">
                              <label for="point" class=" float-right">عدد النقاط:</label>
                              <input type="text" class="form-control" name="point"/>
                          </div>

                          <div class="form-group">
                            <label for="photo" class=" float-right">الصورة :</label>
        <div class="row">
          <div class="col-2">
            <input type="file" id="imgupload" onchange="loadFile(event)"  name="photo" hidden>
        <a href="#" onclick="$('#imgupload').trigger('click'); return false;"> 
           <img class="img " id="image" 
           src="https://res.cloudinary.com/ds9qfm1ok/image/upload/v1595881085/gallery-131964752828011266_ko0lhf.png"
            alt="" width="200" height="200">
        </a>
          </div>
          
        </div>
                            
                                     
                        </div>
                        <script>
                            var loadFile = function(event) {
                                var image = document.getElementById('image');
                                image.src = URL.createObjectURL(event.target.files[0]);
                            };
                            </script>   
                            
                            
                    <div class="row">
                       
                        <div class="col col-12">
                           <button style="width: 100%" type="submit" class="btn btn-success">  اضافة</button>
 
                        </div>
                      
                    </div>    
                      
                        </form>
                  </div></div> 
              </div>   
    
        <div class="row">
        <div class="col-sm-8 offset-sm-2">
        
       </div>
       </div>
    </div>



   

    

</body>
</html>