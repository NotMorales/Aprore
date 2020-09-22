<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany('App\Models\User', 'user_id');
    }

    public function permisos()
    {
        return $this->belongsToMany('App\Models\Permiso');
    }
}
