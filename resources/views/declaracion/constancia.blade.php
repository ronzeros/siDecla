<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Constancia de Registro</title>
	<link rel="stylesheet" href="css/pdf.css">
</head>
<body>
	<div id="contenedor">
		<div class="elem">
			<h3><center>DECLARACIÓN REGISTRADA CON ÉXITO - EXPEDIENTE N° {{$expediente->numexp}}</center></h3>
		<div><h4>SERVICIO DE ADMINISTRACIÓN TRIBUTARIA DE PIURA<br>	
		Jr. Libertad 543 563 Piura - FONOSATP: 285400
		<br>www.satp.gob.pe</h4></div>
				
		<h3><center>DECLARACIÓN VEHICULAR EN LÍNEA</center></h3>
		</div>
		<div>
			<hr><p><strong>DATOS DECLARADOS</strong></p><hr>
			<p><span class="etiqueta"><strong>Declarante: </strong></span>
			<span class="valor2">{{$expediente->declarante}}</span></p>
			<p><span class="etiqueta"><strong>Domicilio: </strong></span>
			<span class="valor2">{{$expediente->direccion}}</span></p>
			<p><span class="etiqueta"><strong>Tipo de persona: </strong></span>
			<span class="valor">{{$expediente->tipo}}</span>
			<span class="etiqueta"><strong>Doc. Identidad: </strong></span>
			<span class="valor">{{$expediente->documento.': '.$expediente->nroDocumento}}</span></p>
			<p><span class="etiqueta"><strong>Teléfono: </strong></span>
			<span class="valor">{{$expediente->telefono}}</span>
			<span class="etiqueta"><strong>Celular: </strong></span>
			<span class="valor">{{$expediente->celular}}</span></p>
			<p><span class="etiqueta"><strong>Correo electrónico: </strong></strong></span>
			<span class="valor2">{{$expediente->correo}}</span></p>
		</div>
		<div><center>
			<table border="1" cellspacing="0" cellpadding="3px">
					<tr><th colspan="5" class="titulo">VEHÍCULOS INCLUIDOS EN LA DECLARACIÓN</th></tr>
					<tr>
						<th rowspan="2" class="titulo">PLACA</th>
						<th rowspan="2">FECHA ADQUISICIÓN</th>
						<th colspan="3" class="titulo">ARCHIVOS ADJUNTOS</th>
					</tr>
					<tr>
						<th>T. Propiedad</th>
						<th>Comprobante</th>
						<th>B. Informativa</th>
					</tr>
					@foreach ($vehiculos as $vehiculo)
					<tr>
						<td><center>{{$vehiculo->placa}}</center></td>
						<td><center>{{date('d/m/Y',strtotime($vehiculo->fecha))}}</center></td>
						<td><center>OK</center></td>
						<td><center>OK</center></td>
						<td><center>OK</center></td>
					</tr>
					@endforeach
					<tr>
						<th colspan="2" rowspan="{{($expediente->codTipo=='2')?'2':'1'}}">Documentos del declarante</th>
						<th colspan="2">Documento de Identidad</th>
						<td><center>OK</center></td>
					</tr>
					@if($expediente->codTipo=="2")
					<tr>
						<th colspan="2">Vigencia Poder</th>
						<td><center>OK</center></td>
					</tr>
					@endif
				</table><br><hr>
		</center></div>
		<div style="text-align: justify;">

			<p>La información contenida en la presente declaración electrónica tiene carácter de declaración jurada, con el envío de la misma acepto que los datos consignados y la documentación adjunta es cierta y comprobable, y en caso de que se detectase que se ha omitido, ocultado, consignado y/o adjuntado información falsa, me someto a las responsabilidades administrativas, civiles y/o penales previstas en la normatividad vigente. Además, en caso de variar o modificar la información declarada y/o adjunta, me compormeto a informar por escrito al SATP, adjuntando la documentación sustentatoria.</p>
			<p>Asimísmo el SATP se reserva el derecho de llevar cabo la fiscalización correspondiente, así como solicitar la acreditación de la misma.</p>
			<span><strong>Fecha de declaración: </strong>{{date('d/m/Y',strtotime($expediente->fecha))}}</span>
		</div>		
	</div>
</body>
</html>