<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use DB;


class clientesController extends Controller
{

    public function registrarCliente()
    {
        return view('registrarCliente');
    }

    public function guardarCliente(Request $datos)
    {


        $cliente = new Clientes();
        $cliente->nombre=$datos->input('nombre');
        $cliente->rfc=$datos->input('rfc');
        $cliente->direccion=$datos->input('direccion');
        $cliente->estado=$datos->input('estado');
        $cliente->municipio=$datos->input('municipio');
        $cliente->localidad=$datos->input('localidad');
        $cliente->telefono=$datos->input('telefono');
        $cliente->email=$datos->input('email');
        $cliente->codigo_postal=$datos->input('codigo_postal');
        $cliente->descuento=$datos->input('descuento');
        $cliente->direccion_entrega=$datos->input('direccion_entrega');
        $cliente->contacto=$datos->input('contacto');
        $cliente->email_contacto=$datos->input('email_contacto');
        $cliente->telefono_contacto=$datos->input('telefono_contacto');
        $cliente->extension_contacto=$datos->input('extension_contacto');
        $cliente->save();

        return Redirect('/consultarClientes');
    }

    public function consultarClientes()
    {
        $clientes=DB::table('clientes')->paginate(15);
        return view('/consultarClientes', compact('clientes'));
    }

    public function eliminarCliente($id){
        $cliente=Clientes::find($id);
        $cliente->delete();

        return Redirect('/consultarClientes');
    }

    public function editarCliente($id){
        $cliente=Clientes::find($id);
        return view('editarCliente',compact('cliente'));
    }

    public function actualizarCliente(Request $datos, $id){
        $cliente=Clientes::find($id);

        $cliente->nombre=$datos->input('nombre');
        $cliente->rfc=$datos->input('rfc');
        $cliente->direccion=$datos->input('direccion');
        $cliente->estado=$datos->input('estado');
        $cliente->municipio=$datos->input('municipio');
        $cliente->localidad=$datos->input('localidad');
        $cliente->telefono=$datos->input('telefono');
        $cliente->email=$datos->input('email');
        $cliente->codigo_postal=$datos->input('codigo_postal');
        $cliente->descuento=$datos->input('descuento');
        $cliente->direccion_entrega=$datos->input('direccion_entrega');
        $cliente->contacto=$datos->input('contacto');
        $cliente->email_contacto=$datos->input('email_contacto');
        $cliente->telefono_contacto=$datos->input('telefono_contacto');
        $cliente->extension_contacto=$datos->input('extension_contacto');
        $cliente->save();

        return Redirect('/consultarClientes');
    }

}

?>
