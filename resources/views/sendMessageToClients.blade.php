
@extends('layouts.master')

@section('title', 'Clients')



@section('content')



<div class="container">
    <div class="row">

             <form action="/sendMsg" method="post">
        @csrf
        <div class="form-group">


<div class="form-group">
    <label for="message">محتوى الرسالة </label>
    <textarea class="form-control"  name="message" id="message"  rows="3"></textarea>
  </div>
<input type="submit" class="btn btn-success p-2 m-2" value="أرسال ">   
        </div>

        </form>
      
    </div>
</div>








 

  





@stop