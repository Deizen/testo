@extends('master')

@section('titulo')
@hasrole('admin')
	<h2>Cajas</h2>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
		<table class="table table-hover">
			<thead>
				<th>ID</th>
				<th>Nombre</th>
				<th>Sucursal</th>
				<th>Limite de Efectivo</th>
				<th>
					<a href="{{url('/registrarCaja')}}" class="btn btn-success">Nueva caja</a>
				</th>
			</thead>
			<tbody>
				@foreach($cajas as $c)
					<tr>
						<td>{{$c->id}}</td>
						<td>{{$c->nombre}}</td>
						<td>{{$c->sucursal}}</td>
						<td>{{$c->efectivo_maximo}}</td>
						<td>
							<a href="{{url('/editarCaja')}}/{{$c->id}}" class="btn btn-xs btn-primary">
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>

							<a href="{{url('/eliminarCaja')}}/{{$c->id}}" class="btn btn-danger btn-xs">
								  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
								
						<!--	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data="{{$c->id}}">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button>
						</td>-->
					</tr> 
					<!-- Modal -->
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
					       <a href="{{url('/eliminarUsuario')}}/{{$c->id}}" class="btn btn-danger">Eliminar</a>
					      </div>
					    </div>
					  </div>
					</div>

				@endforeach
				<div class="text-center">
					{{$cajas->links()}}
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