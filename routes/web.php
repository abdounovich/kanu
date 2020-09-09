<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
Route::get('/rdv','AppointmentController@index');
Route::get('/client/{slug}','ClientController@index');
Route::get('/delete','AppointmentController@deleteFunction');

Route::get('/add','AppointmentController@AddPFunction');


Route::get('/commande', function () {
    return view('commande') ;
});
