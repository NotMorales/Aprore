<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostulanteMasivoRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        return [
            'nombre'            => 'required | String | max:255',
            'apellido_paterno'  => 'required | String | max:255',
            'apellido_materno'  => 'required | String | max:255',
            'sexo'              => 'required | String | max:9',
            'telefono'          => 'required | Numeric',
            'fecha_nacimiento'  => 'required | Date',
            'email'             => 'required | Email | max:255 | unique:users,email',
            'curp'              => 'required | String | max:18 | min:16 | unique:'. $empresa->data_base . '.trabajadores,curp',
            'rfc'               => 'required | String | max:13 | min:12 | unique:'. $empresa->data_base . '.trabajadores,rfc',
            'nss'               => 'required | Numeric | digits_between:10,11 | unique:'. $empresa->data_base . '.trabajadores,nss',
            'calle'             => 'required | String | max:255',
            'colonia'           => 'required | String | max:255',
            'ciudad'            => 'required | String | max:255',
            'codigo_postal'     => 'required | Numeric',
            'fecha_alta'        => 'required | Date',
            'clabe_bancaria'    => ''
        ];
    }
}
