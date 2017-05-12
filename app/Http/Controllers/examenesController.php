<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examenes;
use DB;


class examenesController extends Controller
{

    public function registrarExamen()
    {
        return view('registrarExamen');
    }

    public function guardarExamen(Request $datos)
    {


        $examen = new Examenes();
        $sucursal->nombre=$datos->input('nombre');
        $sucursal->save();

        return Redirect('/consultarExamenes');
    }

    public function consultarExamenes()
    {
        $examenes=DB::table('examenes')->paginate(15);
        return view('/consultarExamenes', compact('examenes'));
    }

    public function eliminarExamen($id){
        $sucursal=Sucursales::find($id);
        $sucursal->delete();

        return Redirect('/consultarExamenes');
    }

    public function editarExamen($id){
        $sucursal=Sucursales::find($id);
        return view('editarSucursal',compact('sucursal'));
    }

    public function actualizarExamen(Request $datos, $id){
        $sucursal=Sucursales::find($id);

        $sucursal->nombre=$datos->input('nombre');
        $sucursal->save();

        return Redirect('/consultarExamenes');
    }

}

?>
