<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\MovieProviderInterface;
use App\Services\Movies\OmdbMovieProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MovieProviderInterface::class, OmdbMovieProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
