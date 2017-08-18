$(document).ready(function(){
	var filas=0;

	$("#frmdeclaracion").submit(function(){
		var men="";
		$("input:file").each(function(){
			var id=$(this).attr("id");
			if(validaImagen(id,"1")==0){
				var nombre=$("#"+id).attr("name");
				if(nombre=="tprop[]"){
					var nid=id.substring(5);
					var placa=$("#placa"+nid).val();
					men=men+ "<li>Debe selecionar la imagen de la tarjeta de propiedad del vehículo de placa " + placa + "</li>";
				}
				else if(nombre=="comp[]"){
					var nid=id.substring(4);
					var placa=$("#placa"+nid).val();
					men=men+ "<li>Debe selecionar la imagen del comprobante de la compra del vehículo de placa " + placa + "</li>";
				}
				else if(nombre=="binf[]"){
					var nid=id.substring(4);
					var placa=$("#placa"+nid).val();
					men=men+ "<li>Debe selecionar la imagen de la boleta informativa del vehículo de placa " + placa + "</li>";
				}
				else if(nombre=="dociden"){
					men=men+ "<li>Debe selecionar la imagen del documento de identidad" + "</li>";
				}
				else if(nombre=="vigpod"){
					men=men+ "<li>Debe selecionar la imagen de la vigencia poder" + "</li>";
				}
			}
		});
		if($("#chkacepto").is(":checked")==false){
			men=men+"<li>Debe aceptar los terminos y condicones</li>";
		}
		$("#merror").html('');
		if(men!=""){
			men="<p>NO SE PUEDE REGISTRAR LA DECLARACIÓN POR LOS SIGUIENTES ERRORES</p><ul>" + men + "</ul>";
			$("#merror").removeClass("hide");
			$("#merror").addClass("show");
			$("#merror").append(men);
			return false;
		}else{
			$("#merror").removeClass("show");
			$("#merror").addClass("hide");
		}
	});

	$("#tDenominacionUrbana").change(function(){
		var op=$(this).val();
		if(op!="1"){
			$("#denominacionUrbana").attr('required','required');
			$("#denominacionUrbana").removeAttr('disabled');
			$("#etapa").removeAttr('disabled');
			$("#denominacionUrbana").focus();
		}else{
			$("#denominacionUrbana").removeAttr('required');
			$("#denominacionUrbana").attr('disabled','disabled');
			$("#etapa").attr('disabled','disabled');
			$("#denominacionUrbana").val('');	
			$("#etapa").val('');
		}
	});

	$("#tipoVia").change(function(){
		var op=$(this).val();
		if(op!="0"){
			$("#via").attr('required','required');
			$("#via").removeAttr('disabled');
			$("#numero").removeAttr('disabled');
			$("#via").focus();
		}else{
			$("#via").removeAttr('required');
			$("#via").attr('disabled','disabled');
			$("#numero").attr('disabled','disabled');
			$("#via").val('');
			$("#numero").val('');
		}
	});

	$("#lote").change(function(){
		if(trim($(this).val())!=""){
			$("#manzana").attr('required','required');
		}else{
			$("#manzana").removeAttr('required');
		}
	});

	//Evento clic del boton agregar vehículo
	$("#btnadd").click(function(){
		$("#mensaje").empty(); //limpia el div de mensaje de error
		var mensaje="";
		var placa=$("#placa").val().toUpperCase();
		var fecha=$("#fechaadq").val();
		if(!(placa.match(/^[A-Z0-9]{5,25}$/))){
			mensaje=mensaje + "<li>Debe ingresar un número de placa válido</li>";
		}
		if(validaFecha(fecha)!=""){
			mensaje=mensaje + "<li>" + validaFecha(fecha) + "</li>";
		}else{
			if(!valFMenAct(fecha)){
				mensaje=mensaje + "<li>La fecha de adquisición no puede ser posterior a la actual</li>";
			}
		}
		var sw=false;
		$("tr.detve").each(function(){
			var id=$(this).attr('id');
			var num=(id.substr(4,id.length));
			var placali =$("#placa"+num).val();	
			if(placa==placali){
				sw=true;
			}
		});
		if(sw==true){
			mensaje=mensaje + "<li>La placa ingresada ya ha sido agregada a la lista anteriormente</li>";
		}
		if(mensaje!=""){
			mensaje="<div class='lert alert-danger'><ul>" + mensaje + "</ul></div>";
			$("#mensaje").append(mensaje);
			$("#mensaje").removeAttr('hidden');
		}else{
			filas++;
			$("#mensaje").attr('hidden','hidden');
			//celda de la placa del vehiculo
			var fila='<tr id="fila' + filas + '" class="detve"><td class="text-right"><input id="placa' + filas + '" type="hidden" name="nplaca[]" value="' + placa + '">Placa:<br><input type="hidden" name="fadq[]" value="' + fechaPHP(fecha) + '"><span><strong>' + placa + '</strong></span><br>Fecha Adquisición:<br><span><strong>' + fecha + '</strong></span><br><span id="delvehi' + filas + '" class="delvehi btn btn-danger glyphicon glyphicon-trash" title="Quitar el vehículo de la lista" onclick=borraFila("' + filas + '")></span></td>';
				//celda de la tarjeta de propiedad
			fila=fila + '<td class="text-center"><div id="ptprop' + filas + '" class="thumbnail preview"><label id="ltprop' + filas + '" for="tprop' + filas + '" class="btn btn-primary" title="Seleccione el archivo correspondiente a la tarjeta de propiedad"><i class="glyphicon glyphicon-paperclip"></i> Adjuntar...</label>';
			//origen de la imagen miniatura de la tarjeta de propiedad
			fila=fila+'<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVkODIwNGU4ZjEgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWQ4MjA0ZThmMSI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OS41NTQ2ODc1IiB5PSI5NC41Ij4xNzF4MTgwPC90ZXh0PjwvZz48L2c+PC9zdmc+"/></div>';
			fila=fila + '<input type="file" id="tprop' + filas + '" name="tprop[]" class="hide" accept="application/pdf, image/*" onchange=validaImagen("tprop' + filas + '")></td>';
			//celda del comprobante de la compra
			fila=fila + '<td class="text-center"><div id="pcomp' + filas + '" class="thumbnail preview"><label id="lcomp' + filas + '" for="comp' + filas + '" class="btn btn-primary" title="Seleccione el archivo correspondiente al comprobante de la compra del vehículo"><i class="glyphicon glyphicon-paperclip"></i> Adjuntar...</label>';
			//origen de la imagen miniatura del comprobante
			fila=fila+'<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVkODIwNGU4ZjEgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWQ4MjA0ZThmMSI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OS41NTQ2ODc1IiB5PSI5NC41Ij4xNzF4MTgwPC90ZXh0PjwvZz48L2c+PC9zdmc+"/></div>';
			fila=fila + '<input type="file" id="comp' + filas + '" name="comp[]" class="hide" accept="application/pdf, image/*" onchange=validaImagen("comp' + filas + '")></td>';
			//celda de la boleta informativa
			fila=fila + '<td class="text-center"><div id="pbinf' + filas + '" class="thumbnail preview"><label id="lbinf' + filas + '" for="binf' + filas + '" class="btn btn-primary" title="Seleccione el archivo correspondiente a la boleta informativa SUNARP del vehículo"><i class="glyphicon glyphicon-paperclip"></i> Adjuntar...</label>';
			//origen de la imagen miniatura del comprobante
			fila=fila+'<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVkODIwNGU4ZjEgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWQ4MjA0ZThmMSI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OS41NTQ2ODc1IiB5PSI5NC41Ij4xNzF4MTgwPC90ZXh0PjwvZz48L2c+PC9zdmc+"/></div>';
			fila=fila + '<input type="file" id="binf' + filas + '" name="binf[]" class="hide" accept="application/pdf, image/*" onchange=validaImagen("binf' + filas + '")></td></tr>';
			
			$("#vehiculos").append(fila);
			
			$("#placa").val('');
			$("#fechaadq").val('');
			$("#guardaDecla").show();
			$("#nvehi").text($("tr.detve").size());	
		}
	});

	$("#btnacepto").click(function(){
		$("#lcondiciones").addClass("hide");
		$("#lformdecla").removeClass("hide");
		$("#lformdecla").addClass("show");
	});

		
	$(".tper").click(function(){
		var valor=$(this).val();
		$("#tdocumento").empty();
		if(valor=="1"){
			$("#tdocumento").append("<option value='1'>Documento Nacional de Identidad</option><option value='2'>Carnet de Extranjería</option><option value='3'>Pasaporte</option>");
			$("#contapepat").removeAttr('hidden');
			$("#contapemat").removeAttr('hidden');
			$("#contnombres").removeAttr('hidden');
			$("#contrsocial").attr('hidden','hidden');
			$("#apepaterno").attr('required','required');
			$("#apematerno").attr('required','required');
			$("#nombres").attr('required','required');
			$("#rsocial").removeAttr('required');
			$("#rsocial").val('');
		}else{
			//alert("persona juridica");
			$("#tdocumento").append("<option value='4'>RUC</option>");
			$("#contapepat").attr('hidden','hidden');
			$("#contapemat").attr('hidden','hidden');
			$("#contnombres").attr('hidden','hidden');
			$("#contrsocial").removeAttr('hidden');
			$("#apepaterno").removeAttr('required');
			$("#apematerno").removeAttr('required');
			$("#nombres").removeAttr('required');
			$("#rsocial").attr('required','required');
			$("#nombres").val('');
			$("#apepaterno").val('');
			$("#apematerno").val('');
		}
	});
//FORMULARIO ASIGNACIÓN DE DECLARACIÓN
	$(".btnasigna").click(function(){
		var codigo=$(this).attr("id");
		$("#ihcodexp").val(codigo);
		$("#spexp").text($("#ihexp"+codigo).val());
		$("#contRegistrador").removeClass("hide");
		$("#contRegistrador").addClass("show");
	});
		
	$("#frmasigna").submit(function(){
		if(confirm("Dese asignar el registrador al expediente " + $("#spexp").text())){
			return true;
		}else{
			return false;
		}
	});

	//CONTROLES GENERALES

	$("#contfechaadq").datepicker({
	    language: "es"
	});

});


//FUNCIONES DE FECHA

function validaFecha(fecha){
	var sw=true
	var men=""
	if(fecha!=undefined&&fecha.trim()!=""){
		if((fecha.match(/^\d{1,2}\/\d{1,2}\/\d{4}$/))){
		    // convertir los numeros a enteros
		    var parts = fecha.split("/");
		    var day = parseInt(parts[0], 10);
		    var month = parseInt(parts[1], 10);
		    var year = parseInt(parts[2], 10);
		    // Revisar los rangos de año y mes
		    if( (year < 1000) || (year > 3000) || (month <= 0) || (month > 12) ){
		    	men="El año o el mes ingresados son incorrectos";
		        sw=false;
		    }else{
		    	var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];
			    // Ajustar para los años bisiestos
			    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
			        monthLength[1] = 29;
			    // Revisar el rango del dia
			    if(!(day > 0 && day <= monthLength[month - 1])){
			    	men="El día ingresado no es correcto";
			    	sw=false;
			    }
		    }
		}else{
			men="La fecha no tiene el formato correcto (dd/mm/aaaa)";
			sw=false;
		}
	}else{
		men="Debe ingresar una fecha válida";
		sw=false;
	}
	return men;
}

function valFMenAct(fecha){
      var x=new Date();
      var fecha = fecha.split("/");
      x.setFullYear(fecha[2],fecha[1]-1,fecha[0]);
      var today = new Date();
      if (x >= today)
        return false;
      else
        return true;
}

function fechaPHP(fecha){
     var fecha = fecha.split("/");
     return fecha[2] + "-"+ fecha[1] + "-" + fecha[0];
}


function borraFila(numFila){
	$("#fila"+numFila).remove();
	var nreg=$("tr.fila").size()
	if(nreg==0){
		$("#guardaDecla").hide();
	}
	$("#nvehi").text(nreg);
}

function validaImagen(id, sinaviso){
	var sinaviso=sinaviso||"";
	var men="";
	var nombre="";
	var tipo="";
	var imagen=document.getElementById(id).files;
	var cant=imagen.length;
	control=$("#"+id);
	if(cant==0){
		men="No ha seleccionado la imagen o archivo pdf, ";
	}else{
		for(x=0;x<cant;x++){
			nombre=imagen[x].name;
			tipo=imagen[x].type;
			if(tipo!="application/pdf" && tipo!="image/png" && tipo!="image/jpg" && tipo!="image/jpeg" && tipo!="image/bmp"){
				men=men + "Debe seleccionar un archivo de tipo imagen o PDF, ";
			}
			var tam=imagen[x].size;
			if(tam>2097152){
				men=men + "El archivo seleccionado excede el tamaño permitido (2MB)";
			}
		}
	}
	if(men!=""){
		var input = $('#' + id);
        var clon = input.clone();  
        input.replaceWith(clon);
        $("#l"+id).html('<i class="glyphicon glyphicon-paperclip"></i> Adjuntar...');
        $("#l"+id).removeClass("btn-success");
		$("#l"+id).addClass("btn-primary");
		$("#p"+id+" img").attr('src',"data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVkODIwNGU4ZjEgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWQ4MjA0ZThmMSI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OS41NTQ2ODc1IiB5PSI5NC41Ij4xNzF4MTgwPC90ZXh0PjwvZz48L2c+PC9zdmc+");
		if(sinaviso==""){
			alert(men);
		}
		return "0";
	}else{
		if(tipo=="application/pdf"){
			$("#p"+id+" img").attr('src','../img/pdf.png');
		}else{
			var reader = new FileReader();
			reader.onload=function(e){
				$("#p"+id+" img").attr('src',e.target.result);
			}
			reader.readAsDataURL(imagen[0]);
		}
		$("#l"+id).html('<i class="glyphicon glyphicon-thumbs-up"></i> ' + nombre);
		$("#l"+id).removeClass("btn-primary");
		$("#l"+id).addClass("btn-success");
		return "1";
	}
}
