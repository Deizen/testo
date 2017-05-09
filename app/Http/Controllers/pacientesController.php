<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacientes;
use DB;

class pacientesController extends Controller
{
    public function registrarPaciente()
    {
    	return view('registrarPaciente');
    }

    public function consultarPacientes()
    {
		$pacientes=DB::table('paciente')->paginate(15);
        return view('/consultarPacientes', compact('pacientes'));
    }

    public function guardarPaciente(Request $datos)
    {
        $fecha_Nac = $datos->año . "-" . $datos->mes . "-" . $datos->dia;
        $pacientes = new pacientes();
    	$pacientes->nombre=$datos->input('nombre');
        $pacientes->apellido_P=$datos->input('apellido_P');
        $pacientes->apellido_M=$datos->input('apellido_M');
        $pacientes->sexo=$datos->input('sexo');
        $pacientes->fecha_Nac=$fecha_Nac;
        $pacientes->telefono=$datos->input('telefono');  
        $pacientes->email=$datos->input('email');
        $pacientes->direccion=$datos->input('direccion');  
        $pacientes->estado=$datos->input('estado');   
        $pacientes->municipio=$datos->input('municipio'); 
        $pacientes->localidad=$datos->input('localidad');
        $pacientes->save();

        return Redirect('/consultarPacientes');
    }
}
