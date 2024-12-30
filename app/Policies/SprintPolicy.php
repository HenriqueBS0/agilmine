<?php

namespace App\Policies;

use App\Models\Sprint;
use App\Models\User;

class SprintPolicy
{
    /**
     * Determine se a ação pode ser realizada na sprint que não está cancelada.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sprint $sprint
     * @return bool
     */
    public function isAtiva(User $user, Sprint $sprint)
    {
        return $sprint->cancelada === false;
    }
}
