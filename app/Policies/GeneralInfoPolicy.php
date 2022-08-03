<?php

namespace App\Policies;

use App\General_info;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralInfoPolicy
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
        return !UserMethod::hasAdminPermission($user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\General_info  $generalInfo
     * @return bool
     */
    public function view(User $user, General_info $generalInfo)
    {
        return UserMethod::condition($user, $generalInfo);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return !UserMethod::hasAdminPermission($user) &&
            !UserMethod::missedTheDeadline() &&
            $user->general_info()->count() < 1;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\General_info  $generalInfo
     * @return bool
     */
    public function update(User $user, General_info $generalInfo)
    {
        return UserMethod::condition($user, $generalInfo) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\General_info  $generalInfo
     * @return bool
     */
    public function delete(User $user, General_info $generalInfo)
    {
        return UserMethod::condition($user, $generalInfo) && !UserMethod::missedTheDeadline();
    }
}
