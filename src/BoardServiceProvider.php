<?php

namespace CozyFex\LaravelBoard;

use CozyFex\LaravelBoard\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class BoardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'board');
        $this->publishes([
            __DIR__.'/views/board' => resource_path('views/CozyFex/Laravel/Board'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
