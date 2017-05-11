@extends('master')

@section('titulo')
@hasrole('admin')
	<div>
		<h2 style="float: left;">Pacientes
		</h2>
		<div style="float: right; position: relative; top: 10px;">
			<a href="{{url('/registrarPaciente')}}" class="btn btn-primary">Agregar</a>
		</div>
	</div>
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
						<td id="details">{{$p->direccion. ", " . $p->municipio . ", " . $p->estado}}</td>
						<td>
							<a href="{{url('/editarPaciente')}}/{{$p->id}}" class="btn btn-xs btn-info" title="Editar" >
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>
								<button type="button" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="modal" data-target="#myModal" data="{{$p->id}}">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</button>
						</td>

					</tr> 
					
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        	<span aria-hidden="true">&times;
					        	</span>
					        </button>
					        <h4 class="modal-title" id="myModalLabel">¿Desear eliminar a {{$p->nombre. " " . $p->apellido_P . " " . $p->apellido_M}}?</h4>
					      </div>
					      <div class="modal-body">
					        ¡El paciente sera eliminado de la lista y no podra ser recuperado!
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					       <a href="{{url('/eliminarPaciente')}}/{{$p->id}}" class="btn btn-danger">Eliminar</a>
					      </div>
					    </div>
					  </div>
					</div>

				@endforeach
			</tbody>
		</table>
	<div class="text-center">
		{{$pacientes->links()}}
	</div>
	</div>
@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole

@stop