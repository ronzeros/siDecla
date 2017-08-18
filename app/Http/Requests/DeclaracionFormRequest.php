<?php

namespace sisDecla\Http\Requests;

use sisDecla\Http\Requests\Request;

class DeclaracionFormRequest extends Request
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
            'tDenominacionUrbana'=>'required|numeric',
            'distrito'=>'required|numeric',
            'tipoVia'=>'required|numeric',
            'telefono'=>'digits_between:6,9|numeric',
            'celular'=>'digits_between:6,9|numeric|required',
        ];
    }
}
