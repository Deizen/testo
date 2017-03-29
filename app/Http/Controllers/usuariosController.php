<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Illuminate\Support\Facades\Hash;

class usuariosController extends Controller
{

    public function registrarUsuario()
    {
        $roles=DB::select('SELECT * FROM roles');
    	return view('registrarUsuario', compact('roles'));
    }

    public function guardarUsuario(Request $datos)
    {

        $hash = bcrypt($datos->input('password'));
		$usuario = new User();
		$usuario->name=$datos->input('name');
		$usuario->email=$datos->input('email');
		$usuario->password=$hash;
        $usuario->role=$datos->get('role');
		$usuario->descuento_maximo=$datos->input('descuento_maximo');
		$usuario->save();

        //asignar rol
        $usuario->assignRole($datos->input('role'));


		return Redirect('/consultarUsuarios');
    }

    public function consultarUsuarios()
    {
        $usuarios=DB::table('users')->paginate(15);
    	return view('consultarUsuarios', compact('usuarios'));
    }

    public function eliminarUsuario($id){
        $usuario=User::find($id);
        $usuario->delete();

        return Redirect('/consultarUsuarios');
    }

    public function editarUsuario($id){
        $usuario=User::find($id);
        $roles=DB::select('SELECT * FROM roles');



        return view('editarUsuario',compact('usuario'), compact('roles'));
    }

    public function actualizarUsuario(Request $datos, $id){
        $usuario=User::find($id);

        if($datos->input('password')!=""){
            $hash = bcrypt($datos->input('password'));
            $usuario->password=$hash;
        }

        $usuario->name=$datos->input('name');
        $usuario->email=$datos->input('email');        
        $usuario->role=$datos->get('role');
        $usuario->descuento_maximo=$datos->input('descuento_maximo');
        $usuario->save();

        //asignar rol
        if(!$usuario->hasRole($datos->input('role'))){
            $usuario->syncRoles([$datos->input('role')]);
        }
        

        return Redirect('/consultarUsuarios');
    }
}

?>
