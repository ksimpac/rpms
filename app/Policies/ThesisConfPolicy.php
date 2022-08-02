<?php

namespace App\Policies;

use App\Thesis_conf;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThesisConfPolicy
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
     * @param  \App\Thesis_conf  $thesisConf
     * @return bool
     */
    public function view(User $user, Thesis_conf $thesisConf)
    {
        return UserMethod::condition($user, $thesisConf);
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
     * @param  \App\Thesis_conf  $thesisConf
     * @return bool
     */
    public function update(User $user, Thesis_conf $thesisConf)
    {
        return UserMethod::condition($user, $thesisConf) && !UserMethod::missedTheDeadline();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Thesis_conf  $thesisConf
     * @return bool
     */
    public function delete(User $user, Thesis_conf $thesisConf)
    {
        return UserMethod::condition($user, $thesisConf) && !UserMethod::missedTheDeadline();
    }
}
