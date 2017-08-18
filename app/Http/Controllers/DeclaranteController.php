<?php

namespace sisDecla\Http\Controllers;

use Illuminate\Http\Request;

use sisDecla\Http\Requests;
use sisDecla\Declarante;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use sisDecla\Http\Requests\DeclaranteFormRequest;
use DB;


class DeclaranteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function actionLogeo(){
        // determina el tipo de modulo que se cargará
        $modulo=Session::get('modulo','0');
        //dd($modulo);
        if($modulo=="2"){
            //si se trata del modulo administrable valida si el usuario tiene los privilegios necesarios
            if(Auth::user()->tusu_id>1){
                $declarante=DB::table('vDeclarante')
                ->where('codusu','=',Auth::user()->id)
                ->first();
                Session::put('coddec',$declarante->coddec);
                Session::put('tusuario',$declarante->tusuario);
                return redirect()->route('declaracion.index');
            }else{
                Auth::logout();
                Session::flash('mensaje_error','No tiene los privilegios necesarios para acceder a este módulo');
                return redirect('/login');
            }
        }else{//si se trata de un declarante verifica si esta registrado como tal
            $user=Auth::user();
            $ndec=count(DB::table('declarante')
            ->where('usu_id','=',$user->id)->get());
            if($ndec==0){//valida si el usuario ha sido registrado como declarante
                //si aun no ha sido registrado como declarante, lo agrega a la tabla de declarantes 
                $declarante=new Declarante;
                $declarante->usu_id=$user->id;
                $declarante->save();
                Mail::send('auth.emails.register', ["user"=>$user], function($msj) use ($user){
                    $msj->subject('Bienvenido al Sistema de Declaración Jurada  Vehicular en Línea');
                    $msj->to($user->email,trim($user->name));
                });
                Auth::logout();
                $men_exito='El declarante ha sido guardado satisfactoriamente, los datos de inicio de sesión fueron enviados al correo electrónico declarado';
                Session::flash('mensaje_exito',$men_exito);
                return redirect('/login');
            }else{
                $declarante=DB::table('vDeclarante')
                ->where('codusu','=',Auth::user()->id)
                ->first();
                Session::put('coddec',$declarante->coddec);
                return redirect()->route('declaracion.create');
            }
            
        } 
    }

    public function index(){
        dd("lista de declarantes");
    }
    /*public function store (){
        dd("envio de condiciones");
       Mail:send('emails.register',$request->all(), function($msj){
            $msj->subject('Bienvenido al Sistema de Declaración Jurada Vehicular en Línea');
            $msj->to('')

        });
        /*$declarante=new Declarante;
        $declarante->tdoc_id=$request->get('tdoc_id');
        $declarante->tden_id=$request->get('tden_id');
        $declarante->dist_id=$request->get('dist_id');
        if($request->get('tvia_id')=="0"){
            $declarante->tvia_id='';
        }else{
            $declarante->tvia_id=$request->get('tvia_id');
        }
        $declarante->declaran_nroDocumento=$request->get('declaran_nroDocumento');
        $declarante->declaran_tPersona=$request->get('declaran_tPersona');
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
        $declarante->save();
        Session::flash('message','Se ha registrado el declarante '.$declarante->declaran_id);
        return Redirect::to('declaracion/declarante');
    }*/

    /*public function show($id){
        //return view('declaracion.declarante.show',["declarante"=>Declarante::findOrfail($id)]);
    }*/

   /* public function edit($id){
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

   /* public function update(DeclaranteFormRequest $request, $id){
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
    }*/

    /*public function destroy($id){
        $declarante=Distrito::findOrFail($id);
        $declarante->dist_estado='0';
        $declarante->update();
        Session::flash('message','El distrito '.$declarante->dist_nombre.' fue Eliminado');
        return Redirect::to('declaracion/distrito');
    }*/
}
