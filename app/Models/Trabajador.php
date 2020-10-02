<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Trabajador extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'trabajadores';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function __construct() {
        $user = User::find( Auth::user()->id );
        $this->connection = $user->empresa->data_base;
    }

    public function user() {
        return $this->hasOne('App\Models\UserPriv', 'id', 'user_id');
    }
}
