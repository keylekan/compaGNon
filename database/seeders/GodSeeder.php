<?php

namespace Database\Seeders;

use App\Models\God;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GodSeeder extends Seeder
{
    public function run(): void
    {
        $gods = [
            [
                'name' => 'Beory',
                'short_description' => 'Déesse de la terre nourricière de la nature',
                'description' => <<<TEXT
Beory, la terre mère. Parfois elle décrite sous la forme d'une femme enceinte d'âge mûr aux cheveux marron, mais La plupart du temps elle l'est à travers les puissances de la nature, la pluie et Oerth elle-même, qui sont vues comme ses manifestations plutôt que comme des faits naturels par les gens instruits. Elle est considérée avec une certaine distance par la plupart des gens communs.
Les faits terrestres des humains, demis humains et leur apparentés ne concernent que peu Beory. Seuls les événements qui affectent l'intégrité d'Oerth l'intéressent. Beory a peu de prêtre. Ceux qui existent sont des druides, mais ils n'ont pas le charisme deleurs confrères.
Les druides de Beory communient contemplativement avec la nature, utilisant leurs dons pour éviter tout changement dans la balance naturelle. Ce sont des gens conservateurs peu enclin à entreprendre des actions incisives. Nombreux sont ceux qui sont solitaires. L'ordre est peu organisé. Les druides traitent leurs semblables comme des supérieurs sur la base du charisme et de l'âge et non sous la forme des titres ou de l'expérience.

Alignement du dieu : Neutre
Alignement des fidèles : Tous
Alignement des druides : Neutre
Centres d’intérêt : Terre, nature, pluie
Symbole : Voir dessin
Couleur : marron
Tenue de cérémonie : Robes grises, vertes ou marrons
Armes : Comme les druides
Pouvoirs spéciaux : Sort baies magiques 1 fois par jour
TEXT,
                'allowed_believer_alignments' => null,         // Tous
                'allowed_cleric_alignments' => ['NN'],        // Alignement des druides : Neutre
            ],
            [
                'name' => 'Boccob',
                'short_description' => 'Dieu de la neutralité et de la magie',
                'description' => <<<TEXT
Boccob, patron de la neutralité, de la connaissance et de la prévoyance, c'est l'archimage des dieux. Il a peu de fidèle, mais cela semble ne pas le concerner.A travers le monde, voyants et devins font appel à lui, et ceux qui cherchent à créer des objetsenchantés demandent son aide. Les messes à Boccob incluent des rituels complexes, de l'encens, la récitation de formules alchimiques et la lecture de livres en rapport avec la connaissance.

Alignement du dieu : Neutre
Alignement des fidèles : Tous
Alignement des clercs : Neutre
Centres d’intérêt : Magie, Arcane, Connaissance
Symbole : Voir symbole
Couleur : Violet
Tenue de cérémonie : Robe violette avec des filets dorés
Armes : fléau, masse, bâton, dague
Pouvoir spécial : Dissipation de la magie une fois par jour.
Les clercs peuvent utiliser tous les objets magiques utilisables par les mages, et avoir accès aux sorts de mage du premier niveau comme s’il s’agissait de sorts de clerc.
TEXT,
                'allowed_believer_alignments' => null,         // Tous
                'allowed_cleric_alignments' => ['NN'],        // Neutre
            ],
            [
                'name' => 'Celestian',
                'short_description' => 'Dieu des étoiles, de l’espace et des voyages astraux',
                'description' => <<<TEXT
Il est dit que Celestian et Fharlanghn sont des frères qui ont suivi des voies similaires en prenant des routes différentes. Alors que Fharlanghn parcourait le monde, Celestian lui,est parti aux confins des étoiles et du plan astral. Celestian, le promeneur des étoiles, a peu decroyant sur Flaeness, Il est adoré par les astronomes, les navigateurs, les philosophes, les rêveurs et d'autres en rapport avec le cosmos ou le ciel. Les temples dédiés à Celestian se trouvent dans la nature loin des lumières des villes, et sont construits au sommet des montagneset des collines avec une vue dégagée sur le ciel. Les messes à Celestian se passent dehors sous unciel étoilé.

Alignement du dieu : Neutre bon
Alignement des fidèles : Tous sauf Mauvais
Alignement des clercs : Neutre bon
Centres d’intérêt : Etoiles, espace, voyageurs
Symbole : Voir symbole
Couleur : Noir
Tenue de cérémonie : Robe noire couverte d'étoiles
Armes : Spear, Epée courte, Bâton
Pouvoir spécial : Liberté de mouvement 1 fois par jour.
TEXT,
                // Tous sauf Mauvais = tous sauf LM/NM/CM
                'allowed_believer_alignments' => ['LB', 'LN', 'NB', 'NN', 'CB', 'CN'],
                'allowed_cleric_alignments' => ['NB'],
            ],
            [
                'name' => 'St Cuthbert',
                'short_description' => 'Dieu de la vérité, de l’honnêteté et de la franchise',
                'description' => <<<TEXT
St Cuthbert, le patron de la vérité et de la franchise, il a de nombreux fidèles et de nombreux temples petits et simples dédiés à sa personne éparpillée partout dans le monde. Ces fidèles sontnombreux dans la partie centrale de Flaeness, dans la cité de Greyhawk et aux alentours, la côte sauvage, Urnst et Verbobonc. Dans ces lieux, les lieux de culte sont grands et élaborés, et bien entretenus. Il y a une grande inimitié entre St Cuthbert et Iuz. Il y a une granderivalité entre les suivants de St Cuthbert et ceux de Pholtus. Les clercs de St Cuthbert sontdivisés en 3 ordres

- L'ordre du chapeau
- L'ordre de l'étoile
- L'ordre du billet

L'ordre du chapeau : Ces membres sont vêtus de manières diverses, mais tous portent un chapeau mou tombant de tartan vert et marron avec le symbole de St Cuthbert en cuivre fixé dessus. L'ordre du chapeau cherche à convertir les gens à la foi. Les membres de l'ordre du chapeau peuvent 1 fois par jour jeter un sort d’Amitié.

L'ordre de l'étoile : leurs vêtements sont vert foncé avec des étoiles de cuivre, d'or ou de platine selon leurs statuts. Les membres de l'étoile recherchent la pureté doctrinale parmi les croyants, ils ne tolèrent aucun écart. La plupart ont un alignement loyal neutre. Ils peuventjeter une fois par jour le sort connaissance des alignements.

L'ordre du billet : est le plus important. Ils sont vêtus de vêtements simples de couleur marron et roussâtre et portent le symbole de la masse de St Cuthbert en chêne ou en bronze. Le but de l'ordre du billet et de protéger les faibles. Ils peuvent jeter une fois par jour le sort Panoplie magique.

Alignement du dieu : Loyal bon
Alignement des fidèles : Loyal bon – Loyal neutre
Alignement des clercs : Loyal bon ou loyal neutre
Centres d’intérêt : Sagesse, honnêteté, discipline, vérité
Symboles : Voir Symbole
Couleurs : Marron, vert
Tenue de cérémonie : variable ( voir ci dessus )
Armes : Massue, Fléau, Masse, Bâton
Pouvoirs spéciaux : Voir ci-dessus
TEXT,
                'allowed_believer_alignments' => ['LB', 'LN'],
                'allowed_cleric_alignments' => ['LB', 'LN'],
            ],
            [
                'name' => 'Ehlonna',
                'short_description' => 'Déesse de la nature et de la fertilité.',
                'description' => <<<TEXT
Ehlonna des forêts, vénérée comme déesse de la fertilité, c'est aussi la patronne des animaux et des gens bons qui vivent dans les forêts. C'est la déesse des chasseurs, pécheurs, bûcherons et detous ceux qui vivent de la forêt.Les temples d'Ehlonna se trouvent dans les bois, bien que de petits temples lui soient dédiés dans certains villages. Ces fidèles se trouvent en force de la côte sauvage jusqu'au fief d'Ulek, et des collines de Kron jusqu'à la mer. Plus de femmes que d'hommes servent Ehlonna. Pour lescérémonies à Ehlonna on utilise des plats de bois et de corne, différentes herbes et de la musiquefaite avec des flûtes.
Les clercs portent des vêtements de couleur vert clair et prennent une plante comme emblème.
Les clercs de cette religion ne protègent pas fanatiquement les plantes contre tous maux, mais ilsvoient la nature comme un ensemble ou toutes les espèces doivent pouvoir se développer. Lesclercs ont sur eux des graines de différentes essences qu'ils plantent afin d'assurer leur survie.

Alignement du dieu : Neutre bon
Alignement des fidèles : Tous ( bon )
Alignement des clercs : neutre bon ou neutre
Centres d’intérêt : Forêt, Faune et flore, fertilité
Symbole : Voir symbole
Couleur : vert pâle
Tenue de cérémonie : robe vert pâle avec une plante ( voir ci dessus )
Armes : arc, dague, spear, bâton, massue
Pouvoirs spéciaux : Les clercs ont la compétence sens de la nature
Sort de peau d’écorce une fois par jour
TEXT,
                // Tous (bon) = tous les alignements bons
                'allowed_believer_alignments' => ['LB', 'NB', 'CB'],
                'allowed_cleric_alignments' => ['NB', 'NN'],
            ],
            [
                'name' => 'Erythnul',
                'short_description' => 'Dieu de la haine, des carnages et de la panique',
                'description' => <<<TEXT
Erythnul est le dieu des carnages, de la jalousie et de la haine. Son seul et unique titre est la Horde. La panique et le carnage sont ses principales sources de plaisirs. Dans les régions civilisées, les barbares, les guerriers maléfiques et les voleurs constituent de petites sectes aux activités criminelles. Dans les territoires les plus sauvages, il est souvent vénéré par les barbares malfaisants, et les créatures mauvaises tel que les gnolls, les gobelours, les trolls ou encore les ogres.

Alignement du dieu :  Chaotique Mauvais
Alignement des fidèles :  Neutre Mauvais, Chaotique Mauvais ou Chaotique neutre
Alignement des clercs :  Chaotique Mauvais ou Neutre Mauvais
Centres d’intérêt :  Carnage, haine, panique
Symbole :  Visage grimaçant
Couleur :  Rouille
Tenue de cérémonie :  Robes blanches avec des taches de sang
Armes :  Etoile du matin, masse
Pouvoirs spéciaux :  Sort frayeur une fois par jour
TEXT,
                'allowed_believer_alignments' => ['NM', 'CM', 'CN'],
                'allowed_cleric_alignments' => ['CM', 'NM'],
            ],
            [
                'name' => 'Fharlanghn',
                'short_description' => 'Dieu des voyages et des distances lointaines',
                'description' => <<<TEXT
Fharlanghn, le voyageur des horizons lointains, il est vénéré comme le dieu des routes, ainsi que dieu des voyages et des distances lointaines. Son nom est souvent invoqué lors des incidents sur les routes. Comme dieu du voyage son symbole est souvent trouvé sur les portes des auberges et des écuries à travers tout le continent ! Ses fidèles non-prêtres sont souvent des aventuriers, des marchands et les itinérants de toutes sortes. Les messes à Fharlanghn se déroulent à l'extérieur des portes si possible sous un ciel ensoleillé et avec une vue dégagée.

Alignement du dieu : Neutre bon
Alignement des fidèles : Tous
Alignement des clercs : Neutre
Centres d’intérêt : Horizon, distance, voyage
Symbole : Disque de bois avec une ligne incurvée qui représente l'horizon
Couleurs : Marron, vert
Tenue de cérémonie :  Robe marron ou verte
Armes :  Contondantes
Pouvoir spécial : Liberté de mouvement une fois par jour.
TEXT,
                'allowed_believer_alignments' => null,     // Tous
                'allowed_cleric_alignments' => ['NN'],     // Neutre
            ],
            [
                'name' => 'Heironeous',
                'short_description' => 'Dieu de la guerre, la justice, la chevalerie et de l’honneur.',
                'description' => <<<TEXT
Heironeous est le champion du combat juste et du devoir chevaleresque. Il est le patron de ceux qui combattent pour l'honneur, la justice et les justes causes. Portant une cotte de maille et armé d'une grande hache de bataille, Heironeous est souvent décrit sous l'apparence d'un jeune homme de grande taille à la peau cuivrée, aux cheveux auburn et aux yeux à la couleur d'ambre. Il est aimé des dieux ; ont dit que sa peau est enchantée et que la plupart des armes se brisent dessus. Il possède également de nombreux autres dons donnés les puissances loyales bonnes.
Heironeous est fort comme guerrier et comme protecteur, et cette dualité attire de nombreux croyants. Les messes dédiées à Heironeous comprennent des hymnes martiaux triomphants, des offrandes faites à une statue de cuivres le décrivant, ces statues ornent la plupart des temples dédiés à son nom.
Cet ordre combattant compte dans ses rangs de nombreux guerriers clercs elfes et demi-elfes ainsi que de nombreux humains ayant atteint des niveaux élevés de guerriers qui se sont tournés ensuite vers la prêtrise. L'ordre à une organisation militaire et maintient d'excellentes armureries ainsi qu'un excellent système de communication. Il y a une inimitié mortelle envers les prêtres d'Hextor frère d'Heironeous qui a choisi une autre voie, celle du mal.

Alignement du dieu : Loyal bon
Alignement des fidèles : Loyal bon, loyal neutre, neutre bon
Alignement des clercs : Loyal bon
Centres d’intérêt : Guerre, chevalerie, honneur, justice
Symbole : Voir symbole
Couleurs : Bleu nuit
Tenue de cérémonie :  Robe Bleu nuit avec des liserés argent
Armes :  Hache de bataille
Pouvoir spécial : Bénédiction 1 fois par jour.
TEXT,
                'allowed_believer_alignments' => ['LB', 'LN', 'NB'],
                'allowed_cleric_alignments' => ['LB'],
            ],
            [
                'name' => 'Hextor',
                'short_description' => 'Dieu de la guerre, de la discorde et des massacres.',
                'description' => <<<TEXT
Hextor le fléau des batailles, champion du mal est le patron de nombreux guerriers maléfiques, des assassins, des mercenaires et de quelques humanoïdes. Il a de nombreux adorateurs dans les terres du grand royaume ou ses prêtres possèdent de nombreux fiefs. Les offices comprennent de la musique discordante provenant d'instrument à vent, de cris et de hurlements ainsi que du choc d'armes de métal. Les plus grands temples sont construits sur les sites de batailles.
Les prêtres d'Hextor sont des combattants et des assassins aguerris, cruels et violents. La prêtrise est régie par des règles strictes et gérées par la force et la cruauté.

Alignement du dieu : Loyal mauvais
Alignement des fidèles : Loyal mauvais, loyal neutre, neutre mauvais
Alignement des clercs : Loyal mauvais
Centres d’intérêt : Guerre, discorde, massacre, conflit, force, tyrannie
Symbole : Une main gantée tenant 6 flèches pointées vers le bas
Couleur : noire
Tenue de cérémonie : Robes noires ornées de crânes blancs et de visages gris
Armes : Arcs, fléau, cimeterre.
Pouvoirs spéciaux : Bénédiction maléfique une fois par jour
TEXT,
                'allowed_believer_alignments' => ['LM', 'LN', 'NM'],
                'allowed_cleric_alignments' => ['LM'],
            ],
            [
                'name' => 'Incabulos',
                'short_description' => 'Dieu de la maladie, de la famine et du désastre.',
                'description' => <<<TEXT
Incabulos est le dieu de ce qui apporte le mal : maladie, famine, conflit et du désastre. C'est un dieu banni et il n'a pas beaucoup de fidèles. Quoiqu'il en soit le peuple de Flaeness lui donne des offrandes, souvent à l'odeur nauséabonde, chandelles de tripes pour l'apaiser et éviter sa colère. Malgré cela, des personnes le vénèrent respectant sa puissance et sa malignité. Les temples d'Incabulos sont cachés et souterrains ou se trouvent dans des lieux isolés. Les messes se font en secret, éclairées par la lueur pâle de bougies noires tandis que les prêtes prononcent des litanies et des chants monocordes. Les clercs d'Incabulos sont les plus secrets qui soit, craignant la colère de ceux qui détestent ce que représente Incabulos, ils sont maîtres dans le déguisement et dans le mensonge.

Alignement du dieu : Neutre mauvais
Alignement des fidèles : Tous mauvais
Alignement des clercs : Tous mauvais
Centres d’intérêt : Catastrophes, fléaux, maladies, cauchemars
Symbole : Voir symbole
Couleurs : Noir, orange
Tenue de cérémonie : Robe noire
Armes : Massue, fléau, masse, bâton
Pouvoirs spéciaux : Immunité aux maladies
Sort contagion une fois par semaine
TEXT,
                'allowed_believer_alignments' => ['LM', 'NM', 'CM'], // Tous mauvais
                'allowed_cleric_alignments' => ['LM', 'NM', 'CM'],  // Tous mauvais
            ],
            [
                'name' => 'Istus',
                'short_description' => 'Déesse du destin et de l’avenir (absente)',
                'description' => <<<TEXT
Istus, l'incolore et la multicolore, déesse de notre destin, c'est aussi la déesse du futur, de la destinée, et de la prédestinée. Elle a peu de véritables fidèles, mais de nombreuses personnes font appel à elle. Certains parieurs et voyants vénèrent Istus. Son culte est puissant à Dyvers, la cité de Greyhawk, Rauxes, Relmord et Stoink la ou les gens comptent sur leur bonne fortune pour vivre. Les cérémonies en l'honneur d'Istus nécessitent des nuages d'encens, de la musique provenant d'instruments en bois et de la méditation de groupe. La plupart de ses prêtres sont des femmes. Ce sont souvent des personnes sans sentiment et cyniques. Le destin est une chose parfois trop cruelle pour vraiment inspirer une forte dévotion, malgré cela certaines personnes vénèrent Istus lorsque le sort a été généreux avec eux. Les clercs d'Istus portent des robes grises ou noires avec une toile aux fils dorés.
Tous les clercs d'Istus portent le signe de la balance en évidence et ont les cheveux longs. Ils ont tendance à prendre des décisions peu importantes en jouant à pile ou face. Même lorsqu'ils prennent une décision importante ils envisagent différentes possibilités.

Alignement du dieu : Neutre
Alignement des fidèles : Tous
Alignement des clercs : Neutre
Centres d’intérêt : Sort, destin
Symbole : Une balance d'or à 3 branches
Couleurs : Gris, noir
Tenue de cérémonie : Robe noires ou grises avec une toile dorée
Armes : Massue, fléau, marteau, masse, bâton
Pouvoir spécial : Sort de confusion une fois par jour.
TEXT,
                'allowed_believer_alignments' => null,     // Tous
                'allowed_cleric_alignments' => ['NN'],     // Neutre
            ],
            [
                'name' => 'Iuz',
                'short_description' => 'Dieu de la malignité et du complot',
                'description' => <<<TEXT
Iuz est le patron de la malignité. Il dirige un empire dans de Flanaess qui porte son nom, la capitale en est Doraka d'où il complotait et préparait ses conquêtes. Il est considéré comme quelqu'un de mauvais et de traître, peu de créatures prononcent son nom hors de ses frontières.
Il est parvenu à devenir un dieu lors de la destruction de Pélor et de Tharizdun. Il y a une grande inimitié entre Iuz et St Cuthbert. Pour les cérémonies en faveur d'Iuz les fidèles utilisent de l'encens à l'odeur forte ou font brûler du fumier, ils font résonner des cloches ou des gongs. Des sacrifices sanguinaires font souvent partie de ces cérémonies. Les messes à Iuz se font dans des endroits anciens et sombres. Les autels sont faits d'os et de crânes.

Alignement du dieu : Chaotique mauvais
Alignement des fidèles : Tous mauvais
Alignement des clercs : Chaotique mauvais
Centres d’intérêt : Oppression, peine, tromperie
Symbole : Crâne souriant
Couleurs : Noir rouille
Tenue de cérémonie : Noire ou blanche tachée de sang
Armes : Massue, fléau, masse, bâton, fronde
Pouvoir spécial : Alignement indétectable une fois par jour
TEXT,
                'allowed_believer_alignments' => ['LM', 'NM', 'CM'], // Tous mauvais
                'allowed_cleric_alignments' => ['CM'],              // Chaotique mauvais
            ],
            [
                'name' => 'Kas',
                'short_description' => 'Dieu des secrets maléfiques ou destructeurs',
                'description' => <<<TEXT
Kas est le dieu des secrets. On l'appelle couramment le général, Le tueur de Vecna. Il règne sur tous ce qui ne doit pas être connu. Il apparaît le plus souvent sous la forme d’un guerrier en armure noire avec une lame longue aux reflets mauves. Parfois en toge portant son sceptre composé d’une main qui tient un œil, symbole de sa victoire contre Vecna
Kas est vénéré par tous ceux qui ont des secrets maléfiques ou destructeurs. Certains de ses adorateurs pourraient dit-on renverser des royaumes.

Alignement du dieu :  Neutre Mauvais
Alignement des fidèles :  Tous Mauvais
Alignement des clercs :  Tous Mauvais
Centres d’intérêt :  Connaissance, secret maléfique ou destructeur
Symbole :  Une épée à deux mains
Couleur :  Noire et gris
Tenue de cérémonie :  Gris foncé à bords noirs
Armes :  épée à deux mains
Pouvoir spécial :  Anti-détection une fois par jour
TEXT,
                'allowed_believer_alignments' => ['LM', 'NM', 'CM'], // Tous mauvais
                'allowed_cleric_alignments' => ['LM', 'NM', 'CM'],  // Tous mauvais
            ],
            [
                'name' => 'Kord',
                'short_description' => 'Dieu de la force et du courage',
                'description' => <<<TEXT
Kord est le dieu de la force, du courage et des exploits physiques. On le connaît sous le nom de lutteur. C’est le saint patron des athlètes. Parmi ses fidèles, on compte des barbares, des guerriers d’alignement bon et des roublards. Kord est un dieu d’alignement chaotique bon. Son nom est souvent prononcé sur les champs de bataille pour attirer son soutien et sa bonne fortune.

Alignement du dieu : Chaotique bon
Alignement des fidèles : Chaotique bon et neutre, Neutre et Neutre bon
Alignement des clercs : Chaotique bon et neutre, Neutre bon
Centres d’intérêt : Force, courage et exploits physiques
Symbole : Cercle rouge avec 2 croix
Couleurs : Rouge
Tenue de cérémonie : Robes rouges avec liserés noirs
Armes : Armes à deux mains
Pouvoir spécial : Sort de force 1 fois par jour
TEXT,
                'allowed_believer_alignments' => ['CB', 'CN', 'NN', 'NB'],
                'allowed_cleric_alignments' => ['CB', 'CN', 'NB'],
            ],
            [
                'name' => 'Mayaheine',
                'short_description' => 'Déesse de la Protection, justice, valeur, et soins',
                'description' => <<<TEXT
Mayaheine est la déesse de la protection et de la justice. Elle apparaît sous la forme d’une femme de grande taille, aux yeux bleus, et à la chevelure cuivrée. Elle porte généralement une armure d’argent et manie l’épée bâtarde. Son bouclier est capable de se fondre dans la pierre et de protéger les murs des villes contre les énergies destructives.
Le culte de Mayaheine s’efforce de défendre les pauvres et les opprimés.
Elle était a servante de Pélor. Elle a acquis le statut de déesse depuis la destruction de ce dernier.

Alignement du dieu : Loyal bon
Alignement des fidèles : Loyal bon – Neutre bon
Alignement des clercs : Loyal bon
Centres d’intérêt : Protection, justice, valeur, soins
Symbole : Voir symbole
Couleurs : Blanc
Tenue de cérémonie : Robe blanche avec des filets dorés
Armes : Epée longue
Pouvoir spécial : Tous les sorts de soins soignent un point de vie supplémentaire. /
Au niveau 4 : Sort protection contre les énergies destructrices
TEXT,
                'allowed_believer_alignments' => ['LB', 'NB'],
                'allowed_cleric_alignments' => ['LB'],
            ],
            [
                'name' => 'Nerull',
                'short_description' => 'Dieu de la mort et du mal',
                'description' => <<<TEXT
Nerull est le patron des activités cachées, il est connu comme l'éventreur, ennemi du bien, le moissonneur de vie, celui qui apporte les ténèbres, le roi de l'obscurité et le dévoreur de chair. Il est le dieu de tous ceux qui embrassent le mal pour le plaisir ou le gain. De nombreux humains et certains humanoïdes rendent hommage à Nerull. Dans certains pays, comme le grand royaume, les temples de Nerull opèrent ouvertement. Partout ailleurs ils agissent cachés. Les messes à Nerull se passent dans les ténèbres, avec des litanies glorifiant la mort et la souffrance. Les sacrifices sont fréquents, les autels sont faits de pierres de couleur rouille.

Alignement du dieu : Neutre mauvais
Alignement des fidèles : Tous mauvais
Alignement des clercs : Tous mauvais
Centres d’intérêt : Mort, ténèbres, meurtre, monde souterrain
Symbole : Un crâne et une faux
Couleur : Rouille
Tenue de cérémonie : Rouille ou noire
Armes : Bâton, dague, masse, faux
Pouvoir spécial : Animation des morts vivants, une fois par jour
TEXT,
                'allowed_believer_alignments' => ['LM', 'NM', 'CM'],
                'allowed_cleric_alignments' => ['LM', 'NM', 'CM'],
            ],
            [
                'name' => 'Obad-Haï',
                'short_description' => 'Dieu de la nature, de la liberté et de la vie sauvage',
                'description' => <<<TEXT
Obad-haï est une des divinités les plus anciennes régnant sur la nature et les étendues sauvages, accordant sa protection à tous ceux qui vivent en harmonie avec cet environnement. Il apparaît sous la forme d’un humain au visage parcheminé d’un age considérable. Il porte des vêtements lui donnant l’apparence d’un pèlerin ou d’un ermite. Il peut parfois apparaître sous la forme d’un nain, gnome ou halfling. Il peut se transformer instantanément en animal sauvage ou créature de la forêt tel que centaure ou ours brun, treant ou aigle géant. Les chapelles ou les églises d’Obad-Haï ont toujours un aspect rustique et sont faites de troncs bruts. Les rituels sont brefs et peu formalisés. Des plantes, de la terre, de l’eau et du feu sont présents généralement lors des cérémonies.

Alignement du dieu : Neutre
Alignement des fidèles : Tous neutre
Alignement des druides : Neutre
Centres d’intérêt : Nature sauvage, bêtes, liberté, chasse
Symbole : Voir symbole
Couleurs : Sans importance
Tenue de cérémonie : Tenues simples du voyageur, bâton de marche
Armes : Armes des druides
Pouvoir spécial : Sorts enchevêtrement
TEXT,
                // "Tous neutre" = tous les alignements neutres (LN, NN, CN)
                'allowed_believer_alignments' => ['LN', 'NN', 'CN'],
                'allowed_cleric_alignments' => ['NN'],
            ],
            [
                'name' => 'Olidammara',
                'short_description' => 'Dieu de la fête, de l’humour et des mauvais tours',
                'description' => <<<TEXT
Olidammara est le dieu favori des voleurs. On l’appelle communément le fou rieur ou le mécréant. Ces principales sources de plaisirs sont le vin les femmes et les chansons. C’est un vagabond, un farceur impénitent et un maître dans l’art du déguisement. Olidammara se montre toujours sous une apparence jeune, mais peut l’altérer comme il le souhaite. Ces temples sont rares, mais nombre de gens lèvent leurs verres à sa santé.

Alignement du dieu : Chaotique neutre
Alignement des fidèles : Chaotique neutre et bon, Neutre et Neutre bon
Alignement des Clercs : Chaotique neutre et bon
Centres d’intérêt : Fêtes, vin, humour, blagues, et larcins
Symbole : Voir symbole
Couleurs : Vert et or
Tenue de cérémonie : Robe vert à filets or
Armes : Contendantes
Pouvoir spécial : Sorts forme translucide une fois par jour
TEXT,
                'allowed_believer_alignments' => ['CN', 'CB', 'NN', 'NB'],
                'allowed_cleric_alignments' => ['CN', 'CB'],
            ],
            [
                'name' => 'Pholtus',
                'short_description' => "Dieu de la lumière et de l'inflexibilité.",
                'description' => <<<TEXT
Pholtus l'éblouissant, c'est le dieu de l'ordre et de l'inflexibilité, du soleil, et de la lune. Certains croyants clament que Pholtus a placé le soleil et la lune dans le ciel et qu'il maintient leurs rigides processions pour montrer à toutes les créatures le chemin à suivre. Un chemin strict dont il ne faut pas dévier car ce chemin mène au bien. Ce point de vue n'est pas embrassé comme une doctrine. Les bâtiments consacrés à Pholtus sont blancs. Les cérémonies utilisent de nombreuses bougies, de longs sermons et des chœurs qui ne cessent de psalmodier, "O lumière aveuglante".
Les clercs de Pholtus sont plutôt actifs en ville, où ils cherchent continuellement à révéler la lumière aux incroyants. Ils sont aussi inflexibles que leur dieu.

Alignement du dieu :  Loyal bon
Alignement des fidèles :  Tous loyaux
Alignement des clercs :  Loyal bon et neutre
Centres d’intérêt :  Lumière, résolution, loi
Symbole :  Soleil d'argent
Couleurs :  blanc, argent et or
Tenue de cérémonie :  Robes blanches et argent
Armes :  Standard
Pouvoir spécial :  brûlure solaire 1 fois par jour
TEXT,
                // Tous loyaux = LB, LN, LM
                'allowed_believer_alignments' => ['LB', 'LN', 'LM'],
                'allowed_cleric_alignments' => ['LB', 'LN'],
            ],
            [
                'name' => 'Ralishaz',
                'short_description' => 'Déesse du hasard et de la folie',
                'description' => <<<TEXT
Ralishaz est connue comme étant la déesse du hasard et de la folie. Beaucoup de personnes dans le monde la voient en tant que responsable de tous les événements imprévus qui apportent le malheur plutôt que le bien-être. C'est la patronne des joueurs et des gens qui prennent des risques inconsidérés. Son intervention est très rarement demandée, mais de petits et modestes temples peuvent être trouvés dans les grandes villes ou dans des endroits déserts. Les messes à Ralishaz nécessitent de jouer des notes au hasard sur divers instruments dans des conditions de lumière et de chaleur, de bruit et de silence totalement aléatoire.

Alignement du dieu : Chaotique neutre
Alignement des fidèles : Tous sauf loyaux
Alignements des clercs : Chaotique neutre
Centres d’intérêt : Chance, malchance
Symbole : Voir symbole
Couleur : Aucune
Tenue de cérémonie : Robes de tissus et de couleurs différentes
Armes : Fronde, masse
Pouvoir spécial : Sort sommeil une fois par jour
TEXT,
                // Tous sauf loyaux = NB, NN, NM, CB, CN, CM
                'allowed_believer_alignments' => ['NB', 'NN', 'NM', 'CB', 'CN', 'CM'],
                'allowed_cleric_alignments' => ['CN'],
            ],
            [
                'name' => 'Rao',
                'short_description' => 'Dieu de la paix et de la sérénité',
                'description' => <<<TEXT
Rao est le dieu serein de la paix, de la raison et de la sérénité.
Son pouvoir n'agit pas directement sur le plan matériel primaire, mais il est connu comme ayant créé de nombreux artefacts magiques aux grands pouvoirs contre le mal (notamment, le crochet de Rao avec l'aide de Boccob). Rao est toujours décrit comme un vieil homme à la peau sombre aux cheveux blancs et aux yeux marron foncé avec des mains longues et effilées, toujours souriant et serein.
Les fidèles de Rao ne sont pas répandus parmi les gens communs, ils sont plus nombreux parmi les dirigeants, les diplomates, les sages et les philosophes. Ceux qui cherchent le moyen d'acquérir de puissants objets magiques pour aider la cause du bien, font appel à lui et lui offrent des offrandes substantielles et méditent sur les textes sacrés de Rao.
Les services à Rao comprennent la discussion de la théologie et la méditation de groupe.
Les prêtres de Rao sont des médiateurs et des négociateurs sages et calmes. La plupart sont des hommes. Les prêtres sont très studieux et leurs devises est : Il y a un temps pour penser et plus rarement un temps pour agir, mais dans ces moments, l'action est sagesse.
Ces prêtres ne sont pas totalement pacifistes.

Alignement du dieu : Loyal bon
Alignement des fidèles : Tous bons
Alignement des clercs : Loyal bon
Centres d’intérêt : Paix, raison, sérénité
Symbole : Voir symbole
Couleur : Blanche
Tenue de cérémonie : Robes blanches
Armes : Fléau, masse, bâton
Pouvoir spécial : Sort amitié une fois par jour
TEXT,
                // Tous bons = LB, NB, CB
                'allowed_believer_alignments' => ['LB', 'NB', 'CB'],
                'allowed_cleric_alignments' => ['LB'],
            ],
            [
                'name' => 'Rudd',
                'short_description' => 'Déesse de la chance et du hasard',
                'description' => <<<TEXT
Rudd est la déesse de la chance, de la bonne fortune et de l’habileté. Elle est connue sous le nom de la dame fortune. Rudd aide en réalité surtout ceux qui s’aide eux même. Ses clercs portent souvent son symbole et reçoivent parfois sa faveur quand ils en ont grandement besoin. Rudd récompense l’habileté et l’innovation par la chance, c’est pourquoi bon nombre de voleurs et d'aventuriers lui rendent hommage.

Alignement du dieu :  Chaotique Neutre
Alignement des fidèles :  Tous Neutre ou Bon
Alignement des clercs :  Chaotique Neutre ou Chaotique Bon
Centres d’intérêt :  Chance, Hasard, Maîtrise
Symbole :  Une flèche au centre d'une cible
Couleur :  Blanc et bleu
Tenue de cérémonie :  Robes blanches avec motif bleu
Armes :  Contendantes
Pouvoir spécial :  Sort sanctuaire une fois par jour
TEXT,
                // Tous Neutre ou Bon = (LN, NN, CN) + (LB, NB, CB)
                'allowed_believer_alignments' => ['LB', 'NB', 'CB', 'LN', 'NN', 'CN'],
                'allowed_cleric_alignments' => ['CN', 'CB'],
            ],
            [
                'name' => 'Ulla',
                'short_description' => 'Déesse de la terre et des montagnes',
                'description' => <<<TEXT
Ulla est la patronne des mineurs, des montagnards et des tailleurs de pierre. Elle a de nombreux fidèles chez les demis humains, particulièrement chez les nains, gnomes, et halflings. Les temples dédiés à Ulla sont éparpillés dans le monde, ils se trouvent souvent dans les zones rocailleuses s'ils ne sont pas souterrains. Lors des cérémonies on utilise des gemmes que l'on montre à la déesse, et on frappe le sol à l'aide de marteaux en chantant des notes sourdes.

Alignement du dieu : Loyal bon
Alignement des fidèles : Tous bon, neutre
Alignement des clercs : Loyal bon
Centres d’intérêt : Collines, montagnes, gemmes
Symbole : Voir symbole
Couleurs : Vert, marron, gris
Tenue de cérémonie : Robes de couleur marron et verte
Armes : Massue, fléau, masse, bâton, marteau, pique, fronde
Pouvoir spécial : Sort peau de pierre une fois par jour
TEXT,
                // Tous bon, neutre = (LB, NB, CB) + (LN, NN, CN)
                'allowed_believer_alignments' => ['LB', 'NB', 'CB', 'LN', 'NN', 'CN'],
                'allowed_cleric_alignments' => ['LB'],
            ],
            [
                'name' => 'Zilchus',
                'short_description' => 'Dieu du commerce, du pouvoir et de l’argent',
                'description' => <<<TEXT
Zilchus est le dieu vénéré par les marchands. Il est le dieu du pouvoir de l’argent, du prestige et des affaires. Il est le saint patron des guildes et des commerçants. Il les protège de la faillite du mauvais sort, il encourage les entrepreneurs qui veulent s’enrichir. Il est prié dans tout le Flanaess.

Alignement du dieu :  Loyal neutre
Alignement des fidèles :  Loyal bon et neutre, Neutre et Neutre bon
Alignement des clercs :  Loyal neutre
Centres d’intérêt :  Pouvoir, prestige, influence et argent
Symbole :  Voir symbole
Couleur :  Or et argent
Tenue de cérémonie :  Rouge et jaune
Armes : Bâton
Pouvoir spécial :  Sort mythes et légendes une fois par semaine
TEXT,
                'allowed_believer_alignments' => ['LB', 'LN', 'NN', 'NB'],
                'allowed_cleric_alignments' => ['LN'],
            ],
        ];

        foreach ($gods as $g) {
            $slug = Str::slug($g['name']); // ex: St Cuthbert => st-cuthbert
            God::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $g['name'],
                    'slug' => $slug,
                    'short_description' => $g['short_description'],
                    'description' => $g['description'],
                    'icon_path' => "images/gods/{$slug}.webp",

                    // champs JSON/array (à caster côté modèle ou en base JSON)
                    'allowed_believer_alignments' => $g['allowed_believer_alignments'],
                    'allowed_cleric_alignments' => $g['allowed_cleric_alignments'],
                ]
            );
        }
    }
}
