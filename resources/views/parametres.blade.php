
@extends('layouts.master')

@section('title', 'Clients')



@section('content')



<div class="container">
    <div class="row">
        <form action="/settings" method="post">
        @csrf

<input type="text"  name="nom" id="nom">  
<input type="text" name="valeur" id="valeur">     
<input type="submit" class="btn btn-success" value="اضافة">   

        </form>
    </div>
</div>


@foreach ($settings as $item)
    
@endforeach

 

  





@stop