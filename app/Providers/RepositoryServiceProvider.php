<?php

declare(strict_types=1);

namespace App\Providers;

// use App\Repositories\XXXXRepository;
// use App\Repositories\XXXXRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register() {}

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // $this->app->bind(XXXXRepository::class, XXXXRepositoryEloquent::class);
    }
}
