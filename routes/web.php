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


Route::get('/add','AppointmentController@AddPFunction');
Route::get('/tester','HomeController@func');

Auth::routes();
Route::match(['get', 'post'], '/botman', 'BotManController@handle')->middleware('auth');;

Route::get('/botman/tinker', 'BotManController@tinker')->middleware('auth');;
Route::get('/rdv','AppointmentController@index')->middleware('auth');;
Route::get('/client/{slug}','ClientController@index')->middleware('auth');;
Route::get('/clients','ClientController@show')->middleware('auth');;

Route::get('/delete','AppointmentController@deleteFunction');
Route::post('/addAppoint','AppointmentController@store');


Route::post('/types','TypeController@store');
Route::get('/types','TypeController@index');
Route::get('/test/{type}/D1/{username}/{Cid}','testController@today');
Route::get('/test/{type}/D2/{username}/{Cid}','testController@tomorrow');
Route::get('/test/{type}/D3/{username}/{Cid}','testController@afterTomorrow');
Route::get('/settings','SettingController@index');
Route::post('/settings','SettingController@store');
Route::post('/settings/{id}','SettingController@update');




Route::post('/test2','testController@sendTextMessage');

Route::post('/test','testController@commande');

Route::get('/delete/{id}','TypeController@supprimer');
Route::get('/edit/{id}','TypeController@edit');
Route::post('/types_edit/{id}','TypeController@update');
Route::get('/actif/{id}/{num}','AppointmentController@actif');
Route::post('/annuler','AppointmentController@Annuler');
Route::get('/annulerByAdmin/{id}','AppointmentController@AnnulerByAdmin');


Route::get('/','HomeController@index');

Route::get('/commande', function () {
    return view('commande') ;
});


Route::get('/t', function () {
    return view('tester') ;
});
Route::get('/abcd','TestController@try');
Route::post('/sendMsg/{id}','ClientController@sendMessageToClient');
Route::get('/sendMsg/{id}','ClientController@sendMessageToClientView');







/* Route::get('/tester', function () {
    return view('tester') ;
}); */


Route::get('/home', 'HomeController@index')->name('home');


