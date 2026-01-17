<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlayableClass;

class PlayableClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            // ===== Combattants =====
            [
                'slug' => 'guerrier',
                'title' => 'Guerrier',
                'category' => 'Combattants',
                'image_path' => 'images/classes/guerrier.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Les guerriers sont l’archétype des combattants. Leur entraînement et leur éducation leur ont apporté vigueur et résistance.

**Équipement :**
- Armures : **toutes**
- Armes : **toutes**
MD
            ],
            [
                'slug' => 'paladin',
                'title' => 'Paladin',
                'category' => 'Combattants',
                'image_path' => 'images/classes/paladin.webp',
                'allowed_alignments' => ['LB'], // Loyal Bon uniquement
                'description' => <<<MD
Guerriers vertueux éduqués avec des principes moraux stricts. Les dieux leur offrent une parcelle de pouvoirs en récompense de leurs efforts.

**Alignement requis :** **Loyal Bon (LB)**

**Équipement :**
- Armures : **toutes**
- Armes : **toutes**
MD
            ],
            [
                'slug' => 'chevalier',
                'title' => 'Chevalier',
                'category' => 'Combattants',
                'image_path' => 'images/classes/chevalier.webp',
                'allowed_alignments' => ['LB', 'LN', 'LM'], // Loyal (Bon/Neutre/Mauvais)
                'description' => <<<MD
Fiers et courageux, les Chevaliers consacrent leur vie à l’idéalisme de la chevalerie : honneur, droiture, loyauté, bravoure.

**Alignement requis :** **Loyal** (**LB**, **LN** ou **LM**)

**Code de conduite (résumé) :**
- Loyauté envers les compagnons
- Courtoisie
- Honneur et justice
- Fierté
- Bravoure
- Respect de la parole donnée et de la hiérarchie

**Armes privilégiées :**
- Lance
- Épée longue
- Masse d’arme

*(Les armes à distance sont généralement délaissées car elles contredisent l’idéal de bravoure.)*
MD
            ],
            [
                'slug' => 'ranger',
                'title' => 'Ranger (Rôdeur)',
                'category' => 'Combattants',
                'image_path' => 'images/classes/ranger.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Combattants proches de la nature, excellents éclaireurs, connaissance des plaines et des forêts.

**Équipement :**
- Armures : **toutes sauf armure de plaques**
- Armes : **toutes**
MD
            ],
            [
                'slug' => 'barbare',
                'title' => 'Barbare',
                'category' => 'Combattants',
                'image_path' => 'images/classes/barbare.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Combattants des climats rudes, endurants, habitués à affronter créatures et éléments.

**Équipement :**
- Armures : **cuir clouté maximum**
- Armes : **toutes**
MD
            ],

            // ===== Lettrés =====
            [
                'slug' => 'clerc',
                'title' => 'Clerc',
                'category' => 'Lettrés',
                'image_path' => 'images/classes/clerc.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Représentants des dieux sur terre, intermédiaires entre le peuple et les divinités. Leurs pouvoirs varient selon la foi et la divinité servie.

**Équipement :**
- Armures : **toutes**
- Armes : **contondantes** (bâton, masse, marteau...) **ou arme de la divinité**
MD
            ],
            [
                'slug' => 'druide',
                'title' => 'Druide',
                'category' => 'Lettrés',
                'image_path' => 'images/classes/druide.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Sages vivant en harmonie avec la nature, ils cherchent à la protéger et peuvent influencer les éléments.

**Équipement :**
- Armures : **cuir clouté maximum**
- Armes : bâton, masse, fléau, cimeterre, faucille
MD
            ],
            [
                'slug' => 'mage',
                'title' => 'Mage',
                'category' => 'Lettrés',
                'image_path' => 'images/classes/mage.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Sages tirant leur puissance de la connaissance des énergies. Les longues heures d’étude les ont parfois éloignés de leur condition physique.

**Équipement :**
- Armures : **aucune** (pas de bouclier)
- Armes : bâton, dague, fléchettes
MD
            ],

            // ===== Roublards =====
            [
                'slug' => 'voleur',
                'title' => 'Voleur',
                'category' => 'Roublards',
                'image_path' => 'images/classes/voleur.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Spécialistes des habitudes et comportements des autres. Ils préfèrent forcer une serrure plutôt que forger une épée.

**Équipement :**
- Armures : **cuir clouté maximum** (pas de bouclier)
- Armes : **toutes armes à une main**

*Certains se spécialisent en assassin (souvent avec une profession de couverture).*
MD
            ],
            [
                'slug' => 'barde',
                'title' => 'Barde',
                'category' => 'Roublards',
                'image_path' => 'images/classes/barde.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Soutien et talents avant le vol : la pièce d’or a plus de valeur quand elle est donnée que soustraite.

**Équipement :**
- Armures : **aucune**
- Armes : **toutes**
MD
            ],
            [
                'slug' => 'marchand',
                'title' => 'Marchand',
                'category' => 'Roublards',
                'image_path' => 'images/classes/marchand.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Ils tirent profit des échanges et connaissent la valeur des choses selon les lieux. Ils savent accroître la valeur d’un objet en le transformant ou en le déplaçant.

**Équipement :**
- Armures : **toutes** (pas de bouclier)
- Armes : **toutes armes à une main**
MD
            ],
        ];

        foreach ($classes as $class) {
            PlayableClass::updateOrCreate(
                ['slug' => $class['slug']],
                [
                    'title' => $class['title'],
                    'description' => $class['description'],
                    'image_path' => $class['image_path'],
                    'category' => $class['category'],
                    'allowed_alignments' => $class['allowed_alignments'],
                ]
            );
        }
    }
}
