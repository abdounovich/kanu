@extends('layouts.master')

@section('title', 'Clients')



@section('content')




@if (\Session::has('success'))
    <div class="alert  alert-info  text-right ">
        <ul>
            <li class="p-2">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@if (\Session::has('erreur'))
    <div class="alert  alert-danger  text-right ">
        <ul>
            <li class="p-2">{!! \Session::get('erreur') !!}</li>
        </ul>
    </div>
@endif



 <form  method="post" action="addAppoint">
    @csrf
    <div class="row">
        
   <div class="col col-2 p-2"><label class="h4 text-white " for="debut">من :</label>
</div>
<div class="col col-10 p-2">
    <input class="form-control  "  type="time" name="debut" id="debut">
</div>

</div>

<div class="row">
        
    <div class="col col-2 p-2">
     <label  class="h4 text-white" for="fin" >إلى  :</label>
    </div>
    <div class="col col-10 p-2">
    <input class="  form-control"type="time" name="fin" id="fin">
</div>

</div>
<div class="row">
        
    <div class="col col-2 p-2">
    <label  class="h4 text-white" for="jour">يوم :</label>
</div>
<div class="col col-10 p-2">
  <input class="form-control"   type="date" name="jour" id="jour">

</div>

</div>
<div class="row">
    
<div class="col col-8">
    <input class="  btn btn-success"   type="submit" value="إضافة">
</div></div>
</form>
           

 
  


<div class="container">

@php
    $appointments=App\Appointment::where("ActiveType",5)->get();
@endphp






<table class="table bg-dark text-white mt-5">
    <thead>
    
    </thead>
    <tbody>
     
        @foreach ($appointments as $appointment)
        <tr>
            <th scope="row">{{$loop->index+1}}</th>
            <td>{{$appointment->jour}}</td>
            <td>{{$appointment->debut}}</td>
            <td> {{$appointment->fin}}</td>
            <td class="text-left">        <a  class="btn btn-danger "  value="" href="/annulerByAdmin/{{$appointment->id}}">حذف</a>
                <a  class="btn btn-warning "  value="" href="#">تعديل</a>
            </td>
          </tr>
         


        
    
    @endforeach
     
       
     
    </tbody>
  </table>

</div>

 
@stop
