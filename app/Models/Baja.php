<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Baja extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'bajas';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $user = User::find( Auth::user()->id );
        $this->connection = $user->empresa->data_base;
    }

    public function trabajador() {
        return $this->hasOne('App\Models\Trabajador', 'id', 'trabajador_id');
    }
}
