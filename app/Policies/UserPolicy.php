<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return ($user->role === config('constant.ROLE_ADMIN') ||
            $user->role === config('constant.ROLE_SUBADMIN'));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $targetUser): bool
    {
        if (in_array($user->role, [config('constant.ROLE_ADMIN'), config('constant.ROLE_SUBADMIN')])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->role === config('constant.ROLE_ADMIN')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $targetUser): bool
    {
        if ($user->role === config('constant.ROLE_ADMIN')) {
            return true;
        }

        if ($user->role === config('constant.ROLE_SUBADMIN')) {
            return $user->id === $targetUser->department->manager_id;
        }

        return $user->id === $targetUser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $targetUser): bool
    {
        if ($user->role === config('constant.ROLE_ADMIN')) {
            return true;
        }

        if ($user->role === config('constant.ROLE_SUBADMIN')) {

            if ($targetUser->department && $targetUser->department->manager_id) {
                return $user->id === $targetUser->department->manager_id;
            }
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
