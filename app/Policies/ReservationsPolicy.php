<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;

class ReservationsPolicy extends Policy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function delete(User $user, Reservation $reservation)
    {
        return $reservation->user_id === $user->id;
    }
}
