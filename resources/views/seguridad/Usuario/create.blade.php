@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        {!!Form::open(array('class'=>'form-horizontal','url'=>'seguridad/usuario', 'method'=>'POST', 'autocomplete'=>'off','role'=>'form')) !!}
        
            {{ csrf_field() }}
            <input type="hidden" name="tedit" value="1">

            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h4>REGISTRO DE NUEVO USUARIO</h4>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('tpersona') ? ' has-error' : '' }}">
                            <label class="col-lg-4 control-label">Tipo de Usuario</label>
                            <div class="col-lg-8">
                                <select id="tusuario" name="tusuario" class="form-control">
                                    @foreach($tiposusuario as $tusu)
                                    <option value="{{$tusu->tusu_id}}">{{$tusu->tusu_nombre}}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('tusuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tusuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('tdocumento') ? ' has-error' : '' }}">
                            <label for="tdocumento" class="col-lg-4 control-label">Tipo de documento</label>
                            <div class="col-lg-8">
                                <select id="tdocumento" name="tdocumento" class="form-control">
                                    @foreach($tiposdocumento as $tdoc)
                                    <option value="{{$tdoc->tdoc_id}}">{{$tdoc->tdoc_nombre}}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('tdocumento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tdocumento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                            <label for="documento" class="col-lg-4 control-label">Documento</label>
                            <div class="col-lg-8">
                                <input type="text" name="documento" value="{{old('documento')}}" class="form-control text-uppercase" placeholder="Nro de documento..." title="Debe ingresar un número de documento válido" required>
                                @if($errors->has('documento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('documento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-lg-4 control-label">Correo Electrónico</label>
                            <div class="col-lg-8">
                                <input id="email" type="mail" name="email" value="{{old('email')}}" class="form-control text-uppercase" placeholder="Correo electrónico del usuario..." required="required" title="Debe ingresar el correo electrónico del usuario">
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="contapepat" class="form-group{{ $errors->has('apepaterno') ? ' has-error' : '' }}">
                            <label for="apepaterno" class="col-lg-4 control-label">Apellido Paterno</label>
                            <div class="col-lg-8">
                                <input id="apepaterno" type="text" name="apepaterno" value="{{old('apepaterno')}}" class="form-control text-uppercase" placeholder="Ap. Paterno usuario..." required="required" title="Debe ingresar el apellido paterno del usuario">
                                @if($errors->has('apepaterno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apepaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div id="contapemat" class="form-group{{ $errors->has('apematerno') ? ' has-error' : '' }}">
                            <label for="apematerno" class="col-lg-4 control-label">Apellido Materno</label>
                            <div class="col-lg-8">
                                <input id="apematerno" type="text" name="apematerno" value="{{old('apematerno')}}" class="form-control text-uppercase" placeholder="Ap. Materno usuario..." required="required" title="Debe ingresar el apellido materno del usuario">
                                @if($errors->has('apematerno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apematerno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="contnombres" class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                            <label for="nombres" class="col-lg-4 control-label">Nombres</label>
                            <div class="col-lg-8">
                                <input id="nombres" type="text" name="nombres" value="{{old('nombres')}}" class="form-control text-uppercase" placeholder="Nombres del usuario..." required="required" title="Debe ingresar el/los nombre(s) del usuario">
                                @if($errors->has('nombres'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-lg-4 control-label">Password</label>
                            <div class="col-lg-8">
                                <input id="password" type="password" class="form-control" name="password" required="required">
                                @if($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-lg-4 control-label">Confirm Password</label>
                            <div class="col-lg-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="required">
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer text-right">
                    <a href="{{URL::action('UsuarioController@index')}}" class="btn btn-warning pull-left">Regresar a Lista de Usuarios</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Registrar usuario
                    </button>
                </div>
            </div>

        {!!Form::close()!!}	
    </div>
</div>
@endsection