<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate: checks if the user had admin role
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // Gate: checks if the user can update the snack
        Gate::define('update-snack', function ($user, $snack) {
            return $user->id === $snack->user_id;
        });

        // Gate: checks if the user can delete the snack
        Gate::define('delete-snack', function ($user, $snack) {
            return $user->id === $snack->user_id;
        });


    }
}
