<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import FaqShell from './Shell.vue';
import FaqStep from './Step.vue';
import FaqCallout from './Callout.vue';
import FaqHelpful from './Helpful.vue';
import FaqQuestion from './Question.vue';

const contents = [
    { id: 'is-it', label: 'Is it the batch, or the burrs bedding in?' },
    { id: 'serial', label: 'Check your serial' },
    { id: 'fix', label: 'The twenty-minute fix' },
    { id: 'instead', label: 'If you would rather not' },
    { id: 'nearby', label: 'People also opened' },
];

const steps = [
    { title: 'Unplug it and empty the hopper', minutes: '2 min', tools: [], body: 'Beans out, hopper off — a quarter turn anticlockwise and it lifts. Tip the last few beans out of the throat with the machine on its side.' },
    { title: 'Take the top burr out', minutes: '4 min', tools: ['3 mm hex'], body: 'Four screws in the collar, all the same length. The burr carrier lifts straight up; it does not need levering, and if it fights you the collar is still holding a screw.' },
    { title: 'Drop the shims onto the seat', minutes: '3 min', tools: ['shim kit'], body: 'Two shims, 0.08 mm each, stacked flat on the machined face. They will sit slightly proud of the lip. That is correct — the carrier squashes them home.' },
    { title: 'Refit and torque in a cross', minutes: '6 min', tools: ['3 mm hex'], body: 'Narrow tab against the punch mark. Nip all four screws finger tight first, then go round in a cross until they stop turning easily. Do not lean on the key.' },
    { title: 'Grind 30 grams and listen', minutes: '5 min', tools: ['stale beans'], body: 'Take it from 1 to 16 and back down. What you are listening for is a single even note the whole way — no swell around the middle. Then reset your dial, because the gap has moved.', last: true },
];

const tells = [
    { title: 'Batch 40', tone: 'batch', lines: ['Starts near the middle of the dial', 'Louder on lighter roasts', 'Worse over three or four weeks', 'Rings even when empty and under load'] },
    { title: 'Bedding in', tone: 'normal', lines: ['Even across the whole dial', 'Same on any roast', 'Quieter every week', 'Silent when the hopper is empty'] },
];

const routes = [
    { title: 'Send it back to the bench', meta: '5 working days, door to door', body: 'We email you a label, you drop it at any 7-Eleven, and it comes back shimmed, cleaned and with the gap reset. The van collects from the shop on Wednesdays.' },
    { title: 'Have someone come to you', meta: 'Taipei and Taichung only', body: 'Twenty minutes on your counter. Two Saturdays a month, and it is the same person who built it — there are only four of us.' },
];

const nearby = [
    { q: 'Grounds cling to everything. Is the graphite finish static?', topic: 'Noise and grind', helpful: 89, votes: 146, updated: '2 weeks ago', a: 'The finish has nothing to do with it — dry beans build a charge as they break. One drop of water stirred through the beans kills it.' },
    { q: 'I opened it myself before writing in. Have I voided anything?', topic: 'Warranty', helpful: 62, votes: 91, updated: '2 Mar', stale: true, a: 'No. Four hex screws and a service manual on this site — taking the top off is the machine working as intended. The sealed motor housing is the one exception.' },
    { q: 'Do I need the receipt to claim?', topic: 'Warranty', helpful: 93, votes: 72, updated: '9 Aug', a: 'The serial is enough. It is on a plate under the base and tells us which run you have.' },
];

const history = [
    { when: '14 Aug', who: 'Lena Kohler', what: 'Added the serial range once the second batch was confirmed' },
    { when: '2 Jul', who: 'Lena Kohler', what: 'Rewrote step 4 — people were over-torquing the collar' },
    { when: '9 May', who: 'Hana Okabe', what: 'First version, off the back of eleven letters in one week' },
];

const samples = ['40-0117', '40-0688', '22-0410', '41-0004'];

const serial = ref('40-0117');
const current = ref(contents[0].id);

const verdict = computed(() => {
    const match = serial.value.trim().toUpperCase().match(/^(\d{2})-(\d{4})$/);

    if (!match) {
        return { text: 'Six characters, like 40-0117.', tone: 'text-zinc-600' };
    }

    const affected = match[1] === '40' && Number(match[2]) >= 100 && Number(match[2]) <= 699;

    return affected
        ? { text: 'That is one of them. The shim kit is free — say the word and it goes out on today’s van.', tone: 'text-amber-300' }
        : { text: 'Not from that run. Which means the noise is something else, and we would like to hear it before you open anything.', tone: 'text-jade-300' };
});

let scroller = null;

const offsetOf = (element) => element.getBoundingClientRect().top - scroller.getBoundingClientRect().top + scroller.scrollTop;

const paint = () => {
    if (!scroller) {
        return;
    }

    const line = scroller.scrollTop + 24;
    const passed = contents
        .map((entry) => document.getElementById(entry.id))
        .filter((element) => element && offsetOf(element) <= line);

    current.value = passed.length > 0 ? passed[passed.length - 1].id : contents[0].id;
};

const jump = (id) => scroller?.scrollTo({ top: offsetOf(document.getElementById(id)) - 16, behavior: 'smooth' });

onMounted(() => {
    scroller = document.querySelector('[data-faq-scroll]');
    scroller?.addEventListener('scroll', paint, { passive: true });
    paint();
});

onBeforeUnmount(() => scroller?.removeEventListener('scroll', paint));
</script>

<template>
    <FaqShell active="Answers" topic="Noise and grind">
        <div class="mx-auto flex max-w-5xl gap-10">
            <article class="min-w-0 flex-1">
                <nav class="flex items-center gap-1.5 font-mono text-[10px] text-zinc-700">
                    <a href="/templates/faq/screens/questions" target="_top" class="transition-colors duration-150 hover:text-cream">Help centre</a>
                    <span>/</span>
                    <a href="/templates/faq/screens/questions" target="_top" class="transition-colors duration-150 hover:text-cream">Noise and grind</a>
                </nav>

                <h1 class="mt-3 max-w-2xl text-2xl/8 font-semibold tracking-tight text-cream">
                    It howls above half the dial after three weeks. Is that normal?
                </h1>

                <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2">
                    <span class="flex items-center gap-2">
                        <span class="grid size-6 place-items-center rounded-full bg-jade-500/15 font-mono text-[10px] text-jade-300">LK</span>
                        <span class="text-[12px] text-zinc-400">Lena Kohler</span>
                        <span class="font-mono text-[10px] text-zinc-700">bench test</span>
                    </span>
                    <span class="font-mono text-[10px] text-zinc-700">edited 3 days ago</span>
                    <span class="font-mono text-[10px] text-zinc-700">opened 1,840 times</span>
                    <span class="font-mono text-[10px] text-jade-400">94% said it helped</span>
                </div>

                <div class="mt-8 max-w-2xl space-y-4 text-[13px]/6.5 text-zinc-400">
                    <p class="text-[15px]/7 text-zinc-300">
                        No, and the shape of it tells you why. Burrs bedding in get quieter every week and never pick one spot on the dial to scream at.
                        A noise that starts around the middle and gets worse on lighter roasts is mechanical, not a running-in noise.
                    </p>
                    <p>
                        In March we shipped roughly 600 machines whose top burr seat came out 0.15 mm shallow. The burr sits proud, the two faces touch once the load comes on,
                        and what you hear is metal singing rather than coffee breaking. We found it because eleven people wrote to us in the same week and described it in almost the same words.
                    </p>
                </div>

                <section id="is-it" class="mt-10 scroll-mt-6">
                    <h2 class="text-base font-medium text-cream">Is it the batch, or the burrs bedding in?</h2>

                    <div class="mt-4 grid max-w-2xl grid-cols-1 gap-3 sm:grid-cols-2">
                        <div
                            v-for="tell in tells"
                            :key="tell.title"
                            class="rounded-xl p-4"
                            :class="tell.tone === 'batch' ? 'border border-red-400/25 bg-red-500/6' : 'border border-white/8 bg-ink-900'"
                        >
                            <p class="font-mono text-[10px] tracking-wider uppercase" :class="tell.tone === 'batch' ? 'text-red-300' : 'text-zinc-500'">{{ tell.title }}</p>
                            <ul class="mt-2.5 space-y-1.5 text-[12px]/5 text-zinc-400">
                                <li v-for="line in tell.lines" :key="line">{{ line }}</li>
                            </ul>
                        </div>
                    </div>

                    <FaqCallout tone="tip" label="The one-minute test" class="mt-5 max-w-2xl">
                        <p>Run it empty from 1 to 16. If it is quiet empty and only sings with beans in it, the seat is proud and this page is about your machine.</p>
                    </FaqCallout>
                </section>

                <section id="serial" class="mt-10 scroll-mt-6">
                    <h2 class="text-base font-medium text-cream">Check your serial</h2>
                    <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                        Plate under the base, six characters after the dash. Anything from 0100 to 0699 came off that run.
                    </p>

                    <div class="mt-4 max-w-md rounded-xl border border-white/8 bg-ink-900 p-4">
                        <label class="flex items-center gap-2.5">
                            <span class="font-mono text-[12px] text-zinc-600">NS-B</span>
                            <input
                                v-model="serial"
                                type="text"
                                maxlength="7"
                                spellcheck="false"
                                placeholder="40-0117"
                                class="w-32 rounded-lg border border-white/10 bg-ink-950 px-2.5 py-1.5 font-mono text-[13px] text-cream focus:border-jade-500/60 focus:outline-none"
                            >
                            <span class="sr-only">The six characters after the dash</span>
                        </label>

                        <p class="mt-3 text-[12px]/5" :class="verdict.tone">{{ verdict.text }}</p>

                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <button
                                v-for="sample in samples"
                                :key="sample"
                                type="button"
                                class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                                @click="serial = sample"
                            >{{ sample }}</button>
                        </div>
                    </div>
                </section>

                <section id="fix" class="mt-10 scroll-mt-6">
                    <div class="flex flex-wrap items-baseline justify-between gap-3">
                        <h2 class="text-base font-medium text-cream">The twenty-minute fix</h2>
                        <span class="font-mono text-[10px] text-zinc-700">shim kit posts free · say the word</span>
                    </div>

                    <div class="mt-5 max-w-2xl">
                        <FaqStep
                            v-for="(step, index) in steps"
                            :key="step.title"
                            :number="index + 1"
                            :title="step.title"
                            :minutes="step.minutes"
                            :tools="step.tools"
                            :last="step.last ?? false"
                        >
                            <p>{{ step.body }}</p>
                        </FaqStep>
                    </div>

                    <FaqCallout tone="warn" label="The mistake everyone makes" class="max-w-2xl">
                        <p>Torquing the four collar screws in a circle rather than a cross pulls the carrier over by a hair and puts the noise back. Cross pattern, finger tight first, and stop when the key stops turning easily.</p>
                    </FaqCallout>
                </section>

                <section id="instead" class="mt-10 scroll-mt-6">
                    <h2 class="text-base font-medium text-cream">If you would rather not open it</h2>
                    <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">Both of these are free, and neither of them counts against the warranty.</p>

                    <div class="mt-4 grid max-w-2xl grid-cols-1 gap-3 sm:grid-cols-2">
                        <div v-for="route in routes" :key="route.title" class="flex flex-col rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p class="text-[13px] font-medium text-cream">{{ route.title }}</p>
                            <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ route.meta }}</p>
                            <p class="mt-2.5 flex-1 text-[12px]/5 text-zinc-500">{{ route.body }}</p>
                            <a
                                href="/templates/faq/screens/ask"
                                target="_top"
                                class="mt-3.5 rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >Arrange it</a>
                        </div>
                    </div>
                </section>

                <FaqHelpful class="mt-10 max-w-2xl" :helpful="94" :votes="212" prompt="Did that fix it?" />

                <section id="nearby" class="mt-10 scroll-mt-6">
                    <h2 class="text-base font-medium text-cream">People also opened</h2>

                    <div class="mt-3 max-w-2xl overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        <FaqQuestion
                            v-for="entry in nearby"
                            :key="entry.q"
                            :question="entry.q"
                            :topic="entry.topic"
                            :helpful="entry.helpful"
                            :votes="entry.votes"
                            :updated="entry.updated"
                            :stale="entry.stale ?? false"
                            class="last:border-b-0"
                        >
                            <p>{{ entry.a }}</p>
                        </FaqQuestion>
                    </div>
                </section>

                <section class="mt-10 max-w-2xl">
                    <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">This page has been rewritten three times</h2>

                    <div class="mt-3 space-y-2.5">
                        <div v-for="entry in history" :key="entry.when" class="flex gap-3">
                            <span class="w-12 shrink-0 font-mono text-[10px] text-zinc-700">{{ entry.when }}</span>
                            <span class="text-[12px]/5 text-zinc-500">{{ entry.what }} <span class="text-zinc-700">— {{ entry.who }}</span></span>
                        </div>
                    </div>
                </section>
            </article>

            <aside class="hidden w-52 shrink-0 xl:block">
                <div class="sticky top-0">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">On this page</p>
                    <nav class="mt-2.5 space-y-1">
                        <button
                            v-for="entry in contents"
                            :key="entry.id"
                            type="button"
                            class="block w-full border-l py-1 pl-3 text-left text-[12px]/5 transition-colors duration-150"
                            :class="current === entry.id ? 'border-jade-400 text-jade-300' : 'border-white/8 text-zinc-600 hover:border-white/25 hover:text-zinc-300'"
                            @click="jump(entry.id)"
                        >{{ entry.label }}</button>
                    </nav>

                    <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                        <p class="font-mono text-[10px] text-zinc-600">Affected serials</p>
                        <p class="mt-1.5 font-mono text-[13px] text-cream">NS-B40-0100 → 0699</p>
                        <p class="mt-1.5 text-[11px]/5 text-zinc-600">Built 3–19 March. 412 of the 600 have been fixed one way or another.</p>
                        <div class="mt-2.5 h-0.5 overflow-hidden rounded-full bg-white/10">
                            <span class="block h-full w-[69%] rounded-full bg-jade-500/70"></span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </FaqShell>
</template>
