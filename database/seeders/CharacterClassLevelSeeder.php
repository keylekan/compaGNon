<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CharacterClass;
use App\Models\CharacterClassLevel;

class CharacterClassLevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [0, 1];

        CharacterClass::all()->each(function ($class) use ($levels) {
            foreach ($levels as $level) {
                CharacterClassLevel::updateOrCreate(
                    [
                        'character_class_id' => $class->id,
                        'level' => $level,
                    ],
                    [
                        'variant' => 'default',
                    ]
                );
            }
        });
    }
}
