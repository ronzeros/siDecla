<?php

namespace sisDecla\Http\Controllers\Auth;

use sisDecla\User;
use Validator;
use sisDecla\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/declarante/logeo';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tdocumento'=>'numeric|required_if:tedit,1',
            'tpersona'=>'numeric|required',
            'documento'=>'between:8,11|required_if:tedit,1|alpha_num|unique:users,documento',
            'apepaterno'=>'between:2,60|string|required_if:tpersona,1',
            'apematerno'=>'between:0,60|string|required_if:tpersona,1',
            'nombres'=>'between:2,60|string|required_if:tpersona,1',
            'rsocial'=>'between:2,60|string|required_if:tpersona,2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'tusu_id' => '1',
            'tdoc_id' => $data['tdocumento'],
            'tipoPersona' => $data['tpersona'],
            'documento' => strtoupper($data['documento']),
            'apellidoPaterno' => strtoupper($data['apepaterno']),
            'apellidoMaterno' => strtoupper($data['apematerno']),
            'nombres' => strtoupper($data['nombres']),
            'razonSocial' => strtoupper($data['rsocial']),
            'email' => strtoupper($data['email']),
            'estado'=>1,
            'password' => bcrypt($data['password'])
        ]);
    }
}
