<script setup>
import { computed, ref } from 'vue';
import InboxShell from './Shell.vue';
import InboxAvatar from './Avatar.vue';
import InboxClock from './Clock.vue';

const macros = [
    {
        slug: 'shim-kit',
        name: 'Shim kit — dispatch',
        used: '41 times this month',
        body: "Hi {{first_name}},\n\nThe kit goes out on today's van, so it should be with you inside {{eta}}. Two shims, a 3 mm hex, and a card with four photographs on it.\n\nNothing comes apart that you cannot put back. The hopper lifts off, three screws hold the top burr, the shims sit under the seat. Twenty minutes at the kitchen table and there is no torque figure to get wrong.\n\nIf you leave it as it is, nothing dramatic happens for a few weeks — it just takes the edge off the burrs eventually, which is why we would rather you did not.\n\n{{agent}}",
    },
    {
        slug: 'warranty',
        name: 'Ours, no charge',
        used: '28 times',
        body: "Hi {{first_name}},\n\nThis one is ours. {{machine}} came out of a run where the burr seats were cut shallow, and the noise you are hearing is the top burr touching under load.\n\nThere is nothing to pay and nothing to prove. Tell me whether you would rather fix it in your kitchen or post it to us, and I will send whichever one you pick.\n\n{{agent}}",
    },
    {
        slug: 'return-label',
        name: 'Return label',
        used: '19 times',
        body: "Hi {{first_name}},\n\nLabel attached — print it, tape it over the old one, and any drop-off point will take it. Postage is on us.\n\nOnce it reaches the workshop it is about {{eta}} on the bench, and we send it back on the same account. Serial on file is {{serial}}, so it will find its way to the right job card.\n\n{{agent}}",
    },
    {
        slug: 'serial',
        name: 'Ask for the serial',
        used: '63 times',
        body: "Hi {{first_name}},\n\nBefore I guess: there is a plate on the underside with a code that starts NS-B. Could you read it to me?\n\nIt tells me which run your machine came from, and that usually tells me what the noise is without you having to describe it any further.\n\n{{agent}}",
    },
    {
        slug: 'lead-time',
        name: 'Dealer lead time',
        used: '11 times',
        body: "Hi {{first_name}},\n\nWe build to order in batches of about sixty, and the current run is spoken for. Twelve units would go on the next one, which means {{eta}} from the day the order lands.\n\nDealer terms start at six units: 35% off list, 30 days, freight at cost. Happy to put that in writing if the number holds.\n\n{{agent}}",
    },
];

const values = {
    '{{first_name}}': 'Tomás',
    '{{machine}}': 'Your jade grinder',
    '{{serial}}': 'NS-B40-0117',
    '{{eta}}': '3 working days',
    '{{agent}}': 'Lena',
};

const variables = Object.keys(values);

const checks = [
    ['He asked a question you have not answered', 'how long the noise takes to do damage'],
    ['The kit is on the shelf', '9 left after this one goes'],
    ['His last two mails came in the evening', 'he is not reading this at 04:12'],
];

const hints = {
    reply: null,
    note: 'nothing here leaves the building',
    forward: null,
};

const mode = ref('reply');
const picked = ref(null);
const hold = ref(false);
const body = ref('');
const editor = ref(null);

const fill = (text) => Object.entries(values).reduce((filled, [token, value]) => filled.split(token).join(value), text);

const words = computed(() => body.value.trim() === '' ? 0 : body.value.trim().split(/\s+/).length);
const seconds = computed(() => Math.max(1, Math.round((words.value / 200) * 60)));

const label = computed(() => {
    if (mode.value === 'note') {
        return 'Leave the note';
    }

    return hold.value ? 'Schedule it for 08:00' : 'Send and close';
});

const pick = (macro) => {
    picked.value = macro.slug;
    body.value = fill(macro.body);
};

const drop = (token) => {
    const field = editor.value;
    const at = field?.selectionStart ?? body.value.length;
    const value = values[token];

    body.value = body.value.slice(0, at) + value + body.value.slice(field?.selectionEnd ?? at);

    field?.focus();
};
</script>

<template>
    <InboxShell active="Compose" :rail="false" :padded="false">
        <div class="flex min-h-0 flex-1 overflow-hidden">
            <div class="min-w-0 flex-1 overflow-y-auto px-5 py-5">
                <div class="flex flex-wrap items-center gap-x-3 gap-y-2">
                    <h3 class="text-[15px] font-medium text-cream">Answering NS-4471</h3>
                    <InboxClock :minutes="-40" bar />
                    <a href="/templates/inbox/screens/conversation" target="_top" class="ml-auto font-mono text-[10px] text-jade-400 transition-colors duration-150 hover:text-jade-300">back to the thread →</a>
                </div>

                <div
                    class="mt-4 overflow-hidden rounded-xl border bg-ink-900 transition-colors duration-150"
                    :class="mode === 'note' ? 'border-amber-400/40' : 'border-white/10'"
                >
                    <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                        <label
                            v-for="[value, text] in [['reply', 'Reply'], ['note', 'Internal note'], ['forward', 'Forward']]"
                            :key="value"
                            class="cursor-pointer rounded-md px-2 py-1 font-mono text-[11px] transition-colors duration-150"
                            :class="mode === value ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:text-cream'"
                        >
                            <input v-model="mode" type="radio" name="compose-mode" :value="value" class="sr-only">
                            {{ text }}
                        </label>

                        <span v-if="hints[mode]" class="ml-auto font-mono text-[10px] text-amber-300/80">{{ hints[mode] }}</span>
                    </div>

                    <div class="divide-y divide-white/5 transition-opacity duration-150" :class="mode === 'note' ? 'opacity-40' : ''">
                        <label class="flex items-center gap-3 px-3.5 py-2.5">
                            <span class="w-12 shrink-0 font-mono text-[10px] text-zinc-600">To</span>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-white/10 bg-ink-950 px-2 py-1">
                                <InboxAvatar name="Tomás Ferreira" size="xs" kind="customer" />
                                <span class="font-mono text-[11px] text-zinc-300">tomas.ferreira@…pt</span>
                            </span>
                            <span class="font-mono text-[10px] text-zinc-700">+ Cc</span>
                        </label>

                        <label class="flex items-center gap-3 px-3.5 py-2.5">
                            <span class="w-12 shrink-0 font-mono text-[10px] text-zinc-600">Subject</span>
                            <input
                                type="text"
                                value="Re: Grinder howls above 1800 rpm after three weeks"
                                class="min-w-0 flex-1 bg-transparent text-[13px] text-cream focus:outline-none"
                            >
                            <span class="shrink-0 font-mono text-[10px] text-zinc-700">NS-4471</span>
                        </label>
                    </div>

                    <div class="border-t border-white/5 px-3.5 py-2.5">
                        <p class="font-mono text-[10px] text-zinc-600">Canned replies — picking one fills the box and swaps every variable for what we know about him</p>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <button
                                v-for="macro in macros"
                                :key="macro.slug"
                                type="button"
                                class="rounded-lg border px-2.5 py-1.5 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                :class="picked === macro.slug ? 'border-jade-500/60 bg-jade-500/10' : 'border-white/10 hover:border-jade-500/50'"
                                @click="pick(macro)"
                            >
                                <span class="block text-[12px]" :class="picked === macro.slug ? 'text-jade-300' : 'text-zinc-300'">{{ macro.name }}</span>
                                <span class="mt-0.5 block font-mono text-[10px] text-zinc-700">{{ macro.used }}</span>
                            </button>
                        </div>
                    </div>

                    <textarea
                        ref="editor"
                        v-model="body"
                        rows="8"
                        placeholder="Or just write it. Nobody is grading the prose."
                        class="w-full resize-none border-t border-white/5 bg-transparent px-3.5 py-3.5 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:outline-none"
                    ></textarea>

                    <div class="flex flex-wrap items-center gap-x-3 gap-y-2 border-t border-white/5 px-3.5 py-2.5">
                        <span class="font-mono text-[10px] text-zinc-600">Drop in</span>
                        <button
                            v-for="token in variables"
                            :key="token"
                            type="button"
                            :title="`fills as ${values[token]}`"
                            class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                            @click="drop(token)"
                        >{{ token }}</button>
                        <span class="ml-auto font-mono text-[10px] text-zinc-700">{{ words }} words · {{ seconds }}s to read</span>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 border-t border-white/5 px-3.5 py-2.5">
                        <span
                            v-for="[file, size] in [['seat-shim-instructions.pdf', '620 KB'], ['warranty-terms.pdf', '96 KB']]"
                            :key="file"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 bg-ink-950 px-2 py-1 font-mono text-[10px] text-zinc-400"
                        >
                            <svg class="size-3 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none"><path d="M9 2.5H4.5v11h7V5z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M9 2.5V5h2.5" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg>
                            {{ file }} <span class="text-zinc-700">{{ size }}</span>
                        </span>
                        <button type="button" class="rounded-lg border border-dashed border-white/15 px-2 py-1 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:border-white/30 hover:text-cream">attach</button>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 border-t border-white/5 bg-ink-950/40 px-3.5 py-3">
                        <label
                            class="flex cursor-pointer items-center gap-2 rounded-lg border px-2.5 py-1.5 font-mono text-[11px] transition-colors duration-150"
                            :class="hold ? 'border-jade-500/60 text-jade-300' : 'border-white/10 text-zinc-500 hover:text-cream'"
                        >
                            <input v-model="hold" type="checkbox" class="sr-only">
                            hold until 08:00 in Porto — 3h 48m
                        </label>

                        <span class="font-mono text-[10px] text-zinc-700">signs off as Lena Kohler · bench test</span>

                        <button
                            type="button"
                            class="ml-auto inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3.5 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >{{ label }}</button>
                    </div>
                </div>

                <p class="mt-3 font-mono text-[10px] text-zinc-700">
                    Escape puts it in drafts. Nothing here is sent until you press the green one, including the scheduled version.
                </p>
            </div>

            <aside class="hidden w-80 shrink-0 overflow-y-auto border-l border-white/5 px-4 py-5 lg:block">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What you are answering</p>

                <div class="mt-3 rounded-xl border border-white/8 bg-ink-900 p-3.5">
                    <div class="flex items-center gap-2.5">
                        <InboxAvatar name="Tomás Ferreira" size="sm" kind="customer" />
                        <span class="text-[13px] text-zinc-300">Tomás Ferreira</span>
                        <span class="ml-auto font-mono text-[10px] text-zinc-700">Tue 11:12</span>
                    </div>
                    <p class="mt-2.5 border-l-2 border-white/10 pl-3 text-[12px]/5 text-zinc-500">
                        Send the kit. I would rather spend twenty minutes than ten days without it. How long before the noise comes back if I leave it as it is?
                    </p>
                </div>

                <div class="mt-5 rounded-xl border border-red-400/25 bg-red-500/5 p-3.5">
                    <p class="font-mono text-[10px] tracking-wide text-red-300/90 uppercase">40 minutes past the promise</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-400">Four hours is what the site says under the contact form. This one has had four hours and forty minutes.</p>
                </div>

                <div class="mt-5">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Before you send</p>
                    <ul class="mt-2.5 space-y-2">
                        <li v-for="[point, detail] in checks" :key="point" class="flex gap-2.5">
                            <span class="mt-1.5 size-1 shrink-0 rounded-full bg-zinc-600"></span>
                            <span class="min-w-0">
                                <span class="block text-[12px]/5 text-zinc-300">{{ point }}</span>
                                <span class="mt-0.5 block font-mono text-[10px] text-zinc-600">{{ detail }}</span>
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="mt-5 border-t border-white/5 pt-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Signature</p>
                    <div class="mt-2.5 rounded-lg border border-white/8 bg-ink-900 p-3 font-mono text-[10px]/5 text-zinc-600">
                        Lena Kohler<br>
                        bench test · NOMAD Supply<br>
                        Taichung · we answer between 09:00 and 18:00, GMT+8
                    </div>
                </div>
            </aside>
        </div>
    </InboxShell>
</template>
