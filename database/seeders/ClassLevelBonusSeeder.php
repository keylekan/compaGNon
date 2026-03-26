<?php

namespace Database\Seeders;

use App\Models\PlayableClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassLevelBonusSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $data = [
            'barbare' => [
                'default' => [
                    0 => ['hit_points' => 9, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    2 => ['hit_points' => 2,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    3 => ['hit_points' => 2,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    4 => ['hit_points' => 3,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    5 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    6 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    7 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    8 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    9 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    10 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                ],
            ],

            'guerrier' => [
                'default' => [
                    0 => ['hit_points' => 8, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 4, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    2 => ['hit_points' => 2,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    3 => ['hit_points' => 2,  'points_c' => 4, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    4 => ['hit_points' => 2,  'points_c' => 4, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    5 => ['hit_points' => 0,  'points_c' => 4, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    6 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    7 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    8 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    9 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    10 => ['hit_points' => 0, 'points_c' => 4, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                ],
            ],

            'chevalier' => [
                'default' => [
                    0 => ['hit_points' => 8, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    2 => ['hit_points' => 2,  'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    3 => ['hit_points' => 2,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                ],
            ],

            'paladin' => [
                'default' => [
                    0 => ['hit_points' => 8, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    2 => ['hit_points' => 2,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    3 => ['hit_points' => 2,  'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    4 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    5 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    6 => ['hit_points' => 1,  'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    7 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    8 => ['hit_points' => 1,  'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    9 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    10 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                ],
            ],

            'ranger' => [
                'default' => [
                    0 => ['hit_points' => 8, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    2 => ['hit_points' => 1,  'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    3 => ['hit_points' => 2,  'points_c' => 4, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    4 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    5 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    6 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    7 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    8 => ['hit_points' => 1,  'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    9 => ['hit_points' => 1,  'points_c' => 2, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    10 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                ],
            ],

            'clerc' => [
                'default' => [
                    0 => ['hit_points' => 6, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    2 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    3 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    4 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 4, 'points_v' => 0, 'points_r' => 0],
                    5 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    6 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    7 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    8 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    9 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    10 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                ],
            ],

            'druide' => [
                'default' => [
                    0 => ['hit_points' => 6, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    2 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    3 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 4, 'points_v' => 0, 'points_r' => 0],
                    4 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    5 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    6 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    7 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    8 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    9 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    10 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                ],
            ],

            'mage' => [
                'default' => [
                    0 => ['hit_points' => 4, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    2 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 4, 'points_v' => 0, 'points_r' => 0],
                    3 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 4, 'points_v' => 0, 'points_r' => 0],
                    4 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 4, 'points_v' => 0, 'points_r' => 0],
                    5 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    6 => ['hit_points' => 0, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    7 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    8 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    9 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                    10 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 0],
                ],
            ],

            'voleur' => [
                'default' => [
                    0 => ['hit_points' => 4, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 4, 'points_r' => 10],
                    2 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 2, 'points_r' => 4],
                    3 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    4 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 2, 'points_r' => 4],
                    5 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 4],
                    6 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    7 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    8 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    9 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    10 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                ],
            ],

            'marchand' => [
                'default' => [
                    0 => ['hit_points' => 4, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 1, 'points_l' => 2, 'points_v' => 0, 'points_r' => 4],
                    2 => ['hit_points' => 2, 'points_c' => 1, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                    3 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                    4 => ['hit_points' => 2, 'points_c' => 1, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                    5 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                    6 => ['hit_points' => 1, 'points_c' => 1, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                    7 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                    8 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                    9 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                    10 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 0, 'points_r' => 2],
                ],
            ],

            'barde' => [
                'default' => [
                    0 => ['hit_points' => 4, 'points_c' => 0, 'points_l' => 0, 'points_v' => 0, 'points_r' => 0],
                    1 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 0, 'points_v' => 2, 'points_r' => 4],
                ],

                'combattant' => [
                    2 => ['hit_points' => 2, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    3 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    4 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    5 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    6 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    7 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    8 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    9 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                    10 => ['hit_points' => 1, 'points_c' => 2, 'points_l' => 0, 'points_v' => 2, 'points_r' => 2],
                ],

                'lettré' => [
                    2 => ['hit_points' => 2, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                    3 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                    4 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                    5 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                    6 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                    7 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                    8 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                    9 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                    10 => ['hit_points' => 1, 'points_c' => 0, 'points_l' => 2, 'points_v' => 2, 'points_r' => 2],
                ],
            ],
        ];

        DB::table('class_level_bonuses')->delete();

        foreach ($data as $className => $variants) {
            $playableClass = PlayableClass::query()
                ->where('slug', $className)
                ->first();

            if (! $playableClass) {
                $this->command?->warn("Classe introuvable : {$className}");
                continue;
            }

            $rows = [];

            foreach ($variants as $variant => $levels) {
                foreach ($levels as $level => $values) {
                    $rows[] = [
                        'playable_class_id' => $playableClass->id,
                        'level' => $level,
                        'variant' => $variant,
                        'hit_points' => $values['hit_points'],
                        'points_c' => $values['points_c'],
                        'points_l' => $values['points_l'],
                        'points_v' => $values['points_v'],
                        'points_r' => $values['points_r'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            DB::table('class_level_bonuses')->insert($rows);
        }
    }
}
