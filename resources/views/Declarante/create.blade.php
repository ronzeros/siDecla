@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div id="mensaje" class="alert alert-danger">
			@if (count($errors)>0)
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
			@endif
		</div>
	</div>
</div>

{!!Form::open(array('id'=>'frmdeclarante1','url'=>'declaracion/declarante', 'method'=>'POST', 'autocomplete'=>'off')) !!}
		{{Form::token()}}
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group  bg-primary">
			<h3 class="titprin">DATOS PERSONALES</h3>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		
		<div class="form-group">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<label>Tipo de Personería</label>
			</div>
			<input type="hidden" name="tedit" value="1">
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
				<input id="radiopn" class="tper" type="radio" name="declaran_tPersona" value="1" checked="checked">
				<label for="radiopn">P. Natural</label>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
				<input id="radiopj" class="tper" type="radio" name="declaran_tPersona" value="2">
				<label for="radiopj">P. Jurídica</label>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
		<div class="form-group">
			<label for="tdoc_id">T. Documento</label>
			<select id="stdoc" name="tdoc_id" class="form-control">
			@foreach ($tiposdoc as $tdoc)
				<option value="{{$tdoc->tdoc_id}}">{{$tdoc->tdoc_nombre}}</option>
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
		<div class="form-group">
			<label for="declaran_nroDocumento">Documento</label>
			<input type="text" name="declaran_nroDocumento" value="{{old('declaran_nroDocumento')}}" class="form-control" placeholder="Nro de documento..." title="Debe ingresar un número de documento válido">
		</div>
	</div>
</div>

<div class="row">
	<div id="contapepat" class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
		<div class="form-group">	
			<label for="declaran_apepat">Ap. Paterno</label>
			<input id="apepat" type="text" name="declaran_apepat" value="{{old('declaran_apepat')}}" class="form-control" placeholder="Ap. Paterno Declarante..." required="required" title="Debe ingresar el apellido paterno del declarante">
		</div>
	</div>
	<div id="contapemat" class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
		<div class="form-group">	
			<label for="declaran_apemat">Ap. Materno</label>
			<input id="apemat" type="text" name="declaran_apemat" value="{{old('declaran_apemat')}}" class="form-control" placeholder="Ap. Materno Declarante..." required="required">
		</div>
	</div>
	<div id="contnombres" class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
		<div class="form-group">	
			<label for="declaran_nombres">Nombres</label>
			<input id="nombres" type="text" name="declaran_nombres" value="{{old('declaran_nombres')}}" class="form-control" placeholder="Nombres Declarante..." required="required">
		</div>
	</div>
	<div id="contrsocial" class="col-lg-9 col-sm-9 col-md-9 col-xs-12" hidden="hidden">
		<div class="form-group">	
			<label for="declaran_rsocial">Razón Social</label>
			<input ID="rsocial" type="text" name="declaran_rsocial" value="{{old('declaran_rsocial')}}" class="form-control" placeholder="Razón Social...">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group  bg-primary">
			<h3 class="titprin">DIRECCIÓN Y CONTACTO</h3>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="tden_id">Distrito</label>
			<select name="tden_id" class="form-control">
			@foreach ($distritos as $dis)
				<option value="{{$dis->dist_id}}">{{$dis->dist_nombre}}</option>
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="tden_id">Tipo Den. Urbana</label>
			<select name="tden_id" class="form-control">
			@foreach ($tiposden as $tden)
				<option value="{{$tden->tden_id}}">{{$tden->tden_nombre}}</option>
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-sm-8 col-md-8 col-xs-8">
		<div class="form-group">
			<label for="declaran_denUrbana">Denominación Urbana</label>
			<input type="text" name="declaran_denUrbana" value="{{old('declaran_denUrbana')}}" class="form-control" placeholder="Denominación Urbana..." required="required">
		</div>
	</div>
	<div class="col-lg-2 col-sm-4 col-md-4 col-xs-4">
		<div class="form-group">
			<label for="declaran_etapa">Etapa</label>
			<input type="text" name="declaran_etapa" value="{{old('declaran_etapa')}}" class="form-control" placeholder="Etapa...">
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 col-md-6 col-xs-6">
		<div class="form-group">
			<label for="tvia_id">Tipo de Vía</label>
			<select name="tvia_id" class="form-control">
			<option value="0">Ninguna...</option>
			@foreach ($tiposvia as $tvia)
				<option value="{{$tvia->tvia_id}}">{{$tvia->tvia_nombre}}</option>
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6 col-md-6 col-xs-6">
		<div class="form-group">
			<label for="declaran_via">Vía</label>
			<input type="text" name="declaran_via" value="{{old('declaran_via')}}" class="form-control" placeholder="Vía...">
		</div>
	</div>
	<div class="col-lg-1 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_numero">Número</label>
			<input type="text" name="declaran_numero" value="{{old('declaran_numero')}}" class="form-control" placeholder="Número...">
		</div>
	</div>
	<div class="col-lg-1 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_manzana">Manzana</label>
			<input type="text" name="declaran_manzana" value="{{old('declaran_manzana')}}" class="form-control" placeholder="Manzana...">
		</div>
	</div>
	<div class="col-lg-1 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_lote">Lote</label>
			<input type="text" name="declaran_lote" value="{{old('declaran_lote')}}" class="form-control" placeholder="Lote...">
		</div>
	</div>
	<div class="col-lg-1 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_interior">Interior</label>
			<input type="text" name="declaran_interior" value="{{old('declaran_interior')}}" class="form-control" placeholder="Interior...">
		</div>
	</div>
	<div class="col-lg-1 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_block">Block</label>
			<input type="text" name="declaran_block" value="{{old('declaran_block')}}" class="form-control" placeholder="Block...">
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="declaran_correo">Correo Electrónico</label>
			<input type="email" name="declaran_correo" value="{{old('declaran_correo')}}" class="form-control" placeholder="Correo Electrónico..." required="required">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
		<div class="form-group">
			<label for="declaran_telefono">Teléfono Fijo</label>
			<input type="text" name="declaran_telefono" value="{{old('declaran_telefono')}}" class="form-control" placeholder="Telefóno Fijo...">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
		<div class="form-group">
			<label for="declaran_celular">Celular</label>
			<input type="text" name="declaran_celular" value="{{old('declaran_celular')}}" class="form-control" placeholder="Teléfono Celular..." required="required">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group bg-info contbotones">
			<button class="btn btn-primary" type="submit" id="btnguardar">Guardar datos del Declarante</button>
			<!--<button class="btn btn-danger derecha" type="reset">Cancelar</button>-->
		</div>
	</div>
</div>
{!!Form::close()!!}	
@endsection