<?php

namespace App\Policies;

use App\User;
use App\Setoran;
use Illuminate\Auth\Access\HandlesAuthorization;

class SetoranPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any setorans.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->banksampah || $user->pegawai->type !== 'driver';
    }

    /**
     * Determine whether the user can view the setoran.
     *
     * @param  \App\User  $user
     * @param  \App\Setoran  $setoran
     * @return mixed
     */
    public function view(User $user, Setoran $setoran)
    {
        //
    }

    /**
     * Determine whether the user can create setorans.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the setoran.
     *
     * @param  \App\User  $user
     * @param  \App\Setoran  $setoran
     * @return mixed
     */
    public function update(User $user, Setoran $setoran)
    {
        return $user->banksampah ||
            ((banksampah()->id === $setoran->banksampah->id)
                &&
                ($setoran->status->id !== config('constants.statuses.SELESAI')));
    }

    /**
     * Determine whether the user can delete the setoran.
     *
     * @param  \App\User  $user
     * @param  \App\Setoran  $setoran
     * @return mixed
     */
    public function delete(User $user, Setoran $setoran)
    {
        //
    }

    /**
     * Determine whether the user can restore the setoran.
     *
     * @param  \App\User  $user
     * @param  \App\Setoran  $setoran
     * @return mixed
     */
    public function restore(User $user, Setoran $setoran)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the setoran.
     *
     * @param  \App\User  $user
     * @param  \App\Setoran  $setoran
     * @return mixed
     */
    public function forceDelete(User $user, Setoran $setoran)
    {
        //
    }
}
