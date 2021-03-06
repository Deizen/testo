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

//Sucursales

Route::get('/consultarSucursales','sucursalesController@consultarSucursales');

Route::get('/registrarSucursal','sucursalesController@registrarSucursal');

Route::post('/guardarSucursal','sucursalesController@guardarSucursal');

Route::get('/eliminarSucursal/{id}','sucursalesController@eliminarSucursal');

Route::get('/editarSucursal/{id}','sucursalesController@editarSucursal');

Route::post('/actualizarSucursal/{id}','sucursalesController@actualizarSucursal');

//Clientes

Route::get('/consultarClientes','clientesController@consultarClientes');

Route::get('/registrarCliente','clientesController@registrarCliente');

Route::post('/guardarCliente','clientesController@guardarCliente');

Route::get('/eliminarCliente/{id}','clientesController@eliminarCliente');

Route::get('/editarCliente/{id}','clientesController@editarCliente');

Route::post('/actualizarCliente/{id}','clientesController@actualizarCliente');

//Cajas

Route::get('/consultarCajas','cajasController@consultarCajas');

Route::get('/registrarCaja','cajasController@registrarCaja');

Route::post('/guardarCaja','cajasController@guardarCaja');

Route::get('/eliminarCaja/{id}','cajasController@eliminarCaja');

Route::get('/editarCaja/{id}','cajasController@editarCaja');

Route::post('/actualizarCaja/{id}','cajasController@actualizarCaja');

//Pacientes

Route::get('/consultarPacientes','pacientesController@consultarPacientes');

Route::get('/registrarPaciente','pacientesController@registrarPaciente');

Route::post('/guardarPaciente','pacientesController@guardarPaciente');

Route::get('/eliminarPaciente/{id}','pacientesController@eliminarPaciente');

Route::get('/editarPaciente/{id}','pacientesController@editarPaciente');

Route::post('/actualizarPaciente/{id}','pacientesController@actualizarPaciente');

Route::get('/pacientesPDF', 'pacientesController@pacientesPDF');

//Parametros

Route::get('/consultarParametros','parametrosController@consultarParametros');

Route::get('/registrarParametro','parametrosController@registrarParametro');

Route::post('/guardarParametro','parametrosController@guardarParametro');

Route::get('/eliminarParametro/{id}','parametrosController@eliminarParametro');

Route::get('/editarParametro/{id}','parametrosController@editarParametro');

Route::post('/actualizarParametro/{id}','parametrosController@actualizarParametro');

//Valores

Route::get('/consultarValoresReferencia','valoresController@consultarValoresReferencia');

Route::get('/registrarValorReferencia','valoresController@registrarValorReferencia');

Route::post('/guardarValorReferencia','valoresController@guardarValorReferencia');

Route::get('/eliminarValorReferencia/{id}','valoresController@eliminarValorReferencia');

Route::get('/editarValorReferencia/{id}','valoresController@editarValorReferencia');

Route::post('/actualizarValorReferencia/{id}','valoresController@actualizarValorReferencia');

//Examenes
Route::get('/registrarExamen','examenesController@registrarExamen');

Route::get('/consultarExamenes','examenesController@consultarExamenes');

Route::get('/home', function () 
{
    return view('home');
});
