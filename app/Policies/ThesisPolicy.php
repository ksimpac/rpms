<?php

namespace App\Policies;

use App\Thesis;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThesisPolicy
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
     * @param  \App\Thesis  $thesis
     * @return bool
     */
    public function view(User $user, Thesis $thesis)
    {
        return UserMethod::condition($user, $thesis);
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
     * @param  \App\Thesis  $thesis
     * @return bool
     */
    public function update(User $user, Thesis $thesis)
    {
        return UserMethod::condition($user, $thesis) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Thesis  $thesis
     * @return bool
     */
    public function delete(User $user, Thesis $thesis)
    {
        return UserMethod::condition($user, $thesis) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user has access to the data.
     *
     * @param  \App\User  $user
     * @param  \App\Thesis  $thesis
     * @return bool
     */
    private function condition(User $user, Thesis $thesis)
    {
        return $user->username === $thesis->username &&
            $user->isSignup === 0 &&
            !UserMethod::hasAdminPermission($user);
    }

    /**
     * Determine whether the user has administrator privileges
     * @param  \App\User  $user
     * @return bool
     */
    private function hasAdminPermission(User $user)
    {
        return $user->is_admin === 1;
    }

    /**
     * Determine whether the user has missed the deadline.
     * @return bool
     */
    private function missedTheDeadline()
    {
        return isset(\App\Deadline::find(1)->time) && now() >= \App\Deadline::find(1)->time;
    }
}
