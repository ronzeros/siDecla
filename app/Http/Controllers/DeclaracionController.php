<?php

namespace sisDecla\Http\Controllers;

use Illuminate\Http\Request;

use sisDecla\Http\Requests;
use sisDecla\Declaracion;//hace referencia al modelo
use sisDecla\Declarante;
use sisDecla\Vehiculo;
use sisDecla\Decdocumento;
use sisDecla\Expediente;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use sisDecla\Http\Requests\DeclaracionFormRequest;


use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class DeclaracionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $modulo=Session::get('modulo','0');
        if($request && $modulo=="2"){
            $query=trim($request->get('searchText'));
            if(Auth::user()->tusu_id>=3){//Especialista en registro
                $declaraciones=DB::table('vDeclaracion')
                ->where('declarante', 'LIKE', '%'.$query.'%')
                ->orWhere('numexp', 'LIKE', '%'.$query.'%')
                ->orWhere('placas', 'LIKE', '%'.$query.'%')
                ->orderBy('codigo','asc')
                ->paginate(7);
            }else{
                $declaraciones=DB::table('vDeclaracion')
                ->where('codusu','=',Auth::user()->id)
                ->where('declarante', 'LIKE', '%'.$query.'%')
                ->orderBy('codigo','asc')
                ->paginate(7);
            }
            $registradores=DB::table('vdeclarante')
            ->where('codtusu','=',2)->select('codusu','declarante')
            ->where('estado','=',1)->get();
            $clsSituacion=['1'=>'alert-info','2'=>'alert-warning','3'=>'alert-success','4'=>'alert-primary'];
            $clsEstado=['0'=>'default','1'=>'alert-success','2'=>'alert-danger'];
            //dd($clsSituacion);  
            return view('declaracion.index',["declaraciones"=>$declaraciones, "searchText"=>$query, "clsSituacion"=>$clsSituacion,"clsEstado"=>$clsEstado,"registradores"=>$registradores]);
        }else{
            Redirect::to("/login");
        }
    }

    public function create(){
        $id=Auth::user()->id;
        $dec=DB::table('vDeclarante')
        ->where('codusu','=',$id)
        ->first();
        $tden=DB::table('tipodenurbana')->where('tden_estado','=','1')->get();
        $tvia=DB::table('tipovia')->where('tvia_estado','=','1')->get();
        $dist=DB::table('distrito')->where('dist_estado','=','1')->get();
        return view('declaracion.create',["declarante"=>$dec,"tiposden"=>$tden,"tiposvia"=>$tvia,"distritos"=>$dist,"titFormulario"=>'REGISTRO DE DECLARACIONES VIRTUALES']);
    }

    public function store(DeclaracionFormRequest $request){
        try{
            DB::beginTransaction();
            $id=Session::get('coddec');
            //guarda los datos de la declaración
            $declaracion=new Declaracion;
            $declaracion->declaran_id=$id;//el codigo del declarante se debe obtener de una variable sesión
            $declaracion->dist_id=$request->get('distrito');
            $declaracion->tden_id=$request->get('tDenominacionUrbana');
            $declaracion->tvia_id=$request->get('tipoVia');
            $mifecha=Carbon::now('America/Lima');
            $declaracion->declarac_fecha=$mifecha->toDateTimeString();
            $declaracion->declarac_telefono=$request->get('telefono');
            $declaracion->declarac_celular=$request->get('celular');
            $declaracion->declarac_denUrbana=strtoupper($request->get('denominacionUrbana'));
            $declaracion->declarac_etapa=strtoupper($request->get('etapa'));
            $declaracion->declarac_via=strtoupper($request->get('via'));
            $declaracion->declarac_numero=$request->get('numero');
            $declaracion->declarac_manzana=strtoupper($request->get('manzana'));
            $declaracion->declarac_lote=$request->get('lote');
            $declaracion->declarac_interior=strtoupper($request->get('interior'));
            $declaracion->declarac_block=$request->get('block');
            $declaracion->save();

            //actualiza los datos del declarante
            $declarante=Declarante::findOrFail($id);
            $declarante->dist_id=$request->get('distrito');
            $declarante->tden_id=$request->get('tDenominacionUrbana');
            $declarante->tvia_id=$request->get('tipoVia');           
            $declarante->declaran_denUrbana=strtoupper($request->get('denominacionUrbana'));
            $declarante->declaran_etapa=strtoupper($request->get('etapa'));
            $declarante->declaran_via=strtoupper($request->get('via'));
            $declarante->declaran_numero=$request->get('numero');
            $declarante->declaran_manzana=strtoupper($request->get('manzana'));
            $declarante->declaran_lote=$request->get('lote');
            $declarante->declaran_interior=strtoupper($request->get('interior'));
            $declarante->declaran_block=strtoupper($request->get('block'));
            $declarante->declaran_telefono=$request->get('telefono');
            $declarante->declaran_celular=$request->get('celular');
            $declarante->update();

            //guarda las imagenes de los documentos del declarante
            if(Input::hasfile('dociden')){
                $file=Input::file('dociden');
                $nombre="dociden_".$declaracion->declarac_id.'_1.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/imagenes/',$nombre);
                $decdoc=new Decdocumento;
                $decdoc->declarac_id=$declaracion->declarac_id;
                $decdoc->doc_id="1";
                $decdoc->decdoc_iden="1";
                $decdoc->decdoc_nombre=$nombre;
                $decdoc->decdoc_fechaCarga=$mifecha->toDateTimeString();
                $decdoc->decdoc_estado="1";
                $decdoc->decdoc_activo="1";
                $decdoc->save();
            }

            if(Input::hasfile('vigpod')){
                $file=Input::file('vigpod');
                $nombre="vigpod.".$declaracion->declarac_id.'_1.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/imagenes/',$nombre);
                $decdoc=new Decdocumento;
                $decdoc->declarac_id=$declaracion->declarac_id;
                $decdoc->doc_id="5";
                $decdoc->decdoc_iden="2";
                $decdoc->decdoc_nombre=$nombre;
                $decdoc->decdoc_fechaCarga=$mifecha->toDateTimeString();
                $decdoc->decdoc_estado="1";
                $decdoc->decdoc_activo="1";
                $decdoc->save();
            }

            //obtiene los arrays de controles del detalle de controles
            $placas=$request->get('nplaca');
            $fechas=$request->get('fadq');
            if($request->hasFile('tprop'))$tarjetas=Input::file('tprop');
            if($request->hasFile('comp'))$comprobantes=Input::file('comp');
            if($request->hasFile('binf'))$boletas=Input::file('binf');

            $cont=0;

            while($cont<count($placas)){
                $vehiculo=new Vehiculo;
                $vehiculo->declarac_id=$declaracion->declarac_id;
                $vehiculo->vehi_placa=$placas[$cont];
                $fechaa=date("Y-m-d", strtotime($fechas[$cont]));
                $vehiculo->vehi_fechaAdquisicion=$fechaa;
                $vehiculo->vehi_estado=1;
                $vehiculo->save();
                
                //guarda los documentos de cada vehiculo
                if($tarjetas[$cont]->isValid()){
                    $file=$tarjetas[$cont];
                    $nombre="tprop_".$declaracion->declarac_id.'_'.$vehiculo->vehi_id.'_1.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/imagenes/',$nombre);
                    $decdoc=new Decdocumento;
                    $decdoc->declarac_id=$declaracion->declarac_id;
                    $decdoc->vehi_id=$vehiculo->vehi_id;
                    $decdoc->doc_id="2";
                    $decdoc->decdoc_iden="3";
                    $decdoc->decdoc_nombre=$nombre;
                    $decdoc->decdoc_fechaCarga=$mifecha->toDateTimeString();
                    $decdoc->decdoc_estado="1";
                    $decdoc->decdoc_activo="1";
                    $decdoc->save();
                }

                if($comprobantes[$cont]->isValid()){
                    $file=$comprobantes[$cont];
                    $nombre="comp_".$declaracion->declarac_id.'_'.$vehiculo->vehi_id.'_1.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/imagenes/',$nombre);
                    $decdoc=new Decdocumento;
                    $decdoc->declarac_id=$declaracion->declarac_id;
                    $decdoc->vehi_id=$vehiculo->vehi_id;
                    $decdoc->doc_id="3";
                    $decdoc->decdoc_iden="4";
                    $decdoc->decdoc_nombre=$nombre;
                    $decdoc->decdoc_fechaCarga=$mifecha->toDateTimeString();
                    $decdoc->decdoc_estado="1";
                    $decdoc->decdoc_activo="1";
                    $decdoc->save();
                }

                if($boletas[$cont]->isValid()){
                    $file=$boletas[$cont];
                    $nombre="binf_".$declaracion->declarac_id.'_'.$vehiculo->vehi_id.'_1.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/imagenes/',$nombre);
                    $decdoc=new Decdocumento;
                    $decdoc->declarac_id=$declaracion->declarac_id;
                    $decdoc->vehi_id=$vehiculo->vehi_id;
                    $decdoc->doc_id="4";
                    $decdoc->decdoc_iden="5";
                    $decdoc->decdoc_nombre=$nombre;
                    $decdoc->decdoc_fechaCarga=$mifecha->toDateTimeString();
                    $decdoc->decdoc_estado="1";
                    $decdoc->decdoc_activo="1";
                    $decdoc->save();
                }
                $cont++;
            }

            //consultar el ultimo numero de expediente del año
            $anio="V".substr(date("Y"),1);
            $nroexp=DB::table('Expediente')->where('exp_numero','LIKE',$anio.'%')->max('exp_numero');
            if(isset($nroexp)){
                $nroexp=substr($nroexp,0,3).(intval(substr($nroexp,3))+1);
            }else{
                $nroexp="V".substr($anio,1)."000001";
            }

            //Creando el expediente
            $expediente=new Expediente;
            $expediente->declarac_id=$declaracion->declarac_id;
            $expediente->exp_numero=$nroexp;
            $expediente->exp_estado=1;
            $expediente->exp_procesado="0";
            $expediente->exp_cerrado="0";
            $expediente->save();
            DB::commit();
            Session::flash("enviacorreo","1");
            return redirect()->route("constancia",$nroexp);
        }catch(\Exception $e){
            DB::rollback();
            Auth::logout();
            Session::flash("men","No se pudo registrar la declaración, vuelva a iniciar sesión");
            dd($e);
        }
    }

    public function show($id){
        $declaracion=DB::table("vdeclaracion")->where('codigo','=',$id)->first();
        $documentos=DB::table("declaraciondocumento")
        ->where('declarac_id','=',$id)
        ->where('decdoc_estado','=',1)->get();
        //dd($documentos);
        return view('declaracion.show',["declaracion"=>$declaracion,"documentos"=>$documentos]);
    }

    /*public function edit($id){
        $declarante=Declarante::findOrFail($id);
         $tdoc=DB::table('tipodocumento')
         ->where('tdoc_estado','=','1')
         ->where('tdoc_tpersona','=',$declarante->declaran_tPersona)
         ->get();
        $tden=DB::table('tipodenurbana')->where('tden_estado','=','1')->get();
        $tvia=DB::table('tipovia')->where('tvia_estado','=','1')->get();
        $dist=DB::table('distrito')->where('dist_estado','=','1')->get();
        return view('declaracion.declarante.edit',["declarante"=>$declarante,"tiposdoc"=>$tdoc,"tiposden"=>$tden,"tiposvia"=>$tvia,"distritos"=>$dist]);
    }*/

    public function update(DeclaracionFormRequest $request, $id){
        $declarante=Declarante::findOrFail($id);
        if($request->get('tedit')=='1'){
            $declarante->tdoc_id=$request->get('tdoc_id');
            $declarante->declaran_nroDocumento=$request->get('declaran_nroDocumento');
            $declarante->declaran_tPersona=$request->get('declaran_tPersona'); 
        }
        $declarante->tden_id=$request->get('tden_id');
        $declarante->dist_id=$request->get('dist_id');
        $declarante->tvia_id=$request->get('tvia_id');
        $declarante->declaran_apepat=$request->get('declaran_apepat');
        $declarante->declaran_apemat=$request->get('declaran_apemat');
        $declarante->declaran_nombres=$request->get('declaran_nombres');
        $declarante->declaran_rsocial=$request->get('declaran_rsocial');
        $declarante->declaran_correo=$request->get('declaran_correo');
        $declarante->declaran_telefono=$request->get('declaran_telefono');
        $declarante->declaran_celular=$request->get('declaran_celular');
        $declarante->declaran_denUrbana=$request->get('declaran_denUrbana');
        $declarante->declaran_etapa=$request->get('declaran_etapa');
        $declarante->declaran_via=$request->get('declaran_via');
        $declarante->declaran_numero=$request->get('declaran_numero');
        $declarante->declaran_manzana=$request->get('declaran_manzana');
        $declarante->declaran_lote=$request->get('declaran_lote');
        $declarante->declaran_interior=$request->get('declaran_interior');
        $declarante->declaran_block=$request->get('declaran_block');
        $declarante->update();
        Session::flash('message','El declarante '.$declarante->declaran_id.' fue actualizado');
        return Redirect::to('declaracion/declarante');
    }

    public function destroy($id){
        /*$declarante=Distrito::findOrFail($id);
        $declarante->dist_estado='0';
        $declarante->update();
        Session::flash('message','El distrito '.$declarante->dist_nombre.' fue Eliminado');
        return Redirect::to('declaracion/distrito');*/
    }

    public function constancia($expediente){
        $expediente=DB::table('vDeclaracion')->where('numexp','=',$expediente)->first();
        $coddec=$expediente->codigo;
        $vehiculos=DB::table('vehiculo')
        ->where('declarac_id','=',$coddec)
        ->where('vehi_estado','=',1)
        ->select('vehi_placa as placa','vehi_fechaAdquisicion as fecha')->get();

        if(Session::get("enviacorreo")=="1"){
            Mail::send('declaracion.constancia', ["expediente"=>$expediente,"vehiculos"=>$vehiculos], function($msj) use ($expediente){
                $msj->subject('Proceso de Declaración Jurada Vehicular en línea concluido');
                $msj->to($expediente->correo,trim($expediente->declarante));
            });
        }
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView("declaracion.constancia",["expediente"=>$expediente, "vehiculos"=>$vehiculos]);
        Auth::logout();
        echo("<script>alert('Su8 declaración ha sido registrada con éxito, los datos de confirmación llegarán al correo electrónico que registró');</script>");
        return $pdf->stream();

        //return view("declaracion.muestraconstancia",["expediente"=>$expediente,"vehiculos"=>$vehiculos]);
    }

    public function descargaconstancia($expediente){
        $expediente=DB::table('vDeclaracion')->where('numexp','=',$expediente)->first();
        $coddec=$expediente->codigo;
        $vehiculos=DB::table('vehiculo')
        ->where('declarac_id','=',$coddec)
        ->where('vehi_estado','=',1)
        ->select('vehi_placa as placa','vehi_fechaAdquisicion as fecha')->get();
       
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView("declaracion.constancia",["expediente"=>$expediente, "vehiculos"=>$vehiculos]);
        return $pdf->stream();
    }

    public function actionAsigna(Request $request){
        //dd($request->all());
        $expediente=Expediente::findOrFail($request->codexp);
        $expediente->id=$request->pusuario;
        $expediente->exp_situacion=3;
        $expediente->update();
        return redirect()->route("declaracion.index");
    }

    public function actionValida(Request $request){
        dd($request->all());
    }
}
