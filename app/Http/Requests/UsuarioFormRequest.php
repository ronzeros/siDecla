<?php

namespace sisDecla\Http\Requests;

use sisDecla\Http\Requests\Request;

class UsuarioFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tusuario'=>'required|numeric',
            'tdocumento'=>'required|numeric',
            'documento'=>'required|alpha_num|between:8,11',
            'apepaterno'=>'required|max:255',
            'apematerno'=>'required|max:255',
            'nombres'=>'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
