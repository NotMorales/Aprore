<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserPriv extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $user = User::find( Auth::user()->id );
        $this->connection = $user->empresa->data_base;
    }

    public function persona() {
        return $this->belongsTo('App\Models\Persona', 'id');
    }

    public function empresa() {
        return $this->hasOne('App\Models\EmpresaPriv', 'id', 'empresa_id');
    }

    public function trabajador() {
        return $this->hasOne('App\Models\Trabajador', 'user_id');
    }
}
