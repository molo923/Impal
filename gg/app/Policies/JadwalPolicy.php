<?php

namespace App\Policies;

use App\Jadwal;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JadwalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any jadwals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'front';
    }

    /**
     * Determine whether the user can view the jadwal.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function view(User $user, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can create jadwals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the jadwal.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function update(User $user, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can delete the jadwal.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function delete(User $user, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can restore the jadwal.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function restore(User $user, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the jadwal.
     *
     * @param  \App\User  $user
     * @param  \App\Jadwal  $jadwal
     * @return mixed
     */
    public function forceDelete(User $user, Jadwal $jadwal)
    {
        //
    }
}
