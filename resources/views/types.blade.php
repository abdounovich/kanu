<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>      
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></head>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
<body style="font-family: 'Cairo', sans-serif;" dir="rtl">
        <div class="container">
            <div class="card mt-5" >
                <div class="card-header">           <h1 class="display-3 text-center">أضف نوع جديد </h1>
                </div>
                <div class="card-body"> <div>
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div><br />
                    @endif
                      <form method="post" action="/types">
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
                              <label for="photo" class=" float-right">صورة :</label>
                              <input type="text" class="form-control" name="photo"/>
                          </div>
                          <button type="submit" class="btn btn-primary p-2 m-4  align-self-center">  اضافة</button>
                      </form>
                  </div></div> 
              </div>   
    
        <div class="row">
        <div class="col-sm-8 offset-sm-2">
        
       </div>
       </div>
    </div>



    <div class=" container mt-5">
        <div class="row">
            <table class="table table-dark table-hover ">
                <thead class=" bg-success text-center">
                    <tr>
                      <th>نوع الحلاقة </th>
                      <th>السعر </th>
                      <th>المدة </th>
                      <th>عدد النقاط</th>
                      <th> الصورة</th>
                      <th></th>
                   
                    </tr>
                  </thead>
                  <tbody class=" text-center">
                   @foreach ($types as $type)
                    <tr class=" align-items-center text-center">
                    
                         <td class="align-middle">{{$type->type}}</td>
                         <td class="align-middle">{{$type->prix}}</td>
                         <td class="align-middle">{{$type->temps}}</td>
                         <td class="align-middle">{{$type->point}}</td>
                         <td class="align-middle"><img class="img border border-white" width="100" height="100"  src="{{$type->photo}}" alt=""></td>
<td>
        <a href="#" class="btn btn-success m-2">تعديل</a>
<a href="#" class="btn btn-danger ">حذف</a>
</td>
            
                    </tr> @endforeach 
                  </tbody>
                
            </table>
        </div>
    </div>
</body>
</html>