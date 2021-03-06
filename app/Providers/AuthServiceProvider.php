<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('havepermiso', function ( User $user, $permiso ) {
            return $user->havePermission( $permiso );
        });

        Gate::define('havemodulo', function ( User $user, $modulo ) {
            return $user->haveModulo( $modulo );
        });
    }
}
