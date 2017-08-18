<?php

namespace sisDecla\Http\Controllers;

use Illuminate\Http\Request;

use sisDecla\Http\Requests;

use sisDecla\User;
use Iluminate\Support\Facades\Redirect;
use sisDecla\Http\Requests\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
            $query=trim($request->get('searchText'));
            $usuarios=DB::table('vDeclarante')
            ->where('declarante', 'LIKE', '%'.$query.'%')
            ->where('codtusu','>',1)
            ->where('estado','=',1)
            ->orderBy('declarante','asc')
            ->paginate(7);
            return view('seguridad.usuario.index',["usuarios"=>$usuarios, "searchText"=>$query]);
        }
    }
    public function create(){
        $tdoc=DB::table('tipodocumento')->select('tdoc_id','tdoc_nombre')
        ->where('tdoc_tpersona','=','1')
        ->where('tdoc_estado','=','1')
        ->orderBy('tdoc_id','asc')->get();
        $tusu=DB::table('tipousuario')
        ->select('tusu_id','tusu_nombre')
        ->where('tusu_id','>',1)->get();
    	return view('seguridad.usuario.create',["tiposdocumento"=>$tdoc,"tiposusuario"=>$tusu]);
    }

    public function store(UsuarioFormRequest $request){
    	$usuario=new User;
    	$usuario->tusu_id=$request->get('tusuario');
    	$usuario->tdoc_id=$request->get('tdocumento');
        $usuario->tipoPersona="1";
        $usuario->documento=strtoupper($request->get('documento'));
        $usuario->apellidoPaterno=strtoupper($request->get('apepaterno'));
        $usuario->apellidoMaterno=strtoupper($request->get('apematerno'));
        $usuario->nombres=strtoupper($request->get('nombres'));
        $usuario->razonSocial="";
        $usuario->email=strtoupper($request->get('email'));
    	$usuario->password=bcrypt($request->get('password'));
        $usuario->estado=1;
    	$usuario->save();
    	return redirect()->action("UsuarioController@index");
    }

    public function edit($id){
        $usuario=User::findOrFail($id);
        $tdoc=DB::table('tipodocumento')->select('tdoc_id','tdoc_nombre')
        ->where('tdoc_tpersona','=','1')
        ->where('tdoc_estado','=','1')
        ->orderBy('tdoc_id','asc')->get();
        $tusu=DB::table('tipousuario')
        ->select('tusu_id','tusu_nombre')
        ->where('tusu_id','>',1)->get();
    	return view('seguridad.usuario.edit',['usuario'=>$usuario, 'tiposusuario'=>$tusu, 'tiposdocumento'=>$tdoc]);
    }

    public function update(UsuarioFormRequest $request, $id){
    	$usuario=new User;
        $usuario->tusu_id=$request->get('tusuario');
        $usuario->tdoc_id=$request->get('tdocumento');
        $usuario->documento=strtoupper($request->get('documento'));
        $usuario->apellidoPaterno=strtoupper($request->get('apepaterno'));
        $usuario->apellidoMaterno=strtoupper($request->get('apematerno'));
        $usuario->nombres=strtoupper($request->get('nombres'));
        $usuario->email=strtoupper($request->get('email'));
        $usuario->password=bcrypt($request->get('password'));
        $usuario->update();
        return redirect()->url("seguridad/usuario");
    }

    public function destroy($id){
    	$usuario=DB::table('users')->where('id','=',$id)->delete();
    	return Redirect::to('seguridad/usuario');
    }
}
