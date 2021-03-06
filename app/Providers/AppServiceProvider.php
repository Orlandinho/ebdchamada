<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('delete', function (User $user) {
           return $user->role_id === Role::IS_ADMIN;
        });

        Gate::define('access', function (User $user) {
            return in_array($user->role_id, [Role::IS_ASSISTENTE, Role::IS_ADMIN]);
        });
    }
}
