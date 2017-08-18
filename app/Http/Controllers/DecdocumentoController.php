<?php

namespace sisDecla\Http\Controllers;

use Illuminate\Http\Request;

use sisDecla\Http\Requests;
use sisDecla\Declaracion;//hace referencia al modelo
use sisDecla\Decdocumento;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use sisDecla\Http\Requests\DeclaracionFormRequest;

use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class DecdocumentoController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
       /* if($request){
            $query=trim($request->get('searchText'));
            $declarantes=DB::table('vDeclarante')
            ->where('declarante', 'LIKE', '%'.$query.'%')
            ->orWhere('nroDocumento', 'LIKE', '%'.$query.'%')
            ->orderBy('codigo','asc')
            ->paginate(7);
            return view('declaracion.declarante.index',["declarantes"=>$declarantes, "searchText"=>$query]);
        }*/
    }

    public function create(){
        $coddec="1";
        $dec=DB::table('vDeclarante')
        ->where('codigo','=',$coddec)
        ->first();
        $tden=DB::table('tipodenurbana')->where('tden_estado','=','1')->get();
        $tvia=DB::table('tipovia')->where('tvia_estado','=','1')->get();
        $dist=DB::table('distrito')->where('dist_estado','=','1')->get();
        return view('declaracion.declaracion.create',["declarante"=>$dec,"tiposden"=>$tden,"tiposvia"=>$tvia,"distritos"=>$dist]);
    }

    public function store (DeclaracionFormRequest $request){
        //dd($request->all());
        try{
            DB::beginTransaction();
            $declaracion=new Declaracion;
            $declaracion->declaran_id="1";//el codigo del declarante se debe obtener de una variable sesión
            $declaracion->dist_id=$request->get('dist_id');
            $declaracion->tden_id=$request->get('tden_id');
            $declaracion->tvia_id=$request->get('tvia_id');
            $mifecha=Carbon::now('America/Lima');
            $declaracion->declarac_fecha=$mifecha->toDateTimeString();
            $declaracion->declarac_correo=$request->get('declarac_correo');
            $declaracion->declarac_telefono=$request->get('declarac_telefono');
            $declaracion->declarac_celular=$request->get('declarac_celular');
            $declaracion->declarac_denUrbana=$request->get('declarac_denUrbana');
            $declaracion->declarac_etapa=$request->get('declarac_etapa');
            $declaracion->declarac_via=$request->get('declarac_via');
            $declaracion->declarac_numero=$request->get('declarac_numero');
            $declaracion->declarac_manzana=$request->get('declarac_manzana');
            $declaracion->declarac_lote=$request->get('declarac_lote');
            $declaracion->declarac_interior=$request->get('declarac_interior');
            $declaracion->declarac_block=$request->get('declarac_block');
            DB:commit();
        }catch(\Exception $e){

        }
        

        /*if(Input::hasfile('dociden')){
            $file=Input::file('dociden');
            $file->move(public_path().'/imagenes/documentos/'.$file->getClientOriginalName());
        }*/

        //$declaracion->save();
        //Session::flash('message','Se ha registrado el declarante '.$declarante->declaran_id);
        //return Redirect::to('declaracion/declarante');*/
    }

    public function show($id){
        return view('declaracion.declarante.show',["declarante"=>Declarante::findOrfail($id)]);
    }

    public function edit($id){
        $declarante=Declarante::findOrFail($id);
         $tdoc=DB::table('tipodocumento')
         ->where('tdoc_estado','=','1')
         ->where('tdoc_tpersona','=',$declarante->declaran_tPersona)
         ->get();
        $tden=DB::table('tipodenurbana')->where('tden_estado','=','1')->get();
        $tvia=DB::table('tipovia')->where('tvia_estado','=','1')->get();
        $dist=DB::table('distrito')->where('dist_estado','=','1')->get();
        return view('declaracion.declarante.edit',["declarante"=>$declarante,"tiposdoc"=>$tdoc,"tiposden"=>$tden,"tiposvia"=>$tvia,"distritos"=>$dist]);
    }

    public function update(DeclaranteFormRequest $request, $id){
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
}
