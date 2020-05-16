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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//rutas protegidas
Route::group(['middleware'=>['permisos']], function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/usuarios', 'UsuariosController@index');
    Route::get('/usuarios/crear', 'UsuariosController@crear');
    Route::post('/usuarios/store', 'UsuariosController@guardar');
    Route::get('/usuarios/edit/{id}', 'UsuariosController@edit');
    Route::post('/usuarios/update','UsuariosController@update');
    Route::get('/usuarios/delete/{id}','UsuariosController@eliminar');


});


//rutas de libros
Route::get('/libros','LibrosController@index');
Route::get('/libros/crear','LibrosController@crear');
Route::post('/libros/store','LibrosController@guardar');
Route::get('/libros/edit/{id}','LibrosController@edit')->middleware('permisos_libro');
Route::post('/libros/update','LibrosController@update');
Route::get('/libros/delete/{id}','LibrosController@eliminar')->middleware('permisos_libro');
