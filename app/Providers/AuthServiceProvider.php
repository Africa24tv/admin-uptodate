<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        $permissions = Permission::all();

        foreach ($permissions as $permission)
        {
            $data = $permission->name;

            Gate::define($data, function ($user) use ($data)
            {
                if ($user != null)
                {
                    if ($user->roles != null)
                    {
                        foreach ($user->roles as $role)
                        {
                            foreach($role->permissions as $permission)
                            {
                                if ($permission->name == $data) {
                                    return $user;
                                }
                            }
                        }
                    }
                }
            });
        }
    }
}
