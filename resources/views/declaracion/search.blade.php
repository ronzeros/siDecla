{!! Form::open(array('url'=>'declaracion', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
<div class="form-group">
	<label for="itbusca">Ingrese el texto de la búsqueda</label>
	<div class="input-group">
		<input class="form-control" type="" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button id="itbusca" type="submit" class="btn btn-success">Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}