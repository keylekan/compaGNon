<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSkillSeeder extends Seeder
{
    public function run(): void
    {
        Character::query()->chunkById(100, function ($characters) {
            foreach ($characters as $character) {
                $characterCreatedAt = $character->created_at ?? now();

                DB::transaction(function () use ($character, $characterCreatedAt) {
                    DB::table('character_skill')
                        ->where('character_id', $character->id)
                        ->where('locked', true)
                        ->whereNull('cost_paid_c')
                        ->whereNull('cost_paid_l')
                        ->whereNull('cost_paid_v')
                        ->whereNull('cost_paid_r')
                        ->delete();

                    $grantedSkills = collect();

                    foreach ($character->classes as $playableClass) {
                        $classLevel = $playableClass->pivot->level ?? 1;

                        $classSkillIds = DB::table('skill_class_levels')
                            ->where('playable_class_id', $playableClass->id)
                            ->where('level', '<=', $classLevel)
                            ->pluck('skill_id');

                        $grantedSkills = $grantedSkills->merge($classSkillIds);
                    }

                    if ($character->race_id) {
                        $raceSkillIds = DB::table('skill_playable_race')
                            ->where('playable_race_id', $character->playable_race_id)
                            ->pluck('skill_id');

                        $grantedSkills = $grantedSkills->merge($raceSkillIds);
                    }

                    if ($grantedSkills->isEmpty()) {
                        return;
                    }

                    $rows = $grantedSkills
                        ->countBy()
                        ->map(function (int $quantity, $skillId) use ($character, $characterCreatedAt) {
                            return [
                                'character_id' => $character->id,
                                'skill_id' => (int) $skillId,
                                'quantity' => $quantity,
                                'cost_paid_c' => null,
                                'cost_paid_l' => null,
                                'cost_paid_v' => null,
                                'cost_paid_r' => null,
                                'locked' => true,
                                'purchased_at' => $characterCreatedAt,
                                'created_at' => $characterCreatedAt,
                                'updated_at' => $characterCreatedAt,
                            ];
                        })
                        ->values()
                        ->all();

                    DB::table('character_skill')->insert($rows);
                });
            }
        });
    }
}
