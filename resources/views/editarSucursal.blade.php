@extends ('master')

@section('titulo')
	<h2>Editar Sucursal</h2>
	<hr>
@stop

@section('contenido')
	<div class="col-xs-12">
		<form action="{{url('/actualizarSucursal')}}/{{$sucursal->id}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token() }}">


			<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
				<label for="nombre">Nombre:</label>
				<input name="nombre" type="text" value="{{$sucursal->nombre}}" placeholder="Teclea nombre" class="form-control" required autofocus>
				@if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
				<label for="direccion">Direccion:</label>
				<input name="direccion" type="text" value="{{$sucursal->direccion}}" placeholder="Teclea direccion" class="form-control" required autofocus>
				@if ($errors->has('direccion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('direccion') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
				<label for="estado">Estado:</label>
				<input name="estado" type="text" value="{{$sucursal->estado}}" placeholder="Teclea estado" class="form-control" required autofocus>
				@if ($errors->has('estado'))
                    <span class="help-block">
                        <strong>{{ $errors->first('estado') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
				<label for="municipio">Municipio:</label>
				<input name="municipio" type="text" value="{{$sucursal->municipio}}" placeholder="Teclea municipio" class="form-control" required autofocus>
				@if ($errors->has('municipio'))
                    <span class="help-block">
                        <strong>{{ $errors->first('municipio') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('localidad') ? ' has-error' : '' }}">
				<label for="localidad">Localidad:</label>
				<input name="localidad" type="text" value="{{$sucursal->localidad}}" placeholder="Teclea localidad" class="form-control" required autofocus>
				@if ($errors->has('localidad'))
                    <span class="help-block">
                        <strong>{{ $errors->first('localidad') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
				<label for="telefono">Telefono:</label>
				<input name="telefono" type="number" value="{{$sucursal->telefono}}" placeholder="Teclea telefono" class="form-control" required autofocus>
				@if ($errors->has('telefono'))
                    <span class="help-block">
                        <strong>{{ $errors->first('telefono') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email">Email:</label>
				<input name="email" type="email" value="{{$sucursal->email}}" placeholder="Teclea Email" class="form-control" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('encargado') ? ' has-error' : '' }}">
				<label for="encargado">Encargado:</label>
				<input name="encargado" type="text" value="{{$sucursal->encargado}}" placeholder="Teclea encargado" class="form-control" required autofocus>
				@if ($errors->has('encargado'))
                    <span class="help-block">
                        <strong>{{ $errors->first('encargado') }}</strong>
                    </span>
                @endif
			</div>

			<button type="submit" class="btn btn-primary">Actualizar</button>
			<a href="{{url('/consultarSucursales')}}" class="btn btn-danger">Cancelar</a>						
		</form>
	</div>
@stop