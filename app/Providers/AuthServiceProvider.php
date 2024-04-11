<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // Correct import
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-articles', function ($user) {
            // Retournez true si l'utilisateur a la permission de mettre à jour les articles
            return $user->hasPermission('update-articles');
        });

        Gate::define('create-article', function ($user) {
            // Retournez true si l'utilisateur a la permission de créer des articles
            return $user->hasPermission('create-article');
        });

        Gate::define('delete-article', function ($user) {
            // Retournez true si l'utilisateur a la permission de supprimer des articles
            return $user->hasPermission('delete-article');
        });
    }

}
