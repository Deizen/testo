<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametro;
use App\Valores;
use DB;


class parametrosController extends Controller
{
    public function registrarValor()
    {
        return view('registrarParametro');
    }
        
    public function guardarParametro(Request $datos)
    {
        $parametro = new Parametro();
        $parametro->nombre=$datos->input('nombre');
        $parametro->medida=$datos->input('medida');
        $parametro->save();

        return Redirect('/consultarParametros');
    }

    public function consultarParametros()
    {
        $parametro=DB::table('parametros')->paginate(15);
        return view('/consultarParametros', compact('parametro'));
    }

    public function eliminarParametro($id){
        $parametro=Parametro::find($id);
        $parametro->delete();

        return Redirect('/consultarParametros');
    }

    public function editarParametro($id){
        $parametro=Parametro::find($id);
        return view('editarParametro',compact('parametro'));
    }
    
      public function actualizarParametro(Request $datos, $id){
        $parametro=Parametro::find($id);

        $parametro->nombre=$datos->input('nombre');
        $parametro->medida=$datos->input('medida');
        $parametro->save();

        return Redirect('/consultarParametros');
    }
}
?>