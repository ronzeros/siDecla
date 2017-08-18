@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<h3>Actualizar datos del Declarante</h3>
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

{!!Form::model($declarante,['id'=>'frmdeclarante','method'=>'PATCH', 'route'=>['declaracion.declarante.update', $declarante->declaran_id]]) !!}
	{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="dist_id">Distrito</label>
			<select name="dist_id" class="form-control">
			@foreach ($distritos as $dis)
			@if($dis->dist_id==$declarante->dist_id)
			<option value="{{$dis->dist_id}}" selected>{{$dis->dist_nombre}}</option>
			@else
			<option value="{{$dis->dist_id}}">{{$dis->dist_nombre}}</option>
			@endif
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<fieldset class="form-group" >
			<input type="hidden" name="tedit" value="2">
			<legend>Tipo de Personería</legend>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<input type="radio" id="radiopn" disabled="disabled" 
				@if($declarante->declaran_tPersona=="1")
				 checked="checked"
				@endif
				>
				<label for="radiopn">Persona Natural</label>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<input id="radiopj"type="radio" disabled="disabled"
				@if($declarante->declaran_tPersona=="2")
				 checked="checked"
				@endif
				>
				<label for="radiopj">Persona Jurídica</label>
			</div>
		</fieldset>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="tdoc_id">Tipo de Documento</label>
			<select id="stdoc" class="form-control" disabled="disabled">
			@foreach ($tiposdoc as $tdoc)
				@if($tdoc->tdoc_id==$declarante->tdoc_id)
				<option value="{{$tdoc->tdoc_id}}" selected>{{$tdoc->tdoc_nombre}}</option>
				@else
				<option value="{{$tdoc->tdoc_id}}">{{$tdoc->tdoc_nombre}}</option>
				@endif
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="declaran_nroDocumento">Documento</label>
			<input type="text" value="{{$declarante->declaran_nroDocumento}}" class="form-control" required="required" title="Debe ingresar un número de documento válido" disabled="disabled">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">	
			<label for="declaran_apepat">Apellido Paterno</label>
			<input id="apepat" type="text" name="declaran_apepat" value="{{$declarante->declaran_apepat}}" class="form-control" 
			@if($declarante->declaran_tPersona=='1')
			required="required"
			@else
			disabled="disabled"
			@endif
			>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">	
			<label for="declaran_apemat">Apellido Materno</label>
			<input id="apemat" type="text" name="declaran_apemat" value="{{$declarante->declaran_apemat}}" class="form-control"
			@if($declarante->declaran_tPersona=='1')
			required="required"
			@else
			disabled="disabled"
			@endif
			>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">	
			<label for="declaran_nombres">Nombres</label>
			<input id="nombres" type="text" name="declaran_nombres" value="{{$declarante->declaran_nombres}}" class="form-control"
			@if($declarante->declaran_tPersona=='1')
			required="required"
			@else
			disabled="disabled"
			@endif
			>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">	
			<label for="declaran_rsocial">Razón Social</label>
			<input ID="rsocial" type="text" name="declaran_rsocial" value="{{$declarante->declaran_rsocial}}" class="form-control"
			@if($declarante->declaran_tPersona=='2')
			required="required"
			@else
			disabled="disabled"
			@endif
			>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="declaran_correo">Correo Electrónico</label>
			<input type="email" name="declaran_correo" value="{{$declarante->declaran_correo}}" class="form-control" required="required">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
		<div class="form-group">
			<label for="declaran_telefono">Teléfono Fijo</label>
			<input type="text" name="declaran_telefono" value="{{$declarante->declaran_telefono}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
		<div class="form-group">
			<label for="declaran_celular">Celular</label>
			<input type="text" name="declaran_celular" value="{{$declarante->declaran_celular}}" class="form-control" required="required">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="tden_id">Tipo de Denominación Urbana</label>
			<select name="tden_id" class="form-control">
			@foreach ($tiposden as $tden)
				@if($declarante->tden_id==$tden->tden_id)
				<option value="{{$tden->tden_id}}" selected>{{$tden->tden_nombre}}</option>
				@else
				<option value="{{$tden->tden_id}}">{{$tden->tden_nombre}}</option>
				@endif
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-8">
		<div class="form-group">
			<label for="declaran_denUrbana">Denominación Urbana</label>
			<input type="text" name="declaran_denUrbana" value="{{$declarante->declaran_denUrbana}}" class="form-control" required="required">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_etapa">Etapa</label>
			<input type="text" name="declaran_etapa" value="{{$declarante->declaran_etapa}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="tvia_id">Tipo de Vía</label>
			<select name="tvia_id" class="form-control">
			@if($declarante->tvia_id=='0')
			<option value="0" selected>Ninguna...</option>
			@else
			<option value="0">Ninguna...</option>
			@endif
			@foreach ($tiposvia as $tvia)
				@if($declarante->tvia_id==$tvia->tvia_id)
				<option value="{{$tvia->tvia_id}}" selected>{{$tvia->tvia_nombre}}</option>
				@else
				<option value="{{$tvia->tvia_id}}">{{$tvia->tvia_nombre}}</option>
				@endif
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="declaran_via">Vía</label>
			<input type="text" name="declaran_via" value="{{$declarante->declaran_via}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_numero">Número</label>
			<input type="text" name="declaran_numero" value="{{$declarante->declaran_numero}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_manzana">Manzana</label>
			<input type="text" name="declaran_manzana" value="{{$declarante->declaran_manzana}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_lote">Lote</label>
			<input type="text" name="declaran_lote" value="{{trim($declarante->declaran_lote)}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_interior">Interior</label>
			<input type="text" name="declaran_interior" value="{{$declarante->declaran_interior}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
		<div class="form-group">
			<label for="declaran_block">Block</label>
			<input type="text" name="declaran_block" value="{{$declarante->declaran_block}}" class="form-control">
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<button class="btn btn-primary" type="submit" id="btnguardar">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
	</div>
</div>
{!!Form::close()!!}	
@endsection