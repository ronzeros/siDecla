@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10 col-offset-lg-1 col-sm-12 col-md-12 col-xs-12">
        @if (count($errors)>0)
            <div id="mensaje" class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
         @endif
        </div>
    <div class="col-lg-10 col-lg-offset-1 col-sm-12 col-md-12 col-xs-12">
        
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <input type="hidden" name="tedit" value="1">

            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <span>REGISTRO DE NUEVO DECLARANTE</span>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('tpersona') ? ' has-error' : '' }}">
                            <label class="col-lg-4 control-label">Tipo de Personería</label>
                            <div class="col-lg-8">
                                <label class="radio-inline"><input id="radiopn" class="tper" type="radio" name="tpersona" value="1" checked="checked">Persona Natural</label>
                                <label class="radio-inline"><input id="radiopj" class="tper" type="radio" name="tpersona" value="2">Persona Jurídica</label>
                                @if($errors->has('tpersona'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tpersona') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('tdocumento') ? ' has-error' : '' }}">
                            <label for="tdocumento" class="col-lg-4 control-label">Tipo de documento</label>
                            <div class="col-lg-8">
                                <select id="tdocumento" name="tdocumento" class="form-control">
                                    <option value="1">Documento Nacional de Identidad</option>
                                    <option value="2">Carnet de Extranjería</option>
                                    <option value="3">Pasaporte</option>
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
                                <input id="email" type="mail" name="email" value="{{old('email')}}" class="form-control text-uppercase" placeholder="Correo electrónico del Declarante..." required="required" title="Debe ingresar el correo electrónico del declarante">
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
                                <input id="apepaterno" type="text" name="apepaterno" value="{{old('apepaterno')}}" class="form-control text-uppercase" placeholder="Ap. Paterno Declarante..." required="required" title="Debe ingresar el apellido paterno del declarante">
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
                                <input id="apematerno" type="text" name="apematerno" value="{{old('apematerno')}}" class="form-control text-uppercase" placeholder="Ap. Materno Declarante..." required="required" title="Debe ingresar el apellido materno del declarante">
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
                                <input id="nombres" type="text" name="nombres" value="{{old('nombres')}}" class="form-control text-uppercase" placeholder="Nombres del Declarante..." required="required" title="Debe ingresar el/los nombre(s) del declarante">
                                @if($errors->has('nombres'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div id="contrsocial" class="form-group{{ $errors->has('rsocial') ? ' has-error' : '' }}" hidden="hidden">
                            <label for="rsocial" class="col-lg-4 control-label">Razón Social</label>
                            <div class="col-lg-8">
                                <input id="rsocial" type="text" name="rsocial" value="{{old('rsocial')}}" class="form-control text-uppercase" placeholder="Razón social del Declarante..." title="Debe ingresar el/los nombre(s) del declarante">
                                @if($errors->has('rsocial'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rsocial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-lg-4 control-label">Password</label>
                            <div class="col-lg-8">
                                <input id="password" type="password" class="form-control" name="password">
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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
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
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Registrar declarante
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

