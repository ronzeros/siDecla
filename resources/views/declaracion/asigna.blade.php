<div id="contRegistrador" class="col-lg-6 hide">
	{!!Form::open(array('id'=>'frmasigna','url'=>'declaracion/asigna', 'method'=>'POST', 'autocomplete'=>'off','role'=>'form')) !!}
	<div class="form-group">
		<input type="hidden" name="codexp" id="ihcodexp">
		<label for="pusuario">Seleccione un registrador para asignarle al expediente: <span id="spexp" class="bg-red"></span></label>
		<div class="input-group">
			<select name="pusuario" class="form-control selectpicker" data-live-search="true">
				@foreach($registradores as $registrador)
				<option value="{{$registrador->codusu}}">{{$registrador->declarante}}</option>
				@endforeach
			</select>
			<span class="input-group-btn">
			<button type="submit" class="btn btn-success">Asignar</button>
			</span>
		</div>
	</div>
	{!!Form::close()!!}	
</div>