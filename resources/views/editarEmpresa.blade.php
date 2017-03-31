@extends ('master')

@section('titulo')
@hasrole('admin')
	<h2>Configuracion de empresa</h2>
	<hr>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
		<form action="{{url('/actualizarEmpresa')}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token() }}">
			<div class="form-group">
				<label for="nombre">Nombre:</label>
				<input name="nombre" type="text" value="{{$Empresa->nombre}}" placeholder="Teclea nombre" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="rfc">RFC:</label>
				<input name="rfc" type="text" value="{{$Empresa->rfc}}" placeholder="Teclea RFC" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="direccion">Direccion:</label>
				<input name="direccion" type="text" value="{{$Empresa->direccion}}" placeholder="Teclea Direccion" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="estado">Estado:</label>
				<input name="estado" type="text" value="{{$Empresa->estado}}" placeholder="Teclea Estado" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="municipio">Municipio:</label>
				<input name="municipio" type="text" value="{{$Empresa->municipio}}" placeholder="Teclea Municipio" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="localidad">Localidad:</label>
				<input name="localidad" type="text" value="{{$Empresa->localidad}}" placeholder="Teclea Localidad" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input name="email" type="email" value="{{$Empresa->email}}" placeholder="Teclea email" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="telefono">Telefono:</label>
				<input name="telefono" type="number" value="{{$Empresa->telefono}}" placeholder="Teclea telefono" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="codigo_postal">Codigo Postal:</label>
				<input name="codigo_postal" type="number" value="{{$Empresa->codigo_postal}}" placeholder="Teclea CP" class="form-control" required>
			</div>
			<button type="submit" class="btn btn-primary">Actualizar</button>
			<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>						
		</form>
	</div>

@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole

@stop