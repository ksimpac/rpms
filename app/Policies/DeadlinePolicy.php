<?php

namespace App\Policies;

use App\Deadline;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeadlinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return UserMethod::hasAdminPermission($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return UserMethod::hasAdminPermission($user);
    }
}
