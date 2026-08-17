<script setup>
import { computed, ref } from 'vue';
import FaqShell from './Shell.vue';

const candidates = [
    { slug: 'noise', q: 'It howls above half the dial after three weeks. Is that normal?', topic: 'Noise and grind', helpful: 94, keys: 'noise noisy loud howl scream squeal whine rpm dial halfway middle grinding sound batch vibration' },
    { slug: 'static', q: 'Grounds cling to everything. Is the graphite finish static?', topic: 'Noise and grind', helpful: 89, keys: 'static cling mess grounds dust everywhere stick graphite finish spray' },
    { slug: 'season', q: 'Do I have to season the burrs, and how much coffee does that cost me?', topic: 'Setting it up', helpful: 96, keys: 'season seasoning break in bedding new burrs waste beans first grind drift' },
    { slug: 'used', q: 'It arrived with grounds inside. Was mine used?', topic: 'Setting it up', helpful: 97, keys: 'used second hand grounds inside chute dirty box opened refurbished' },
    { slug: 'void', q: 'I opened it myself before writing in. Have I voided anything?', topic: 'Warranty', helpful: 62, keys: 'warranty void opened apart screws myself repair fix disassemble guarantee' },
    { slug: 'late', q: 'Nine days and the tracking has not moved. Where is it?', topic: 'Orders and delivery', helpful: 71, keys: 'tracking late delivery shipping where order lost days parcel courier customs' },
    { slug: 'address', q: 'Can I change the address after ordering?', topic: 'Orders and delivery', helpful: 90, keys: 'address change move wrong delivery order edit label' },
    { slug: 'finish', q: 'Jade or graphite — does the finish change anything?', topic: 'Before you buy', helpful: 98, keys: 'jade graphite colour color finish difference which choose buy' },
];

const after = [
    { when: 'Straight away', what: 'A reference number lands in your mail. It is the same number the desk sees.' },
    { when: 'Within 47 minutes', what: 'Median first reply, business hours. Not a robot and not a form letter — one of four people.' },
    { when: 'Same day', what: 'If it needs a part, the part goes on the van before anybody asks you to prove anything.' },
    { when: 'Whenever it closes', what: 'If the answer was worth writing down, it turns up in the help centre with your words in it.' },
];

const samples = ['it screams past halfway', 'grounds go everywhere', 'nine days, no tracking', 'I already took it apart'];

const lanes = ['Noise and grind', 'Setting it up', 'Warranty', 'Orders and delivery', 'Something else'];

const stop = ['the', 'and', 'for', 'with', 'that', 'this', 'have', 'has', 'was', 'are', 'but', 'not', 'you', 'from', 'its', 'it', 'is', 'my', 'me', 'a', 'i'];

const text = ref('');
const forced = ref(false);
const lane = ref(lanes[0]);
const email = ref('tomas@ferreira.pt');
const serial = ref('');

const words = computed(() => text.value.toLowerCase().replace(/[^a-z0-9\s]/g, ' ').split(/\s+/)
    .filter((word) => word.length > 2 && !stop.includes(word)));

const alike = (key, word) => key === word
    || (key.length > 3 && word.startsWith(key))
    || (word.length > 3 && key.startsWith(word));

const score = (entry, list) => {
    const keys = entry.keys.split(' ');

    return list.reduce((total, word) => total + (keys.some((key) => alike(key, word)) ? 1 : 0), 0);
};

const matches = computed(() => candidates
    .map((entry) => ({ entry, hits: score(entry, words.value) }))
    .filter((row) => row.hits > 0)
    .sort((a, b) => b.hits - a.hits)
    .slice(0, 3)
    .map((row) => row.entry));

const showForm = computed(() => forced.value || (words.value.length > 0 && matches.value.length === 0));

const suggest = (sample) => {
    text.value = sample;
    forced.value = false;
};
</script>

<template>
    <FaqShell active="Ask">
        <div class="mx-auto flex max-w-5xl gap-10">
            <div class="min-w-0 flex-1">
                <h1 class="text-lg font-semibold tracking-tight text-cream">Say it the way you would say it out loud</h1>
                <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                    Six out of ten letters have an answer sitting on this site already, so we look while you type.
                    If one of them is yours, you have your answer now instead of at ten tomorrow morning.
                </p>

                <div class="mt-5">
                    <textarea
                        v-model="text"
                        rows="4"
                        spellcheck="false"
                        placeholder="Three weeks old and it has started screaming past halfway on the dial…"
                        class="w-full resize-none rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                    ></textarea>

                    <div class="mt-2 flex flex-wrap items-center gap-1.5">
                        <span class="font-mono text-[10px] text-zinc-700">try</span>
                        <button
                            v-for="sample in samples"
                            :key="sample"
                            type="button"
                            class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                            @click="suggest(sample)"
                        >{{ sample }}</button>
                    </div>
                </div>

                <div v-if="matches.length > 0" class="mt-6">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">
                        {{ matches.length }} {{ matches.length === 1 ? 'answer looks' : 'answers look' }} like what you just wrote
                    </p>

                    <div class="mt-2.5 overflow-hidden rounded-xl border border-jade-500/25 bg-jade-500/5">
                        <a
                            v-for="entry in matches"
                            :key="entry.slug"
                            href="/templates/faq/screens/answer"
                            target="_top"
                            class="flex items-start gap-3 border-b border-white/5 px-4 py-3 transition-colors duration-150 last:border-b-0 hover:bg-white/4"
                        >
                            <span class="mt-1 size-1.5 shrink-0 rounded-full bg-jade-400"></span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-[13px]/5 text-zinc-200">{{ entry.q }}</span>
                                <span class="mt-1 flex items-center gap-2.5">
                                    <span class="font-mono text-[10px] text-zinc-600">{{ entry.topic }}</span>
                                    <span class="font-mono text-[10px] text-jade-400/80">{{ entry.helpful }}% said it helped</span>
                                </span>
                            </span>
                            <svg class="mt-0.5 size-3.5 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none"><path d="M6 3.5 10.5 8 6 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>

                    <button
                        type="button"
                        class="mt-2.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream"
                        @click="forced = true"
                    >none of those — send it to a person →</button>
                </div>

                <div v-if="showForm" class="mt-6 border-t border-white/5 pt-6">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What the desk needs from you</p>

                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span class="block text-[12px] text-zinc-400">Where to write back</span>
                            <input
                                v-model="email"
                                type="email"
                                class="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                            >
                        </label>

                        <label class="block">
                            <span class="block text-[12px] text-zinc-400">Serial, if the machine is the problem</span>
                            <input
                                v-model="serial"
                                type="text"
                                spellcheck="false"
                                placeholder="NS-B40-0117"
                                class="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 font-mono text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                            >
                        </label>
                    </div>

                    <div class="mt-4">
                        <span class="block text-[12px] text-zinc-400">What is it about</span>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <button
                                v-for="entry in lanes"
                                :key="entry"
                                type="button"
                                class="rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150"
                                :class="lane === entry ? 'border-jade-500/60 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-400 hover:border-jade-500/50 hover:text-cream'"
                                @click="lane = entry"
                            >{{ entry }}</button>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-dashed border-white/12 px-3 py-2 text-[12px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">
                            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                            Attach a recording
                            <input type="file" class="sr-only">
                        </label>
                        <span class="font-mono text-[10px] text-zinc-700">a ten-second clip of the noise beats three paragraphs describing it</span>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center gap-4 border-t border-white/5 pt-5">
                        <button
                            type="button"
                            class="rounded-lg bg-jade-500 px-4 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >Send it</button>

                        <p class="text-[12px]/5 text-zinc-500">
                            It is <span class="font-mono text-zinc-300">04:12</span> at the bench. Nobody is up.
                            <span class="block text-zinc-600">First reply usually lands by <span class="font-mono">10:30</span>, and it will be a person.</span>
                        </p>
                    </div>
                </div>
            </div>

            <aside class="hidden w-56 shrink-0 lg:block">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What happens next</p>

                <div class="mt-3 space-y-3.5">
                    <div v-for="entry in after" :key="entry.when" class="border-l border-white/8 pl-3">
                        <p class="font-mono text-[10px] text-jade-400/80">{{ entry.when }}</p>
                        <p class="mt-1 text-[12px]/5 text-zinc-500">{{ entry.what }}</p>
                    </div>
                </div>

                <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                    <p class="font-mono text-[10px] text-zinc-600">What does not happen</p>
                    <ul class="mt-2 space-y-1.5 text-[11px]/5 text-zinc-500">
                        <li>No account to create</li>
                        <li>No ticket number to quote back at us</li>
                        <li>No chatbot in between</li>
                        <li>Nothing sold to you afterwards</li>
                    </ul>
                </div>
            </aside>
        </div>
    </FaqShell>
</template>
