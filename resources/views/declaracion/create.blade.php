@extends ('layouts.app')
@section ('content')

<div id="lcondiciones" class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="text-center">TÉRMINOS Y CONDICIONES</h3></div>
			<div class="panel-body">
				<p class="text-justify">Los términos y condiciones para el uso de del Sistema de Declaración Jurada en Línea cuya ubicación se encuentra en el sitio <a href="www.satp.gob.pe son"></a>www.satp.gob.pe</a> son:</p>
				<p class="text-justify">El uso del Sistema de Declaración Jurada en Línea es aprobado por el SATP con la Resolución de Gerencia N° 1573-2013-SATP, que aprueba la directiva <a href="#">DIR-001-13-ERT</a>, y tiene como finalidad facilitar a los CONTRIBUYENTES el cumplimineto de la presentación de la Declaración Jurada de Personas Naturales y Jurídicas, obligación formal estipulada en la Ley de Tributación Municipal, aprobada mediante Decreto Legislativo Nro 776.</p>
				<p class="text-justify">El Sisterma de Declaración Jurada en Línea, funciona en el ambito de internet y tiene la característica de permitir al CONTRIBUYENTE registrar en el SATP la información de sus transferencias de vehículos, asimismo actualizar sus datos como razón social, domicilio, teléfono, correo electrónico y representrante legal.</p>
				<p class="text-justify">Este servicio de ofrecerá las veinticuatro(24) horas del día los 365 días del año, salvo fallas de conectividad ajenas a nuestra responsabilidad, el registro de la información y su proceso en línea, se valida y graba cuando el registro de las transferencias se efectuaron exitosamente generando la Declaración Jurada. En el caso de que el CONTRIBUYENTE durante el uso del sistema de Declaración Jurada en Línea, deje sin uso el sistema por un lapso de tiempo de más de diez(10) minutos, el sistema se bloquea automáticamente por seguridad maneniendo la información en un registro temporal, permitiendo continuar con el proceso de Declaración Jurada una vez reingresada su clave de acceso</p>
				<p class="text-justify">El sitema entregará virtualmente al CONTRIBUYENTE una constancia de haber cumplido con la presentación de la Declaración Jurada en Línea, permitiendo imprimirla, guardarla en archivo PDF y/o enviarla a su correo electrónico declarado en la presente Declaración Jurada de corresponder.	
				</p>
				<a href="#">Ver Directiva</a>
			</div>
			<div class="panel-footer text-right">
                <button id="btnacepto" type="button" class="btn btn-primary">
                    <i class="glyphicon glyphicon-ok"></i> Aceptar
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="glyphicon glyphicon-remove"></i> Cancelar
                </button>
            </div>
		</div>
	</div>
	
</div>


<div id="lformdecla" class="hide">
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		@if (count($errors)>0)
			<div id="mensaje" class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>	
			</div>
		@endif
		</div>
	</div>

	{!!Form::open(array('id'=>'frmdeclaracion','url'=>'declaracion', 'method'=>'POST', 'autocomplete'=>'off','files'=>'true')) !!}
			{{Form::token()}}
		
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group  bg-primary">
				<h3 class="text-uppercase text-center">{{$declarante->declarante. ' | ' .$declarante->documento. ' '.$declarante->nroDocumento. ' | ' .$declarante->tipo. ' | ' . $declarante->correo}}</span></h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		
			
			<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="distrito">Distrito</label>
					<select id="distrito" name="distrito" class="form-control">
					@foreach ($distritos as $dis)
						<option value="{{$dis->dist_id}}" {{($declarante->iddist==$dis->dist_id)? 'selected':''}}>{{$dis->dist_nombre}}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="tDenominacionUrbana">T. Den. Urbana</label> 
					<select id="tDenominacionUrbana" name="tDenominacionUrbana" class="form-control">
					@foreach ($tiposden as $tden)
						<option value="{{$tden->tden_id}}" {{($declarante->idtden==$tden->tden_id)? 'selected':''}}>{{$tden->tden_nombre}}</option>
					@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-4 col-md-3 col-sm-6 col-xs-9">
				<div class="form-group">
					<label for="denominacionUrbana">Den. Urbana</label>
					<input type="text" id="denominacionUrbana" name="denominacionUrbana" class="form-control text-uppercase" value="{{$declarante->denUrbana}}" title="Denominación urbana" {{(intval($declarante->idtden)<2)?'disabled=disabled':''}}>
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-2 col-xs-3">
				<div class="form-group">
					<label for="etapa">Etapa</label>
					<input type="text" id="etapa" name="declarac_etapa" class="form-control" value="{{$declarante->etapa}}" title="Etapa de denominación urbana" {{(intval($declarante->idtden)<=2)?'disabled="disabled"':''}}>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="tipoVia">Tipo Vía</label> 
					<select id="tipoVia" name="tipoVia" class="form-control">
					<option value="0" {{($declarante->idtvia=='')? 'selected':''}}>Ninguna</option>
					@foreach ($tiposvia as $tvia)
						<option value="{{$tvia->tvia_id}}" {{($declarante->idtvia==$tvia->tvia_id)? 'selected':''}}>{{$tvia->tvia_nombre}}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="via">Vía</label>
					<input type="text" id="via" name="via" class="form-control text-uppercase" value="{{$declarante->via}}" title="Vía" {{(intval($declarante->idtvia)<1)?'disabled="disabled"':''}}>
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
				<div class="form-group">
					<label for="numero">Nro</label>
					<input type="text" id="numero" name="numero" class="form-control" value="{{$declarante->numero}}" title="Número" {{(intval($declarante->idtvia)<1)?'disabled="disabled"':''}}>
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
				<div class="form-group">
					<label for="manzana">Mz</label>
					<input type="text" id="manzana" name="manzana" class="form-control uppercase" value="{{$declarante->manzana}}" title="Manzana">
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
				<div class="form-group">
					<label for="lote">Lote</label>
					<input type="text" id="lote" name="lote" class="form-control" value="{{$declarante->lote}}" title="Lote">
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-3 col-xs-6">
				<div class="form-group">
					<label for="interior">Int</label>
					<input type="text" id="interior" name="interior" class="form-control uppercase" value="{{$declarante->interior}}" title="Interior">
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-3 col-xs-6">
				<div class="form-group">
					<label for="Block">Block</label>
					<input type="text" id="block" name="block" class="form-control uppercase" value="{{$declarante->bloque}}" title="Block">
				</div>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" id="telefono" name="telefono" class="form-control" value="{{$declarante->telefono}}" title="Teléfono Fijo" pattern="^\d{6,9}$">
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
				<div class="form-group">
					<label for="celular">Celular</label>
					<input type="text" id="celular" name="celular" class="form-control" value="{{$declarante->celular}}" title="Teléfono Celular" pattern="^[9]\d{8}$" required="required">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					<strong>AGREGAR VEHÍCULOS Y ADJUNTAR DOCUMENTOS</strong>
				</div>
				<div class="panel-body">
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
						<label for="placa">Placa</label>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">		
						<input type="text" id="placa" name="placa" class="form-control text-uppercase" title="Ingrese un número de placa">
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<label for="fecha">Adquisición</label>
					</div>
					<div class="col-lg-4 col-md-2 col-sm-3 col-xs-8">		
						<div class="form-group">
			                <div class='input-group date' id="contfechaadq">
			                    <input type='text' id="fechaadq" class="form-control datepicker" name="fechaadq" title="Seleccione la fecha de adquisión del vehículo"/>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
					</div>	
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-4">
						<span id="btnadd" class="btn btn-success glyphicon glyphicon-plus" title="Añadir vehículo de la lista"></span>
					</div>
				</div>
		
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<thead class="bg-primary">
							<th class="text-center">Vehículo</th>
							<th class="text-center">Tarjeta de Propiedad</th>
							<th class="text-center">Comprobante</th>
							<th class="text-center">Boleta Inf. SUNARP</th>
						</thead>
						<!-- aqui va el footer de la tabla (botón guardar)-->
						<tbody id="vehiculos">
							
						</tbody>
					</table>
				</div>
				
				
			</div>
		</div>

		<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					<strong>DOCUMENTOS DEL DECLARANTE</strong>
				</div>
				<div class="table">
					<table class="table table-condensed table-hover">
					<tr>
						<td class="text-center"><p class="alert alert-info">DOC. IDENTIDAD</p>
							<div id="pdociden" class="thumbnail preview"><label iD="ldociden" for="dociden" class="btn btn-primary" title="Seleccione el archivo correspondiente al documento de identidad del declarante"><i class="glyphicon glyphicon-paperclip"></i> Adjuntar...</label>
							<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVkODIwNGU4ZjEgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWQ4MjA0ZThmMSI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OS41NTQ2ODc1IiB5PSI5NC41Ij4xNzF4MTgwPC90ZXh0PjwvZz48L2c+PC9zdmc+"/></div>
							<input type="file" id="dociden" name="dociden" class="hide" accept="application/pdf, image/*" onchange="validaImagen('dociden');">
						</td>

						@if($declarante->codTipo=="2")
						<td class="text-center"><p class="alert alert-info">VIGENCIA PODER</p>
							<div id="pvigpod" class="thumbnail preview"><label id="lvigpod" for="vigpod" class="btn btn-primary" title="Seleccione el archivo correspondientea la vigencia de poder"><i class="Glyphicon glyphicon-paperclip"></i> Adjuntar...</label>
							<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVkODIwNGU4ZjEgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWQ4MjA0ZThmMSI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OS41NTQ2ODc1IiB5PSI5NC41Ij4xNzF4MTgwPC90ZXh0PjwvZz48L2c+PC9zdmc+"/></div>
							<input type="file" id="vigpod" name="vigpod" class="hide" accept="application/pdf, image/*" onchange="validaImagen('vigpod');">
						</td>
						@endif
					</tr>
					</table>
				</div>	
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-warning ">
				<p class="text-justify">La información contenida en la presente declaración electrónica tiene carácter de declaración jurada, con el envío de la misma acepto que los datos consignados y la documentación adjunta es cierta y comprobable, y en caso de que se detectase que se ha omitido, ocultado, consignado y/o adjuntado información falsa, me someto a las responsabilidades administrativas, civiles y/o penales previstas en la normatividad vigente. Además, en caso de variar o modificar la información declarada y/o adjunta, me compormeto a informar por escrito al SATP, adjuntando la documentación sustentatoria.</p>
				<p class="text-justify">Asimísmo el SATP se reserva el derecho de llevar cabo la fiscalización correspondiente, así como solicitar la acreditación de la misma.</p>
				<div class="checkbox text-left"><label><input type="checkbox" name="chkacepto" id="chkacepto" required="required">Acepto los términos y condiciones</label></div>
			</div>
			<div id="merror" class="col-lg-12 alert alert-danger hide"></div>
			<div class="col-lg-12 text-right"><input id="guardaDecla" type="submit" value="Guardar Declaración" class="btn btn-primary" style="display: none;"></div>
		</div>
	</div>
	{!!Form::close()!!}	
</div>
@endsection