<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Carrera;
use DB;

class alumnosController extends Controller
{
    public function registrarAlumnos()
    {
    	return view('registrarAlumno');
    }

    public function guardarAlumno(Request $datos)
    {
		$alumno = new Alumno();
		$alumno->nombre=$datos->input('nombre');
		$alumno->edad=$datos->input('edad');
		$alumno->sexo=$datos->input('sexo');
		$alumno->id_carrera=$datos->input('id_carrera');
		$alumno->correo=$datos->input('correo');
		$alumno->save();

		return Redirect('/registrarAlumnos');
    }

    public function consultarAlumnos()
    {
        $alumnos=DB::table('alumnos')
                ->join('carreras', 'alumnos.id_carrera','=','carreras.id')
                ->select('alumnos.*', 'carreras.nombre AS carrera')
                ->paginate(5);
    	//$alumnos=Alumno::paginate(3);
    	return view('consultarAlumnos', compact('alumnos'));
    }

    public function eliminarAlumno($id){
        $alumno=Alumno::find($id);
        $alumno->delete();

        return Redirect('/consultarAlumnos');
    }

    public function editarAlumno($id){
        $alumno=Alumno::find($id);
        return view('editarAlumno',compact('alumno'));
    }

    public function actualizarAlumno(Request $datos, $id){
        $alumno==Alumno::find($id);
        $alumno->nombre=$datos->input('nombre');
        $alumno->edad=$datos->input('edad');
        $alumno->sexo=$datos->input('sexo');
        $alumno->id_carrera=$datos->input('id_carrera');
        $alumno->correo=$datos->input('correo');
        $alumno->save();

        return Redirect('/consultarAlumnos');
    }
}

?>
