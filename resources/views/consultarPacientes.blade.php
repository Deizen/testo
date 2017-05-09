@extends('master')

@section('titulo')
@hasrole('admin')
	<h2>Pacientes</h2>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
		<table class="table table-hover">
			<thead>
				<th>ID</th>
				<th>Nombre</th>
				<th>Apellido Paterno</th>
				<th>Apellido Materno</th>
				<th>Sexo</th>
				<th>Fecha de Nacimiento</th>
				<th>Telefono</th>
				<th>Email</th>
				<th>Direccion</th>
				<th>Estado</th>
				<th>Municipio</th>
				<th>Localidad</th>
				<th>
					<a href="{{url('/registrarPaciente')}}" class="btn btn-success">Nuevo Paciente</a>
				</th>
			</thead>
			<tbody>
				@foreach($pacientes as $p)
					<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->nombre}}</td>
						<td>{{$p->apellido_P}}</td>
						<td>{{$p->apellido_M}}</td>
						<td>{{$p->sexo}}</td>
						<td>{{$p->fecha_Nac}}</td>
						<td>{{$p->telefono}}</td>
						<td>{{$p->email}}</td>
						<td>{{$p->direccion}}</td>
						<td>{{$p->estado}}</td>
						<td>{{$p->municipio}}</td>
						<td>{{$p->localidad}}</td>
						<td>
						<a href="{{url('/editarPaciente')}}/{{$p->id}}" class="btn btn-xs btn-primary">
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
	</div>

@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole

@stop