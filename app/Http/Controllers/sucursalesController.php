<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursales;
use DB;


class sucursalesController extends Controller
{

    public function registrarSucursal()
    {
        return view('registrarSucursal');
    }

    public function guardarSucursal(Request $datos)
    {


        $sucursal = new Sucursales();
        $sucursal->nombre=$datos->input('nombre');
        $sucursal->direccion=$datos->input('direccion');
        $sucursal->estado=$datos->input('estado');
        $sucursal->municipio=$datos->input('municipio');
        $sucursal->localidad=$datos->input('localidad');
        $sucursal->telefono=$datos->input('telefono');
        $sucursal->email=$datos->input('email');
        $sucursal->encargado=$datos->input('encargado');
        $sucursal->save();

        return Redirect('/consultarSucursales');
    }

    public function consultarSucursales()
    {
        $sucursales=DB::table('sucursales')->paginate(15);
        return view('/consultarSucursales', compact('sucursales'));
    }

    public function eliminarSucursal($id){
        $sucursal=Sucursales::find($id);
        $sucursal->delete();

        return Redirect('/consultarSucursales');
    }

    public function editarSucursal($id){
        $sucursal=Sucursales::find($id);
        return view('editarSucursal',compact('sucursal'));
    }

    public function actualizarSucursal(Request $datos, $id){
        $sucursal=Sucursales::find($id);

        $sucursal->nombre=$datos->input('nombre');
        $sucursal->direccion=$datos->input('direccion');
        $sucursal->estado=$datos->input('estado');
        $sucursal->municipio=$datos->input('municipio');
        $sucursal->localidad=$datos->input('localidad');
        $sucursal->telefono=$datos->input('telefono');
        $sucursal->email=$datos->input('email');
        $sucursal->encargado=$datos->input('encargado');
        $sucursal->save();

        return Redirect('/consultarSucursales');
    }

}

?>
