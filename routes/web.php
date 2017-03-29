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

Route::get('/registrarAlumnos','alumnosController@registrarAlumnos');

Route::get ('grupo2', function() 
{ 
		return view('grupo2/home');
});

Route::post('/guardarAlumno','alumnosController@guardarAlumno');

Route::get('/eliminarAlumno/{id}','alumnosController@eliminarAlumno');

Route::get('/consultarAlumnos','alumnosController@consultarAlumnos');

Route::get('/editarAlumno/{id}','alumnosController@editarAlumno');

Route::get('actualizarAlumno/{id}','alumnosController@actualizarAlumno');
Auth::routes();

Route::get('/home', 'HomeController@index');
