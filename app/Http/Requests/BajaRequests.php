<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use App\Models\Trabajador;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BajaRequests extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        if ($this->method() == 'PATCH') {
            $label_expediente = '';
        }else {
            $label_expediente = 'required|mimes:pdf,rar,zip|max:2048';
        }
        return [
            'tipo'              => 'required | String | max:255',
            'fecha_baja'        => 'required | Date',
            'mensaje'           => '',
            'expediente'        => $label_expediente
        ];
    }
}
