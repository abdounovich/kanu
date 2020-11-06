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
Route::match(['get', 'post'], '/botman', 'BotManController@handle')->middleware('auth');

Route::get('/botman/tinker', 'BotManController@tinker')->middleware('auth');
Route::get('/rdv','AppointmentController@index')->middleware('auth');
Route::get('/client/{slug}','ClientController@index')->middleware('auth');
Route::get('/clients','ClientController@show')->middleware('auth');

Route::get('/delete','AppointmentController@deleteFunction')->middleware('auth');
Route::post('/addAppoint','AppointmentController@store')->middleware('auth');

Route::post('/types','TypeController@store')
->middleware('auth');
Route::get('/types','TypeController@index')
->middleware('auth');
Route::get('/test/{type}/D1/{username}/{Cid}','testController@today')
;
Route::get('/test/{type}/D2/{username}/{Cid}','testController@tomorrow')
;
Route::get('/test/{type}/D3/{username}/{Cid}','testController@afterTomorrow')
;
Route::get('/settings','SettingController@index')
->middleware('auth');
Route::post('/settings','SettingController@store')
->middleware('auth');
Route::post('/settings/{id}','SettingController@update')
->middleware('auth');




Route::post('/test2','testController@sendTextMessage')
->middleware('auth');

Route::post('/test','testController@commande')
->middleware('auth');

Route::get('/delete/{id}','TypeController@supprimer')
->middleware('auth');
Route::get('/edit/{id}','TypeController@edit')
->middleware('auth');
Route::post('/types_edit/{id}','TypeController@update')
->middleware('auth');
Route::get('/actif/{id}/{num}','AppointmentController@actif')
->middleware('auth');
Route::post('/annuler','AppointmentController@Annuler')
->middleware('auth');
Route::get('/annulerByAdmin/{id}','AppointmentController@AnnulerByAdmin')
->middleware('auth');


Route::get('/','HomeController@index')
->middleware('auth');

Route::get('/commande', function () {
    return view('commande') ;
});


Route::get('/t', function () {
    return view('tester') ;
});
Route::get('/abcd','TestController@try');
Route::post('/sendMsg/{id}','ClientController@sendMessageToClient')
->middleware('auth');
Route::get('/sendMsg/{id}','ClientController@sendMessageToClientView')
->middleware('auth');







/* Route::get('/tester', function () {
    return view('tester') ;
}); */


Route::get('/home', 'HomeController@index')->name('home');


