@extends ('master')

@section('titulo')
@hasrole('admin')
	<h2>Editar Cliente</h2>
	<hr>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')
	<div class="col-xs-12">
		<form action="{{url('/actualizarCliente')}}/{{$cliente->id}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token() }}">


			<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
				<label for="nombre">Nombre de tu jefa:</label>
				<input name="nombre" type="text" value="{{$cliente->nombre}}" placeholder="Teclea nombre" class="form-control" required autofocus>
				@if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('rfc') ? ' has-error' : '' }}">
				<label for="rfc">RFC:</label>
				<input name="rfc" type="text" value="{{$cliente->rfc}}" placeholder="Teclea RFC" class="form-control" required autofocus>
				@if ($errors->has('rfc'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rfc') }}</strong>
                    </span>
                @endif
			</div>


			<div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
				<label for="direccion">Direccion:</label>
				<input name="direccion" type="text" value="{{$cliente->direccion}}" placeholder="Teclea direccion" class="form-control" required autofocus>
				@if ($errors->has('direccion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('direccion') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
				<label for="estado">Estado:</label>
				<input name="estado" type="text" value="{{$cliente->estado}}" placeholder="Teclea estado" class="form-control" required autofocus>
				@if ($errors->has('estado'))
                    <span class="help-block">
                        <strong>{{ $errors->first('estado') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
				<label for="municipio">Municipio:</label>
				<input name="municipio" type="text" value="{{$cliente->municipio}}" placeholder="Teclea municipio" class="form-control" required autofocus>
				@if ($errors->has('municipio'))
                    <span class="help-block">
                        <strong>{{ $errors->first('municipio') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('localidad') ? ' has-error' : '' }}">
				<label for="localidad">Localidad:</label>
				<input name="localidad" type="text" value="{{$cliente->localidad}}" placeholder="Teclea localidad" class="form-control" required autofocus>
				@if ($errors->has('localidad'))
                    <span class="help-block">
                        <strong>{{ $errors->first('localidad') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('codigo_postal') ? ' has-error' : '' }}">
				<label for="codigo_postal">Codigo Postal:</label>
				<input name="codigo_postal" type="number" value="{{$cliente->codigo_postal}}" placeholder="Teclea codigo postal" class="form-control" required autofocus>
				@if ($errors->has('codigo_postal'))
                    <span class="help-block">
                        <strong>{{ $errors->first('codigo_postal') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
				<label for="telefono">Telefono:</label>
				<input name="telefono" type="number" value="{{$cliente->telefono}}" placeholder="Teclea telefono" class="form-control" required autofocus>
				@if ($errors->has('telefono'))
                    <span class="help-block">
                        <strong>{{ $errors->first('telefono') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email">Email:</label>
				<input name="email" type="email" value="{{$cliente->email}}" placeholder="Teclea Email" class="form-control" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('direccion_entrega') ? ' has-error' : '' }}">
				<label for="direccion_entrega">Direccion de Entrega:</label>
				<input name="direccion_entrega" type="text" value="{{$cliente->direccion_entrega}}" placeholder="Teclea direccion de entrega" class="form-control" required autofocus>
				@if ($errors->has('direccion_entrega'))
                    <span class="help-block">
                        <strong>{{ $errors->first('direccion_entrega') }}</strong>
                    </span>
                @endif
			</div>		

			<div class="form-group{{ $errors->has('descuento') ? ' has-error' : '' }}">
				<label for="descuento">Descuento:</label>
				<input name="descuento" type="number" value="{{$cliente->descuento}}" placeholder="Teclea descuento" class="form-control" required autofocus>
				@if ($errors->has('descuento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('descuento') }}</strong>
                    </span>
                @endif
			</div>				

			<div class="form-group{{ $errors->has('contacto') ? ' has-error' : '' }}">
				<label for="contacto">Contacto:</label>
				<input name="contacto" type="text" value="{{$cliente->contacto}}" placeholder="Teclea encargado" class="form-control" required autofocus>
				@if ($errors->has('contacto'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contacto') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('telefono_contacto') ? ' has-error' : '' }}">
				<label for="telefono_contacto">Telefono Contacto:</label>
				<input name="telefono_contacto" type="number" value="{{$cliente->telefono_contacto}}" placeholder="Teclea telefono contacto" class="form-control" required autofocus>
				@if ($errors->has('telefono_contacto'))
                    <span class="help-block">
                        <strong>{{ $errors->first('telefono_contacto') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('extension_contacto') ? ' has-error' : '' }}">
				<label for="extension_contacto">Extension Contacto:</label>
				<input name="extension_contacto" type="number" value="{{$cliente->extension_contacto}}" placeholder="Teclea extension contacto" class="form-control" required autofocus>
				@if ($errors->has('extension_contacto'))
                    <span class="help-block">
                        <strong>{{ $errors->first('extension_contacto') }}</strong>
                    </span>
                @endif
			</div>			

			<div class="form-group{{ $errors->has('email_contacto') ? ' has-error' : '' }}">
				<label for="email_contacto">Email Contacto:</label>
				<input name="email_contacto" type="email" value="{{$cliente->email_contacto}}" placeholder="Teclea Email del contacto" class="form-control" required>
                @if ($errors->has('email_contacto'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email_contacto') }}</strong>
                    </span>
                @endif
			</div>			

			<button type="submit" class="btn btn-primary">Actualizar</button>
			<a href="{{url('/consultarClientes')}}" class="btn btn-danger">Cancelar</a>						
		</form>
	</div>

@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole
@stop