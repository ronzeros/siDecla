@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
            @if(Session::get('mensaje_exito','')!='')
            <p class="alert alert-success">{{Session::get('mensaje_exito','')}}</p>
            @endif
            @if(Session::get('mensaje_error','')!='')
            <p class="alert alert-dander">{{Session::get('mensaje_error','')}}</p>
            @endif
            @if (count($errors)>0)
            <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>   
    @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-offset-1 col-md-5 col-lg-offset-1 col-lg-6">
            <h3 class="btn-link">Acerca de la Declaración Tributaria</h3>
            <p class="text-justify">
                La declaración tributaria es la manifestación de hechos comunicados a la Administración Tributaria en la forma y lugar esdtablecidos por Ley, Reglamento, Resolución de Supérintendencia o Norma de rango similar, la cual podrá constituir la bae para la determinación de la obligación tributaria.
            </p>
            <p class="text-justify">
               La Administración Tributaria, a solicitud del deudor tributario, podrá autorizar la presentación de la declaración tributataria por medios magnéticos, fax, transferencia electrónica, o por cualquier otro medio que señale, previo cumplimiento de las condiciones que se establezca mediante Resolución de Superintendencia o norma de rango similar. Adicionalmente, podrá establecer para determinados deudores la obligación de presentar la declaración en las formas antes mencionadas y en las condiciones que señale para ello.
            </p>
            <br>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading"> INICIAR SESIÓN</div>
                <div class="panel-body">
                    {!!Form::open(['class'=>'form-horizontal','url'=>'/login', 'method'=>'POST', 'autocomplete'=>'off']) !!}
                    <input type="hidden" name="tusu" value="1">
                        <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                            <label for="documento" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 control-label">Usuario</label>

                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <input id="documento" type="text" class="form-control" name="documento" value="{{ old('documento') }}">

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
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-6 col">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recuerdame
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Acceder
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <p class="text-justify">El declarante de propiedad vehicular debe registrarse en el módulo de declaraciones juradas del SATP, despues de eso debe iniciar sesión para poder realizar sus declaraciones en línea.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
