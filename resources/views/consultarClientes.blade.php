@extends('master')

@section('titulo')
@hasrole('admin')
	<h2>Clientes</h2>
@endhasrole
@stop



@section('contenido')

@hasrole('admin')
	<div class="col-xs-12">
		<table class="table table-hover">
			<thead>
				<th>ID</th>
				<th>Nombre</th>
				<th>Direccion</th>
				<th>Estado</th>
				<th>Municipio</th>
				<th>Telefono</th>
				<th>Contacto</th>
				<th>Email Contacto</th>
				<th>Telefono Contacto</th>
				<th>
					<a href="{{url('/registrarCliente')}}" class="btn btn-success">Nuevo cliente</a>
				</th>
			</thead>
			<tbody>
				@foreach($clientes as $c)
					<tr>
						<td>{{$c->id}}</td>
						<td>{{$c->nombre}}</td>
						<td>{{$c->direccion}}</td>
						<td>{{$c->estado}}</td>
						<td>{{$c->municipio}}</td>
						<td>{{$c->telefono}}</td>
						<td>{{$c->contacto}}</td>
						<td>{{$c->email_contacto}}</td>
						<td>{{$c->telefono_contacto}}</td>
						<td>
							<a href="{{url('/editarCliente')}}/{{$c->id}}" class="btn btn-xs btn-primary">
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>

							<a href="{{url('/eliminarCliente')}}/{{$c->id}}" class="btn btn-danger btn-xs">
								  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
								
						<!--	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data="{{$c->id}}">
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
					       <a href="{{url('/eliminarSucursal')}}/{{$c->id}}" class="btn btn-danger">Eliminar</a>
					      </div>
					    </div>
					  </div>
					</div>-->

				@endforeach
				<div class="text-center">
					{{$clientes->links()}}
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