<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StaffPriv extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'staffs';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function __construct() {
        $user = User::find( Auth::user()->id );
        $this->connection = $user->empresa->data_base;
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
