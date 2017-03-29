@extends ('master')

@section('titulo')
	<h2>Configuracion empresa</h2>
	<hr>
@stop

@section('contenido')
	<div class="col-xs-12">
		<form action="{{url('/actualizarEmpresa')}}/{{1}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token() }}">
			<div class="form-group">
				<label for="nombre">Nombre:</label>
				<input name="nombre" type="text" value="{{$Empresa->nombre}}" placeholder="Teclea nombre" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="edad">RFC:</label>
				<input name="edad" type="text" value="{{$Empresa->rfc}}" placeholder="Teclea RFC" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="edad">Direccion:</label>
				<input name="edad" type="text" value="{{$Empresa->direccion}}" placeholder="Teclea Direccion" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="edad">Estado:</label>
				<input name="edad" type="text" value="{{$Empresa->estado}}" placeholder="Teclea Estado" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="edad">Municipio:</label>
				<input name="edad" type="text" value="{{$Empresa->municipio}}" placeholder="Teclea Municipio" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="edad">Localidad:</label>
				<input name="edad" type="text" value="{{$Empresa->localidad}}" placeholder="Teclea Localidad" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="edad">Email:</label>
				<input name="edad" type="email" value="{{$Empresa->email}}" placeholder="Teclea email" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="correo">Telefono:</label>
				<input name="correo" type="number" value="{{$Empresa->telefono}}" placeholder="Teclea telefono" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="edad">Codigo Postal:</label>
				<input name="edad" type="number" value="{{$Empresa->codigo_postal}}" placeholder="Teclea CP" class="form-control" required>
			</div>
			<button type="submit" class="btn btn-primary">Actualizar</button>
			<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>						
		</form>
	</div>
@stop