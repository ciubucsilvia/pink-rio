<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Corp\Article;
use Corp\Permission;
use Corp\Menu;
use Corp\Policies\ArticlePolicy;
use Corp\Policies\PermissionPolicy;
use Corp\Policies\MenuPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'Corp\Model' => 'Corp\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenuPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('VIEW_ADMIN', function($user) {
            return $user->canDo('VIEW_ADMIN');
        });

        Gate::define('VIEW_ADMIN_ARTICLES', function($user) {
            return $user->canDo('VIEW_ADMIN_ARTICLES');
        });

        Gate::define('EDIT_USERS', function($user) {
            return $user->canDo('EDIT_USERS');
        });

        Gate::define('VIEW_ADMIN_MENU', function($user) {
            return $user->canDo('VIEW_ADMIN_MENU');
        });

        Gate::define('EDIT_MENU', function($user) {
            return $user->canDo('EDIT_MENU');
        });
    }
}
