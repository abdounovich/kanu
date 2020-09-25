
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

<div class="container">
    <div class="row">
        <div class="col">
            @foreach ($settings as $setting)
        <div><h2>{{$setting->nom}}->>{{$setting->valeur}}</h2></div>
            @endforeach
        </div>
    </div>
</div>

 

  





@stop