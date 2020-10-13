<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasMany('App\Models\User', 'user_id');
    }

    public function permisos()
    {
        return $this->belongsToMany('App\Models\Permiso');
    }
}
