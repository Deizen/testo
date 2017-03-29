<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DatosEmpresa;
use DB;

class datosEmpresaController extends Controller
{


    public function editarEmpresa(){
        $Empresa=Empresa::find(1);
        return view('editarEmpresa',compact('Empresa'));
    }

    public function actualizarEmpresa(Request $datos, $id){
        $Empresa==Empresa::find($id);
        $Empresa->nombre=$datos->input('nombre');
        $Empresa->rfc=$datos->input('rfc');
        $Empresa->direccion=$datos->input('direccion');
        $Empresa->estadp=$datos->input('estado');
        $Empresa->municipio=$datos->input('municipio');
        $Empresa->localidad=$datos->input('localidad');
        $Empresa->email=$datos->input('email');
        $Empresa->telefono=$datos->input('telefono');
        $Empresa->codigo_postal=$datos->input('codigo_postal');
        $Empresa->save();

        return Redirect('/configEmpresa');
    }

}

?>
