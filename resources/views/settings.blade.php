
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




 

  





@stop