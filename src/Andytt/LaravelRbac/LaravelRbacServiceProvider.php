<?php namespace Andytt\LaravelRbac;

use Illuminate\Support\ServiceProvider;

class LaravelRbacServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('andytt/laravel-rbac');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app['rbac'] = $this->app->share(function ($app) {

            return new RBAC(new RbacResources, new RbacRoles, new RbacPermissions);

        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('rbac');
    }

}
