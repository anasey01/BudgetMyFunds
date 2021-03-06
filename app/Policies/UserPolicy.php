<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can create.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }


    public function userCategory(User $user)
    {
        return $user->isOwner();
    }

    public function ownerAccess(User $user)
    {
        return $user->isOwner();
    }

    public function ownerSuperAdminAccess(User $user)
    {
        return $user->isOwner() || $user->isSuperAdmin();
    }
}
