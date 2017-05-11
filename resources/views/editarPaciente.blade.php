@extends ('master')

@section('titulo')
@hasrole('admin')
	<h2>Editar Paciente</h2>
	<hr>
@endhasrole
@stop

@section('contenido')
@hasrole('admin')

	<div class="col-xs-12">
	<form action="{{url('/actualizarPaciente')}}/{{$pacientes->id}}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="nombre">Nombre:</label>
			<input name="nombre" type="text" value="{{$pacientes->nombre}}" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="apellido_P">Apellido Paterno:</label>
			<input name="apellido_P" type="text" value="{{$pacientes->apellido_P}}" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="apellido_M">Apellido Materno:</label>
			<input name="apellido_M" type="text" value="{{$pacientes->apellido_M}}" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="sexo">Sexo:</label>
			<select name="sexo" class="form-control" required>
			@if($pacientes->sexo=='Femenino')
				<option value="Femenino" selected>Femenino</option>
				<option value="Masculino">Masculino</option>
			@else
				<option value="Femenino">Femenino</option>
				<option value="Masculino" selected>Masculino</option>
			@endif
			</select>
		</div>
		<div class="form-group">
			<label for="fecha_Nac">Fecha de Nacimiento:</label>
			<br>
			<select name="dia" class="form-control" required autofocus style="width: 70px; display: inline-block;">
					@for($i=1; $i<=31; $i++)
					{
						<option <?php if($dia==$i) echo 'selected' ; ?> value="{{$dia}}">{{$dia}}</option>
					}
					@endfor
			</select>
			<select name="mes" class="form-control" required autofocus style="width: 140px; display: inline-block;">
				<option <?php if ($mes==1) echo 'selected' ; ?> value="1">Enero</option>
				<option <?php if ($mes==2) echo 'selected' ; ?> value="2">Febrero</option>
				<option <?php if ($mes==3) echo 'selected' ; ?> value="3">Marzo</option>
				<option <?php if ($mes==4) echo 'selected' ; ?> value="4">Abril</option>
				<option <?php if ($mes==5) echo 'selected' ; ?> value="5">Mayo</option>
				<option <?php if ($mes==6) echo 'selected' ; ?> value="6">Junio</option>
				<option <?php if ($mes==7) echo 'selected' ; ?> value="7">Julio</option>
				<option <?php if ($mes==8) echo 'selected' ; ?> value="8">Agosto</option>
				<option <?php if ($mes==9) echo 'selected' ; ?> value="9">Septiembre</option>
				<option <?php if ($mes==10) echo 'selected' ; ?> value="10">Octubre</option>
				<option <?php if ($mes==11) echo 'selected' ; ?> value="11">Noviembre</option>
				<option <?php if ($mes==12) echo 'selected' ; ?> value="12">Diciembre</option>
			</select>

			<select name="año" class="form-control" required autofocus style="width: 85px; display: inline-block;">
				@for($i=1910; $i<=2017; $i++)
				{
					<option <?php if($año==$i) echo 'selected' ; ?> value="{{$año}}">{{$año}}</option>
				}
				@endfor
			</select>
		</div>
		<div class="form-group">
			<label for="telefono">Telefono:</label>
			<input name="telefono" type="text" value="{{$pacientes->telefono}}" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input name="email" type="email" value="{{$pacientes->email}}" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="direccion">Direccion:</label>
			<input name="direccion" type="text" value="{{$pacientes->direccion}}" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="estado">Estado:</label>
			<input name="estado" type="text" value="{{$pacientes->estado}}" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="municipio">Municipio:</label>
			<input name="municipio" type="text" value="{{$pacientes->municipio}}" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="localidad">Localidad:</label>
			<input name="localidad" type="text" value="{{$pacientes->localidad}}" class="form-control" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary" ">Guardar</button>
		<a href="{{url('/consultarPacientes')}}" class="btn btn-danger">Cancelar</a>
	</form>
</div>

@else
    <div class="jumbotron">
        <h1>Error - Pagina no encontrada</h1>
    </div>
@endhasrole
@stop
