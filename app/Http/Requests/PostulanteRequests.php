<?php

namespace App\Http\Requests;

use App\Models\Trabajador;
use Illuminate\Foundation\Http\FormRequest;

class PostulanteRequests extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        if ($this->method() == 'PATCH') {
            $postulante = Trabajador::findOrFail( $this->route('postulante') );
            $label_rules = 'required | Email | max:255 | unique:users,email,'. $postulante->user->id;
        }else {
            $label_rules = 'required | Email | max:255 | unique:users,email';
        }
        return [
            'nombre'            => 'required | String | max:255',
            'apellido_paterno'  => 'required | String | max:255',
            'apellido_materno'  => 'required | String | max:255',
            'sexo'              => 'required | String | max:255',
            'telefono'          => 'required | Numeric',
            'fecha_nacimiento'  => 'required | Date',
            'email'             => $label_rules
        ];
    }
}
