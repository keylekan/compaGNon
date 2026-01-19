<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function view(User $user, Event $event): bool
    {
        if ($user->admin) {
            return true;
        }

        if (!$event->is_published) {
            return false;
        }

        return $event->registrations()
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->exists();
    }

    public function create(User $user): bool
    {
        return $user->admin;
    }

    public function update(User $user): bool
    {
        return $user->admin;
    }

    public function invite(User $user, Event $event): bool
    {
        return $user->admin;
    }
}
