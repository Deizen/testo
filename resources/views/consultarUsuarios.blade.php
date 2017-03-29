@extends('master')

@section('titulo')
	<h2>Usuarios</h2>
@stop

@section('contenido')
	<div class="col-xs-12">
		<table class="table table-hover">
			<thead>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Rol</th>
				<th>Descuento Max.</th>
				<th>
					<a href="{{url('/registrarUsuario')}}" class="btn btn-success">Nuevo usuario</a>
				</th>
			</thead>
			<tbody>
				@foreach($usuarios as $u)
					<tr>
						<td>{{$u->id}}</td>
						<td>{{$u->name}}</td>
						<td>{{$u->email}}</td>
						<td>{{$u->role}}</td>
						<td>{{$u->descuento_maximo}}</td>
						<td>
							<a href="{{url('/editarUsuario')}}/{{$u->id}}" class="btn btn-xs btn-primary">
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>

							<a href="{{url('/eliminarUsuario')}}/{{$u->id}}" class="btn btn-danger btn-xs">
								  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
								
						<!--	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data="{{$u->id}}">
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
					       <a href="{{url('/eliminarUsuario')}}/{{$u->id}}" class="btn btn-danger">Eliminar</a>
					      </div>
					    </div>
					  </div>
					</div>

				@endforeach
				<div class="text-center">
					{{$usuarios->links()}}
				</div>
			</tbody>
		</table>
	</div>

@stop