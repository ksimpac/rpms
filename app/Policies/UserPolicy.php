<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user hasn't sign up.
     *
     * @param  \App\User  $user
     * @return bool
     */
    private function hasNotSignup(User $user)
    {
        return $user->isSignup === 0;
    }

    public function check(User $user)
    {
        return $this->hasNotSignup($user) && !UserMethod::missedTheDeadline();
    }
}
