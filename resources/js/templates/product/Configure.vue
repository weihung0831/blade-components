<script setup>
import { computed, reactive, ref } from 'vue';
import UiButton from '../../components/ui/actions/Button.vue';
import ProductShell from './Shell.vue';
import ProductFinishPicker from './FinishPicker.vue';
import ProductOptionRow from './OptionRow.vue';

const finish = ref('graphite');

const groups = [
    {
        label: 'Hoppers and dosing',
        note: 'what the coffee goes through',
        options: [
            { option: 'hopper', code: 'SDH', label: 'Single-dose hopper, 60 g', detail: 'Bellows lid, 12° cone. The one the grinder is designed around.', price: 0, included: true },
            { option: 'bin', code: 'BIN', label: 'Bin hopper, 1.2 kg', detail: 'For a bar that runs one roast all day. Swaps in without tools.', price: 84, lead: 'in stock' },
            { option: 'cup', code: 'CUP', label: 'Dosing cup, 58 mm', detail: 'Stainless, magnetic base, sits under the chute.', price: 36, checked: true, lead: 'in stock' },
            { option: 'knock', code: 'KNB', label: 'Knock box, walnut collar', detail: 'Rubber bar, quiet enough for an open kitchen.', price: 42, lead: 'ships in 3 days' },
        ],
    },
    {
        label: 'Keeping it true',
        note: 'parts, not a service plan',
        options: [
            { option: 'brush', code: 'BRS', label: 'Burr brush and burr tool', detail: 'Both live in the base. Replacements are $9.', price: 0, included: true },
            { option: 'shims', code: 'SHM', label: 'Alignment shim kit', detail: '0.05, 0.1 and 0.2 mm, plus the marker pen method printed on the card.', price: 28, checked: true, lead: 'in stock' },
            { option: 'burrs', code: 'SPB', label: 'Spare burr set, 83 mm', detail: 'Same coating. Worth having on the shelf if you grind more than 8 kg a week.', price: 210, lead: 'in stock' },
            { option: 'tablets', code: 'TAB', label: 'Cleaning tablets, 12 pack', detail: 'Grain based, no rinse cycle needed after.', price: 18, lead: 'in stock' },
        ],
    },
    {
        label: 'After it lands',
        note: 'optional, and cancellable',
        options: [
            { option: 'warranty', code: 'W48', label: 'Warranty to four years', detail: 'Extends the machine cover, not the burrs — those are five years already.', price: 120, lead: 'added to your order' },
            { option: 'setup', code: 'SET', label: 'Bench setup, Taipei and New Taipei', detail: 'An hour on site: zero point, first dial-in on your beans, and the cleaning routine with whoever opens.', price: 90, lead: 'booked after it ships' },
        ],
    },
];

const options = groups.flatMap((group) => group.options);

const selected = reactive(Object.fromEntries(options.map((option) => [option.option, Boolean(option.included || option.checked)])));

const base = computed(() => (finish.value === 'jade' ? 1300 : 1180));

const total = computed(() => options.reduce(
    (sum, option) => sum + (selected[option.option] ? option.price : 0),
    base.value,
));

const lines = computed(() => options.filter((option) => selected[option.option]));

const code = computed(() => [
    'EG83',
    { graphite: 'GRA', cream: 'CRM', jade: 'JDE' }[finish.value],
    ...options.filter((option) => selected[option.option] && option.price > 0).map((option) => option.code),
].join('-'));

const money = (value) => `$${value.toLocaleString('en-US')}`;
</script>

<template>
    <ProductShell v-model:finish="finish" active="Configure">
        <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
            <div class="flex flex-col gap-6">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight text-cream">Build the setup, then buy it once</h1>
                    <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                        Everything here ships in the same box and carries the same return window. Nothing is a subscription, and nothing here is required to use the grinder.
                    </p>
                </div>

                <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                        <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Finish</h2>
                        <span class="font-mono text-[10px] text-zinc-600">Jade is anodised in batches of 60</span>
                    </div>

                    <div class="p-5">
                        <ProductFinishPicker v-model="finish" detailed />
                        <p class="mt-3 font-mono text-[10px] text-zinc-600">
                            <span v-if="finish === 'graphite'">Graphite and Cream ship from stock. Both are the same $1,180.</span>
                            <span v-else-if="finish === 'cream'">Cream shows workshop marks less than Graphite does. Same $1,180.</span>
                            <span v-else>Jade adds $120 and waits for batch 07. You are charged when it ships.</span>
                        </p>
                    </div>
                </section>

                <section v-for="group in groups" :key="group.label" class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                        <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">{{ group.label }}</h2>
                        <span class="font-mono text-[10px] text-zinc-600">{{ group.note }}</span>
                    </div>

                    <div class="flex flex-col divide-y divide-white/5">
                        <ProductOptionRow
                            v-for="option in group.options"
                            :key="option.option"
                            v-model="selected[option.option]"
                            :label="option.label"
                            :detail="option.detail"
                            :price="option.price"
                            :included="option.included ?? false"
                            :lead="option.lead ?? null"
                        />
                    </div>
                </section>

                <p class="font-mono text-[10px]/5 text-zinc-600">
                    Prices include tax. Anything on this page can come off the order up to the moment it is packed — reply to the confirmation email and it is done.
                </p>
            </div>

            <aside class="flex flex-col gap-4 lg:sticky lg:top-32">
                <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                    <div class="flex items-baseline justify-between gap-4 border-b border-white/5 px-5 py-4">
                        <h2 class="text-base font-medium text-cream">Your build</h2>
                        <span class="font-mono text-[10px] text-jade-400">{{ code }}</span>
                    </div>

                    <ul class="flex flex-col divide-y divide-white/5">
                        <li class="flex items-baseline gap-3 px-5 py-3">
                            <span class="text-[13px] text-zinc-300">EG-83 grinder</span>
                            <span class="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">$1,180</span>
                        </li>

                        <li v-if="finish === 'jade'" class="flex items-baseline gap-3 px-5 py-3">
                            <span class="text-[13px] text-zinc-300">Jade finish</span>
                            <span class="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">$120</span>
                        </li>

                        <li v-for="line in lines" :key="line.option" class="flex items-baseline gap-3 px-5 py-3">
                            <span class="min-w-0 flex-1 truncate text-[13px] text-zinc-300">{{ line.label }}</span>
                            <span class="shrink-0 font-mono text-[13px] text-zinc-400">{{ line.included ? 'included' : money(line.price) }}</span>
                        </li>

                        <li class="flex items-baseline gap-3 px-5 py-3">
                            <span class="text-[13px] text-zinc-300">Express shipping</span>
                            <span class="ml-auto shrink-0 font-mono text-[13px] text-jade-400">free</span>
                        </li>
                    </ul>

                    <div class="border-t border-white/8 bg-ink-950 px-5 py-4">
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="text-[13px] text-cream">Total</span>
                            <span class="font-mono text-2xl text-cream">{{ money(total) }}</span>
                        </div>
                        <p class="mt-1 text-right font-mono text-[10px] text-zinc-600">or 6 × ${{ (total / 6).toFixed(2) }} at 0%</p>

                        <UiButton class="mt-4 w-full">Add the build to cart</UiButton>

                        <p class="mt-3 text-center font-mono text-[10px] text-zinc-600">
                            {{ finish === 'jade' ? 'batch 07 · charged when it ships' : 'leaves the workshop tomorrow' }} · 30-day returns
                        </p>
                    </div>
                </section>

                <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Buying for a bar</p>
                    <p class="mt-2.5 text-[13px]/6 text-zinc-400">
                        Three or more units gets a quote with net-30 terms, a spare burr set thrown in, and one setup visit per site.
                    </p>
                    <a href="/templates/pricing/screens/enterprise" target="_top"
                        class="mt-4 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Ask for a quote →</a>
                </div>

                <p class="px-1 font-mono text-[10px]/5 text-zinc-600">
                    What this leaves out: a bench, a scale that reads to 0.1 g, and beans. We sell none of those and will happily tell you what we use.
                </p>
            </aside>
        </div>
    </ProductShell>
</template>
