<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Permission;
use Gate;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Permission::get()->map(function ($permission){
            Gate::define($permission->name,function($user) use ($permission)
            {
                return $user->hasPermission($permission);
            });
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}