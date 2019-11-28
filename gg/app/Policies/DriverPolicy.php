<?php

namespace App\Policies;

use App\User;
use App\Driver;
use Illuminate\Auth\Access\HandlesAuthorization;

class DriverPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any drivers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'front' || $user->pegawai->type === 'driver';
    }

    /**
     * Determine whether the user can view the driver.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function view(User $user, Driver $driver)
    {
        //
    }

    /**
     * Determine whether the user can create drivers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the driver.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function update(User $user, Driver $driver)
    {
        //
    }

    /**
     * Determine whether the user can delete the driver.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function delete(User $user, Driver $driver)
    {
        //
    }

    /**
     * Determine whether the user can restore the driver.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function restore(User $user, Driver $driver)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the driver.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function forceDelete(User $user, Driver $driver)
    {
        //
    }
}
