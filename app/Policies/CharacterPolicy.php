<?php

namespace App\Policies;

use App\Models\Character;
use App\Models\User;

class CharacterPolicy
{
    public function view(User $user, Character $character): bool
    {
        if ($user->admin) {
            return true;
        }

        if ($character->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function update(User $user, Character $character): bool
    {
        if ($character->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Character $character): bool
    {
        if ($character->user_id === $user->id) {
            return true;
        }

        return false;
    }
}
