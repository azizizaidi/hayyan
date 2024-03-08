<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

       // 'Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic' => 'App\Policies\RouteStatisticPolicy',
       // 'App\Models\User' => 'App\Policies\UserPolicy'
        User::class => UserPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        $this->registerPolicies();
     //   Gate::before(function (User $user, string $ability) {
      //      return $user->isSuperAdmin() ? true: null;
      //  });
    }
}
