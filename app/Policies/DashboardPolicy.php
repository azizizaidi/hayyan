<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClassName;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_dashboard');
    }

    public static function canView(User $user): bool
    {
         return $user->can('widget_StatsOverview');

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClassName  $className
     * @return bool
     */

}
