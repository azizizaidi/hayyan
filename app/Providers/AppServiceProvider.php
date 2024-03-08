<?php

namespace App\Providers;
use Gate;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\DatabaseTableSizeCheck;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;
use App\Models\User;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


       // Health::checks([
       //     OptimizedAppCheck::new(),
       //     DebugModeCheck::new(),
       //     EnvironmentCheck::new(),
       //     DatabaseCheck::new(),
        //    CpuLoadCheck::new()
        //    ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
        //    ->failWhenLoadIsHigherInTheLast15Minutes(1.5),
        //    DatabaseTableSizeCheck::new()
        //    ->table('users', maxSizeInMb: 1_000),
        //    SecurityAdvisoriesCheck::new()
       // ]);


    }
}
