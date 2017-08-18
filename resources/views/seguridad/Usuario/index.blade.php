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
				<h4>LISTADO DE USUARIOS</h4>
			</div>
			<div class="panel-body">
				<div class="col-lg-6">
					@include('seguridad.usuario.search')
				</div>
				<div class="col-lg-2">
					@if(Auth::user()->tusu_id==4)
					<a href="usuario/create"><button class="btn btn-success">Nuevo</button></a>
					@endif
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead class="bg-primary">
						<th class="text-center">Usuario</th>
						<th class="text-center">Tipo</th>
						<th class="text-center">Doc Identidad</th>
						<th class="text-center">Correo</th>
						<th class="text-center">Opciones</th>
					</thead>
					@foreach ($usuarios as $usu)
					<tr>
						<td>{{$usu->declarante}}</td>
						<td>{{$usu->tusuario}}</td>
						<td>{{$usu->documento.': '.$usu->nroDocumento}}</td>
						<td>{{$usu->correo}}</td>
						<td class="text-center">
							<a href="" class="btn btn-info glyphicon glyphicon-user" title="Ver detalles del usuario"></a>
							@if(Auth::user()->tusu_id==4)
							<a href="{{URL::action('UsuarioController@edit',$usu->codusu)}}" class="btn btn-success glyphicon glyphicon-pencil" title="Editar usuario"></a>
							<a href="" class="btn btn-danger glyphicon glyphicon-remove" title="Eliminar usuario"></a>
							@endif
						</td>
					</tr>
					@include('seguridad.usuario.modal')
					@endforeach
				</table>	
			</div>
			<div class="panel-footer">
				{{$usuarios->render()}}
			</div>
		</div>				
	</div>
</div>

@endsection