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
Route::get('/clients','ClientController@show');

Route::get('/delete','AppointmentController@deleteFunction');

Route::get('/add','AppointmentController@AddPFunction');
Route::post('/types','TypeController@store');
Route::get('/types','TypeController@index');
Route::get('/test','testController@index');
Route::post('/test','testController@commande');

Route::get('/delete/{id}','TypeController@supprimer');
Route::get('/edit/{id}','TypeController@edit');
Route::post('/types_edit/{id}','TypeController@update');
Route::get('/','HomeController@index');
Route::get('/commande', function () {
    return view('commande') ;
});
