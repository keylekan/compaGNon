<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-sand-900">Créer un personnage</h1>
        <p class="mt-1 text-sand-600">Choisis un nom, une race et une classe. Tu pourras relire les descriptions à tout moment.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <p class="font-medium mb-2">Le formulaire contient des erreurs :</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div
        x-data="characterWizard({
    races: @js($races),
    classes: @js($classesByCategory->flatten()->values()),
    gods: @js($gods),
    name: @js(old('name')),
    gender: @js(old('gender')),
    alignment: @js(old('alignment')),
  })"
        class="grid grid-cols-1 lg:grid-cols-12 gap-6"
    >
        {{-- Colonne principale --}}
        <div class="lg:col-span-8">
            <x-panel>
                <x-stepper step="step" />
            </x-panel>

            <form method="POST" action="{{ route('characters.store') }}" class="mt-6">
                @csrf

                {{-- STEP 1 : Race --}}
                <x-stepper-step
                    pos="1"
                    title="Choisir une race"
                    subtitle="Clique pour sélectionner. “Détails” pour lire la description."
                    disabled="!selectedRaceId"
                >
                    <x-character.race-choice :races="$races" selected-race-id="selectedRaceId" />
                </x-stepper-step>

                {{-- STEP 2 : Classe --}}
                <x-stepper-step
                    pos="2"
                    title="Choisir une classe"
                    subtitle="Certaines classes imposent un alignement (ex : Paladin = LB, Chevalier = Loyal)."
                    disabled="!selectedClassId"
                >
                    <x-character.class-choice :classes-by-category="$classesByCategory" selected-class-id="selectedClassId" />
                </x-stepper-step>

                {{-- STEP 3 : Dieu --}}
                <x-stepper-step
                    pos="3"
                    title="Choisir un dieu"
                    subtitle="Dans Greyhawk, presque tout le monde est croyant. Certains sont au service de leur dieu, d'autres sont de simples fidèles."
                    disabled="!selectedClassId"
                >
                    <x-character.god-choice :gods="$gods" selected-god-id="selectedGodId" is-allowed="isGodAllowed" />
                </x-stepper-step>

                {{-- STEP 4 : Nom --}}
                <x-stepper-step
                    pos="4"
                    title="Identité du personnage"
                    subtitle="Votre alignement peut être influencé par votre classe ou dieu."
                    disabled="!canGoNextFromIdentity()"
                >
                    <div class="mt-4">
                        <label class="block text-sm font-semibold text-sand-800">Nom</label>
                        <x-input class="mt-1" name="name" x-model.trim="name" required full />
                    </div>

                    <div class="mt-5">
                        <div class="text-sm font-semibold text-sand-800">Genre</div>
                        <div class="mt-2 flex gap-2">
                            <x-pill-radio name="gender" value="H" model="gender">Homme</x-pill-radio>
                            <x-pill-radio name="gender" value="F" model="gender">Femme</x-pill-radio>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-baseline justify-between">
                            <div class="text-sm font-semibold text-sand-800">Alignement</div>
                            <div class="text-xs text-sand-700">ex : Paladin = LB • Chevalier = Loyal</div>
                        </div>

                        <div class="mt-2">
                            <x-alignment-grid name="alignment" model="alignment" allowed="allowedAlignments" />
                        </div>
                    </div>
                </x-stepper-step>

                {{-- STEP 4 : Résumé --}}
                <div x-show="step === 5" x-transition>
                    <x-panel>
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-sand-900">Résumé</h2>
                                <p class="mt-1 text-sm text-sand-600">Vérifie avant de créer le personnage.</p>
                            </div>
                            <x-button
                                variant="secondary"
                                @click="go(4)"
                            >
                                ← Retour
                            </x-button>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="rounded-xl border border-sand-200 bg-white p-4">
                                <div class="text-xs font-semibold text-sand-500">Race</div>
                                <div class="mt-2 flex items-center gap-3" x-show="selectedRace">
                                    <img :src="selectedRace?.image_path ? ('/' + selectedRace.image_path) : ''"
                                         class="h-10 w-14 rounded-lg object-cover border border-sand-200" alt="">
                                    <div class="font-semibold text-sand-900" x-text="selectedRace?.title"></div>
                                </div>
                                <div class="mt-3 flex gap-3">
                                    <button type="button" class="text-sm font-semibold text-bronze-700 hover:underline" @click="go(1)">
                                        Modifier
                                    </button>
                                    <button type="button" class="text-sm font-semibold text-sand-700 hover:underline"
                                            @click="openDetails('race', selectedRace)" x-show="selectedRace">
                                        Détails
                                    </button>
                                </div>
                            </div>

                            <div class="rounded-xl border border-sand-200 bg-white p-4">
                                <div class="text-xs font-semibold text-sand-500">Classe</div>
                                <div class="mt-2 flex items-center gap-3" x-show="selectedClass">
                                    <img :src="selectedClass?.image_path ? ('/' + selectedClass.image_path) : ''"
                                         class="h-10 w-14 rounded-lg object-cover border border-sand-200" alt="">
                                    <div class="font-semibold text-sand-900" x-text="selectedClass?.title"></div>
                                </div>
                                <div class="mt-3 flex gap-3">
                                    <button type="button" class="text-sm font-semibold text-bronze-700 hover:underline" @click="go(2)">
                                        Modifier
                                    </button>
                                    <button type="button" class="text-sm font-semibold text-sand-700 hover:underline"
                                            @click="openDetails('class', selectedClass)" x-show="selectedClass">
                                        Détails
                                    </button>
                                </div>
                            </div>

                            <div class="rounded-xl border border-sand-200 bg-white p-4">
                                <div class="text-xs font-semibold text-sand-500">Dieu</div>
                                <div class="mt-2 flex items-center gap-3" x-show="selectedGod">
                                    <img :src="selectedGod?.icon_path ? ('/' + selectedGod.icon_path) : ''"
                                         class="h-10 w-14 rounded-lg object-cover border border-sand-200" alt="">
                                    <div class="font-semibold text-sand-900" x-text="selectedGod?.name"></div>
                                </div>
                                <div class="mt-3 flex gap-3">
                                    <button type="button" class="text-sm font-semibold text-bronze-700 hover:underline" @click="go(3)">
                                        Modifier
                                    </button>
                                    <button type="button" class="text-sm font-semibold text-sand-700 hover:underline"
                                            @click="openDetails('class', selectedGod)" x-show="selectedClass">
                                        Détails
                                    </button>
                                </div>
                            </div>

                            <div class="rounded-xl border border-sand-200 bg-white p-4">
                                <div class="text-xs font-semibold text-sand-500">Identité</div>
                                <div class="mt-1 font-semibold text-sand-900" x-text="name || '—'"></div>
                                <div class="mt-1 text-sm font-semibold text-sand-800" x-text="`${genderLabel}, ${alignmentLabel}`"></div>
                                <button type="button" class="mt-3 text-sm font-semibold text-bronze-700 hover:underline" @click="go(4)">
                                    Modifier
                                </button>
                            </div>
                        </div>

                        <div class="mt-7 flex items-center justify-end">
                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-gold-600 px-5 py-2.5 font-semibold text-white
                     hover:bg-gold-700 disabled:opacity-50"
                                    :disabled="!canSubmit()"
                            >
                                Créer le personnage
                            </button>
                        </div>
                    </x-panel>
                </div>
            </form>
        </div>

        {{-- Panneau latéral “résumé” (desktop) --}}
        <aside class="hidden sm:block lg:col-span-4">
            <x-panel class="sticky top-6">
                <div class="text-sm font-semibold text-sand-900">Ton personnage</div>

                <div class="mt-4 space-y-4">
                    <div>
                        <div class="text-xs font-semibold text-sand-600">Identité</div>
                        <div class="mt-1 font-semibold text-sand-900" x-text="name || '—'"></div>
                        <div class="mt-1 text-sm font-semibold text-sand-800" x-text="genderLabel"></div>
                        <div class="mt-1 text-sm font-semibold text-sand-800" x-text="alignmentLabel"></div>
                    </div>

                    <div>
                        <div class="text-xs font-semibold text-sand-600">Race</div>
                        <div class="mt-2 flex items-center gap-3" x-show="selectedRace">
                            <img :src="selectedRace?.image_path ? ('/' + selectedRace.image_path) : ''"
                                 class="h-9 w-12 rounded-lg object-cover border border-sand-200" alt="">
                            <div class="font-semibold text-sand-900" x-text="selectedRace?.title"></div>
                        </div>
                        <div class="mt-2 text-sm text-sand-500" x-show="!selectedRace">—</div>
                    </div>

                    <div>
                        <div class="text-xs font-semibold text-sand-600">Classe</div>
                        <div class="mt-2 flex items-center gap-3" x-show="selectedClass">
                            <img :src="selectedClass?.image_path ? ('/' + selectedClass.image_path) : ''"
                                 class="h-9 w-12 rounded-lg object-cover border border-sand-200" alt="">
                            <div class="font-semibold text-sand-900" x-text="selectedClass?.title"></div>
                        </div>
                        <div class="mt-2 text-sm text-sand-500" x-show="!selectedClass">—</div>
                    </div>

                    <div>
                        <div class="text-xs font-semibold text-sand-600">Dieu</div>
                        <div class="mt-2 flex items-center gap-3" x-show="selectedGod">
                            <img :src="selectedGod?.icon_path ? ('/' + selectedGod.icon_path) : ''"
                                 class="h-9 w-9 rounded-lg object-cover border border-sand-200" alt="">
                            <div class="font-semibold text-sand-900" x-text="selectedGod?.name"></div>
                        </div>
                        <div class="mt-2 text-sm text-sand-500" x-show="!selectedGod">—</div>
                    </div>
                </div>

                <div class="mt-6 text-xs text-sand-600">
                    Les bonus (PV, etc.) seront calculés automatiquement quand tu valides.
                </div>
            </x-panel>
        </aside>
    </div>

    <script>
        function characterWizard({ races, classes, gods, name, gender, alignment }) {
            return {
                step: 1,
                races,
                classes,
                gods,

                name: name || '',
                gender: gender || null,
                alignment: alignment || null, // "LB","LN","LM","NB","NN","NM","CB","CN","CM"

                selectedRaceId: null,
                selectedClassId: null,
                selectedGodId: null,

                detailsOpen: false,
                detailsType: null, // 'race' | 'class'
                detailsItem: null,

                get genderLabel() {
                    if (!this.gender) return null;
                    return this.gender === 'H' ? "Homme" : "Femme";
                },
                get alignmentLabel() {
                    if (!this.alignment) return null;
                    if (this.alignment === 'NN') return 'Neutre';

                    const law = {
                        L: 'Loyal',
                        N: 'Neutre',
                        C: 'Chaotique',
                    };
                    const mor = {
                        B: 'Bon',
                        N: 'Neutre',
                        M: 'Mauvais',
                    }
                    return `${law[this.alignment[0]]} ${mor[this.alignment[1]]}`;
                },
                get selectedRace() {
                    return this.races.find(r => r.id === Number(this.selectedRaceId)) || null;
                },
                get selectedClass() {
                    return this.classes.find(c => c.id === Number(this.selectedClassId)) || null;
                },
                get selectedGod() {
                    return this.gods.find(g => g.id === Number(this.selectedGodId)) || null;
                },
                get allowedAlignments() {
                    const classAlignments = this.selectedClass?.allowed_alignments;
                    if (!classAlignments) return null;

                    const godAlignments = this.selectedGod && (
                        this.selectedClass.slug === 'clerc' ? this.selectedGod.allowed_cleric_alignments : this.selectedGod.allowed_believer_alignments
                    )
                    if (!godAlignments) return classAlignments;

                    return classAlignments.filter((a) => godAlignments.includes(a));
                },

                isGodAllowed(god) {
                    const classAlignments = this.selectedClass?.allowed_alignments;
                    if (!classAlignments) return true;

                    const godAlignments = god.allowed_believer_alignments;
                    if (!godAlignments) return true;

                    return classAlignments.some((a) => godAlignments.includes(a));
                },

                go(n) { this.step = n; },

                canGoNextFromIdentity() {
                    return (this.name || '').trim().length >= 2 && !!this.gender && !!this.alignment;
                },
                canSubmit() {
                    return this.canGoNextFromIdentity() && this.selectedRaceId && this.selectedClassId;
                },

                isClassAllowed(allowed) {
                    if (!allowed || allowed.length === 0) return true
                    return allowed.includes(this.alignment)
                },

                openDetails(type, item) {
                    this.detailsType = type
                    this.detailsItem = item
                    this.detailsOpen = true
                },
                chooseFromDetails() {
                    if (!this.detailsItem) return
                    if (this.detailsType === 'race') this.selectedRaceId = String(this.detailsItem.id)
                    if (this.detailsType === 'class') this.selectedClassId = String(this.detailsItem.id)
                    this.detailsOpen = false
                },

                init() {
                    this.$watch('selectedClass', () => {
                        // si rien sélectionné, ok
                        if (!this.selectedClassId) return;

                        if (this.selectedGod && this.isGodAllowed(this.selectedGod)) {
                            this.selectedGodId = null;
                        } else {
                            if (!this.allowedAlignments || !this.alignment) return;

                            if (!this.allowedAlignments.includes(this.alignment)) {
                                this.alignment = null;
                            }
                        }
                    })

                    this.$watch('selectedGod', () => {
                        if (!this.allowedAlignments || !this.alignment) return;

                        if (!this.allowedAlignments.includes(this.alignment)) {
                            this.alignment = null;
                        }
                    })
                },
            }
        }
    </script>
</x-app-layout>
