<script setup>
import { computed, ref } from 'vue';
import OnboardingShell from './Shell.vue';
import OnboardingTask from './Task.vue';

const tasks = ref([
    { label: 'Pick the region', why: 'Done on the second setup screen. It is on this list because it is the only setting that cannot be changed afterwards, so it gets said twice.', cost: '1 min', done: true, required: true },
    { label: 'A bank account for payouts', why: 'Orders can come in without it and the money sits with us. Nothing goes to a bank until this is here, and the first payout is seven days behind the first order anyway.', cost: '6 min', done: false, required: true },
    { label: 'An address customers can write to', why: 'Confirmed by clicking the link in the mail we sent to ana@kerouac.coffee. Without it, every order confirmation goes out from a no-reply nobody reads.', cost: 'done in 40 seconds', done: true, required: true },
    { label: 'Bring the catalog over', why: '387 products in, 19 rows left behind with a reason against each. The photos finished about an hour after the rest.', cost: '19 min', done: true, required: false },
    { label: 'Price your own freight', why: 'Until you do, orders use our default table, which is about 12% over what the courier charges you. That difference is yours, not ours, so it is worth an evening.', cost: '25 min', done: false, required: false },
    { label: 'Point kerouac.coffee at the shop', why: 'Two DNS records and a wait. The kerouac.nomadsupply.cc address keeps working forever either way, and half of all shops never bother.', cost: '10 min, then a day of waiting', done: false, required: false },
    { label: 'Read the refund policy you are shipping', why: 'Ticked because you accepted ours. It is a reasonable policy and it is not yours — the returns window in it is 14 days, which is longer than the law asks and shorter than what most roasters offer.', cost: '4 min to read', done: true, required: false },
    { label: 'Put somebody else on the shop', why: 'Two seats are in the plan and one of them is empty. It matters the first week you are ill.', cost: '3 min', done: false, required: false, moved: 'was on the required list until March' },
    { label: 'A photograph at the top of the shop', why: 'You uploaded the one of the roaster. Shops with a photo sell about a fifth more in their first month, which is a correlation we have never been able to untangle from simply caring.', cost: '2 min', done: true, required: false, moved: 'was on the required list until March' },
]);

const filters = [
    { key: 'all-tasks', label: 'All nine' },
    { key: 'yes', label: 'Holds the shop shut' },
    { key: 'no', label: 'Can wait' },
];

const spell = ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

const picked = ref('all-tasks');

const shut = computed(() => tasks.value.filter((task) => task.required));
const rest = computed(() => tasks.value.filter((task) => !task.required));
const shutDone = computed(() => shut.value.filter((task) => task.done).length);
const done = computed(() => tasks.value.filter((task) => task.done).length);
const left = computed(() => shut.value.length - shutDone.value);
const closed = computed(() => left.value > 0);

const toggle = (task) => {
    task.done = !task.done;
};
</script>

<template>
    <OnboardingShell active="What is left" step="payouts" :skipped="['people']" interactive>
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-3 gap-y-2">
                <button
                    v-for="filter in filters"
                    :key="filter.key"
                    type="button"
                    :data-active="picked === filter.key ? '' : undefined"
                    class="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-jade-500/15 data-active:text-jade-300"
                    @click="picked = filter.key"
                >{{ filter.label }}</button>

                <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ spell[done] }} of nine done</span>
            </div>
        </template>

        <div class="mx-auto max-w-6xl">
            <h1 class="text-lg font-semibold tracking-tight text-cream">Nine things, and only three of them matter today</h1>
            <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                Every onboarding checklist wants all nine ticked. This one sorts them by whether the shop can open without them,
                says what it costs you to leave one alone, and admits which two were on the wrong list until somebody looked.
            </p>

            <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
                <section>
                    <div v-if="picked !== 'no'">
                        <div class="flex items-baseline justify-between gap-3">
                            <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Holds the shop shut</h2>
                            <span class="font-mono text-[10px] text-zinc-700">three</span>
                        </div>

                        <div class="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-amber-400/20 bg-ink-950">
                            <OnboardingTask v-for="task in shut" :key="task.label" v-bind="task" @toggle="toggle(task)" />
                        </div>
                    </div>

                    <div v-if="picked !== 'yes'" class="mt-7">
                        <div class="flex items-baseline justify-between gap-3">
                            <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Everything else</h2>
                            <span class="font-mono text-[10px] text-zinc-700">six</span>
                        </div>

                        <div class="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            <OnboardingTask v-for="task in rest" :key="task.label" v-bind="task" @toggle="toggle(task)" />
                        </div>
                    </div>
                </section>

                <aside>
                    <div
                        class="rounded-xl border p-4"
                        :class="closed ? 'border-amber-400/25 bg-amber-400/5' : 'border-jade-500/25 bg-jade-500/5'"
                    >
                        <p class="text-[13px]" :class="closed ? 'text-amber-300' : 'text-jade-300'">
                            {{ closed ? `${spell[left]} thing${left === 1 ? '' : 's'} still hold${left === 1 ? 's' : ''} it shut` : 'Nothing is holding it shut' }}
                        </p>
                        <p class="mt-1.5 text-[12px]/5 text-zinc-400">
                            {{ closed
                                ? 'Everything else on the list can happen with customers already in the door.'
                                : 'The rest of the list can wait until the shop is busy enough to make it worth doing.' }}
                        </p>

                        <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-white/8">
                            <div
                                class="h-full rounded-full transition-[width] duration-300"
                                :class="closed ? 'bg-amber-400/70' : 'bg-jade-500'"
                                :style="{ width: `${Math.round((shutDone / shut.length) * 100)}%` }"
                            ></div>
                        </div>
                        <p class="mt-1.5 font-mono text-[10px] text-zinc-600">{{ shutDone }} of the {{ shut.length }} required · {{ done }} of {{ tasks.length }} altogether</p>

                        <button
                            type="button"
                            :disabled="closed"
                            class="mt-3 w-full rounded-lg bg-jade-500 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70 disabled:cursor-not-allowed disabled:bg-white/8 disabled:text-zinc-600"
                        >Open the shop</button>
                    </div>

                    <div class="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        <p class="border-b border-white/5 px-4 py-2.5 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What a customer sees right now</p>

                        <div class="p-4">
                            <div class="rounded-lg border border-white/8 bg-ink-950 p-3">
                                <div class="flex items-center gap-2">
                                    <span class="size-5 rounded bg-jade-500/20"></span>
                                    <span class="text-[12px] text-cream">Kerouac Coffee</span>
                                    <span class="ml-auto font-mono text-[9px] text-zinc-700">kerouac.nomadsupply.cc</span>
                                </div>

                                <div class="mt-2.5 h-12 rounded bg-white/6"></div>

                                <div class="mt-2 grid grid-cols-3 gap-1.5">
                                    <div v-for="tile in 3" :key="tile" class="rounded bg-white/4 p-1.5">
                                        <span class="block h-6 rounded bg-white/6"></span>
                                        <span class="mt-1 block h-1 w-2/3 rounded bg-white/10"></span>
                                        <span class="mt-1 block h-1 w-1/3 rounded bg-jade-500/40"></span>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-3 text-[11px]/5 text-zinc-600">
                                387 products, a photo, and a checkout that works. The freight line at the till still says our
                                default rate, which is the one unticked thing a customer would actually notice.
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Two things moved off the top list</p>
                        <p class="mt-2 text-[12px]/5 text-zinc-400">
                            Inviting somebody and uploading a photo used to hold the shop shut. In March we looked at 400 shops
                            that opened without either and could not find anything worse about them, so both moved down here.
                            The list got shorter rather than longer, which is the rarer direction.
                        </p>
                        <a
                            href="/templates/onboarding/screens/dropout"
                            target="_top"
                            class="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                        >What that changed</a>
                    </div>
                </aside>
            </div>
        </div>
    </OnboardingShell>
</template>
