@extends ('layouts.app')
@section ('content')
<div class="row">
	<div class="col-lg-6 col-lg-offset-3 panel panel-primary">
		@include ('declaracion.constancia',["expediente"=>$expediente,"vehiculos"=>$vehiculos]);	
	</div>
</div>
@endsection