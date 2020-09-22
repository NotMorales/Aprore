<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
<<<<<<< HEAD
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
=======

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

<<<<<<< HEAD
=======
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
    public function boot()
    {
        $this->registerPolicies();

<<<<<<< HEAD
        Gate::define('havepermiso', function ( User $user, $permiso ) {
            return $user->havePermission( $permiso );
        });

        Gate::define('havemodulo', function ( User $user, $modulo ) {
            return $user->haveModulo( $modulo );
        });
=======
        //
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
    }
}
