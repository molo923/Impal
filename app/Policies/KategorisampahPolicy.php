<?php

namespace App\Policies;

use App\User;
use App\Kategorisampah;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategorisampahPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any kategorisampahs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'back';
    }

    /**
     * Determine whether the user can view the kategorisampah.
     *
     * @param  \App\User  $user
     * @param  \App\Kategorisampah  $kategorisampah
     * @return mixed
     */
    public function view(User $user, Kategorisampah $kategorisampah)
    {
        //
    }

    /**
     * Determine whether the user can create kategorisampahs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'back';
    }

    /**
     * Determine whether the user can update the kategorisampah.
     *
     * @param  \App\User  $user
     * @param  \App\Kategorisampah  $kategorisampah
     * @return mixed
     */
    public function update(User $user, Kategorisampah $kategorisampah)
    {
        return ($user->banksampah || $user->pegawai->type === 'back');
    }

    /**
     * Determine whether the user can delete the kategorisampah.
     *
     * @param  \App\User  $user
     * @param  \App\Kategorisampah  $kategorisampah
     * @return mixed
     */
    public function delete(User $user, Kategorisampah $kategorisampah)
    {
        //
    }

    /**
     * Determine whether the user can restore the kategorisampah.
     *
     * @param  \App\User  $user
     * @param  \App\Kategorisampah  $kategorisampah
     * @return mixed
     */
    public function restore(User $user, Kategorisampah $kategorisampah)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the kategorisampah.
     *
     * @param  \App\User  $user
     * @param  \App\Kategorisampah  $kategorisampah
     * @return mixed
     */
    public function forceDelete(User $user, Kategorisampah $kategorisampah)
    {
        //
    }
}
