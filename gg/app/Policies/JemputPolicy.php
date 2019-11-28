<?php

namespace App\Policies;

use App\Jemput;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JemputPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any jemputs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'front';
    }

    /**
     * Determine whether the user can view the jemput.
     *
     * @param  \App\User  $user
     * @param  \App\Jemput  $jemput
     * @return mixed
     */
    public function view(User $user, Jemput $jemput)
    {
        //
    }

    /**
     * Determine whether the user can create jemputs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the jemput.
     *
     * @param  \App\User  $user
     * @param  \App\Jemput  $jemput
     * @return mixed
     */
    public function update(User $user, Jemput $jemput)
    {
        //
    }

    /**
     * Determine whether the user can delete the jemput.
     *
     * @param  \App\User  $user
     * @param  \App\Jemput  $jemput
     * @return mixed
     */
    public function delete(User $user, Jemput $jemput)
    {
        //
    }

    /**
     * Determine whether the user can restore the jemput.
     *
     * @param  \App\User  $user
     * @param  \App\Jemput  $jemput
     * @return mixed
     */
    public function restore(User $user, Jemput $jemput)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the jemput.
     *
     * @param  \App\User  $user
     * @param  \App\Jemput  $jemput
     * @return mixed
     */
    public function forceDelete(User $user, Jemput $jemput)
    {
        //
    }
}
