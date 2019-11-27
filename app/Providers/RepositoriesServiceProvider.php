<?php

namespace App\Providers;

use App\Repositories\SetoranRepository;
use App\Repositories\SetoranRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
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
        $this->app->bind(SetoranRepositoryInterface::class, [
           SetoranRepository::class,
        ]);
    }
}
