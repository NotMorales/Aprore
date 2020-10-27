<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\Trabajador;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SucursalRequests extends FormRequest {
    public function authorize(){
        return true;
    }

    public function rules(){
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        if ($this->method() == 'PATCH') {
            $sucursal = Sucursal::findOrFail( $this->route('sucursal') );
            $label_rfc  = 'required | String | max:13 | min:13 | unique:'. $empresa->data_base . '.sucursales,rfc,'. $sucursal->id;
        }else {
            $label_rfc  = 'required | String | max:13 | min:13 | unique:'. $empresa->data_base . '.sucursales,rfc';
        }

        return [
            'nombre'        => 'required | String | max:255',
            'razon'         => 'required | String | max:255',
            'rfc'           => $label_rfc,
            'correo'        => 'required | Email | max:255',
            'telefono'      => 'required | Numeric',
            'direccion'     => 'required | String | max:255',
            'descripcion'   => 'required | String | max:255'
        ];
    }
}
