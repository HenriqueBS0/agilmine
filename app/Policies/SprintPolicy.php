<?php

namespace App\Policies;

use App\Models\Sprint;
use App\Models\User;
use Gate;

class SprintPolicy
{

    public function isGestor(User $user, Sprint $sprint)
    {
        return Gate::forUser($user)->allows('isGestor', $sprint->projeto);
    }

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
