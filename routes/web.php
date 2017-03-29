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

Route::get('/', function () 
{
    return view('home');
});

//Configuracion de empresa

Route::get('/editarEmpresa/','editarEmpresaController@editarEmpresa');

Route::post('/actualizarEmpresa/','editarEmpresaController@actualizarEmpresa');

//Usuarios

Route::get('/consultarUsuarios','usuariosController@consultarUsuarios');

Route::get('/registrarUsuario','usuariosController@registrarUsuario');

Route::post('/guardarUsuario','usuariosController@guardarUsuario');

Route::get('/eliminarUsuario/{id}','usuariosController@eliminarUsuario');

Route::get('/editarUsuario/{id}','usuariosController@editarUsuario');

Route::post('/actualizarUsuario/{id}','usuariosController@actualizarUsuario');
Auth::routes();


Route::get('/home', function () 
{
    return view('home');
});
