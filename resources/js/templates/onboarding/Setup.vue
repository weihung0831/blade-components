<script setup>
import { ref } from 'vue';
import OnboardingShell from './Shell.vue';
import OnboardingField from './Field.vue';
import OnboardingStepper from './Stepper.vue';

const order = ['shop', 'region', 'catalog', 'people', 'payouts'];

const regions = [
    { key: 'tpe', city: 'Taipei', code: 'ap-tpe-1', latency: '4 ms from your shop', note: 'Orders, names and addresses stay inside Taiwan. This is the one nine shops in ten pick, and the only one your accountant will not ask about.', picked: true },
    { key: 'sin', city: 'Singapore', code: 'ap-sin-2', latency: '41 ms', note: 'Worth it if most of what you sell leaves the island. Card processing settles a day earlier here.' },
    { key: 'fra', city: 'Frankfurt', code: 'eu-fra-1', latency: '243 ms', note: 'Only if you are selling into the EU and somebody has asked you about GDPR in writing.' },
];

const sources = [
    { key: 'shopify', label: 'Shopify export', note: 'products_export.csv, straight out of the admin', common: 'what 61% arrive with' },
    { key: 'woo', label: 'WooCommerce', note: 'The product CSV exporter plugin', common: '22%' },
    { key: 'blank', label: 'Nothing yet', note: 'Type the first product in by hand', common: '17%' },
];

const seats = [
    { email: 'ana@kerouac.coffee', role: 'Owner', note: 'You. Already in.', fixed: true },
    { email: '', role: 'Can ship orders', note: 'Sees orders and stock, cannot see takings.' },
    { email: '', role: 'Can ship orders', note: 'Two seats are in the plan. A third is $9 a month.' },
];

const step = ref('region');
const skipped = ref([]);

const go = (key) => {
    if (order.includes(key)) {
        step.value = key;
    }
};

const skip = (key) => {
    if (!skipped.value.includes(key)) {
        skipped.value = [...skipped.value, key];
    }

    go(order[Math.min(order.indexOf(key) + 1, order.length - 1)]);
};

const row = [
    { key: 'shop', label: 'Shop' },
    { key: 'region', label: 'Region' },
    { key: 'catalog', label: 'Catalog' },
    { key: 'people', label: 'People' },
    { key: 'payouts', label: 'Payouts' },
];

const rowSteps = () => row.map((entry, index) => ({
    ...entry,
    state: skipped.value.includes(entry.key) && entry.key !== step.value
        ? 'skipped'
        : index < order.indexOf(step.value) ? 'done' : entry.key === step.value ? 'current' : 'todo',
}));

const primary = 'inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3.5 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70';
const secondary = 'inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-3 py-2 text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70';
const quiet = 'font-mono text-[11px] text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70';
</script>

<template>
    <OnboardingShell active="Setting up" :step="step" :skipped="skipped" interactive @jump="go">
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                <OnboardingStepper layout="row" class="min-w-0 flex-1 lg:hidden" :steps="rowSteps()" />

                <p class="font-mono text-[11px] text-zinc-600 lg:ml-0">
                    Three of the five are required. The other two say so, and skipping one costs you nothing today.
                </p>

                <a
                    href="/templates/onboarding/screens/dropout"
                    target="_top"
                    class="ml-auto hidden shrink-0 font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream sm:block"
                >734 shops stopped somewhere in here</a>
            </div>
        </template>

        <div class="mx-auto grid max-w-5xl grid-cols-1 gap-8 lg:grid-cols-[1.5fr_1fr]">
            <section>
                <div v-if="step === 'shop'">
                    <h1 class="text-lg font-semibold tracking-tight text-cream">What the shop is called</h1>
                    <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                        The name goes on the storefront, the receipts and the mail your customers get. All three change together
                        later, so nothing here is a decision you have to sleep on.
                    </p>

                    <div class="mt-6 flex flex-col gap-5 rounded-xl border border-white/8 bg-ink-900 p-5">
                        <OnboardingField label="Shop name" value="Kerouac Coffee" why="Shown on the storefront and at the top of every order mail." />

                        <OnboardingField
                            label="Address people type"
                            value="kerouac"
                            prefix="https://"
                            suffix=".nomadsupply.cc"
                            why="Your own domain can point at this the day you want it to. Nobody has to know this address exists."
                            hint="free, and yours from now"
                        />

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <OnboardingField label="Prices are in" value="TWD — New Taiwan dollar" why="Changing this after the first order means restating every price." />
                            <OnboardingField label="Ships from" value="Taipei, Taiwan" why="Sets the default freight table and the tax line on invoices." />
                        </div>
                    </div>

                    <div class="mt-4 flex items-center gap-3">
                        <button type="button" :class="primary" @click="go('region')">Next: where it lives</button>
                    </div>
                </div>

                <div v-else-if="step === 'region'">
                    <h1 class="text-lg font-semibold tracking-tight text-cream">Where the orders sit</h1>
                    <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                        One choice on this page cannot be undone from inside the product, so it gets its own step rather than a
                        dropdown three fields down on the last one. Pick the city your customers are in.
                    </p>

                    <div class="mt-6 flex flex-col gap-2.5">
                        <label
                            v-for="region in regions"
                            :key="region.key"
                            class="flex cursor-pointer gap-3 rounded-xl border p-4 transition-colors duration-150"
                            :class="region.picked ? 'border-jade-500/50 bg-jade-500/6' : 'border-white/8 bg-ink-900 hover:border-white/15'"
                        >
                            <input type="radio" name="region" class="sr-only" :checked="region.picked" />
                            <span class="mt-1 size-3.5 shrink-0 rounded-full border-2" :class="region.picked ? 'border-jade-500 bg-jade-500/30' : 'border-white/20'"></span>

                            <span class="min-w-0 flex-1">
                                <span class="flex items-baseline gap-2">
                                    <span class="text-[13px] text-cream">{{ region.city }}</span>
                                    <span class="font-mono text-[10px] text-zinc-600">{{ region.code }}</span>
                                    <span class="ml-auto shrink-0 font-mono text-[10px] text-jade-400/80">{{ region.latency }}</span>
                                </span>
                                <span class="mt-1 block text-[12px]/5 text-zinc-500">{{ region.note }}</span>
                            </span>
                        </label>
                    </div>

                    <div class="mt-4 rounded-xl border border-amber-400/25 bg-amber-400/5 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-amber-300/80 uppercase">Read this bit</p>
                        <p class="mt-2 max-w-xl text-[12px]/5 text-zinc-400">
                            Moving a shop between regions means a new workspace and a migration one of us runs by hand. We have
                            done it eleven times. It takes two working days and the shop is read-only for about four hours of
                            that. Nobody has regretted picking Taipei.
                        </p>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <button type="button" :class="secondary" @click="go('shop')">Back</button>
                        <button type="button" :class="primary" @click="go('catalog')">Keep Taipei, carry on</button>
                    </div>
                </div>

                <div v-else-if="step === 'catalog'">
                    <div class="flex items-baseline gap-3">
                        <h1 class="text-lg font-semibold tracking-tight text-cream">Bring the catalog over</h1>
                        <span class="font-mono text-[10px] text-zinc-700">optional</span>
                    </div>
                    <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                        This is the long step — nineteen minutes in the middle, and the one people close the tab on. It is also
                        the only one you can hand to somebody else and go and do something useful.
                    </p>

                    <div class="mt-6 flex flex-col gap-2.5">
                        <button
                            v-for="(source, index) in sources"
                            :key="source.key"
                            type="button"
                            class="flex items-center gap-3 rounded-xl border p-4 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            :class="index === 0 ? 'border-jade-500/50 bg-jade-500/6' : 'border-white/8 bg-ink-900 hover:border-white/15'"
                        >
                            <span class="min-w-0 flex-1">
                                <span class="block text-[13px] text-cream">{{ source.label }}</span>
                                <span class="mt-0.5 block text-[12px]/5 text-zinc-500">{{ source.note }}</span>
                            </span>
                            <span class="shrink-0 font-mono text-[10px] text-zinc-600">{{ source.common }}</span>
                        </button>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <button type="button" :class="secondary" @click="go('region')">Back</button>
                        <a href="/templates/onboarding/screens/import" target="_top" :class="primary">Upload the CSV</a>
                        <button type="button" :class="quiet" @click="skip('catalog')">Skip — I will do it later</button>
                    </div>
                </div>

                <div v-else-if="step === 'people'">
                    <div class="flex items-baseline gap-3">
                        <h1 class="text-lg font-semibold tracking-tight text-cream">Anybody else</h1>
                        <span class="font-mono text-[10px] text-zinc-700">optional</span>
                    </div>
                    <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                        Three quarters of shops skip this and stay one person for a while. It sits here rather than in settings
                        because the people who do need it need it on day one, in the hour they are already thinking about it.
                    </p>

                    <div class="mt-6 flex flex-col gap-3 rounded-xl border border-white/8 bg-ink-900 p-5">
                        <template v-for="(seat, index) in seats" :key="index">
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3">
                                <span
                                    class="min-w-0 flex-1 truncate rounded-lg border px-3 py-2 font-mono text-[12px]"
                                    :class="seat.fixed ? 'border-white/8 bg-ink-950/60 text-zinc-500' : 'border-white/10 bg-ink-950 text-zinc-700'"
                                >{{ seat.email || 'somebody@kerouac.coffee' }}</span>

                                <span class="shrink-0 rounded-lg border border-white/10 px-2.5 py-2 text-[12px] text-zinc-400 sm:w-40">{{ seat.role }}</span>
                            </div>
                            <p class="-mt-1 text-[11px]/5 text-zinc-600">{{ seat.note }}</p>
                        </template>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <button type="button" :class="secondary" @click="go('catalog')">Back</button>
                        <button type="button" :class="primary" @click="go('payouts')">Send the invites</button>
                        <button type="button" :class="quiet" @click="skip('people')">Skip — it is just me</button>
                    </div>
                </div>

                <div v-else>
                    <h1 class="text-lg font-semibold tracking-tight text-cream">Where the money lands</h1>
                    <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                        You can open the shop and take orders without this. What you cannot do is get paid — takings sit with us
                        until an account is here, and the first payout leaves seven days after the first order ships.
                    </p>

                    <div class="mt-6 flex flex-col gap-5 rounded-xl border border-white/8 bg-ink-900 p-5">
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <OnboardingField label="Bank" value="822 — 中國信託商業銀行" why="Taiwanese accounts only for now. Overseas payouts go through a wire and cost $18." />
                            <OnboardingField label="Account number" placeholder="14 digits, no dashes" why="Checked against the name below before the first payout, not after it fails." />
                        </div>

                        <OnboardingField label="Account holder" value="柯瑞克咖啡有限公司" why="Has to match the bank's records exactly. A mismatch is the reason four in five first payouts bounce." />

                        <OnboardingField label="Tax number" value="90512347" optional why="Eight digits, if you are a company. Sole traders leave this empty and we invoice under your name." />
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <button type="button" :class="secondary" @click="go('people')">Back</button>
                        <a href="/templates/onboarding/screens/checklist" target="_top" :class="primary">That is the setup done</a>
                    </div>
                </div>
            </section>

            <aside class="flex flex-col gap-4">
                <div v-if="step === 'shop'" class="rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Why we ask now</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        The address has to exist before anything else can point at it — order mail, the storefront, the invite
                        links. It is the only field on this step that other steps depend on.
                    </p>
                    <p class="mt-3 border-t border-white/5 pt-3 font-mono text-[10px] text-zinc-600">98% get through this step · 2 min median</p>
                </div>

                <div v-else-if="step === 'region'" class="rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Why we ask now</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        Because it is the one thing here that hardens. Every other answer on these five screens can be changed
                        from settings in under a minute, so this is the only page that gets a warning box.
                    </p>
                    <p class="mt-3 border-t border-white/5 pt-3 font-mono text-[10px] text-zinc-600">91% get through this step · 1 min median</p>
                    <p class="mt-2 text-[11px]/5 text-zinc-600">The 9% mostly leave to go and ask somebody. Two thirds come back the same day.</p>
                </div>

                <div v-else-if="step === 'catalog'" class="rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If you skip it</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        The shop opens empty and you can import any time — the screen does not go away. Most people who skip type
                        one product by hand, work out how long forty of them would take, and come back to the CSV.
                    </p>
                    <p class="mt-3 border-t border-white/5 pt-3 font-mono text-[10px] text-zinc-600">64% get through this step · 19 min median</p>
                    <p class="mt-2 text-[11px]/5 text-zinc-600">This is where the afternoon goes. It is also where 41% of everybody who never opened a shop stopped.</p>
                </div>

                <div v-else-if="step === 'people'" class="rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If you skip it</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        Nothing. You run the shop alone, which is what 74% do. Half of them add somebody inside the first month
                        anyway, from settings, in about forty seconds.
                    </p>
                    <p class="mt-3 border-t border-white/5 pt-3 font-mono text-[10px] text-zinc-600">skipped by 74% · 3 min when it is not</p>
                </div>

                <div v-else class="rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If you skip it</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        The shop still opens and orders still come in. The money waits with us, and we mail you about it on day
                        three, day ten and day thirty. 312 shops are selling right now with no account attached.
                    </p>
                    <p class="mt-3 border-t border-white/5 pt-3 font-mono text-[10px] text-zinc-600">89% get through this step · 6 min median</p>
                </div>

                <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we deleted</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        This used to be seven steps. A theme picker and a shipping-zone builder came out in March after we
                        watched where people stopped, and 3.6 points more of them have opened since.
                    </p>
                    <a
                        href="/templates/onboarding/screens/dropout"
                        target="_top"
                        class="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                    >The numbers behind that</a>
                </div>
            </aside>
        </div>
    </OnboardingShell>
</template>
