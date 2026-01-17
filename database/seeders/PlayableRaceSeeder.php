<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlayableRace;

class PlayableRaceSeeder extends Seeder
{
    public function run(): void
    {
        $races = [
            [
                'slug' => 'elfe',
                'title' => 'Elfe',
                'image_path' => 'images/races/elfe.webp',
                'description' => <<<MD
Les elfes mesurent au moins **1m70** et sont plutôt sveltes, avec des **oreilles pointues**.

**Traits :**
- Immunisés au sort *sommeil*.
- Résistent à la magie affectant l’esprit **1 fois par jour**.
- **-1 point de vie** (faible corpulence).
- Vision nocturne excellente (**extérieur uniquement**).
  *(Une lampe frontale devra être utilisée, n’oubliez pas de l’emmener.)*
- Immunisés à la paralysie due au toucher des goules.
- Bénéficient de la compétence **Tir précis** avec les arcs.
MD
            ],
            [
                'slug' => 'demi-elfe',
                'title' => 'Demi-elfe',
                'image_path' => 'images/races/demi-elfe.webp',
                'description' => <<<MD
Les demi-elfes mesurent au moins **1m75**, ont des **oreilles pointues** et une **vision nocturne excellente** (**extérieur uniquement**).
*(Une lampe frontale devra être utilisée, n’oubliez pas de l’emmener.)*

**Traits :**
- Immunisés au sort *sommeil*.
MD
            ],
            [
                'slug' => 'hobbit',
                'title' => 'Hobbit',
                'image_path' => 'images/races/hobbit.webp',
                'description' => <<<MD
Les hobbits mesurent au maximum **1m55**. Leurs **pieds larges** sont généralement **velus**.

**Traits :**
- Vision nocturne excellente (**extérieur uniquement**).
- Braves : résistent aux sorts de **peur** ou **fuite** **2 fois par jour**.
- Préfèrent les armes de jets : compétence **Tir précis**.
- **-1 point de vie**.
MD
            ],
            [
                'slug' => 'humain',
                'title' => 'Humain',
                'image_path' => 'images/races/humain.webp',
                'description' => <<<MD
Les humains ont une **faculté d’apprentissage élevée**.

**Traits :**
- +2 points de compétence **C**
- +1 point de compétence **L**
MD
            ],
            [
                'slug' => 'demi-orc',
                'title' => 'Demi-orc',
                'image_path' => 'images/races/demi-orc.webp',
                'description' => <<<MD
Les demi-orcs sont peu aimés des races civilisées : peau verdâtre, oreilles pointues, dents proéminentes et carrure imposante.

**Traits :**
- Possèdent le don **Brute**.
- Vision excellente dans l’obscurité (**extérieur et intérieur**).
  *(Une lampe frontale devra être utilisée, n’oubliez pas de l’emmener.)*
- Faible intelligence : **-1 point de compétence par niveau**.
MD
            ],
            [
                'slug' => 'nain',
                'title' => 'Nain',
                'image_path' => 'images/races/nain.webp',
                'description' => <<<MD
Les nains mesurent au maximum **1m65**. Barbe et forte corpulence sont leurs signes les plus remarquables. Ils ont une aversion pour la magie.

**Traits :**
- Vision excellente dans l’obscurité (**extérieur et intérieur**).
  *(Une lampe frontale devra être utilisée, n’oubliez pas de l’emmener.)*
- Haine envers les goblinoïdes : **+1 dégât** contre eux.
- Résistent au poison **1 fois par GN**.
- **+1 point de vie**.
- Résistent à la magie affectant l’esprit **1 fois par jour**.
MD
            ],
        ];

        foreach ($races as $race) {
            PlayableRace::updateOrCreate(
                ['slug' => $race['slug']],
                [
                    'title' => $race['title'],
                    'description' => $race['description'],
                    'image_path' => $race['image_path'],
                ]
            );
        }
    }
}
