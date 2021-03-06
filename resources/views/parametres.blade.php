
@extends('layouts.master')

@section('title', 'Clients')



@section('content')







<div class="container">
    <div class="row text-right" >

        <div class=" form-group"> <form  method="post" action="addAppoint">
    @csrf
<label class="h4 text-white " for="debut">من :</label>
    <input class="m-2 p-2 col col-12 form-control" type="time" name="debut" id="debut">
    <label  class="h4 text-white" for="fin" >إلى  :</label>

    <input class="m-2 p-2 form-control"type="time" name="fin" id="fin">
    
    <label  class="h4 text-white" for="jour">يوم :</label>

  <input class="m-2 p-2 col col-12 form-control" type="date" name="jour" id="jour">
  <input type="time" class="form-control p-2 m-2"  name="nom" id="nom">  



    <input class=" m-2 p-2 btn btn-success" style="width: 99%" type="submit" value="إضافة">
</form></div>
           

 
    </div>
</div>


<div class="container">
    <div class="row">
        
    </div>
</div>

<div class="container">
    <div class="row">

             <form action="/settings" method="post">
        @csrf
        <div class="form-group">

<input type="time" class="form-control p-2 m-2"  name="nom" id="nom">  
<input type="text"  class="form-control p-2 m-2"  name="valeur" id="valeur">     
<input type="submit" class="btn btn-success p-2 m-2" value="اضافة">   
        </div>

        </form>
      
    </div>
</div>






<div class="container">
    <div class="card mt-5 mb-5" style="opacity: 0.9"  >
        <div class="card-header  bg-success text-white ">           <h4 class=" text-center p-2 "> الإعدادات    </h4>
        </div>
        <div class="card-body bg-dark text-white"> <div>
           

           @foreach ($settings as $setting)
        <form method="post" action="/settings/{{$setting->id}}" role="form" enctype="multipart/form-data">
                  @csrf
                
        
                 
        
                  <div class="form-group  d-flex">
                      <input type="text" class="form-control p-2 m-2" value="{{$setting->key}}" name="nom"/>
              
                      <input type="text" class="form-control p-2 m-2"  value="{{$setting->value}}" name="valeur"/>
                
                    <button  type="submit" class="btn btn-success p-2 m-2">  حفظ التغييرات</button>

                </div>
                    
            

             
              
                </form>

                @endforeach 

          </div></div> 
      </div>  





 

  





@stop