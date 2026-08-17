<script setup>
import { computed, ref } from 'vue';
import ContactShell from './Shell.vue';
import ContactField from './Field.vue';

const reasons = [
    { key: 'warranty', label: 'Something is wrong with the machine', person: 'Ines Marto', initials: 'IM', reply: '47 min', window: '09:30–18:30 Mon–Fri', note: 'She built about a third of the machines in the field. Noise questions usually come back in one line.' },
    { key: 'order', label: 'An order or a parcel', person: 'Ping Hsu', initials: 'PH', reply: '2 h', window: '09:00–18:00 Mon–Sat', note: 'He can move an address up to the moment the label prints, which is 16:00 the day before it ships.' },
    { key: 'dealer', label: 'I sell coffee gear', person: 'Ines Marto', initials: 'IM', reply: '1 day', window: 'Tue and Thu', note: 'Dealer terms start at six machines a month. Under that she will tell you to buy at retail and keep the margin.' },
    { key: 'press', label: 'Press, or none of the above', person: 'Sofia Reis', initials: 'SR', reply: '3 days', window: 'Mon Wed Fri', note: 'Two loan machines exist. If your deadline is inside a fortnight, say so in the first line.' },
];

const after = [
    { when: 'Straight away', what: 'A reference lands in your mail. It is the same one on our side, so quoting it means something.' },
    { when: 'When the bench opens', what: 'A person reads it. Not a triage bot deciding which queue you belong in.' },
    { when: 'Same day, usually', what: 'If it needs a part, the part goes on the van before anyone asks you to prove anything.' },
    { when: 'After it closes', what: 'If the answer was worth keeping, it turns up in the help centre with your wording in it.' },
];

const ages = ['Under a month', '1 to 12 months', 'Over a year', 'Bought used'];
const troubles = ['It has not arrived', 'Wrong item', 'Arrived damaged', 'Change the address'];
const volumes = ['1 to 5', '6 to 15', '16 to 40', 'More than 40'];
const needs = ['Photographs', 'A machine on loan', 'Twenty minutes on a call', 'Specifications'];

const checks = [
    { key: 'when', label: 'when it started', test: (text) => /\b(week|weeks|month|months|day|days|since|after|yesterday|new|arrived|first)\b/i.test(text) },
    { key: 'what', label: 'what it does', test: (text) => text.trim().length > 40 },
    { key: 'tried', label: 'what you already tried', test: (text) => /\b(tried|already|swapped|cleaned|reset|checked|took|opened|ran)\b/i.test(text) },
];

const reason = ref('warranty');
const name = ref('Tomás Ferreira');
const email = ref('tomas@ferreira.pt');
const serial = ref('');
const age = ref(ages[1]);
const order = ref('');
const trouble = ref(troubles[0]);
const shop = ref('');
const city = ref('');
const volume = ref(volumes[1]);
const outlet = ref('');
const deadline = ref('2026-09-04');
const wanted = ref([needs[0]]);
const message = ref('');

const desk = computed(() => reasons.find((entry) => entry.key === reason.value));

const words = computed(() => (message.value.trim() === '' ? 0 : message.value.trim().split(/\s+/).length));

const chip = (on) => (on
    ? 'border-jade-500/60 bg-jade-500/10 text-jade-300'
    : 'border-white/10 text-zinc-400 hover:border-jade-500/50 hover:text-cream');

const toggleNeed = (entry) => {
    wanted.value = wanted.value.includes(entry)
        ? wanted.value.filter((item) => item !== entry)
        : [...wanted.value, entry];
};
</script>

<template>
    <ContactShell active="Write in" :rail="false">
        <div class="mx-auto flex max-w-5xl gap-10">
            <div class="min-w-0 flex-1">
                <h1 class="text-lg font-semibold tracking-tight text-cream">Say it the way you would say it out loud</h1>
                <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                    The first question tells us whose desk this belongs on. Everything after it changes with your answer, so
                    you are never typing a serial number into a form about wholesale pricing.
                </p>

                <fieldset class="mt-6">
                    <legend class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What is this about</legend>
                    <div class="mt-2.5 flex flex-wrap gap-1.5">
                        <button
                            v-for="entry in reasons"
                            :key="entry.key"
                            type="button"
                            class="rounded-lg border px-3 py-1.5 text-[12px] transition-colors duration-150"
                            :class="chip(reason === entry.key)"
                            @click="reason = entry.key"
                        >{{ entry.label }}</button>
                    </div>
                </fieldset>

                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <ContactField v-model="name" label="Your name" />
                    <ContactField v-model="email" label="Where to write back" type="email" />
                </div>

                <div v-if="reason === 'warranty'" class="mt-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <ContactField
                            v-model="serial"
                            label="Serial"
                            placeholder="NS-B40-0117"
                            mono
                            hint="Plate under the base, six digits after NS-B. It tells us the batch and the burr set."
                        />

                        <div>
                            <span class="text-[12px] text-zinc-400">How long have you had it</span>
                            <div class="mt-2 flex flex-wrap gap-1.5">
                                <button
                                    v-for="entry in ages"
                                    :key="entry"
                                    type="button"
                                    class="rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150"
                                    :class="chip(age === entry)"
                                    @click="age = entry"
                                >{{ entry }}</button>
                            </div>
                        </div>
                    </div>

                    <label class="mt-4 flex cursor-pointer items-center gap-2.5 rounded-lg border border-dashed border-white/12 px-3 py-2.5 text-[12px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">
                        <svg class="size-3.5 shrink-0" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                        Attach a clip of the noise
                        <span class="ml-auto font-mono text-[10px] text-zinc-700">ten seconds, dial 1 to 16, no beans</span>
                        <input type="file" class="sr-only">
                    </label>
                </div>

                <div v-else-if="reason === 'order'" class="mt-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <ContactField
                            v-model="order"
                            label="Order number"
                            placeholder="NS-2026-0117"
                            mono
                            hint="On the confirmation mail. Without it we are searching by surname, and there are four of you."
                        />

                        <div>
                            <span class="text-[12px] text-zinc-400">What has happened</span>
                            <div class="mt-2 flex flex-wrap gap-1.5">
                                <button
                                    v-for="entry in troubles"
                                    :key="entry"
                                    type="button"
                                    class="rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150"
                                    :class="chip(trouble === entry)"
                                    @click="trouble = entry"
                                >{{ entry }}</button>
                            </div>
                        </div>
                    </div>

                    <p class="mt-3 text-[12px]/5 text-zinc-600">
                        Tracking that has not moved for nine days is almost always customs, not the courier. Ping can see the
                        declaration and will tell you which of the two it is before you spend an afternoon on the phone.
                    </p>
                </div>

                <div v-else-if="reason === 'dealer'" class="mt-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <ContactField v-model="shop" label="Shop" placeholder="Rua da Prata Coffee" />
                        <ContactField v-model="city" label="City" placeholder="Lisbon" />
                    </div>

                    <div class="mt-4">
                        <span class="text-[12px] text-zinc-400">Machines a month, honestly</span>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <button
                                v-for="entry in volumes"
                                :key="entry"
                                type="button"
                                class="rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150"
                                :class="chip(volume === entry)"
                                @click="volume = entry"
                            >{{ entry }}</button>
                        </div>
                        <p class="mt-2.5 text-[12px]/5 text-zinc-600">
                            Under six a month the dealer price is worse for you than the retail one, once the stock you have to
                            hold is counted. We would rather say that now than in the third mail.
                        </p>
                    </div>
                </div>

                <div v-else class="mt-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <ContactField v-model="outlet" label="Where it runs" placeholder="Standart, issue 24" />
                        <ContactField v-model="deadline" label="Your deadline" type="date" mono />
                    </div>

                    <div class="mt-4">
                        <span class="text-[12px] text-zinc-400">What you need</span>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <button
                                v-for="entry in needs"
                                :key="entry"
                                type="button"
                                class="rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150"
                                :class="chip(wanted.includes(entry))"
                                @click="toggleNeed(entry)"
                            >{{ entry }}</button>
                        </div>
                        <p class="mt-2.5 text-[12px]/5 text-zinc-600">Two loan machines exist and they are usually out. Six weeks of notice gets you one; two does not.</p>
                    </div>
                </div>

                <div class="mt-5">
                    <ContactField label="What happened" hint="Plain sentences beat a bullet list. Whoever reads it has taken one of these apart, so you can be blunt about it.">
                        <textarea
                            v-model="message"
                            rows="5"
                            spellcheck="false"
                            placeholder="Three weeks old. Quiet at first, and since the weekend it screams anywhere past halfway on the dial…"
                            class="w-full resize-none rounded-lg border border-white/10 bg-ink-900 px-3 py-2.5 text-[13px]/6 text-cream placeholder:text-zinc-600 transition-colors duration-150 focus:border-jade-500/60 focus:outline-none"
                        ></textarea>
                    </ContactField>

                    <div class="mt-2.5 flex flex-wrap gap-x-5 gap-y-2">
                        <span v-for="check in checks" :key="check.key" class="flex items-center gap-1.5">
                            <span
                                class="flex size-3.5 items-center justify-center rounded-full border"
                                :class="check.test(message) ? 'border-jade-500/60 bg-jade-500/15' : 'border-white/12'"
                            >
                                <svg class="size-2" :class="check.test(message) ? 'text-jade-400' : 'text-zinc-700'" viewBox="0 0 12 12" fill="none"><path d="M2 6.5 4.5 9 10 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span class="font-mono text-[10px]" :class="check.test(message) ? 'text-jade-400/90' : 'text-zinc-700'">{{ check.label }}</span>
                        </span>

                        <span class="ml-auto font-mono text-[10px] text-zinc-700">{{ words }} words · three lines is plenty</span>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap items-center gap-4 border-t border-white/5 pt-5">
                    <a
                        href="/templates/contact/screens/sent"
                        target="_top"
                        class="rounded-lg bg-jade-500 px-4 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >Send it</a>

                    <p class="text-[12px]/5 text-zinc-500">
                        It is <span class="font-mono text-zinc-300">04:12</span> at the bench and nobody is up.
                        <span class="block text-zinc-600">First reply usually lands by <span class="font-mono">10:20</span>, and it will be a person.</span>
                    </p>
                </div>
            </div>

            <aside class="hidden w-60 shrink-0 lg:block">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where this lands</p>

                <div class="mt-3 rounded-xl border border-jade-500/25 bg-jade-500/5 p-3.5">
                    <div class="flex items-center gap-3">
                        <span class="flex size-9 shrink-0 items-center justify-center rounded-lg border border-jade-500/40 bg-jade-500/10 font-mono text-[11px] text-jade-300">{{ desk.initials }}</span>
                        <span class="min-w-0">
                            <span class="block truncate text-[13px] text-cream">{{ desk.person }}</span>
                            <span class="mt-0.5 block font-mono text-[10px] text-zinc-600">reads this one</span>
                        </span>
                    </div>

                    <p class="mt-3 text-[12px]/5 text-zinc-500">{{ desk.note }}</p>

                    <div class="mt-3.5 border-t border-white/8 pt-3">
                        <p class="flex items-baseline gap-2">
                            <span class="font-mono text-base text-cream">{{ desk.reply }}</span>
                            <span class="font-mono text-[10px] text-zinc-700">median first reply</span>
                        </p>
                        <p class="mt-1 font-mono text-[10px] text-zinc-600">{{ desk.window }}</p>
                    </div>
                </div>

                <p class="mt-6 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What happens next</p>
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
                        <li>No chatbot in between</li>
                        <li>Nothing sold to you afterwards</li>
                        <li>Your address goes to the courier and nowhere else</li>
                    </ul>
                </div>
            </aside>
        </div>
    </ContactShell>
</template>
