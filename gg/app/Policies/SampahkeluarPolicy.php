<?php

namespace App\Policies;

use App\User;
use App\Sampahkeluar;
use Illuminate\Auth\Access\HandlesAuthorization;

class SampahkeluarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sampahkeluars.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'front';
    }

    /**
     * Determine whether the user can view the sampahkeluar.
     *
     * @param  \App\User  $user
     * @param  \App\Sampahkeluar  $sampahkeluar
     * @return mixed
     */
    public function view(User $user, Sampahkeluar $sampahkeluar)
    {
        //
    }

    /**
     * Determine whether the user can create sampahkeluars.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'front';
    }

    /**
     * Determine whether the user can update the sampahkeluar.
     *
     * @param  \App\User  $user
     * @param  \App\Sampahkeluar  $sampahkeluar
     * @return mixed
     */
    public function update(User $user, Sampahkeluar $sampahkeluar)
    {
        return ($user->banksampah || $user->pegawai->type === 'back')
            && ($user->banksampah->id ?? $user->pegawai->banksampah->id)
            === $sampahkeluar->banksampah->id;
    }

    /**
     * Determine whether the user can delete the sampahkeluar.
     *
     * @param  \App\User  $user
     * @param  \App\Sampahkeluar  $sampahkeluar
     * @return mixed
     */
    public function delete(User $user, Sampahkeluar $sampahkeluar)
    {
        //
    }

    /**
     * Determine whether the user can restore the sampahkeluar.
     *
     * @param  \App\User  $user
     * @param  \App\Sampahkeluar  $sampahkeluar
     * @return mixed
     */
    public function restore(User $user, Sampahkeluar $sampahkeluar)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the sampahkeluar.
     *
     * @param  \App\User  $user
     * @param  \App\Sampahkeluar  $sampahkeluar
     * @return mixed
     */
    public function forceDelete(User $user, Sampahkeluar $sampahkeluar)
    {
        //
    }
}
