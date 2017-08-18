@extends ('layouts.admin')
@section ('contenido')

{!!Form::open(array('url'=>'declaracion/valida', 'method'=>'POST', 'autocomplete'=>'off','files'=>'true')) !!}
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading text-center"><strong>
				VALIDACIÓN DE DECLARACIÓN - EXPEDIENTE {{$declaracion->numexp}} <span class="bg-red pull-right">{{strtoupper($declaracion->tipo)}}</span></strong>
			</div>
			<div class="panel-body">
				<div class="col-lg-3">
					<div class="form-group">
						<label>Declarante <strong class="bg-red">{{$declaracion->documento.': '.$declaracion->nroDocumento}}</strong></label>
						<span class="form-control" title="Nombre o Razón Social del declarante">{{$declaracion->declarante}}</span>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label>Dirección  <strong class="bg-red">DISTRITO: {{strtoupper($declaracion->distrito)}}</strong></label>
						<span class="form-control">{{$declaracion->direccion}}</span>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label>Correo electrónico</label>
						<span class="form-control">{{$declaracion->correo}}</span>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label>Teléfonos</label>
						<span class="form-control">{{$declaracion->celular.' '}}
						@if($declaracion->distrito!='')
						| {{strtoupper($declaracion->telefono)}}
						@endif
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!--PANEL DE DOCUMEnTOS DE EL/LOS VEHICULO(S)-->
	<?php $vehiculos=explode(",",$declaracion->placas);?>
		<div class="col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading text-center"><strong>VEHÍCULOS DECLARADOS ({{count($vehiculos)}})</strong></div>
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-bordered">
						<thead class="bg-info">
							<th class="text-center">Vehículo</th>
							<th class="text-center">Tarjeta de Propiedad</th>
							<th class="text-center">Comprobante</th>
							<th class="text-center">Boleta Informativa</th>
						</thead>
						<tbody>
						@foreach($vehiculos as $placa)
							<tr>
								<?php $vehi=explode("|",$placa);?>
								@foreach($documentos as $doc)
									<?php 
										if($doc->vehi_id==$vehi[0]){
											if($doc->doc_id==2) $ntprop=$doc->decdoc_nombre;
											if($doc->doc_id==3) $ncomp=$doc->decdoc_nombre;
											if($doc->doc_id==4) $nbinf=$doc->decdoc_nombre;
										}
									?>
								@endforeach
								<td class="text-right">
									<label>Placa:</label><span class="form-control">{{$vehi[1]}}</span>
									<label>Fecha Adquisición:</label><span class="form-control">{{$vehi[2]}}</span>
								</td>
								<td class="text-center">
									<div class="thumbnail preview">
										<div class="botones">
											<div class="checkbox"><label class="btn btn-primary"><input type="checkbox" name="ictprop{{$vehi[0]}}" value="2-{{$declaracion->codigo.'-'.$vehi[0]}}">Aprobar doc.</label></div>
											<a href="{{asset('imagenes/'.$ntprop)}}" target="_blank" class="btn btn-success">Ver documento...</a>
										</div>
										<img src="{{asset('imagenes/'.$ntprop)}}"/>
									</div>
								</td>
								<td class="text-center">
									<div class="thumbnail preview">
										<div class="botones">
											<div class="checkbox"><label class="btn btn-primary"><input type="checkbox" name="iccomp{{$vehi[0]}}" value="3-{{$declaracion->codigo.'-'.$vehi[0]}}">Aprobar doc.</label></div>
											<a href="{{asset('imagenes/'.$ncomp)}}" target="_blank" class="btn btn-success">Ver documento...</a>
										</div>
										<img src="{{asset('imagenes/'.$ncomp)}}"/>
									</div>
								</td>
								<td class="text-center">
									<div class="thumbnail preview">
										<div class="botones">
											<div class="checkbox"><label class="btn btn-primary"><input type="checkbox" name="icbinf{{$vehi[0]}}" value="4-{{$declaracion->codigo.'-'.$vehi[0]}}">Aprobar doc.</label></div>
											<a href="{{asset('imagenes/'.$nbinf)}}" target="_blank" class="btn btn-success">Ver documento...</a>
										</div>
										<img src="{{asset('imagenes/'.$nbinf)}}"/>
									</div>
								</td>
							</tr>
						@endforeach						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<!--PANEL DE DOCUMENTOS DEL DECLARANTE-->
		<div class="col-lg-4">
			<div class="panel panel-primary">
				<div class="panel-heading text-center"><strong>DOCUMENTOS DEL DECLARANTE</strong></div>
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-bordered">
						<thead class="bg-info">
							<th class="text-center">Doc. Indentidad</th>
							@if($declaracion->codTipo=="2")
							<th class="text-center">Vigencia Poder</th>
							@endif
						</thead>
						<tbody>
							@foreach($documentos as $doc)
							<?php 
								if(is_null($doc->vehi_id)||$doc->vehi_id==""){
									if($doc->doc_id==1) $ndiden=$doc->decdoc_nombre;
									if($doc->doc_id==5) $nvpod=$doc->decdoc_nombre;
								}
							?>
							@endforeach
							<tr>
								<td class="text-center">
									<div class="thumbnail preview">
										<div class="botones">
											<div class="checkbox"><label class="btn btn-primary"><input type="checkbox" name="icdiden{{$vehi[0]}}" value="1-{{$declaracion->codigo.'-0'}}">Aprobar doc.</label></div>
											<a href="{{asset('imagenes/'.$ndiden)}}" target="_blank" class="btn btn-success">Ver documento...</a>
										</div>
										<img src="{{asset('imagenes/'.$ndiden)}}"/>
									</div>
								</td>
								@if($declaracion->codTipo=="2")
								<td class="text-center">
									<div class="thumbnail preview">
										<div class="botones">
											<div class="checkbox"><label class="btn btn-primary"><input type="checkbox" name="icvpod{{$vehi[0]}}" value="5-{{$declaracion->codigo.'-0'}}">Aprobar doc.</label></div>
											<a href="{{asset('imagenes/'.$nvpod)}}" target="_blank" class="btn btn-success">Ver documento...</a>
										</div>
										<img src="{{asset('imagenes/'.$nvpod)}}"/>
									</div>
								</td>
								@endif
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<div class="col-lg-12 text-right">
		<button type="submit" class="btn btn-success">Guardar la Validación</button>
	</div>
</div>
	
	
{!!Form::close()!!}	

@endsection