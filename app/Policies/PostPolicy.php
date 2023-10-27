<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function verify(User $user)
    {
        // Check if the user has viewed 4 different snacks
        return $user->snackView() >= 4;
    }
}
