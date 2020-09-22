<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'direccion', 'correo', 'contacto', 'telefono', 'rfc', 'data_base', 'logo_path', 'created_at', 'updated_at', 'deleted_at'];

    public function staffs()
    {
        return $this->belongsToMany('App\Models\User', 'staffs', 'empresa_id', 'user_id');
    }
}
