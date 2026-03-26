<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\PlayableClass;
use App\Models\PlayableRace;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $races = PlayableRace::query()
            ->get()
            ->keyBy('slug');

        $classes = PlayableClass::query()
            ->get()
            ->keyBy('slug');

        $defaultClassLevel = 1;

        $skills = [
            // DONS
            [
                'title' => 'Attaque Sournoise',
                'description' => <<<MD
Attaque dans le dos.

En utilisant cette compétence, la personne qui effectuera une attaque dans le dos doublera les points de dégâts lors de la première attaque. Ces dégâts ne prennent pas en compte l'armure afin de restituer la qualité de l’attaque. Pour effectuer cette attaque, posez votre main sur l'épaule de votre victime, posez votre lame à plat sur son dos, et annoncez les dégâts qu’il subit.
MD,
                'class_levels' => [
                    ['class' => 'voleur', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Aura de valeur',
                'description' => <<<MD
Le Chevalier est l'incarnation vivante des idéaux les plus élevés. 1 fois par jour par niveau du chevalier, tous ses alliés situés à moins de 3 mètres de lui bénéficient d'une immunité contre la peur pendant 1 combat, dans la limite de 4 + 1 par niveau du chevalier. Si le chevalier est immobilisé, inconscient ou impuissant, ses alliés perdent ce bonus.
MD,
                'class_levels' => [
                    ['class' => 'chevalier', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Brave',
                'description' => <<<MD
Les personnages possédant ce don sont des braves, elles résistent à la peur (magique ou non) ou au sort de fuite 2 fois par jour.
MD,
                'races' => ['hobbit'],
            ],
            [
                'title' => 'Bravoure',
                'description' => <<<MD
Les chevaliers sont courageux et développent une capacité importante à surmonter les périls les plus effrayants. Ils résistent à la peur (magique ou non) 1 fois par jour par niveau du chevalier.
MD,
                'class_levels' => [
                    ['class' => 'chevalier', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Brute',
                'description' => <<<MD
Par son lien de parenté avec les orcs, le demi-orc est une créature brutale. Il bénéficie de 1 point de dégât supplémentaire sur une attaque lors d’un combat. Le combattant annonce les dégâts augmentés d’1 point suivis de « Brute ».
MD,
                'races' => ['demi-orc'],
            ],
            [
                'title' => 'Connaissance de la forêt',
                'description' => <<<MD
Connaissance de la faune et de la flore de la forêt, de ses dangers et des méthodes pour y progresser et y survivre. Un groupe de dix personnes peut être guidé grâce à cette compétence. Les membres d'un groupe non accompagnés d’une personne possédant ce don perdent tous 1 point d'armure et 2 points de vie du fait de la méconnaissance du milieu et de ses dangers.
MD,
                'class_levels' => [
                    ['class' => 'druide', 'level' => $defaultClassLevel],
                    ['class' => 'ranger', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Détection du mal',
                'description' => <<<MD
Permet, en se concentrant et en déchirant un morceau de parchemin sacré, de détecter un objet ou une personne dégageant une aura maléfique. Un Clerc d’alignement mauvais dégage plus ou moins cette aura, un guerrier ou un voleur pas forcément. Contactez un Orga.
MD,
                'class_levels' => [
                    ['class' => 'paladin', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Ennemi juré',
                'description' => <<<MD
Permet de doubler les dégâts contre un type de créature ou une race.

Exemples : orcs et demi-orcs, trolls, nains, elfes, humains, hobbits, gobelins, hobegobelins, duergars, drows (elfes noirs), dridders, harpies, dragons, gnolls, kobolds, orgres et ogres-mages, ours-hiboux, squelettes, zombies, fantômes et créatures éthérées, araignées géantes, githyankis, lycanthropes, vampires, ethercaps, goules, flagelleurs mentaux, gauth, tyrannœil, méduses, minotaures, satyres…
MD,
                'class_levels' => [
                    ['class' => 'ranger', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Fascination',
                'description' => <<<MD
Le barde est un artiste qui utilise le chant et la musique pour exercer une fascination sur une créature humanoïde par niveau. La créature, de taille moyenne, est captivée par le chant ou la musique, elle devient inoffensive et le restera tant que le barde exercera son art. Si elle est attaquée, la fascination est rompue. Utilisable 1 fois par jour par niveau de barde.
MD,
                'class_levels' => [
                    ['class' => 'barde', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Guérison de la maladie',
                'description' => <<<MD
Permet de guérir n'importe quelle maladie une fois par semaine, soit 1 fois pendant la durée du GN.
MD,
                'class_levels' => [
                    ['class' => 'paladin', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Haine',
                'description' => <<<MD
Les Nains ont une haine envers les goblinoïdes. Ils bénéficient d’un bonus de 1 point de dégât supplémentaire quand ils les combattent au corps à corps.
MD,
                'races' => ['nain'],
            ],
            [
                'title' => 'Immunité à la paralysie de la Goule',
                'description' => <<<MD
Les Elfes résistent à la paralysie de la Goule.
MD,
                'races' => ['elfe'],
            ],
            [
                'title' => 'Immunité au Sommeil',
                'description' => <<<MD
Les Elfes sont immunisés aux sorts de sommeil.
MD,
                'races' => ['elfe'],
            ],
            [
                'title' => 'Imposition des mains',
                'description' => <<<MD
Imposer les mains sur une personne permet de lui faire récupérer des points de vie. Avec l’imposition, on brise un sceau qui est récupéré ensuite auprès de l'alchimiste dans un temps défini par l’organisation. Les points de vie peuvent être distribués 1 à 1 sur différents blessés.
MD,
                'class_levels' => [
                    ['class' => 'paladin', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Inspiration Vaillante',
                'description' => <<<MD
Le barde est un artiste qui utilise le chant et la musique pour donner du cœur à l’ouvrage à ses compagnons d’armes. Lorsqu’il utilise son art, tant qu’il chante ou joue d’un instrument, il immunise 2 de ses compagnons par niveau du barde à la peur, même magique. Il bénéficie lui-même de cet avantage. Utilisable 1 fois par jour par niveau de barde.
MD,
                'class_levels' => [
                    ['class' => 'barde', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Inspiration Héroïque',
                'description' => <<<MD
Le barde est un artiste qui utilise le chant et la musique pour donner du cœur à l’ouvrage à ses compagnons d’armes. Lorsqu’il utilise son art lors d’un combat, tant qu’il chante ou joue d’un instrument, il peut donner à 2 de ses compagnons par niveau de barde un bonus aux dommages de +1 et un bonus d’armure de +1. Ce don est utilisable 1 fois par jour.
MD,
                'class_levels' => [
                    ['class' => 'barde', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Pistage',
                'description' => <<<MD
Le ranger peut suivre des pistes en forêt. Il est capable de retrouver et de reconnaître les empreintes laissées par des créatures en forêt.
MD,
                'class_levels' => [
                    ['class' => 'ranger', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Pouvoir divin',
                'description' => <<<MD
Les prêtres reçoivent un pouvoir spécial de leur divinité qui leur permet de bénéficier d’un sort gratuit par jour ou d’une capacité spéciale en fonction du dieu vénéré. Voir la description du dieu dans le Livre des Dieux.
MD,
                'class_levels' => [
                    ['class' => 'clerc', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Rage',
                'description' => <<<MD
2 fois par jour par niveau, le barbare peut se mettre en rage. Il gagne 1 PV supplémentaire par niveau au-delà de son nombre de PV maximum et cause 1 point de dommage supplémentaire sur chaque coup pour la durée d’un combat.

À la fin du combat, le barbare perd les PV supplémentaires acquis lors de l’état de rage. Il est exténué pendant 30 minutes et doit se reposer. Il se déplace lentement, ne peut pas courir, et s’il doit combattre, il ne touchera qu’un seul coup sur deux.
MD,
                'class_levels' => [
                    ['class' => 'barbare', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Ralliement',
                'description' => <<<MD
Grâce à son chant, le barde peut rallier à sa cause des créatures amies, neutres ou ennemies pour qu’elles combattent à ses côtés. Le barde peut rallier à lui 1 créature de taille moyenne par niveau du barde. Il peut aussi rallier les compagnons mis en fuite par une créature causant la peur ou par le sort fuite. Il ne peut cependant pas rallier un camarade ayant reçu l’injonction d’attaquer ses amis. Utilisable 1 fois par jour.
MD,
                'class_levels' => [
                    ['class' => 'barde', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Repousser/contrôler les morts-vivants',
                'description' => <<<MD
Permet de faire fuir ou de contrôler les morts-vivants 1 fois par jour et par niveau. Le nombre de créatures mises en fuite dépend de la puissance de ces créatures et aussi du niveau du clerc et du paladin. Le personnage doit brandir son symbole béni et déclamer la formule du Vadé rétro, en annonçant le niveau de son personnage après la formule. Les créatures doivent voir le symbole béni du prêtre et être libres de fuir.

Certains clercs mauvais peuvent décider de contrôler les morts-vivants au lieu de les faire fuir.
MD,
                'class_levels' => [
                    ['class' => 'clerc', 'level' => $defaultClassLevel],
                    ['class' => 'paladin', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Résistance à la Magie',
                'description' => <<<MD
Les Mages ont la maîtrise de la magie et cela leur permet de limiter les dommages des sorts d’attaque qui leur sont lancés. Les Mages résistent à 4 + 1 point de dégât magique par niveau du Mage.

La résistance magique est restaurée à son maximum à chaque lever du soleil.
Exemple : un mage niveau 1 résiste à 5 points de dommages magiques. Au niveau 2, un mage résiste à 6 points de dommages magiques.
MD,
                'class_levels' => [
                    ['class' => 'mage', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Résistance à la magie de l’esprit',
                'description' => <<<MD
Ce don permet de résister à la magie de l’esprit 1 fois par jour.
MD,
                'races' => ['elfe', 'nain'],
            ],
            [
                'title' => 'Résistance au poison',
                'description' => <<<MD
Permet de résister au poison 1 fois par GN.
MD,
                'races' => ['nain'],
            ],
            [
                'title' => 'Santé Divine - Immunité aux maladies',
                'description' => <<<MD
Immunité à toutes les maladies, même magiques, dont la lycanthropie et le toucher des momies, à ne pas confondre avec les malédictions.
MD,
                'class_levels' => [
                    ['class' => 'paladin', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Survie milieu hostile',
                'description' => <<<MD
Le barbare a appris à survivre dans les forêts, les déserts ou tout autre lieu hostile. Il en connaît les pièges et les secrets, il peut y vivre sans subir de conséquence grave et y conduire d’autres personnes sans leur faire perdre à tous 1 point d'armure et 2 points de vie du fait de la méconnaissance du milieu et de ses dangers.
MD,
                'class_levels' => [
                    ['class' => 'barbare', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Savoir Bardique',
                'description' => <<<MD
À travers les chants et les contes, les bardes possèdent une grande connaissance des histoires et légendes et peuvent avoir des informations concernant un artefact puissant, les légendes concernant les ogres hantant les bois derrière cette petite ville, le trésor de cet ancien mage… Les histoires d’hier peuvent être des indications précieuses pour votre survie. Utilisable 2 fois par jour.
MD,
                'class_levels' => [
                    ['class' => 'barde', 'level' => $defaultClassLevel],
                ],
            ],
            [
                'title' => 'Vision Nocturne',
                'description' => <<<MD
Vision nocturne en extérieur.

Ces créatures possèdent une excellente vision de nuit qui leur permet de se déplacer en extérieur sans avoir besoin d’une torche ou de toute autre source lumineuse. Une lampe frontale devra être utilisée, elle ne doit pas servir à éclairer le passage pour les autres membres du groupe.
MD,
                'races' => ['elfe', 'demi-elfe', 'hobbit'],
            ],
            [
                'title' => 'Vision dans l’obscurité',
                'description' => <<<MD
Vision dans l’obscurité en extérieur et en intérieur.

Ces créatures possèdent une excellente vision dans l’obscurité la plus profonde qui leur permet de se déplacer n’importe où, en extérieur et en intérieur, sans lumière. Une lampe frontale devra être utilisée, elle ne doit pas servir à éclairer le passage pour les autres membres du groupe.
MD,
                'races' => ['demi-orc', 'nain'],
            ],
            [
                'title' => 'Volonté de fer',
                'description' => <<<MD
Résistant à la torture, le chevalier ne cèdera pas aux sévices de ses tortionnaires. Il tiendra jusqu'à la mort.
MD,
                'class_levels' => [
                    ['class' => 'chevalier', 'level' => $defaultClassLevel],
                ],
            ],
            // COMPÉTENCES
            [
                'title' => 'Alchimie - Fabrication de composante de sort',
                'description' => <<<MD
Cette compétence permet d’extraire la partie active d’une plante ou de traiter les matières premières pour en faire des ingrédients de sorts. Le nombre d’ingrédients pouvant être fabriqués dépend du degré de maîtrise (8 niveaux de sorts par degré de maîtrise).
MD,
                'cost_l' => 2,
                'cost_c' => 4,
                'cost_v' => 4,
            ],
            [
                'title' => 'Alchimie - Fabrication de Potion',
                'description' => <<<MD
Cette compétence permet de fabriquer certaines potions les plus courantes, d’extraire la substance active d’une partie de plante ou de traiter les matières premières pour en faire des ingrédients de sorts ou de potions.

Exemple : Argash possède la compétence Alchimie. Il sait fabriquer une potion de Ruse de Renard avec une macération de feuilles de sureau, de fleurs de pissenlits et une pincée de poudre de racine de Mandragore mais ne sait les reconnaître dans la forêt.

Walter dispose de la compétence herboristerie et il sait identifier le sureau. Il sait que l’effet direct de la tige de sureau sert à faire tomber la fièvre. Et que les racines et les feuilles sont utilisées dans des potions.

Le nombre de potions connues dépend du degré de maîtrise (2 potions par degré de maîtrise).
MD,
                'cost_l' => 2,
                'cost_c' => 4,
                'cost_v' => 4,
            ],
            [
                'title' => 'Ambidextrie',
                'description' => <<<MD
Capacité à maîtriser le combat à deux armes : une longue dans la main directrice et une courte dans l’autre main. Achetée une deuxième fois : une arme longue dans chaque main.
MD,
                'cost_l' => 6,
                'cost_c' => 3,
                'cost_v' => 3,
                'max_purchases' => 2,
            ],
            [
                'title' => 'Armurerie',
                'description' => <<<MD
Compétence permettant de réparer 4 points d’armure métallique par achat.

Le personnage doit trouver une forge et disposer de ressources en fer suffisantes pour effectuer les réparations (durée : 15 minutes). Il peut se procurer des ressources en minerai de fer auprès des marchands ou de toute personne disposant de cette ressource, chaque ressource minerai de fer permet de réparer un certain nombre de PA. Il est impossible de réparer l’armure sans ressources minerai.

S’il ne dispose pas des outils adéquats, cette compétence lui permet de réparer la moitié des points d’armure. Les outils de forge doivent être validés par les organisateurs.

Achetée deux fois, cette compétence permet de réparer 8 points d’armure en 15 minutes.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 4,
            ],
            [
                'title' => 'Arme de siège',
                'description' => <<<MD
Permet d'utiliser une arme de siège. Les armes de sièges sont des armes lourdes qui lancent des projectiles de grande taille.

Le nombre de personnes pour actionner une arme de siège peut varier en fonction de l’arme.

Au niveau 1 la compétence permet d’utiliser une arme de siège seul, au niveau 2 elle permet au tireur d’avoir un acolyte, ne disposant pas forcément de la compétence, qui l’aide à manipuler l’arme. Au niveau 3, le tireur peut avoir 2 acolytes. Avec cette compétence, le tireur est capable de réparer l’arme si elle a été démantelée.

Cf. description des armes de sièges.
MD,
                'cost_l' => 8,
                'cost_c' => 4,
                'cost_v' => 8,
                'max_purchases' => 3,
            ],
            [
                'title' => 'Assassinat',
                'description' => <<<MD
Placez-vous derrière votre victime et passez-lui votre dague sur la gorge. Dites-lui le mauvais sort que vous venez de lui faire subir. La victime tombe à zéro point de vie et tombe dans le coma.

Elle ne peut ni crier ni se débattre. Le gorgerin métallique est une protection efficace contre cette attaque mais pas infaillible. Une lame peut être enfoncée dans les interstices d’une armure.

Pour éviter tout litige, contactez un Orga avant le passage à l’acte.
MD,
                'cost_l' => 16,
                'cost_c' => 16,
                'cost_v' => 8,
                'max_purchases' => 1,
            ],
            [
                'title' => 'Assommer',
                'description' => <<<MD
Placez-vous derrière votre victime et posez doucement votre arme sur sa tête. Et dites-lui le mauvais sort que vous venez de lui faire subir. La victime reste inconsciente pendant 1 minute.

En mêlée, cette attaque est difficilement exécutable. Les camails et les casques ou heaumes protègent de cette attaque. Un deuxième degré permet de franchir les camails, un troisième les casques et heaumes.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 2,
                'max_purchases' => 3,
            ],
            [
                'title' => 'Botte d’arme',
                'description' => <<<MD
Cette compétence permet de porter un coup spécial. Annoncé « botte d’arme » lors de la frappe, ce coup inflige les dégâts même s’il est paré par un bouclier ou une arme. La botte d’arme est utilisable une fois par mêlée pour un achat, deux fois par mêlée si elle est achetée deux fois, etc.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 4,
            ],
            [
                'title' => 'Commandement',
                'description' => <<<MD
Un personnage disposant de cette compétence est aguerri dans l’art de diriger des troupes. 1 fois par jour par niveau de compétence, il peut rallier à lui 1 de ses compagnons, par niveau de compétence, qui fuit un combat et insuffler le courage pour vaincre la peur non magique. Il bénéficie lui-même de cet avantage.
MD,
                'cost_l' => 6,
                'cost_c' => 3,
                'cost_v' => 6,
            ],
            [
                'title' => 'Commerce',
                'description' => <<<MD
Commerce permet de bénéficier de 10 % par niveau de compétence de ristourne lors de la négociation de ressources telles que le bois, le minerai, les céréales, la pierre et la laine par rapport à leur cours en bourse.
MD,
                'cost_l' => 3,
                'cost_c' => 6,
                'cost_v' => 3,
            ],
            [
                'title' => 'Concentration',
                'description' => <<<MD
Permet au lanceur de sorts de ne pas rompre sa préparation de sort lorsqu’il subit une attaque.

1 attaque par achat. Les points de dégât reçus sont comptabilisés.
MD,
                'cost_l' => 1,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Connaissance des maladies',
                'description' => <<<MD
Cette compétence permet d’identifier une maladie, suivant les symptômes que peut présenter un malade. Ceux-ci peuvent varier : vomissements, boutons, douleurs.

Environ 20 % de chance d’identifier une maladie par niveau de maîtrise. Pour soigner une maladie, il faut en connaître le remède.
MD,
                'cost_l' => 1,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Connaissance des poisons',
                'description' => <<<MD
Cette compétence permet d’identifier un poison, suivant sa couleur, son odeur, ses effets. Ceux-ci sont nombreux et ont des effets divers qui vont de la perte de conscience jusqu'à la mort.

Environ 20 % de chance de le reconnaître par niveau de maîtrise. Pour composer un poison il faut en connaître la recette et posséder la compétence Alchimie – Fabrication de potions.
MD,
                'cost_l' => 1,
                'cost_c' => 2,
                'cost_v' => 1,
            ],
            [
                'title' => 'Connaissance des remèdes',
                'description' => <<<MD
Permet de connaître les potions pour guérir des maladies ou fabriquer des antidotes.

Environ 20 % de chance de réussite par niveau de maîtrise. Il faut posséder la compétence Alchimie et avoir la recette pour réaliser la potion.
MD,
                'cost_l' => 1,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Connaissance des Sorts',
                'description' => <<<MD
Cette compétence permet d’identifier un sort, suivant sa gestuelle, son mode préparatoire. Elle permet d’en connaître ses effets. En ayant cette compétence le personnage peut en prévenir une partie des effets. Il ne subit en général que la moitié de l’effet du sort : moitié de durée, moitié de dégâts.

Cette compétence doit être possédée pour un groupe de sorts. Exemple : sorts de feu : moitié des dégâts pour les sorts boule de feu, flèche enflammée, flammes, lame enflammée.
MD,
                'cost_l' => 2,
                'cost_c' => 4,
                'cost_v' => 4,
            ],
            [
                'title' => 'Contrefaçon',
                'description' => <<<MD
Cette capacité permet de falsifier un document ou un objet. Contactez un Orga et transmettez-lui votre requête. Il vous dira le temps que vous devez passer pour effectuer la copie et vous la remettra un peu plus tard.
MD,
                'cost_l' => 2,
                'cost_c' => 2,
                'cost_v' => 1,
                'max_purchases' => 1,
            ],
            [
                'title' => 'Coup puissant',
                'description' => <<<MD
1 point de dégât supplémentaire est infligé lors de cette attaque. Le combattant annonce « Coup puissant » suivi des dégâts.

Il est utilisable une fois par mêlée, par achat.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 4,
            ],
            [
                'title' => 'Crochetage',
                'description' => <<<MD
Les portes fermées à clef seront repérées par une étiquette indiquant le niveau de complexité de la serrure. Le voleur qui essayera de crocheter la serrure consultera le niveau de complexité de la serrure. Si ce niveau est inférieur ou égal à la valeur de sa compétence alors la serrure sera crochetée. Le cas contraire bloquera sa progression.

Si deux voleurs sont présents, le voleur possédant la compétence la plus faible pourra ajouter la moitié de la valeur de sa compétence à celle du second voleur, les chances de crochetage seront alors accrues.

La compétence Crochetage ne s’applique pas et n’aura donc pas d’effet sur une porte ou une serrure fermée magiquement.
MD,
                'cost_r' => 1,
            ],
            [
                'title' => 'Désarmement',
                'description' => <<<MD
Permet de désarmer l’adversaire lors du combat. Le désarmement doit être annoncé quand les armes sont en contact. La victime laisse alors tomber son arme, puis peut tenter de la ramasser.

Cette compétence est utilisable une fois par mêlée pour un achat, deux fois pour deux, etc.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 4,
            ],
            [
                'title' => 'Désamorçage',
                'description' => <<<MD
Désamorçage des pièges mécaniques et magiques.

Cette compétence est liée à la compétence détection des pièges.
MD,
                'cost_r' => 1,
            ],
            [
                'title' => 'Détection des pièges',
                'description' => <<<MD
Détection des pièges mécaniques et magiques.

Dans certaines professions c'est une question de survie et cette compétence devient pratiquement un sixième sens. Les pièges possèdent un niveau de complexité, concernant leur détection et leur désamorçage.

Un piège de complexité supérieure à la compétence du voleur ne pourra pas être détecté ou désamorcé, voire les deux à la fois.
MD,
                'cost_r' => 1,
            ],
            [
                'title' => 'Esquive',
                'description' => <<<MD
Permet d’éviter un coup porté par l’un de vos adversaires une fois par combat si elle est possédée une fois, deux fois si elle est achetée deux fois, etc.

Esquive ne protège pas des attaques dans le dos, assassinat, égorgement et sorts.
MD,
                'cost_l' => 3,
                'cost_c' => 3,
                'cost_v' => 3,
            ],
            [
                'title' => 'Estimation',
                'description' => <<<MD
Une personne ayant cette compétence connaîtra la valeur approximative d'un objet précieux, d'une pierre. Le degré de maîtrise affine la précision de la valeur.
MD,
                'cost_l' => 1,
                'cost_c' => 1,
                'cost_v' => 1,
            ],
            [
                'title' => 'Évasion',
                'description' => <<<MD
Une personne dotée de cette compétence est capable de s’évader d’une prison, de retirer ses fers, de se libérer de toute entrave non magique. Le prisonnier déclare avoir la compétence évasion et le niveau de la compétence. Ses gardiens, s’ils sont présents, doivent le laisser partir et attendre 30 secondes par niveau de compétence de l’évadé avant de se rendre compte de la situation et de sonner l’alerte.

Merci pour le roleplay.
MD,
                'cost_l' => 4,
                'cost_c' => 4,
                'cost_v' => 2,
            ],
            [
                'title' => 'Fuite',
                'description' => <<<MD
Une personne dotée de cette compétence est capable de fuir un combat ou une situation quelle qu’elle soit. Ses poursuivants doivent attendre 30 secondes par niveau de compétence du fuyard avant de se lancer à sa poursuite.

Cette compétence n’empêche pas les attaques à distance par les personnes utilisant des armes à distance ou les lanceurs de sorts.
MD,
                'cost_l' => 2,
                'cost_c' => 4,
                'cost_v' => 2,
            ],
            [
                'title' => 'Herboristerie',
                'description' => <<<MD
Cette compétence permet d’identifier les plantes et d’en connaître l’utilisation habituelle.

Elle permet de reconnaître 4 plantes communes par niveau de compétence.

Un personnage sait reconnaître une plante et connaît les effets directs de cette plante. Il doit disposer de la compétence alchimie pour utiliser différents mélanges de plantes afin de fabriquer des potions ou onguents.

Exemple : Walter dispose de la compétence herboristerie et il sait identifier le sureau. Il sait que l’effet direct de la tige de sureau sert à faire tomber la fièvre, et que les racines et les feuilles sont utilisées dans des potions.

Argash possède la compétence Alchimie. Il sait fabriquer une potion de Ruse de Renard avec une macération de feuilles de sureau, de fleurs de pissenlits et une pincée de poudre de racine de Mandragore mais ne sait les reconnaître dans la forêt.

Seuls les personnages possédant la compétence herboristerie ont la capacité de reconnaître les plantes et de les cueillir. Un personnage ne connaissant pas les plantes ne repèrera pas les plantes et ne pourra pas l’indiquer à quelqu’un.

Les plantes sont matérialisées par des plantes en plastique.

Lorsqu’un personnage a découvert des plantes, il doit se rendre auprès de l’herboriste pour extraire les parties utilisables, tige, feuilles, fleurs, qui remet au personnage des composantes papiers en échange de la plante.

Attention : cueillir une plante ou la détenir sans la connaître occasionne automatiquement la perte de 2 PV en plus des effets néfastes possibles que pourraient occasionner la plante.
MD,
                'cost_l' => 1,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Histoire ancienne',
                'description' => <<<MD
Une connaissance en histoire ancienne peut vous apporter des souvenirs concernant un artefact puissant, les légendes concernant les ogres hantant les bois derrière cette petite ville, le trésor de cet ancien mage. Les histoires d’hier peuvent être des indications précieuses pour votre survie.

Utilisable 1 fois par jour par niveau de compétence.
MD,
                'cost_l' => 1,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Langage',
                'description' => <<<MD
Connaissance du dialecte de différents peuples ou créatures. Utile pour éviter quelques malentendus.

1 langue par niveau de compétence.

Langues disponibles : Commun (Aerdi), elfe, nain, orc.
MD,
                'cost_l' => 1,
                'cost_c' => 1,
                'cost_v' => 1,
            ],
            [
                'title' => 'Langues Anciennes',
                'description' => <<<MD
Cette connaissance permet de connaître une langue ancienne par niveau de compétence.

Les personnes disposant de cette compétence sont capables de déchiffrer les écrits anciens.

Langues accessibles : Sulmitic Ancien, Sulois Ancien, Baklunish Ancien, Oeridian Ancien, Lendorian, Ferral.
MD,
                'cost_l' => 3,
                'cost_c' => 6,
                'cost_v' => 6,
            ],
            [
                'title' => 'Langues Hermétiques',
                'description' => <<<MD
Les langues hermétiques sont des langages utilisés par les lanceurs de sorts : magiciens, prêtres, druides, bardes. Cette compétence permet de connaître une langue hermétique par niveau de compétence. Les personnes disposant de cette compétence sont capables de déchiffrer les écrits hermétiques.

Langues accessibles : Arcanes, Clérical, Druidique, Démoniaque.
MD,
                'cost_l' => 3,
                'cost_c' => 6,
                'cost_v' => 6,
            ],
            [
                'title' => 'Langages secrets',
                'description' => <<<MD
Les langages secrets sont les langages utilisés par certaines castes et guildes pour communiquer entre elles. Cette compétence permet de connaître un langage secret par niveau de compétence. Les personnes disposant de cette compétence sont capables de déchiffrer les signes et les codes.

Langages accessibles : Guilde des Marchands, Guilde des Voleurs.
MD,
                'cost_l' => 3,
                'cost_c' => 3,
                'cost_v' => 2,
            ],
            [
                'title' => 'Lire et écrire',
                'description' => <<<MD
Cette connaissance permet de lire et d’écrire correctement 1 langue par niveau de compétence. Elle permet ainsi de déchiffrer les textes ou avertissements rédigés dans cette langue.
MD,
                'cost_l' => 1,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Maroquinerie',
                'description' => <<<MD
Permet de réparer les objets en cuir, une armure par exemple. Pour réparer l’objet en cuir en question, il faut disposer de ressources en cuir.

Il est possible de se procurer des ressources en cuir ou fourrure auprès des marchands ou de toute personne disposant de cette ressource ou capable de s’en procurer. Chaque ressource peau ou fourrure permet de réparer un certain nombre de PA. Il est impossible de réparer l’armure sans ressource peau ou fourrure.

Cette compétence permet de réparer 2 points d’armure par achat en 15 minutes. Un arbitre jugera du temps passé à effectuer la réparation et la qualité du travail avant de valider la réparation.

Au niveau 2, la compétence permet de réparer 4 PA en 15 minutes.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Parade',
                'description' => <<<MD
Permet de bloquer un coup spécial. La Parade annule un coup puissant, un désarmement et une botte d’arme.

Elle n’empêche pas les coups spéciaux des monstres, exemple : choc pour les trolls.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Piégeage',
                'description' => <<<MD
Permet de poser des pièges de différentes tailles : pièges à ours, barbacane constituée de pieux, fosse à pieux, passage piégé. Permet aussi de les désactiver.

Pour poser un piège, il faut se procurer le matériel nécessaire auprès d’un marchand.

Cf. description des pièges dans la section Armes.
MD,
                'cost_l' => 4,
                'cost_c' => 4,
                'cost_v' => 2,
            ],
            [
                'title' => 'Port d’armure',
                'description' => <<<MD
Le personnage peut porter une armure malgré les restrictions dues à sa classe.

Il y a 3 niveaux d’armure : les armures légères, cuir et fourrures, les armures intermédiaires, cotte de mailles et armure d’écailles, et les armures lourdes, armure de plate et harnois.

Exemples : Port d’armure achetée une fois permet au magicien de porter une armure de cuir maximum, ou au barbare et au voleur de porter une cotte de maille. Achetée deux fois le mage peut porter une cotte de maille, et le barbare une armure de plaque ou un harnois.
MD,
                'cost_l' => 6,
                'cost_c' => 3,
                'cost_v' => 3,
                'max_purchases' => 3,
            ],
            [
                'title' => 'Premiers soins',
                'description' => <<<MD
Le personnage peut panser les plaies de manière à stabiliser l’état d’un personnage blessé tombé à 0 point de vie. Pour cela il doit passer 1 minute à effectuer les premiers soins afin de redonner 1 point de vie au blessé. Le personnage qui était tombé à 0 point de vie et qui subit les Premiers Soins ne peut plus combattre, il peut au mieux se défendre en parant les coups. Il doit se reposer pendant 15 minutes avant de pouvoir reprendre le combat normalement.

Un personnage possédant cette compétence peut, après quelque temps passé à désinfecter les plaies, voire les recoudre, redonner 2 points de vie en passant 5 minutes auprès du blessé.

Lors des soins, le personnage place un bandage blanc tâché de rouge sur la partie du corps qu’il a soignée. Le bandage pourra être retiré 15 minutes après que le soin soit terminé.

Un personnage ne peut subir qu’un seul premier soin simultanément : quand le bandage sera retiré il pourra subir un nouveau premier soin.

Utilisation 1 fois par combat par achat.
MD,
                'cost_l' => 2,
                'cost_c' => 2,
                'cost_v' => 4,
            ],
            [
                'title' => 'Résistance à la torture',
                'description' => <<<MD
La présence d'un arbitre est obligatoire. Cette compétence permet à un personnage de résister à la torture. Il peut alors mentir à une question. Bien sûr, les dégâts infligés sont tout de même retirés des points de vie.

Vous pouvez utiliser cette compétence une fois par niveau de compétence et par torture.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Séduction',
                'description' => <<<MD
Cette compétence permet de séduire une personne et de lui demander un petit service ou quelques pièces de monnaie, voire parfois davantage. Annoncez le niveau de séduction + le niveau du personnage, au cours d’une discussion. Le service est accordé si le niveau de la cible est inférieur à la valeur indiquée.
Exemple : une magicienne de niveau 2, possédant une compétence de séduction de 3 pourra obtenir un petit service de n'importe quelle personne d'un niveau + compétence inférieur à 5. Cette compétence n'est utilisable qu'une fois par cible et par jour. La cible peut accepter même en cas d’échec.
MD,
                'cost_l' => 1,
                'cost_c' => 1,
                'cost_v' => 1,
            ],
            [
                'title' => 'Sens de la nature',
                'description' => <<<MD
Cette compétence se rapproche de connaissance de la forêt, mais le personnage possédant cette compétence ne peut diriger que deux autres personnes en forêt.
MD,
                'cost_l' => 2,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Tir précis',
                'description' => <<<MD
Le personnage occasionne un point de dégât supplémentaire 1 fois par combat. Acheté une deuxième fois, le personnage peut effectuer une attaque à +1 une deuxième fois. Utilisable avec toutes les armes à distance : arc, arbalète, dague, javelot, etc.
MD,
                'cost_l' => 4,
                'cost_c' => 2,
                'cost_v' => 2,
                'races' => ['elfe', 'hobbit'],
            ],
            [
                'title' => 'Torture',
                'description' => <<<MD
La présence d'un arbitre est obligatoire. Le bourreau inflige des points de dégâts. Si la victime possède résistance à la torture, elle décide quand elle répondra et peut en plus mentir. Dans le cas contraire elle dit la vérité à condition de la connaître ou déclare ne rien savoir. Bien sûr, les dégâts sont retirés des points de vie.
MD,
                'cost_l' => 2,
                'cost_c' => 2,
                'cost_v' => 2,
            ],
            [
                'title' => 'Vol à la tire',
                'description' => <<<MD
Le vol à la tire ou pickpocket est l’action de dérober subrepticement un objet ou des pièces de monnaie se trouvant dans la poche d’un quidam sans se faire remarquer. Dans la cité de Greyhawk, certains experts dans ce genre d’exercice sont si doués qu’ils parviennent même à remettre d’autres objets voire un petit mot en lieu de ce qu’ils ont pris.

Ce type de petit jeu ne plaît bien sûr pas aux guildes qui se passeraient volontiers de cette publicité.

Les joueurs qui choisiront la compétence Vol à la tire se verront remettre 2 pinces à linge par niveau de compétence : l’une afin de dérober un objet et l’autre pour le vol de valeurs financières. Elles seront de couleurs différentes selon s’il s’agit d’objet ou de valeurs et seront numérotées afin de permettre aux organisateurs d’identifier l’auteur du vol.

Le joueur qui effectuera un vol à la tire devra se rapprocher de sa victime et placer discrètement la ou les pinces à linge à l’endroit qu’il souhaite. Placer les pinces à linge permet de mimer l’acte de vol à la tire. S’il n’est pas remarqué, il aura réussi son action.

Le voleur pourra ensuite prévenir un arbitre qu’il a officié, ou attendre que le joueur remarque par lui-même qu’une pince à linge est accrochée à sa bourse ou à la manche de sa robe.

La victime du vol devra alors se rendre auprès d’un arbitre qui lui prendra les objets ou valeurs qui lui auront été dérobés. Il les remettra au voleur discrètement. Ces actions pourront prendre un certain temps et les organisateurs s’attacheront à les effectuer le plus rapidement possible.
MD,
                'cost_l' => 2,
                'cost_c' => 2,
                'cost_v' => 1,
            ],
        ];

        foreach ($skills as $skillConfig) {
            $config = array_merge([
                'max_purchases' => null,
                'cost_c' => null,
                'cost_l' => null,
                'cost_v' => null,
                'cost_r' => null,
                'races' => [],
                'class_levels' => [],
            ], $skillConfig);

            $skill = Skill::query()->updateOrCreate(
                ['title' => $config['title']],
                [
                    'description' => $config['description'],
                    'cost_c' => $config['cost_c'],
                    'cost_l' => $config['cost_l'],
                    'cost_v' => $config['cost_v'],
                    'cost_r' => $config['cost_r'],
                    'max_purchases' => $config['max_purchases'],
                ]
            );

            $raceIds = collect($config['races'])
                ->map(function (string $raceName) use ($races, $skill) {
                    $race = $races->get($raceName);

                    if (! $race) {
                        $this->command?->warn("Race introuvable pour le don [{$skill->title}] : {$raceName}");
                        return null;
                    }

                    return $race->id;
                })
                ->filter()
                ->values()
                ->all();

            $skill->races()->sync($raceIds);

            $classLevels = collect($config['class_levels'])
                ->map(function (array $classLevel) use ($classes, $skill) {
                    $class = $classes->get($classLevel['class']);

                    if (! $class) {
                        $this->command?->warn("Classe introuvable pour le don [{$skill->title}] : {$classLevel['class']}");
                        return null;
                    }

                    return [
                        'playable_class_id' => $class->id,
                        'level' => $classLevel['level'],
                    ];
                })
                ->filter()
                ->values();

            $skill->classLevels()->delete();

            foreach ($classLevels as $classLevel) {
                $skill->classLevels()->create($classLevel);
            }
        }
    }
}
