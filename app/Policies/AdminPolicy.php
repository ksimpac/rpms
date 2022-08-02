<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function export(User $user)
    {
        return UserMethod::hasAdminPermission($user);
    }

    public function profile(User $user)
    {
        return UserMethod::hasAdminPermission($user);
    }

    public function register(User $user)
    {
        return UserMethod::hasAdminPermission($user);
    }

    public function removeUsers(User $user)
    {
        return UserMethod::hasAdminPermission($user);
    }
}
