<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use App\Models\Trabajador;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InformacionRequests extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        if ($this->method() == 'PATCH') {
            $postulante = Trabajador::findOrFail( $this->route('informacion') );
            $label_curp = 'required | String | max:18 | min:18 | unique:'. $empresa->data_base . '.trabajadores,curp,'. $postulante->id;
            $label_rfc  = 'required | String | max:13 | min:13 | unique:'. $empresa->data_base . '.trabajadores,rfc,'. $postulante->id;
            $label_nss  = 'required | Numeric | digits:11 | unique:'. $empresa->data_base . '.trabajadores,nss,'. $postulante->id;
        }else {
            $label_curp = 'required | String | max:18 | min:18 | unique:'. $empresa->data_base . '.trabajadores,curp';
            $label_rfc  = 'required | String | max:13 | min:13 | unique:'. $empresa->data_base . '.trabajadores,rfc';
            $label_nss  = 'required | Numeric | digits:11 | unique:'. $empresa->data_base . '.trabajadores,nss';
        }
        return [
            'curp'              => $label_curp,
            'rfc'               => $label_rfc,
            'nss'               => $label_nss,
            'calle'             => 'required | String | max:255',
            'colonia'           => 'required | String | max:255',
            'ciudad'            => 'required | String | max:255',
            'codigo_postal'     => 'required | Numeric',
            'fecha_alta'        => 'required | Date',
            'clabe_bancaria'    => ''
        ];
    }
}
