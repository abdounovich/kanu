
@extends('layouts.master')

@section('title', 'Clients')



@section('content')





 

  
<div class="container">
    <div class="row">

        <div class="col col-4 ">  <div class="card rounded bg-primary text-white p-2 shadow" style="opacity: 0.8" >
        <i class="m-4 p-2 fa fa-users fa-5x d-flex align-self-center "></i>
        <div class="h3 p-2   d-flex align-self-center"> الزبائن   </div>
        <div class="h1 d-flex align-self-center">{{$clients->count()}}</div>

        <button class=" m-4 p-2 btn btn-warning d-flex align-self-center">مشاهدة الجميع</button>
         </div>
        </div>
      

        <div class="col col-4 ">  <div class="card rounded bg-danger text-white p-2 shadow" style="opacity: 0.8" >
            <i class="m-4 p-2 fa fa-calendar fa-5x d-flex align-self-center "></i>
            <div class="h3 p-2   d-flex align-self-center"> المواعيد   </div>
            <div class="h1 d-flex align-self-center">{{$appointments->count()}}</div>
    
            <button class=" m-4 p-2 btn btn-warning d-flex align-self-center">مشاهدة الجميع</button>
             </div>
            </div>


            
        <div class="col col-4 ">  <div class="card rounded bg-success text-white p-2 shadow" style="opacity: 0.8" >
            <i class="m-4 p-2 fa fa-list fa-5x d-flex align-self-center "></i>
            <div class="h3 p-2   d-flex align-self-center"> الأنواع    </div>
            <div class="h1 d-flex align-self-center">{{$types->count()}}</div>
    
            <button class=" m-4 p-2 btn btn-warning d-flex align-self-center">مشاهدة الجميع</button>
             </div>
            </div>
    </div>
</div>






@stop