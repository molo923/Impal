<?php

namespace App\Policies;

use App\SetoranPayment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DompetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any setoran payments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->banksampah || $user->pegawai->type === 'front';
    }

    /**
     * Determine whether the user can view the setoran payment.
     *
     * @param  \App\User  $user
     * @param  \App\SetoranPayment  $setoranPayment
     * @return mixed
     */
    public function view(User $user, SetoranPayment $setoranPayment)
    {
        //
    }

    /**
     * Determine whether the user can create setoran payments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the setoran payment.
     *
     * @param  \App\User  $user
     * @param  \App\SetoranPayment  $setoranPayment
     * @return mixed
     */
    public function update(User $user, SetoranPayment $setoranPayment)
    {
        //
    }

    /**
     * Determine whether the user can delete the setoran payment.
     *
     * @param  \App\User  $user
     * @param  \App\SetoranPayment  $setoranPayment
     * @return mixed
     */
    public function delete(User $user, SetoranPayment $setoranPayment)
    {
        //
    }

    /**
     * Determine whether the user can restore the setoran payment.
     *
     * @param  \App\User  $user
     * @param  \App\SetoranPayment  $setoranPayment
     * @return mixed
     */
    public function restore(User $user, SetoranPayment $setoranPayment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the setoran payment.
     *
     * @param  \App\User  $user
     * @param  \App\SetoranPayment  $setoranPayment
     * @return mixed
     */
    public function forceDelete(User $user, SetoranPayment $setoranPayment)
    {
        //
    }
}
