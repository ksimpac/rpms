<?php

namespace App\Policies;

use App\Education;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationPolicy
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
     * @param  \App\Education  $education
     * @return bool
     */
    public function view(User $user, Education $education)
    {
        return UserMethod::condition($user, $education);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return !UserMethod::hasAdminPermission($user) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Education  $education
     * @return bool
     */
    public function update(User $user, Education $education)
    {
        return UserMethod::condition($user, $education) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Education  $education
     * @return bool
     */
    public function delete(User $user, Education $education)
    {
        return UserMethod::condition($user, $education) && !UserMethod::missedTheDeadline();
    }
}
