<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
<<<<<<< HEAD
use App\Traits\UserTrait;
=======
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
<<<<<<< HEAD
    use UserTrait;

=======

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

<<<<<<< HEAD
=======
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

<<<<<<< HEAD
=======
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

<<<<<<< HEAD
    protected $appends = [
        'profile_photo_url',
    ];

    
=======
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
}
