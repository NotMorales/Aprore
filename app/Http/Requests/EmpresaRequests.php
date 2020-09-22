<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequests extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'        => 'required | String | max:255',
            'direccion'     => 'required | String | max:255',
            'correo'        => 'required | Email | max:255',
            'contacto'      => 'required | String | max:255',
            'telefono'      => 'required | Numeric',
            'rfc'           => 'required | String | max:255',
            'data_base'     => 'required | String | max:255'
        ];
    }
}
