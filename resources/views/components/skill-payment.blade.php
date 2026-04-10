@props([
    'action',
    'method' => 'POST',

    // Affichage
    'skill',

    // Coût cible normalisé
    'target' => 0,

    // Solde joueur par type
    // ex: ['C' => 5, 'L' => 8, 'V' => 2, 'R' => 1]
    'balances' => [],

    // Valeur normalisée dun point de chaque type
    // ex: ['C' => 1, 'L' => 0.5, 'V' => 1, 'R' => 1]
    'weights' => [],

    // Combinaisons rapides proposées
    // ex:
    // [
    //   ['label' => '3C', 'points' => ['C' => 3]],
    //   ['label' => '3V', 'points' => ['V' => 3]],
    //   ['label' => '6L', 'points' => ['L' => 6]],
    // ]
    'presets' => [],
])

@php
    $pointTypes = array_values(array_unique(array_merge(
        array_keys($balances),
        array_keys($weights),
        ['C', 'L', 'V', 'V1']
    )));
@endphp

<div
    x-data="skillPaymentComponent({
        target: {{ Js::from((float) $target) }},
        balances: {{ Js::from($balances) }},
        weights: {{ Js::from($weights) }},
        presets: {{ Js::from($presets) }},
        pointTypes: {{ Js::from($pointTypes) }},
    })"
    class="w-full"
>
    <x-panel x-show="maxQuantity" :main="false" class="flex flex-col gap-5">
        <div class="flex flex-col gap-4">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <h3 class="text-lg font-semibold text-stone-900">{{ $skill->title }}</h3>

                    <template x-for="(cost, index) in costs" :key="'cost-' + index">
                        <span class="rounded-full border border-bronze-300 bg-bronze-100 px-2.5 py-0.5 text-xs font-medium text-bronze-800">
                            <span x-text="presetSummary(cost)"></span>
                        </span>
                    </template>

                    <x-button x-show="!open" class="ml-auto" type="button" variant="primary" size="sm" @click="open = true">
                        Acheter
                    </x-button>
                </div>

                @if($skill->description)
                    <x-markdown class="mt-2 text-sm" value="{{ Js::from($skill->description) }}" />
                @endif
            </div>
        </div>

        <div
            class="space-y-5"
            x-show="open"
            x-collapse
            x-cloak
        >
            <div class="flex gap-2">
                <div class="inline-flex rounded-xl border border-stone-300 bg-stone-100 p-1 mx-auto">
                    <button
                        type="button"
                        class="rounded-lg px-4 py-2 text-sm font-medium transition"
                        :class="mode === 'preset'
                    ? 'bg-white text-stone-900 shadow-sm'
                    : 'text-stone-600 hover:text-stone-900'"
                        @click="mode = 'preset'"
                    >
                        Paiement rapide
                    </button>

                    <button
                        type="button"
                        class="rounded-lg px-4 py-2 text-sm font-medium transition"
                        :class="mode === 'custom'
                    ? 'bg-white text-stone-900 shadow-sm'
                    : 'text-stone-600 hover:text-stone-900'"
                        @click="mode = 'custom'"
                    >
                        Paiement personnalisé
                    </button>
                </div>

                <div x-show="maxQuantity > 1" class="inline-flex rounded-xl border border-stone-300 bg-stone-100 p-1 mx-auto">
                    <div class="px-4 py-2 text-sm font-medium text-stone-600">
                        Quantité
                    </div>
                    <div class="flex items-center gap-2">
                        <x-button
                            type="button"
                            variant="ghost"
                            size="sm"
                            @click="quantity -= 1"
                            x-bind:disabled="quantity <= 1"
                        >
                            -
                        </x-button>

                        <div class="min-w-16 rounded-lg border border-stone-300 bg-white px-3 py-1 text-center text-sm font-semibold text-stone-900">
                            <span x-text="quantity"></span>
                        </div>

                        <x-button
                            type="button"
                            variant="ghost"
                            size="sm"
                            @click="quantity += 1"
                            x-bind:disabled="quantity >= maxQuantity"
                        >
                            +
                        </x-button>
                    </div>
                </div>
            </div>

            <div x-show="mode === 'preset'" class="space-y-3">
                <div class="flex flex-wrap gap-3">
                    <template x-for="(preset, index) in presets" :key="'preset-' + index">
                        <button
                            type="button"
                            class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-medium transition"
                            :class="presetIsSelected(preset)
                                ? 'border-bronze-500 bg-bronze-100 text-bronze-900'
                                : (canAffordPreset(preset)
                                    ? 'border-stone-300 bg-white text-stone-800 hover:border-bronze-400 hover:bg-sand-100'
                                    : 'cursor-not-allowed border-stone-200 bg-stone-100 text-stone-400')"
                            :disabled="!canAffordPreset(preset)"
                            @click="applyPreset(preset)"
                        >
                            <span x-text="presetSummary(preset)"></span>
                        </button>
                    </template>
                </div>
            </div>

            <div x-show="mode === 'custom'" class="space-y-3">
                <template x-for="type in pointTypes" :key="'row-' + type">
                    <div x-show="weights[type] > 0 && balances[type] > 0" class="rounded-xl border border-stone-200 bg-stone-50/70 p-4">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-stone-900" x-text="`Points ${type}`"></p>
                                <p class="text-xs text-stone-600">
                                    Disponibles :
                                    <span x-text="balances[type] ?? 0"></span>
                                    ·
                                    Valeur unitaire :
                                    <span x-text="formatNumber(weights[type] ?? 0)"></span>
                                </p>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-button
                                    type="button"
                                    variant="ghost"
                                    size="sm"
                                    @click="decrement(type)"
                                    x-bind:disabled="(selected[type] ?? 0) <= 0"
                                >
                                    -
                                </x-button>

                                <div class="min-w-14 rounded-lg border border-stone-300 bg-white px-3 py-2 text-center text-sm font-semibold text-stone-900">
                                    <span x-text="selected[type] ?? 0"></span>
                                </div>

                                <x-button
                                    type="button"
                                    variant="ghost"
                                    size="sm"
                                    @click="increment(type)"
                                    x-bind:disabled="(selected[type] ?? 0) >= (balances[type] ?? 0)"
                                >
                                    +
                                </x-button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div class="space-y-3">
                <div class="flex items-center justify-between gap-4">
                    <p class="text-sm font-medium text-stone-800">Progression du paiement</p>

                    <p class="text-sm font-semibold"
                       :class="isExact() ? 'text-emerald-700' : 'text-stone-700'">
                        <span x-text="formattedTotal()"></span>
                        /
                        <span x-text="formattedTarget()"></span>
                    </p>
                </div>

                <div class="h-4 overflow-hidden rounded-full border border-stone-300 bg-stone-200/70">
                    <div
                        class="h-full rounded-full bg-gold-500 transition-all duration-200"
                        :style="`width: ${progressPercent()}%`"
                    ></div>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <template x-if="isExact()">
                        <p class="font-medium text-emerald-700">
                            Combinaison valide :
                            <span class="font-medium text-stone-900" x-text="selectedSummary()"></span>
                        </p>
                    </template>

                    <template x-if="!isExact() && total() < totalTarget()">
                        <p class="font-medium text-amber-700">
                            Il manque <span x-text="formattedMissing()"></span>.
                        </p>
                    </template>

                    <template x-if="!isExact() && total() > totalTarget()">
                        <p class="font-medium text-red-700">
                            Paiement trop élevé de <span x-text="formattedOverflow()"></span>.
                        </p>
                    </template>
                </div>
            </div>

            <form action="{{ $action }}" method="POST" class="pt-2">
                @csrf
                @if(!in_array(strtoupper($method), ['GET', 'POST']))
                    @method($method)
                @endif

                <input type="hidden" name="skill_id" value="{{ $skill->id }}">
                <input type="hidden" name="quantity" :value="quantity">

                <input type="hidden" name="payment[C]" :value="selected['C'] ?? 0">
                <input type="hidden" name="payment[L]" :value="selected['L'] ?? 0">
                <input type="hidden" name="payment[V]" :value="selected['V'] ?? 0">
                <input type="hidden" name="payment[R]" :value="selected['V1'] ?? 0">

                <div class="flex items-center gap-3">
                    <x-button type="submit" variant="primary" x-bind:disabled="!isExact()">
                        <span x-text="quantity > 1 ? `Acheter x${quantity}` : 'Acheter'"></span>
                    </x-button>

                    <x-button type="button" variant="ghost" @click="resetSelection()" x-show="hasSelection()">
                        Réinitialiser
                    </x-button>

                    <x-button type="button" variant="ghost" @click="open = false">
                        Annuler
                    </x-button>
                </div>
            </form>
        </div>
    </x-panel>
</div>

@once
    @push('scripts')
        <script>
            function skillPaymentComponent(config) {
                return {
                    quantity: 1,
                    maxQuantity: 0,
                    open: false,
                    mode: 'preset',
                    target: Number(config.target ?? 0),
                    balances: config.balances ?? {},
                    weights: config.weights ?? {},
                    pointTypes: config.pointTypes ?? ['C', 'L', 'V', 'V1'],
                    selected: {},

                    get costs() {
                        const result = []
                        this.pointTypes.forEach(type => {
                            if (this.weights[type] > 0) {
                                result.push({[type]: this.target / this.weights[type]});
                            }
                        });
                        return result;
                    },

                    get presets() {
                        const result = []
                        let basicPurchase = false;
                        const target = this.quantity * this.target;
                        this.pointTypes.forEach(type => {
                            if (this.weights[type] > 0) {
                                const cost = target / this.weights[type];
                                const canPurchase = this.balances[type] >= cost;
                                if (canPurchase) {
                                    basicPurchase = true;
                                }
                                result.push({[type]: cost});
                            }
                        });
                        if (!basicPurchase) {
                            const types = this.pointTypes
                                .filter(type => this.weights[type] > 0)
                                .map((type, index) => ({
                                    key: type,
                                    index,
                                    weight: this.weights[type],
                                    balance: this.balances[type],
                                }))
                                .sort((a, b) => {
                                    if (b.weight !== a.weight) {
                                        return b.weight - a.weight;
                                    }

                                    if (b.balance !== a.balance) {
                                        return b.balance - a.balance;
                                    }

                                    return a.index - b.index;
                                });
                            let preset = {};
                            let total = 0;
                            for (const type of types) {
                                const canSpend = Math.min(type.balance, Math.trunc((target - total) / type.weight));
                                if (canSpend) {
                                    total += canSpend * type.weight;
                                    preset[type.key] = canSpend;
                                }
                                if (total >= target) break;
                            }
                            result.push(preset);
                        }
                        return result;
                    },

                    init() {
                        let weightedBalance = 0;
                        this.pointTypes.forEach(type => {
                            if (typeof this.selected[type] === 'undefined') {
                                this.selected[type] = 0;
                            }

                            if (typeof this.balances[type] === 'undefined') {
                                this.balances[type] = 0;
                            }

                            if (typeof this.weights[type] === 'undefined') {
                                this.weights[type] = 0;
                            }

                            weightedBalance += this.balances[type] * this.weights[type];
                        });

                        this.maxQuantity = Math.trunc(weightedBalance / this.target);
                    },

                    total() {
                        return this.pointTypes.reduce((sum, type) => {
                            return sum + ((Number(this.selected[type]) || 0) * (Number(this.weights[type]) || 0));
                        }, 0);
                    },

                    totalTarget() {
                        return this.quantity * this.target;
                    },

                    epsilon() {
                        return 0.00001;
                    },

                    isExact() {
                        return Math.abs(this.total() - this.totalTarget()) < this.epsilon();
                    },

                    progressPercent() {
                        if (this.totalTarget() <= 0) return 0;

                        const percent = (this.total() / this.totalTarget()) * 100;
                        return Math.max(0, Math.min(percent, 100));
                    },

                    increment(type) {
                        const current = Number(this.selected[type] || 0);
                        const max = Number(this.balances[type] || 0);

                        if (current >= max) return;

                        this.selected[type] = current + 1;
                    },

                    decrement(type) {
                        const current = Number(this.selected[type] || 0);

                        if (current <= 0) return;

                        this.selected[type] = current - 1;
                    },

                    resetSelection() {
                        this.pointTypes.forEach(type => {
                            this.selected[type] = 0;
                        });
                    },

                    hasSelection() {
                        return this.pointTypes.some(type => Number(this.selected[type] || 0) > 0);
                    },

                    canAffordPreset(preset) {
                        const points = preset ?? {};

                        return this.pointTypes.every(type => {
                            const needed = Number(points[type] || 0);
                            const available = Number(this.balances[type] || 0);

                            return needed <= available;
                        });
                    },

                    applyPreset(preset) {
                        if (!this.canAffordPreset(preset)) return;

                        this.pointTypes.forEach(type => {
                            this.selected[type] = Number((preset ?? {})[type] || 0);
                        });
                    },

                    presetIsSelected(preset) {
                        return this.pointTypes.every(type => {
                            return Number(this.selected[type] || 0) === Number((preset ?? {})[type] || 0);
                        });
                    },

                    presetSummary(preset) {
                        return this.pointsSummary(preset ?? {});
                    },

                    selectedSummary() {
                        return this.pointsSummary(this.selected);
                    },

                    pointsSummary(points) {
                        const parts = this.pointTypes
                            .map(type => {
                                const value = Number(points[type] || 0);
                                return value > 0 ? `${value}${type}` : null;
                            })
                            .filter(Boolean);

                        return parts.join(' + ');
                    },

                    missing() {
                        return Math.max(0, this.totalTarget() - this.total());
                    },

                    overflow() {
                        return Math.max(0, this.total() - this.totalTarget());
                    },

                    formattedMissing() {
                        return this.formatNumber(this.missing());
                    },

                    formattedOverflow() {
                        return this.formatNumber(this.overflow());
                    },

                    formattedTotal() {
                        return this.formatNumber(this.total());
                    },

                    formattedTarget() {
                        return this.formatNumber(this.totalTarget());
                    },

                    formatNumber(value) {
                        const num = Number(value || 0);

                        if (Number.isInteger(num)) {
                            return String(num);
                        }

                        return num.toFixed(2).replace(/\.?0+$/, '');
                    },
                };
            }
        </script>
    @endpush
@endonce
