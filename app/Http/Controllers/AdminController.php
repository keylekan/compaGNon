<?php

namespace App\Http\Controllers;

use App\Actions\InviteAdminAction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index ()
    {
        $admins = User::query()
            ->where('admin', true)
            ->orderBy('name')
            ->orderBy('email')
            ->get();

        return view('admin', [
            'admins' => $admins,
        ]);
    }

    public function invite(
        Request $request,
        InviteAdminAction $inviteAdmin
    ) {
        if (! $request->user()?->admin) {
            abort(403);
        }

        $data = $request->validate([
            'emails' => ['required', 'string'],
        ]);

        // textarea → array
        $emails = preg_split('/[\s,;]+/', $data['emails']);

        $stats = $inviteAdmin->execute($emails);

        return back()->with('success', sprintf(
            'Comptes admin créés : %d créés, %d mis à jour.',
            $stats['created'],
            $stats['updated'],
        ));
    }
}
