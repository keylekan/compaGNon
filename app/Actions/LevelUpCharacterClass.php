<?php

namespace App\Actions;

use App\Models\Character;
use App\Models\CharacterClass;
use App\Models\SkillClassLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use RuntimeException;
use Throwable;

class LevelUpCharacterClass
{
    /**
     * Passage de niveau d'une classe pour un personnage
     * @throws Throwable
     */
    public function execute(Character $character, int $playableClassId, string $variant = 'default'): CharacterClass
    {
        return DB::transaction(function () use ($character, $playableClassId, $variant) {
            $currentGlobalLevel = $character->characterClasses()->sum('level');

            if ($currentGlobalLevel >= 10) {
                throw new RuntimeException('Le personnage a déjà atteint le niveau maximum.');
            }

            // 1. Récupérer la classe du personnage
            $character->characterClasses()
                ->firstOrCreate(
                    ['class_id' => $playableClassId],
                    ['level' => 0],
                );
            $class = $character->characterClasses()
                ->where('class_id', $playableClassId)
                ->lockForUpdate()
                ->firstOrFail();

            // 2. Calcul du nouveau niveau
            $newLevel = $class->level + 1;

            // 3. Mise à jour
            $class->update([
                'level' => $newLevel,
            ]);

            // 4. Bonus de niveau
            $class->levels()->create([
                'level' => $newLevel,
                'variant' => $variant,
            ]);

            // 5. Récupérer les compétences à débloquer
            $skillsToGrant = $this->getSkillsForLevel($playableClassId, $newLevel);

            // 6. Les attacher au personnage
            $this->attachSkillsToCharacter($character, $skillsToGrant);

            $character->skills()->update([
                'locked' => true,
            ]);

            return $class->fresh();
        });
    }

    /**
     * Récupère les compétences débloquées à un niveau donné
     */
    protected function getSkillsForLevel(int $playableClassId, int $level): Collection
    {
        return SkillClassLevel::query()
            ->with('skill')
            ->where('playable_class_id', $playableClassId)
            ->where('level', $level)
            ->get();
    }

    /**
     * Attache les compétences au personnage sans doublons
     */
    protected function attachSkillsToCharacter(
        Character $character,
        Collection $skills,
    ): void {
        foreach ($skills as $skillLevel) {
            $character->skills()->attach($skillLevel->skill_id, [
                'purchased_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
