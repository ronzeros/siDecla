<?php

namespace sisDecla\Http\Controllers;

use Illuminate\Http\Request;

use sisDecla\Http\Requests;
use sisDecla\Distrito;//hace referencia al modelo
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use sisDecla\Http\Requests\DeclaracionFormRequest;//hace referencia al archivo de validación
use DB;
class DistritoController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));
    		$distritos=DB::table('distrito')->where('dist_nombre', 'LIKE', '%'.$query.'%')
            ->where('dist_estado', '=', '1')
    		->orderBy('dist_id','asc')
    		->paginate(7);
    		return view('declaracion.distrito.index',["distritos"=>$distritos, "searchText"=>$query]);
    	}
    }

    public function create(){
    	return view('declaracion.distrito.create');
    }

    public function store (DistritoFormRequest $request){
    	$distrito=new Distrito;
    	$distrito->dist_nombre=$request->get('nombre');
        $distrito->dist_estado='1';
    	$distrito->save();
        Session::flash('message','Se ha creado el distrito '.$distrito->dist_nombre);
    	return Redirect::to('declaracion/distrito');
    }

    public function show($id){
    	return view('declaracion.distrito.show',["distrito"=>Distrito::findOrfail($id)]);
    }

    public function edit($id){

    	return view('declaracion.distrito.edit',["distrito"=>Distrito::findOrfail($id)]);
	}

	public function update(DistritoFormRequest $request, $id){
		$distrito=Distrito::findOrFail($id);
		$distrito->dist_nombre=$request->get('nombre');
		$distrito->update();
        Session::flash('message','El distrito '.$distrito->dist_id.' fue actualizado a '.$distrito->dist_nombre);
		return Redirect::to('declaracion/distrito');
	}

	public function destroy($id){
        $distrito=Distrito::findOrFail($id);
        $distrito->dist_estado='0';
        $distrito->update();
        Session::flash('message','El distrito '.$distrito->dist_nombre.' fue Eliminado');
        return Redirect::to('declaracion/distrito');
	}
}
