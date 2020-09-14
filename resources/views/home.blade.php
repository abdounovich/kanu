
@extends('layouts.master')

@section('title', 'Clients')



@section('content')





 

  
<div class="container">
    <div class="row">

        <div class="col col-4 p-4">  <div class="card rounded bg-primary text-white p-2 shadow" style="opacity: 0.8" >
        <i class="m-4 p-2 fa fa-users fa-5x d-flex align-self-center "></i>
        <div class="h3 p-2   d-flex align-self-center">عدد الزبائن : {{$clients->count()}}</div>
        <button class=" m-4 p-2 btn btn-warning d-flex align-self-center">مشاهدة الجميع</button>
         </div>
        </div>
      

        <div class="col col-4 p-4">  <div class="card rounded bg-success text-white p-2 shadow" style="opacity: 0.8" >
            <i class="m-4 p-2 fa fa-calendar fa-5x d-flex align-self-center "></i>
            <div class="h3 p-2   d-flex align-self-center">عدد المواعيد  : {{$appointments->count()}}</div>
            <button class=" m-4 p-2 btn btn-warning d-flex align-self-center">مشاهدة الجميع</button>
             </div>
            </div>



            <div class="col col-4 p-4">  <div class="card rounded bg-info text-white p-2 shadow" style="opacity: 0.8" >
                <i class="m-4 p-2 fa fa-list fa-5x d-flex align-self-center "></i>
                <div class="h3 p-2   d-flex align-self-center">عدد الأنواع : {{$types->count()}}</div>
                <button class=" m-4 p-2 btn btn-warning d-flex align-self-center">مشاهدة الجميع</button>
                 </div>
                </div>

    </div>
</div>






@stop