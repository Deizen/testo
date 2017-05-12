@extends('master')

@section('titulo')
@hasrole('admin')
	<h2>Examenes</h2>
@endhasrole
@stop



@section('contenido')

@hasrole('admin')
	<div class="col-xs-12">
		<table class="table table-hover">
			<thead>
				<th>ID</th>
				<th>Nombre</th>
					<a href="{{url('/registrarExamen')}}" class="btn btn-success">Nuevo Examen</a>
				</th>
			</thead>
			<tbody>
				@foreach($examenes as $e)
					<tr>
						<td>{{$e->id}}</td>
						<td>{{$e->nombre}}</td>
						<td>
							<a href="{{url('/editarSucursal')}}/{{$s->id}}" class="btn btn-xs btn-primary">
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>

							<a href="{{url('/eliminarSucursal')}}/{{$s->id}}" class="btn btn-danger btn-xs">
								  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
								
						<!--	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data="{{$s->id}}">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button>
						</td>-->
					</tr> 
					<!-- Modal 
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        	<span aria-hidden="true">&times;
					        	</span>
					        </button>
					        <h4 class="modal-title" id="myModalLabel">¿Deseas eliminar el usuario?</h4>
					      </div>
					      <div class="modal-body">
					        ¡No se podrá recuperar el registro!
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					       <a href="{{url('/eliminarSucursal')}}/{{$s->id}}" class="btn btn-danger">Eliminar</a>
					      </div>
					    </div>
					  </div>
					</div>-->

				@endforeach
				<div class="text-center">
					{{$examenes->links()}}
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