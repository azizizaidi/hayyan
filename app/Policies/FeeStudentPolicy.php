<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ReportClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeeStudentPolicy
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
        return $user->can('view_any_fee_student');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return bool
     */
    public function view(User $user, ReportClass $invoice): bool
    {
        return $user->can('view_invoice');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */

    public function update(User $user, ReportClass $fee): bool
    {
        return $user->can('update_fee_student');
    }

  



}
