<?php

namespace sisDecla\Http\Controllers;

use Illuminate\Http\Request;

use sisDecla\Http\Requests;
use sisDecla\Users;//hace referencia al modelo
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use DB;

class AdministradorController extends Controller
{
    public function actionLogin2(){
        return view('auth.login2');
    }

}
