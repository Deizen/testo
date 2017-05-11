@extends('master')

@section('titulo')
@hasrole('admin')
	<h2>Pacientes</h2>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
<link rel="stylesheet" href="{{asset("css/style.css")}}">
	<div class="col-xs-">
		<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th >ID</th>
				<th >Nombre</th>
				<th >Edad</th>
				<th >Telefono</th>
				<th >Email</th>
				<th >Detalles</th>
				<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($pacientes as $p)
					<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->nombre. " " . $p->apellido_P . " " . $p->apellido_M}}</td>
						<td>{{date('Y-m-d') - $p->fecha_Nac}}</td>
						<td>{{$p->telefono}}</td>
						<td>{{$p->email}}</td>
						<td onmouseover="this.select()">{{$p->direccion. ", " . $p->municipio . ", " . $p->estado}}</td>
						<td>
						<a href="{{url('/editarPaciente')}}/{{$p->id}}" class="btn btn-xs btn-info">
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>

							<a href="{{url('/eliminarPaciente')}}/{{$p->id}}" class="btn btn-danger btn-xs">
								  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
					</tr> 
				@endforeach
				<div class="text-center">
					{{$pacientes->links()}}
				</div>
			</tbody>
		</table>
		<div style="text-align: center;">
		<input type="button" a href="{{url('/registrarPaciente')}}" class="btn btn-primary btn-smn" value="Agregar Paciente">
		</div>
	</div>
@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole

@stop