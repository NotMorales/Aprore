<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformacionRequests extends FormRequest {
    
    public function authorize() {
        return true;
    }
 
    public function rules() {
        return [
            'curp'              => 'required | String | max:18',
            'rfc'               => 'required | String | max:15',
            'nss'               => 'required | Numeric',
            'calle'             => 'required | String | max:255',
            'colonia'           => 'required | String | max:255',
            'ciudad'            => 'required | String | max:255',
            'codigo_postal'     => 'required | Numeric',
            'empresa'           => 'required | Numeric',
            'postulante'        => 'required | Numeric',
            'fecha_alta'        => 'required | Date'
        ];
    }
}
