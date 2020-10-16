<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaStaffRequests extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'nombre'            => 'required | String | max:255',
            'apellido_paterno'  => 'required | String | max:255',
            'apellido_materno'  => 'required | String | max:255',
            'sexo'              => 'required | String | max:255',
            'telefono'          => 'required | Numeric',
            'fecha_nacimiento'  => 'required | Date',
            'name'              => 'required | String | max:255',
            'email'             => 'required | Email | max:255 | unique:users,email',
            'password'          => 'required | String | min:8',
        ];
    }
}
