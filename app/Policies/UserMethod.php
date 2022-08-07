<?php

namespace App\Policies;

use App\User;

class UserMethod
{
    /**
     * Determine whether the user has access to the data.
     *
     * @param  \App\User  $user
     * @param  mixed  $model
     * @return bool
     */
    public static function condition(User $user, $model)
    {
        return $user->username === $model->username &&
            $user->isSignup === 0 &&
            !self::hasAdminPermission($user);
    }

    /**
     * Determine whether the user has administrator privileges.
     * @param  \App\User  $user
     * @return bool
     */
    public static function hasAdminPermission(User $user)
    {
        return $user->is_admin === 1;
    }

    /**
     * Determine whether the user has missed the deadline.
     * @return bool
     */
    public static function missedTheDeadline()
    {
        $time = \App\Deadline::find(1)->time ?? null;
        return isset($time) && now() >= $time;
    }
}
