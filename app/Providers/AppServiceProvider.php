<?php

namespace App\Providers;

use App\Repositories\Contracts\AuthorsRepository;
use App\Repositories\DbAuthorsRepository;
use App\Repositories\FileAuthorsRepository;
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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->bind(
            AuthorsRepository::class,
            DbAuthorsRepository::class,
            FileAuthorsRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
    }
}
