<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InviteAdminAction
{
    /**
     * @param  array<int, string>  $emails
     * @return array{created:int, updated:int, linked:int, skipped:int}
     */
    public function execute(array $emails): array
    {
        $emails = collect($emails)
            ->map(fn ($e) => Str::of($e)->trim()->lower()->toString())
            ->filter()
            ->unique()
            ->values();

        if ($emails->isEmpty()) {
            return ['created' => 0, 'updated' => 0, 'skipped' => 0];
        }

        $usersByEmail = User::query()
            ->whereIn('email', $emails->all())
            ->get(['id', 'email'])
            ->keyBy('email');

        $stats = ['created' => 0, 'updated' => 0, 'skipped' => 0];

        DB::transaction(function () use ($emails, $usersByEmail, &$stats) {
            foreach ($emails as $email) {
                $user = $usersByEmail->get($email);

                // Si user existe, rattacher immédiatement
                if ($user) {
                    if ($user->admin) {
                        $stats['skipped']++;
                        continue;
                    }

                    $user->admin = true;
                    $user->save();

                    $stats['updated']++;
                } else {
                    User::create(['email' => $email, 'admin' => true, 'name' => '', 'password' => '']);
                    $stats['created']++;
                }
            }
        });

        return $stats;
    }
}
