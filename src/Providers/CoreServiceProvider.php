<?php

namespace Phy\Core\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{

    public function boot()
    {
        require_once __DIR__.'/../helpers/define.php';
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // load routes
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

        //load migration
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->app->singleton('checkValidToken', function(){
            return new \Phy\Core\Service\CheckValidToken;
        });

        $this->app->singleton('sessions', function(){
            return new \Phy\Core\CoreSession;
        });

        $this->app->singleton('loginAuth', function(){
            return new \Phy\Core\Service\LoginAuth;
        });

        $this->app->singleton('doLogout', function(){
            return new \Phy\Core\Service\DoLogout;
        });
    }
}