<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function (){
    //return view('auth/login');
    return view('layouts/inicio');
});

Route::get('declarante/logeo','DeclaranteController@actionLogeo')->name('logeo');
Route::get('admin/login','AdministradorController@actionLogin2')->name('login2');
Route::get('declaracion/constancia/{expediente}','DeclaracionController@constancia')->name('constancia');
Route::post('declaracion/asigna','DeclaracionController@actionAsigna')->name('asigna');
Route::post('declaracion/valida','DeclaracionController@actionValida')->name('valida');
Route::get('declaracion/descarga/{expediente}','DeclaracionController@descargaconstancia')->name('descarga');
Route::resource('admin/distrito','DistritoController');
Route::resource('declaracion','DeclaracionController');
Route::resource('declarante','DeclaranteController');
Route::resource('seguridad/usuario','UsuarioController');
Route::get('declaracion/asignadeclaracion','DeclaracionController@actionAsigna')->name('asigna');

Route::auth();

Route::get('/home', 'HomeController@index');
