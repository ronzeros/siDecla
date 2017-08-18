
@extends ('layouts.app')
@section ('content')
<div id="condiciones" class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	@if (count($errors)>0)
		<div id="mensaje" class="alert alert-danger">
			<p>NO SE PUDO REGISTRAR LA DECLARACIÓN POR LOS SIGUIENTES ERRORES</p>
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>	
		</div>
	@endif
	</div>
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
                <a href="create" class="btn btn-primary">
                    <i class="glyphicon glyphicon-ok"></i> Aceptar
                </a>
                <button type="reset" class="btn btn-danger">
                    <i class="glyphicon glyphicon-remove"></i> Cancelar
                </button>
            </div>
		</div>
	</div>
	
</div>
@endsection
