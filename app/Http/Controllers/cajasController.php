<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cajas;
use DB;


class cajasController extends Controller
{

    public function registrarCaja()
    {
        $sucursales=DB::select('SELECT * FROM sucursales');
        return view('registrarCaja', compact('sucursales'));
    }

    public function guardarCaja(Request $datos)
    {


        $caja = new Cajas();
        $caja->nombre=$datos->input('nombre');
        $caja->sucursal=$datos->get('sucursal');
        $caja->efectivo_maximo=$datos->input('efectivo_maximo');
        $caja->save();

        return Redirect('/consultarCajas');
    }

    public function consultarCajas()
    {
        $cajas=DB::table('cajas')->paginate(15);
        return view('/consultarCajas', compact('cajas'));
    }

    public function eliminarCaja($id){
        $caja=Cajas::find($id);
        $caja->delete();

        return Redirect('/consultarCaja');
    }

    public function editarCaja($id){
        $caja=Cajas::find($id);
        $sucursales=DB::select('SELECT * FROM sucursales');
        return view('editarCaja',compact('caja'), compact('sucursales'));
    }

    public function actualizarCaja(Request $datos, $id){
        $caja=Cajas::find($id);

        $caja->nombre=$datos->input('nombre');
        $caja->sucursal=$datos->get('sucursal');
        $caja->efectivo_maximo=$datos->input('efectivo_maximo');
        $caja->save();

        return Redirect('/consultarCajas');
    }

}

?>
