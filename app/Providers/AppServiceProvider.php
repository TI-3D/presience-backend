<?php

namespace App\Providers;

use App\Contracts\AuthenticationContract;
use App\Services\AuthenticationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public array $singletons = [
        AuthenticationContract::class => AuthenticationService::class,

    ];

    public function provides(): array
    {
        return [
            AuthenticationContract::class,
        ];
    }


    public function register(): void
    {
        //
        $this->app->bind(AuthenticationContract::class, AuthenticationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
