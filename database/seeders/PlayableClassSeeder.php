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

| Niveau 1 | Équipement |
|---------|------------|
| 10 points de vie<br>Armurerie (1)<br>4 points de compétence C | Armures : **toutes**<br>Armes : **toutes** |
MD
            ],
            [
                'slug' => 'paladin',
                'title' => 'Paladin',
                'category' => 'Combattants',
                'image_path' => 'images/classes/paladin.webp',
                'allowed_alignments' => ['LB'],
                'description' => <<<MD
Guerriers vertueux éduqués avec des principes moraux stricts. Les dieux leur offrent une parcelle de pouvoirs en récompense de leurs efforts.

**Alignement requis :** **Loyal Bon (LB)**

| Niveau 1 | Équipement |
|---------|------------|
| 10 points de vie<br>Imposition des mains (+2 PV)<br>Repousser les morts-vivants<br>Santé divine (immunité maladies)<br>Guérison de la maladie<br>Détection du mal | Armures : **toutes**<br>Armes : **toutes** |
MD
            ],
            [
                'slug' => 'chevalier',
                'title' => 'Chevalier',
                'category' => 'Combattants',
                'image_path' => 'images/classes/chevalier.webp',
                'allowed_alignments' => ['LB', 'LN', 'LM'],
                'description' => <<<MD
Fiers et courageux, les Chevaliers consacrent leur vie à l’idéalisme de la chevalerie : honneur, droiture, loyauté, bravoure.

**Alignement requis :** **Loyal** (**Loyal Bon**, **Loyal Neutre** ou **Loyal Mauvais**)

| Niveau 1 | Informations |
|---------|------------------------------|
| 10 points de vie<br>Aura de valeur<br>Bravoure<br>Volonté de fer<br>2 points de compétence C | **Armes privilégiées** : lance, épée longue, masse<br>**Armures** : toutes, avec une préférence pour les armures lourdes<br>**Code de conduite** :<br>- Loyauté envers les compagnons<br>- Courtoisie<br>- Honneur et justice<br>- Fierté<br>- Bravoure<br>- Respect de la parole donnée et de la hiérarchie |
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

| Niveau 1 | Équipement |
|---------|------------|
| 10 points de vie<br>Pistage<br>Connaissance de la forêt | Armures : **toutes sauf plaques**<br>Armes : **toutes** |
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

| Niveau 1 | Équipement |
|---------|------------|
| 11 points de vie<br>Maroquinerie (1)<br>Survie en milieu hostile<br>Rage | Armures : **cuir clouté maximum**<br>Armes : **toutes** |
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
Représentants des dieux sur terre, intermédiaires entre le peuple et les divinités.

| Niveau 1 | Équipement |
|---------|------------|
| 8 points de vie<br>Repousser/contrôler les morts-vivants<br>Pouvoir divin<br>Lire et écrire<br>3 sorts niveau 1<br>2 sorts niveau 2<br>1 sort niveau 3 | Armures : **toutes**<br>Armes : **contondantes** ou arme de la divinité |
MD
            ],
            [
                'slug' => 'druide',
                'title' => 'Druide',
                'category' => 'Lettrés',
                'image_path' => 'images/classes/druide.webp',
                'allowed_alignments' => ['LN', 'NN', 'CN', 'NB', 'NM'],
                'description' => <<<MD
Sages vivant en harmonie avec la nature, ils cherchent à la protéger.

**Alignement requis :** **Composante neutre** (**Loyal Neutre**, **Chaotique Neutre**, **Neutre Bon**, **Neutre Mauvais** ou **Neutre**)

| Niveau 1 | Équipement |
|---------|------------|
| 8 points de vie<br>Lire et écrire<br>Connaissance de la forêt<br>3 sorts niveau 1<br>2 sorts niveau 2<br>1 sort niveau 3 | Armures : **cuir clouté maximum**<br>Armes : bâton, masse, fléau, cimeterre, faucille |
MD
            ],
            [
                'slug' => 'mage',
                'title' => 'Mage',
                'category' => 'Lettrés',
                'image_path' => 'images/classes/mage.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Sages tirant leur puissance de la connaissance des énergies.

| Niveau 1 | Équipement |
|---------|------------|
| 5 points de vie<br>Résistance aux dégâts magiques<br>Lire et écrire<br>4 sorts niveau 1<br>3 sorts niveau 2<br>1 sort niveau 3 | Armures : **aucune**<br>Armes : bâton, dague, fléchettes |
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
Spécialistes des habitudes et comportements des autres.

| Niveau 1 | Équipement |
|---------|------------|
| 6 points de vie<br>10 points de compétence V1<br>4 points de compétence V<br>Attaque dans le dos (x2) | Armures : **cuir clouté maximum**<br>Armes : **armes à une main** |
MD
            ],
            [
                'slug' => 'barde',
                'title' => 'Barde',
                'category' => 'Roublards',
                'image_path' => 'images/classes/barde.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Soutien et talents avant le vol.

| Niveau 1 | Équipement |
|---------|------------|
| 6 points de vie<br>Chanter ou jouer d’un instrument<br>Fascination<br>Savoir bardique<br>Inspiration vaillante<br>Lire et écrire<br>4 points de compétence V1<br>2 sorts niveau 1 (mage)<br>1 sort niveau 2 (mage) | Armures : **aucune**<br>Armes : **toutes** |
MD
            ],
            [
                'slug' => 'marchand',
                'title' => 'Marchand',
                'category' => 'Roublards',
                'image_path' => 'images/classes/marchand.webp',
                'allowed_alignments' => null,
                'description' => <<<MD
Ils tirent profit des échanges et connaissent la valeur des choses.

| Niveau 1 | Équipement |
|---------|------------|
| 6 points de vie<br>Évaluer 2<br>Commerce (1)<br>4 points de compétence V1<br>2 points de compétence L<br>1 point de compétence C | Armures : **toutes**<br>Armes : **armes à une main** |
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
