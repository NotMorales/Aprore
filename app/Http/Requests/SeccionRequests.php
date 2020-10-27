<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeccionRequests extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'nombre'        => 'required|String|Max:255',
            'descripcion'   => 'required|String|Max:255',
        ];
    }
}
