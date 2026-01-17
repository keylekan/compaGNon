<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        // Si ta home est accessible sans login, gère ce cas
        if (! $user) {
            return view('home', [
                'upcomingEvents' => collect(),
            ]);
        }

        $query = Event::query()
            ->where('is_published', true)
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->limit(3);

        if (! $user->admin) {
            $query->whereHas('registrations', function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            });
        }

        return view('home', [
            'upcomingEvents' => $query->get(),
        ]);
    }
}
