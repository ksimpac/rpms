<?php

namespace App\Policies;

use App\Most_project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MostProjectPolicy
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
     * @param  \App\Most_project  $mostProject
     * @return bool
     */
    public function view(User $user, Most_project $mostProject)
    {
        return UserMethod::condition($user, $mostProject);
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
     * @param  \App\Most_project  $mostProject
     * @return bool
     */
    public function update(User $user, Most_project $mostProject)
    {
        return UserMethod::condition($user, $mostProject) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Most_project  $mostProject
     * @return bool
     */
    public function delete(User $user, Most_project $mostProject)
    {
        return UserMethod::condition($user, $mostProject) && !UserMethod::missedTheDeadline();
    }
}
