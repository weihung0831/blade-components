<script setup>
import { computed, ref } from 'vue';
import ChangelogEntry from './Entry.vue';
import ChangelogShell from './Shell.vue';
import ChangelogStamp from './Stamp.vue';

const months = [
    { label: 'August 2026', releases: [
            { version: '4.2.1', date: '18 Aug', state: 'live', lived: 'eleven hours after 4.2.0', note: 'A hotfix, and the reason 4.2.0 is not the last word on the freight field.', entries: [
                    { kind: 'broke', title: 'Freight came out at zero for shops with a flat rate and no zones', note: 'The new rate object read the zone table first and found nothing to read. 41 shops, 260 orders, all of them shipped free of charge for eleven hours.', who: 'we paid the freight on those 260 ourselves', issue: 'INC-118' },
                    { kind: 'fixed', title: 'A flat rate with no zones falls back to the flat rate', note: 'Which is what the sentence says, and what the code did not.', issue: '#4471' }
                ] },
            { version: '4.2.0', date: '17 Aug', state: 'live', note: 'Six days to reach every region. The one below is the change worth reading before your next deploy.', entries: [
                    { kind: 'changed', title: 'Freight is an object on the order, not a number', note: 'order.shipping_rate becomes order.freight.rate, with the carrier, the zone and the surcharge beside it. The old field keeps answering until 1 February 2027 and then stops.', who: 'anyone reading orders off the API — about 340 shops', breaking: true, issue: '#4392' },
                    { kind: 'added', title: 'Freight zones you draw rather than list', note: 'Postal codes as ranges, and a map that shades what the range covers so you can see the hole in it.', who: 'shops that ship outside one city', issue: '#4188' },
                    { kind: 'added', title: 'A carrier quote at the till, if your carrier answers in under 900ms', note: 'Three do. The rest fall back to your own table, and the order says which of the two it used.', who: 'shops on Hsinchu Express, T-Cat or SF', issue: '#4201' },
                    { kind: 'fixed', title: 'The freight column in the CSV export rounded to whole dollars', note: 'Two years old. Nobody reported it because it only showed up in the export, and people reconcile off the invoice.', who: 'nobody, until they tried to reconcile off the export', issue: '#3980' },
                    { kind: 'removed', title: 'The per-item freight override', note: 'Used by 11 shops, seven of whom told us it did the opposite of what they expected. The zone rules cover every case they were using it for, and we moved all eleven by hand.', who: 'the eleven, and we wrote to each of them in June', breaking: true, issue: '#4390' }
                ] },
            { version: '4.1.4', date: '11 Aug', state: 'superseded', entries: [
                    { kind: 'fixed', title: 'Order search stopped matching on the second word of a product name', note: 'A tokeniser change from 4.1.2 that nobody caught because the test fixture is one word long.', who: 'anyone who searched for "guji natural" and got nothing', issue: '#4344' },
                    { kind: 'fixed', title: 'Invoices from before March printed the old tax number', who: 'shops that changed their tax number this year — 14 of them', issue: '#4351' },
                    { kind: 'changed', title: 'The order list loads 60 rows instead of 25', note: 'It is the same query. The 25 was a number somebody typed in 2023.', issue: '#4302' }
                ] },
            { version: '4.1.3', date: '4 Aug', state: 'pulled', lived: 'up for four hours', note: 'Pulled at 14:20 the same afternoon. The stock counter double-counted returns, so anything sent back read as two back on the shelf. 96 shops saw a wrong number, none of them oversold, and the count was rebuilt from the ledger overnight.', entries: [
                    { kind: 'broke', title: 'Returned stock counted twice', note: 'The return wrote to the counter and the nightly rebuild added it again. Caught by a shop with 3 grinders in stock reading 5.', who: '96 shops, for four hours', issue: 'INC-114' },
                    { kind: 'added', title: 'Stock movements have a reason against them', note: 'Went back out with 4.1.4 and has been fine since.', issue: '#4290' }
                ] }
        ] },
    { label: 'July 2026', releases: [
            { version: '4.1.2', date: '28 Jul', state: 'superseded', entries: [
                    { kind: 'changed', title: 'Product search matches on parts of a word', note: 'Searching "guji" finds "Guji Natural". Searching "uji" also finds it, which is the trade.', issue: '#4211' },
                    { kind: 'fixed', title: 'The refund email went out in English to shops set to Chinese', who: '61 shops, one of whom had been forwarding them with an apology for a year', issue: '#4233' }
                ] },
            { version: '4.1.1', date: '21 Jul', state: 'superseded', entries: [
                    { kind: 'fixed', title: 'Webhook retries stopped after the first failure instead of the fifth', note: 'Introduced in 4.1.0, six days earlier. Every endpoint that was down for a minute lost whatever came in during it.', who: 'anyone running a webhook — the affected deliveries were re-sent on the 22nd', issue: 'INC-109' },
                    { kind: 'fixed', title: 'Two decimal places on the payout summary', issue: '#4180' }
                ] },
            { version: '4.1.0', date: '14 Jul', state: 'superseded', note: 'Announced in the March roadmap as "early May".', entries: [
                    { kind: 'added', title: 'Webhooks for every order event, with a delivery log you can read', note: 'Nine events. The log keeps 30 days and shows the response body, which is the part that makes it worth having.', who: 'shops with anything downstream of an order', issue: '#3871' },
                    { kind: 'changed', title: 'API keys are shown once and then hashed', note: 'Existing keys keep working. You can no longer read them back out of the settings screen, which is the entire point.', who: 'anyone who was using the settings screen as a password manager', breaking: true, issue: '#4001' },
                    { kind: 'removed', title: 'The v1 API, three years after v2 shipped', note: 'Down to four shops in June, all four moved with our help before this went out.', who: 'four shops, all of whom knew about it since 2024', breaking: true, issue: '#2117' }
                ] }
        ] },
    { label: 'June 2026', releases: [
            { version: '4.0.7', date: '30 Jun', state: 'superseded', entries: [
                    { kind: 'fixed', title: 'Emails to Gmail addresses landed in the promotions tab', note: 'One header, and six weeks of asking a mail company what it wanted.', who: 'roughly half of every order confirmation we send', issue: '#4055' },
                    { kind: 'changed', title: 'The dashboard loads in 1.1s rather than 3.4s', note: 'Four queries the page did not need, run on every load since 2024.', issue: '#4090' }
                ] },
            { version: '4.0.6', date: '16 Jun', state: 'superseded', entries: [
                    { kind: 'added', title: 'Draft orders you can send as a payment link', who: 'shops that take orders over the phone — 210 of them use this weekly now', issue: '#3702' },
                    { kind: 'fixed', title: 'The 12-month sales chart missed the current month', issue: '#4020' }
                ] }
        ] }
];

const filters = [
    { key: 'all-lines', label: 'Everything' },
    { key: 'breaking', label: 'Things that break something' },
    { key: 'broke', label: 'Things we broke' },
    { key: 'added', label: 'New' },
    { key: 'fixed', label: 'Fixes' },
];

const keeps = {
    'all-lines': () => true,
    breaking: (entry) => entry.breaking === true,
    broke: (entry) => entry.kind === 'broke',
    added: (entry) => entry.kind === 'added',
    fixed: (entry) => entry.kind === 'fixed',
};

const picked = ref('all-lines');

const shown = computed(() => months
    .map((month) => ({
        ...month,
        releases: month.releases
            .map((release) => ({ ...release, entries: release.entries.filter(keeps[picked.value]) }))
            .filter((release) => release.entries.length > 0),
    }))
    .filter((month) => month.releases.length > 0));

const lines = computed(() => shown.value.flatMap((month) => month.releases).reduce((sum, release) => sum + release.entries.length, 0));
const releases = computed(() => shown.value.reduce((sum, month) => sum + month.releases.length, 0));

const dot = (state) => (state === 'pulled' ? 'bg-red-400' : state === 'live' ? 'bg-jade-500' : 'bg-white/20');
</script>

<template>
    <ChangelogShell active="The log">
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-2 gap-y-2">
                <button
                    v-for="filter in filters"
                    :key="filter.key"
                    type="button"
                    :data-active="picked === filter.key ? '' : undefined"
                    class="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-jade-500/15 data-active:text-jade-300"
                    @click="picked = filter.key"
                >{{ filter.label }}</button>

                <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ lines }} {{ lines === 1 ? 'line' : 'lines' }} across {{ releases }} {{ releases === 1 ? 'release' : 'releases' }}</span>
            </div>
        </template>

        <div class="mx-auto max-w-4xl">
            <h1 class="text-lg font-semibold tracking-tight text-cream">Every line says who would notice it</h1>
            <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                Most changelogs are written for the people who wrote the code. This one names the shops each line affects, marks
                the two releases where the thing we shipped was worse than what it replaced, and leaves the one we pulled sitting
                in the list with the reason under it.
            </p>

            <div class="mt-7 flex flex-col gap-9">
                <section v-for="month in shown" :key="month.label">
                    <div class="flex items-baseline gap-3">
                        <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">{{ month.label }}</h2>
                        <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                        <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ month.releases.length }} releases</span>
                    </div>

                    <div class="mt-3 flex flex-col gap-5">
                        <article v-for="release in month.releases" :key="release.version" class="flex gap-3 sm:gap-4">
                            <div class="hidden w-16 shrink-0 flex-col items-end pt-1 sm:flex">
                                <span class="font-mono text-[11px] text-zinc-600">{{ release.date }}</span>
                                <span class="mt-2 w-px flex-1 bg-white/8"></span>
                            </div>

                            <div class="relative hidden shrink-0 flex-col items-center pt-2 sm:flex">
                                <span class="size-2.5 shrink-0 rounded-full ring-4 ring-ink-950" :class="dot(release.state)"></span>
                                <span class="mt-1 w-px flex-1 bg-white/8"></span>
                            </div>

                            <div
                                class="min-w-0 flex-1 overflow-hidden rounded-xl border bg-ink-950"
                                :class="release.state === 'pulled' ? 'border-red-400/25' : 'border-white/8'"
                            >
                                <div
                                    class="border-b px-3.5 py-3"
                                    :class="release.state === 'pulled' ? 'border-red-400/15 bg-red-400/4' : 'border-white/5'"
                                >
                                    <ChangelogStamp
                                        :version="release.version"
                                        :date="`${release.date} 2026`"
                                        :state="release.state"
                                        :lines="release.entries.length"
                                        :lived="release.lived ?? null"
                                        :note="release.note ?? null"
                                    />
                                </div>

                                <div class="divide-y divide-white/5">
                                    <ChangelogEntry v-for="entry in release.entries" :key="entry.title" v-bind="entry" />
                                </div>

                                <div class="flex items-center gap-3 border-t border-white/5 px-3.5 py-2">
                                    <a
                                        href="/templates/changelog/screens/release"
                                        target="_top"
                                        class="font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-jade-300"
                                    >read it in full</a>
                                    <span class="ml-auto font-mono text-[10px] text-zinc-700">{{ release.state === 'pulled' ? 'never reached every region' : 'rolled out over 4–6 days' }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
            </div>

            <p v-if="lines === 0" class="mt-6 rounded-xl border border-white/8 bg-ink-900 px-3.5 py-8 text-center text-[12px] text-zinc-600">
                Nothing of that sort in these three months.
            </p>

            <div class="mt-9 rounded-xl border border-white/8 bg-ink-900 p-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What is not here</p>
                <p class="mt-2 max-w-2xl text-[12px]/5 text-zinc-400">
                    Security fixes go up 30 days after they are deployed, with the same detail. Nothing is ever quietly removed
                    from this page — the four-hour release in August stays where it is, and the entry saying we broke stock
                    counts stays under it. Anything before April 2026 is in the archive, same format, back to the first release
                    in March 2023.
                </p>
            </div>
        </div>
    </ChangelogShell>
</template>
