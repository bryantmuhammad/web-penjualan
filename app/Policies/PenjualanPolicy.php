<?php

namespace App\Policies;

use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenjualanPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Penjualan $penjualan)
    {
        return $user->id == $penjualan->user_id;
    }
}
