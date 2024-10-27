<?php

namespace App\Providers;

use App\Contracts\AttendanceContract;
use App\Contracts\AuthenticationContract;
use App\Contracts\ProfileContract;
use App\Contracts\ScheduleContract;
use App\Services\AttendanceService;
use App\Services\AuthenticationService;
use App\Services\ProfileService;
use App\Services\ScheduleeService;
use App\Services\ScheduleService;
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
        $this->app->bind(ProfileContract::class, ProfileService::class);
        $this->app->bind(ScheduleContract::class, ScheduleService::class);
        $this->app->bind(AttendanceContract::class, AttendanceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
