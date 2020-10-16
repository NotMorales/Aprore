<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InformacionRequests extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        return [
            'curp'              => 'required | String | max:18 | min:16 | unique:'. $empresa->data_base . '.trabajadores,curp',
            'rfc'               => 'required | String | max:13 | min:12 | unique:'. $empresa->data_base . '.trabajadores,rfc',
            'nss'               => 'required | Numeric | digits_between:10,11 | unique:'. $empresa->data_base . '.trabajadores,nss',
            'calle'             => 'required | String | max:255',
            'colonia'           => 'required | String | max:255',
            'ciudad'            => 'required | String | max:255',
            'codigo_postal'     => 'required | Numeric',
            'empresa'           => 'required | Numeric',
            'postulante'        => 'required | Numeric',
            'fecha_alta'        => 'required | Date',
            'clabe_bancaria'    => ''
        ];
    }
}
