<?php

namespace App\Policies;

use App\Other;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OtherPolicy
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
     * @param  \App\Other  $other
     * @return bool
     */
    public function view(User $user, Other $other)
    {
        return UserMethod::condition($user, $other);
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
     * @param  \App\Other  $other
     * @return bool
     */
    public function update(User $user, Other $other)
    {
        return UserMethod::condition($user, $other) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Other  $other
     * @return bool
     */
    public function delete(User $user, Other $other)
    {
        return UserMethod::condition($user, $other) && !UserMethod::missedTheDeadline();
    }
}
