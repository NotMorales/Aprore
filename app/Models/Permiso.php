<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Permiso extends Model
{
    use HasFactory;

    public function __construct() {
        $user = User::find( Auth::user()->id );
        $this->connection = $user->empresa->data_base;
    }
}
