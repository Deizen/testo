@extends('master')

@section('titulo')
@hasrole('admin')
	<h2>Parametros</h2>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
		<table class="table table-hover">
			<thead>
				<th>ID</th>
				<th>Nombre</th>
                                <th>Medida</th>
				<th>
					<a href="{{url('/registrarParametro')}}" class="btn btn-success">Nuevo parametro</a>
				</th>
			</thead>
			<tbody>
				@foreach($parametro as $p)
					<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->nombre}}</td>
                                                <td>{{$p->medida}}</td>
						<td>
							<a href="{{url('/editarParametro')}}/{{$p->id}}" class="btn btn-xs btn-primary">
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>

							<a href="{{url('/eliminarParametro')}}/{{$p->id}}" class="btn btn-danger btn-xs">
								  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
                                                </td>
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
					        <h4 class="modal-title" id="myModalLabel">¿Deseas eliminar el parametro?</h4>
					      </div>
					      <div class="modal-body">
					        ¡No se podrá recuperar el registro!
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					       <a href="{{url('/eliminarParametro')}}/{{$p->id}}" class="btn btn-danger">Eliminar</a>
					      </div>
					    </div>
					  </div>
					</div>

				@endforeach
				<div class="text-center">
					{{$parametro->links()}}
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