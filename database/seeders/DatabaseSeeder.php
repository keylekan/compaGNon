<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::firstWhere(['email' => 'contact@lesderniersdesolace.com']);
        if (! $admin) {
            User::factory()->create([
                'name' => 'Admin LDS',
                'email' => 'contact@lesderniersdesolace.com',
                'admin' => true,
            ]);
        }

        $this->call([
            PlayableRaceSeeder::class,
            PlayableClassSeeder::class,
        ]);
    }
}
