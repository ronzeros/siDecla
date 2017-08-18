@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@if(Session::has('message'))
			<p class="alert alert-success">{{Session::get('message')}}</p>
		@endif

	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				<h4>LISTADO DE DECLARACIONES</h4>
			</div>
			<div class="panel-body">
				<div class="col-lg-6">
					@include('declaracion.search')
				</div>
				@if(Auth::user()->tusu_id==3)
				@include('declaracion.asigna')
				@endif
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th class="text-center">Expediente</th>
						<th class="text-center">Declarante</th>
						<th class="text-center">Distrito</th>
						<th class="text-center">Dirección</th>
						<th class="text-center">Placa/F. Adq</th>
						<th class="text-center">Situación</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Opciones</th>
					</thead>
					@if(count($declaraciones)>=1)
						@foreach ($declaraciones as $dec)
						<tr>
							<td class="text-center">{{$dec->numexp}}<input type="hidden" id="ihexp{{$dec->codexp}}" value="{{$dec->numexp}}"></td>
							<td>{{$dec->declarante}}</td>
							<td>{{strtoupper($dec->distrito)}}</td>
							<td>{{$dec->direccion}}</td>
							<td>
								<ul>
								@foreach(explode(",",$dec->placas) as $placa)
								<?php $vehi=explode("|",$placa);?>
									<li>{{$vehi[1].'('.$vehi[2].')'}}</li>
								@endforeach
								</ul>
							</td>
							<td class="text-center alert {{$clsSituacion[$dec->codsit]}}">{{$dec->situacion}}</td>
							<td class="text-center alert {{$clsEstado[$dec->codest]}}">{{$dec->estado}}</td>
							<td class="text-center">
								<a href="{{URL::action('DeclaracionController@show',$dec->codigo)}}" class="btn btn-info glyphicon glyphicon-eye-open" title="Ver detalles de declaración"></a>
								@if((Auth::user()->tusu_id==3)&&($dec->codsit==1)) 
								<butoon id="{{$dec->codexp}}" class="btn btn-warning btnasigna glyphicon glyphicon-user" title="Asignar declaración a registrador"></button>
								@endif
								@if((Auth::user()->tusu_id==2)&&($dec->codsit==3)&&($dec->codusu==Auth::user()->id))
								<a href="{{URL::action('DeclaracionController@show',$dec->codigo)}}" class="btn btn-warning glyphicon glyphicon-tasks" title="Validar declaración"></a>
								@endif
							</td>
						</tr>
						@include('declaracion.modal')
						@endforeach
					@else
						<tr>
							<td colspan="8" class="bg-info"><h3 class="text-center">No se encontraron coincidencias</h3></td>
						</tr>
					@endif
				</table>	
			</div>
			<div class="panel-footer">
				{{$declaraciones->render()}}
			</div>
		</div>				
	</div>
</div>

@endsection