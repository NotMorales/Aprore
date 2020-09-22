<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EmpresaPriv extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'direccion', 'correo', 'contacto', 'telefono', 'rfc', 'data_base', 'logo_path', 'created_at', 'updated_at', 'deleted_at'];

    public function __construct() {
        $user = User::find( Auth::user()->id );
        $this->connection = $user->empresa->data_base;
    }

    public function modulos()
    {
        return $this->belongsToMany('App\Models\Modulo', 'empresa_modulo', 'empresa_id');
    }
}
