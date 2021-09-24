<?php

namespace App\Policies;

use App\Models\Kua;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use function PHPUnit\Framework\returnSelf;

class KuaPolicy
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
     * @param  \App\Models\Kua  $kua
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Kua $kua)
    {
        return $user->id == $kua->created_by;
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
     * @param  \App\Models\Kua  $kua
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Kua $kua)
    {
        return $user->id == $kua->created_by;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kua  $kua
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Kua $kua)
    {
        return $user->id == $kua->created_by;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kua  $kua
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Kua $kua)
    {
        return $user->id == $kua->created_by;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kua  $kua
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Kua $kua)
    {
        return $user->id == $kua->created_by;
    }
}
