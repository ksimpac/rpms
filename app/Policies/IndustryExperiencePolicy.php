<?php

namespace App\Policies;

use App\Industry_experience;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndustryExperiencePolicy
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
     * @param  \App\Industry_experience  $industryExperience
     * @return bool
     */
    public function view(User $user, Industry_experience $industryExperience)
    {
        return UserMethod::condition($user, $industryExperience);
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
     * @param  \App\Industry_experience  $industryExperience
     * @return bool
     */
    public function update(User $user, Industry_experience $industryExperience)
    {
        return UserMethod::condition($user, $industryExperience) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Industry_experience  $industryExperience
     * @return bool
     */
    public function delete(User $user, Industry_experience $industryExperience)
    {
        return UserMethod::condition($user, $industryExperience) && !UserMethod::missedTheDeadline();
    }
}
