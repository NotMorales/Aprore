<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Seccion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'secciones';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'descripcion', 'created_at', 'updated_at', 'deleted_at'];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $user = User::find( Auth::user()->id );
        $this->connection = $user->empresa->data_base;
    }

    public function area() {
        return $this->hasOne('App\Models\Area', 'id', 'area_id');
    }
}
