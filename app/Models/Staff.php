<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'staffs';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function empresa() {
        return $this->belongsTo('App\Models\Empresa');
    }
}
