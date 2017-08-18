@extends ('layouts.admin')
@section ('contenido')
<div class="row">
<div class="col-lg-12 text-center">
    @if(Session::has('mensaje'))
    <p class="alert alert-danger">{{Session::get('mensaje')}}</p>
    @endif
</div>
<div class="col-lg-10 col-lg-offset-1 text-center"><strong><h3>MÓDULO DE ADMINISTRACIÓN DEL SISTEMA DE DECLARACIÓN JURADA EN LÍNEA</h3><br></strong></div>
<div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 col-lg-offset-3">

       {!!Form::open(['class'=>'form-horizontal','url'=>'/login', 'method'=>'POST', 'autocomplete'=>'off']) !!}
            <input type="hidden" name="tusu" value="2">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">INICIAR SESIÓN</div>
                <div class="panel-body">
                        <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                            <label for="documento" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 control-label">Usuario</label>

                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <input id="documento" type="text" class="form-control" name="documento" value="{{ old('documento') }}" required>

                                @if ($errors->has('documento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('documento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 control-label">Contraseña</label>

                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                    
                </div>
                <div class="panel-footer text-right">
                    <div class="checkbox pull-left"><label><input type="checkbox" name="remember"> Recuerdame</label></div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-sign-in"></i> Acceder</button>
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidaste tu contraseña?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection