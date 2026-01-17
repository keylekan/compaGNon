<?php

namespace App\Http\Controllers;

use App\Actions\InviteUsersToEventAction;
use App\Enums\EventType;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Event::query()->where('is_published', true);

        if (! $user->admin) {
            $query->whereHas('registrations', function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            });
        }

        $events = $query->orderByDesc('starts_at')->get();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Event::class);

        return view('events.create', [
            'types' => EventType::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Event::class);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'type' => ['required', new Enum(EventType::class)],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $event = Event::create([
            ...$data,
            'is_published' => $data['is_published'] ?? false,
        ]);

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Événement créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Event $event)
    {
        if (! $event->is_published && ! $request->user()->admin) {
            abort(404);
        }

        Gate::authorize('view', $event);

        $user = $request->user();

        $registration = $event->registrations()
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->with('character')
            ->first();

        return view('events.show', compact('event', 'registration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        Gate::authorize('invite', $event);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        Gate::authorize('invite', $event);
        //
    }

    public function invite(
        Request $request,
        Event $event,
        InviteUsersToEventAction $inviteUsersToEvent
    ) {
        Gate::authorize('invite', $event);

        $data = $request->validate([
            'emails' => ['required', 'string'],
            'payment_status' => ['nullable', 'in:unknown,unpaid,paid,refunded'],
        ]);

        // textarea → array
        $emails = preg_split('/[\s,;]+/', $data['emails']);

        $defaults = [];
        if (! empty($data['payment_status'])) {
            $defaults['payment_status'] = $data['payment_status'];
            if ($data['payment_status'] === 'paid') {
                $defaults['paid_at'] = now();
            }
        }

        $stats = $inviteUsersToEvent->execute($event, $emails, $defaults);

        return back()->with('success', sprintf(
            'Invitations traitées : %d créées, %d mises à jour, %d liées.',
            $stats['created'],
            $stats['updated'],
            $stats['linked'],
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
