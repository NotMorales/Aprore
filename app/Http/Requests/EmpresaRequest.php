<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'nombre'        => 'required | String | max:255',
            'direccion'     => 'required | String | max:255',
            'correo'        => 'required | String | max:255 | Email',
            'contacto'      => 'required | String | max:255',
            'telefono'      => 'required | Numeric | max:255',
            'rfc'           => 'required | String | max:255',
            'data_base'     => 'required | String | max:255',
        ];
    }
}
