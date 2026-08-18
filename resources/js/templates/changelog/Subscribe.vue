<script setup>
import { computed, ref } from 'vue';
import ChangelogChannel from './Channel.vue';
import ChangelogShell from './Shell.vue';

const channels = ref([
    { name: 'Mail', handle: 'ana@kerouac.coffee', icon: 'mail', on: true, note: 'One mail per release, written by whoever shipped it. No images, no tracking pixel, and the unsubscribe link is at the top rather than the bottom.', volume: '9 last year', lag: 'the morning after the last region' },
    { name: 'RSS', handle: 'nomadsupply.cc/changelog.xml', icon: 'rss', on: false, note: 'The whole entry in the feed, not a teaser and a link. Also available as JSON Feed at the same path with .json.', volume: 'every line, 214 last year', lag: 'within a minute of publishing' },
    { name: 'Webhook', handle: 'POST https://ops.kerouac.coffee/hooks/nomad', icon: 'hook', on: true, note: 'A signed POST with the release, the affected endpoints, and the deadline if there is one. Retried five times over an hour.', volume: 'only breaking, 9 last year', lag: 'the moment the first region gets it' },
    { name: 'Slack', handle: '#platform-changes', icon: 'chat', on: false, note: 'The headline and the who-would-notice line, threaded so your replies stay out of our inbox. Fourteen shops route this to an on-call channel.', volume: 'whatever this page is set to', lag: 'same as mail' }
]);

const filters = [
    { key: 'all-mail', label: 'Everything', count: 214, mails: '214 notifications last year, about four a week', note: 'Every line of every release, fixes included. Two shops want this and both of them run their own integration against ours.' },
    { key: 'breaking-mail', label: 'Only what breaks something', count: 9, mails: '9 notifications last year, three of them the same deadline said again', note: 'The default, and what nearly everybody keeps. If a mail arrives, something you built needs a look — that is the whole promise of this setting.' },
    { key: 'mine-mail', label: 'Anything touching what you use', count: 31, mails: '31 notifications last year', note: 'Worked out from the endpoints your keys actually called in the last 90 days. You called six of the 41, so most of the log is noise for you.' }
];

const samples = [
    { tags: ['all-mail', 'breaking-mail', 'mine-mail'], version: '4.2.0', title: 'Freight is an object on the order from February', when: '17 Aug', kind: 'breaking' },
    { tags: ['all-mail', 'breaking-mail'], version: '4.1.0', title: 'The v1 API is switched off in July', when: '14 Jul', kind: 'breaking' },
    { tags: ['all-mail', 'mine-mail'], version: '4.1.4', title: 'Order search matches on the second word again', when: '11 Aug', kind: 'fix' },
    { tags: ['all-mail', 'mine-mail'], version: '4.0.7', title: 'Order confirmations stopped landing in the promotions tab', when: '30 Jun', kind: 'fix' },
    { tags: ['all-mail'], version: '4.1.4', title: 'The order list loads 60 rows instead of 25', when: '11 Aug', kind: 'small' },
    { tags: ['all-mail'], version: '4.0.6', title: 'Two decimal places on the payout summary', when: '16 Jun', kind: 'small' }
];

const shapes = {
    'all-mail': { count: 214, line: '214 notifications last year, about four a week' },
    'breaking-mail': { count: 9, line: '9 notifications last year, three of them the same deadline said again' },
    'mine-mail': { count: 31, line: '31 notifications last year, worked out from the six endpoints your keys called' },
};

const spell = ['none', 'one', 'two', 'three', 'four'];

const picked = ref('breaking-mail');

const shape = computed(() => shapes[picked.value] ?? shapes['breaking-mail']);
const shown = computed(() => samples.filter((sample) => sample.tags.includes(picked.value)));
const on = computed(() => channels.value.filter((channel) => channel.on).length);
const width = computed(() => Math.max(3, Math.round((shape.value.count / 214) * 100)));

const more = computed(() => (picked.value === 'all-mail'
    ? `and ${shape.value.count - shown.value.length} more — the log keeps nothing back`
    : `and ${shape.value.count - shown.value.length} more last year · ${214 - shape.value.count} lines never left this page`));

const toggle = (channel) => {
    channel.on = !channel.on;
};

const dot = (kind) => (kind === 'breaking' ? 'bg-amber-400' : kind === 'fix' ? 'bg-jade-500/70' : 'bg-white/20');
</script>

<template>
    <ChangelogShell active="Getting told">
        <div class="mx-auto max-w-5xl">
            <h1 class="text-lg font-semibold tracking-tight text-cream">Nine mails a year, or 214. Your call, and the page does the arithmetic</h1>
            <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                Most changelog subscriptions have one setting: on. This one has three, and each says what last year would have
                looked like under it. The default is the middle one, because a notification you ignore is worse than no
                notification at all — it teaches you to ignore the next one.
            </p>

            <div class="mt-7 grid grid-cols-1 gap-8 lg:grid-cols-[1.5fr_1fr]">
                <div>
                    <section>
                        <div class="flex items-baseline justify-between gap-3">
                            <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What you hear about</h2>
                            <span class="font-mono text-[10px] text-zinc-700">applies to every channel</span>
                        </div>

                        <div class="mt-2.5 flex flex-col gap-2">
                            <button
                                v-for="filter in filters"
                                :key="filter.key"
                                type="button"
                                :data-active="picked === filter.key ? '' : undefined"
                                class="group/filter flex w-full items-start gap-3 rounded-xl border border-white/8 bg-ink-950 p-3.5 text-left transition-colors duration-150 outline-none hover:border-white/15 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:border-jade-500/40 data-active:bg-jade-500/5"
                                @click="picked = filter.key"
                            >
                                <span class="mt-0.5 grid size-4 shrink-0 place-items-center rounded-full border border-white/20 transition-colors duration-150 group-data-active/filter:border-jade-500">
                                    <span class="size-2 rounded-full bg-transparent transition-colors duration-150 group-data-active/filter:bg-jade-500"></span>
                                </span>

                                <span class="min-w-0 flex-1">
                                    <span class="flex flex-wrap items-baseline gap-x-2">
                                        <span class="text-[13px] text-cream">{{ filter.label }}</span>
                                        <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ filter.count }} last year</span>
                                    </span>
                                    <span class="mt-1.5 block text-[11px]/5 text-zinc-500">{{ filter.note }}</span>
                                </span>
                            </button>
                        </div>
                    </section>

                    <section class="mt-7">
                        <div class="flex items-baseline justify-between gap-3">
                            <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where it arrives</h2>
                            <span class="font-mono text-[10px] text-zinc-700">{{ spell[on] }} of four on</span>
                        </div>

                        <div class="mt-2.5 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            <ChangelogChannel
                                v-for="channel in channels"
                                :key="channel.handle"
                                v-bind="channel"
                                @toggle="toggle(channel)"
                            />
                        </div>

                        <p class="mt-3 text-[11px]/5 text-zinc-600">
                            The webhook is the one worth having if you run anything against the API. It fires before the mail does,
                            and it carries the endpoints by name, so a deploy script can refuse to run when a deadline is inside
                            its window.
                        </p>
                    </section>
                </div>

                <aside>
                    <div class="rounded-xl border border-jade-500/25 bg-jade-500/5 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Under this setting, last year</p>

                        <p class="mt-2 flex items-baseline gap-2">
                            <span class="font-mono text-3xl tracking-tight text-cream">{{ shape.count }}</span>
                            <span class="font-mono text-[11px] text-zinc-600">of 214</span>
                        </p>

                        <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-white/8">
                            <div class="h-full rounded-full bg-jade-500 transition-[width] duration-300" :style="{ width: `${width}%` }"></div>
                        </div>

                        <p class="mt-2 text-[12px]/5 text-zinc-400">{{ shape.line }}</p>

                        <button
                            type="button"
                            class="mt-4 w-full rounded-lg bg-jade-500 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >Save it</button>

                        <p class="mt-2 text-center font-mono text-[10px] text-zinc-600">changed whenever, no confirmation mail</p>
                    </div>

                    <div class="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        <p class="border-b border-white/5 px-4 py-2.5 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What would have reached you</p>

                        <ul class="divide-y divide-white/5">
                            <li v-for="sample in shown" :key="sample.title" class="flex items-start gap-3 px-4 py-2.5">
                                <span class="mt-1.5 size-1.5 shrink-0 rounded-full" :class="dot(sample.kind)"></span>

                                <span class="min-w-0 flex-1">
                                    <span class="block text-[12px]/5 text-zinc-300">{{ sample.title }}</span>
                                    <span class="mt-0.5 flex items-baseline gap-2 font-mono text-[10px] text-zinc-700">
                                        <span>{{ sample.version }}</span>
                                        <span>{{ sample.when }}</span>
                                    </span>
                                </span>
                            </li>
                        </ul>

                        <p class="border-t border-white/5 px-4 py-2.5 font-mono text-[10px] text-zinc-700">{{ more }}</p>
                    </div>

                    <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What this list is not for</p>
                        <p class="mt-2 text-[12px]/5 text-zinc-400">
                            Nothing else is ever sent to it. No features we would like you to try, no end-of-year letter, no
                            survey. It is a separate list from billing and from support, and the only reason we would use it
                            outside a release is a security matter, which has happened twice since 2023.
                        </p>
                    </div>
                </aside>
            </div>
        </div>
    </ChangelogShell>
</template>
