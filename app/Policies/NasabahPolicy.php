<?php

namespace App\Policies;

use App\User;
use App\Nasabah;
use Illuminate\Auth\Access\HandlesAuthorization;

class NasabahPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any nasabahs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'front';
    }

    /**
     * Determine whether the user can view the nasabah.
     *
     * @param  \App\User  $user
     * @param  \App\Nasabah  $nasabah
     * @return mixed
     */
    public function view(User $user, Nasabah $nasabah)
    {
        //
    }

    /**
     * Determine whether the user can create nasabahs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the nasabah.
     *
     * @param  \App\User  $user
     * @param  \App\Nasabah  $nasabah
     * @return mixed
     */
    public function update(User $user, Nasabah $nasabah)
    {
        //
    }

    /**
     * Determine whether the user can delete the nasabah.
     *
     * @param  \App\User  $user
     * @param  \App\Nasabah  $nasabah
     * @return mixed
     */
    public function delete(User $user, Nasabah $nasabah)
    {
        //
    }

    /**
     * Determine whether the user can restore the nasabah.
     *
     * @param  \App\User  $user
     * @param  \App\Nasabah  $nasabah
     * @return mixed
     */
    public function restore(User $user, Nasabah $nasabah)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the nasabah.
     *
     * @param  \App\User  $user
     * @param  \App\Nasabah  $nasabah
     * @return mixed
     */
    public function forceDelete(User $user, Nasabah $nasabah)
    {
        //
    }
}
