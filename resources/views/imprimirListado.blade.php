@extends ('master')

@section ('titulo')
@hasrole ('admin')

	<h2>Imprimir Listado de Pacientes</h2>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')

		<div class="form-group">
			<label for="empresa">Empresa:</label>
			<select name="empresa" class="form-control" required autofocus>
			<option value="" selected>Seleccione Empresa</option>
			@foreach($empresas as $e)
				<option value="{{$e->id}}">{{$e->nombre}}</option>
			@endforeach
			</select>
		</div>