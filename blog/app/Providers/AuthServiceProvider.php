<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('eAdmin', function($user){
            return $user->admin == "S";
        });

        Gate::define('autor', function($user){
            //se for admin já retorna true
            //se não verifica se é autor
            //se não é toco
            return ($user->admin == "S" ? true : $user->autor == "S");
        });
    }
}
