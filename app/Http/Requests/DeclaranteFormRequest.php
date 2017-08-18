<?php

namespace sisDecla\Http\Requests;

use sisDecla\Http\Requests\Request;

class DeclaranteFormRequest extends Request
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
            'tdoc_id'=>'numeric|required_if:tedit,1',
            'tden_id'=>'numeric|required',
            'dist_id'=>'numeric|required',
            'tvia_id'=>'numeric',
            'declaran_nroDocumento'=>'between:8,11|required_if:tedit,1|alpha_num|unique:Declarante,declaran_nroDocumento',
            'declaran_apepat'=>'between:2,60|string|required_if:declaran_tPersona,1',
            'declaran_apemat'=>'between:0,60|string|required_if:declaran_tPersona,1',
            'declaran_nombres'=>'between:2,60|string|required_if:declaran_tPersona,1',
            'declaran_rsocial'=>'between:2,60|string|required_if:declaran_tPersona,2',
            'declaran_correo'=>'required|between:5,50|email',
            'declaran_telefono'=>'digits_between:6,9|numeric',
            'declaran_celular'=>'digits:9|required|numeric',
            'declaran_denUrbana'=>'between:2,35|required|string',
            'declaran_etapa'=>'between:0,3|alpha_num',
            'declaran_via'=>'between:0,50|string',
            'declaran_numero'=>'digits_between:0,5|numeric',
            'declaran_manzana'=>'max:5|alpha_num',
            'declaran_lote'=>'digits_between:0,5|numeric',
            'declaran_interior'=>'max:5|alpha_num',
            'declaran_block'=>'max:5|alpha_num'
        ];
    }

    public function messages()
    {
        return[
            'tdoc_id.numeric'=>'El valor asignado al tipo de documento no es válido',
            'tdoc_id.required_if'=>'Dede seleccionar un tipo de documento',
            'tden_id.numeric'=>'El valor asignado al tipo de denominación urbana no es válido',
            'tden_id.required'=>'Debe seleccionar un tipo de denominación urbana',
            'dist_id.numeric'=>'El valor asignado al distrito no es válido',
            'dist_id.required'=>'Dede seleccionar un distrito',
            'tvia_id.numeric'=>'El valor asignado al tipo de vía no es válido',
            'declaran_nroDocumento.between'=>'El número de documento debe tener entre 8 y 11 caracteres',
            'declaran_nroDocumento.required_if'=>'Debe ingresar El número de documento',
            'declaran_nroDocumento.alpha_num'=>'El número de documento solo puede incluir números y letras',
            'declaran_nroDocumento.unique'=>'El número de documento ya ha sido registrado',
            'declaran_apepat.between'=>'El apellido paterno solo puede tener entre 2 y 60 caracteres',
            'declaran_apepat.string'=>'El apellido paterno solo puede incluir letras',
            'declaran_apepat.required_if'=>'Debe ingresar el apellido paterno',
            'declaran_apemat.between'=>'El apellido materno no puede tener más de 60 caracteres',
            'declaran_apemat.string'=>'El apellido materno solo puede incluir letras',
            'declaran_apemat.required_if'=>'Debe ingresar el apellido materno',
            'declaran_nombres.between'=>'El nombre debe tener entre 2 y 60 caracteres',
            'declaran_nombres.string'=>'El nombre solo puede incluir letras',
            'declaran_nombres.required_if'=>'Debe ingresar el/los nombres del declarante',
            'declaran_rsocial.between'=>'La razón social debe tener entre 2 y 60 caracteres',
            'declaran_rsocial.string'=>'La razón social solo puede incluir letras',
            'declaran_correo.required'=>'Debe ingresar un correo electrónico',
            'declaran_correo.between'=>'El correo electrónico no puede tener más de 50 caracteres',
            'declaran_correo.mail'=>'La dirección de correo electrónico no es válida',
            'declaran_telefono.digits_between'=>'El número de teléfono debe tener entre 6 y 9 dígitos',
            'declaran_telefono.numeric'=>'El  número de teléfono solo puede incluir números',
            'declaran_celular.digits'=>'El número de celular debe tener 9 dígitos',
            'declaran_celular.required'=>'Debe ingresar el  número de celular',
            'declaran_celular.numeric'=>'El  número de celular solo puede incluir números',
            'declaran_denUrbana.between'=>'La denominación urbana nombre debe tener entre 2  y 35 caracteres',
            'declaran_denUrbana.string'=>'La denominación urbana solo puede incluir letras y números',
            'declaran_etapa.between'=>'La etapa de denominación urbana no puede tener más de 3 caracteres',
            'declaran_etapa.alpha_num'=>'La etapa de denominación urbana solo puede incluir letras y números',
            'declaran_via.between'=>'La vía no puede tener más de 50 caracteres',
            'declaran_via.string'=>'La vía solo puede incluir letras y números',
            'declaran_numero.digits_between'=>'El número no puede tener más de 5 caracteres',
            'declaran_numero.numeric'=>'El número solo puede incluir números',
            'declaran_manzana.between'=>'La manzana no puede tener más de 5 caracteres',
            'declaran_manzana.alpha_num'=>'la manzana solo puede incluir letras y números',
            'declaran_lote.digits_between'=>'El lote no puede tener más de 5 caracteres',
            'declaran_lote.numeric'=>'El lote solo puede incluir números',
            'declaran_interior.digits_between'=>'El interior no puede tener más de 5 caracteres',
            'declaran_interior.alpha_num'=>'El interior solo puede incluir letras y números',
            'declaran_block.between'=>'El bloque no puede tener más de 5 caracteres',
            'declaran_block.alpha_num'=>'El bloque solo puede incluir letras y números'
        ];
    }
}
