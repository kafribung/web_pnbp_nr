<?php

namespace App\Policies;

use App\Models\{User, Penghulu};
use Illuminate\Auth\Access\HandlesAuthorization;

class PenghuluPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->hasRole('admin')) return true;
        else return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penghulu  $penghulu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Penghulu $penghulu)
    {
        return $user->id == $penghulu->created_by;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->hasRole('admin')) return true;
        else return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penghulu  $penghulu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Penghulu $penghulu)
    {
        return $user->id == $penghulu->created_by;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penghulu  $penghulu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Penghulu $penghulu)
    {
        return $user->id == $penghulu->created_by;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penghulu  $penghulu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Penghulu $penghulu)
    {
        return $user->id == $penghulu->created_by;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penghulu  $penghulu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Penghulu $penghulu)
    {
        return $user->id == $penghulu->created_by;
    }
}
