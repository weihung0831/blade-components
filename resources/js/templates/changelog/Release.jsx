import { ChangelogDiff } from './Diff';
import { ChangelogEntry } from './Entry';
import { ChangelogShell } from './Shell';

const BEFORE = [
    { state: 'same', text: '{' },
    { state: 'same', text: '  "id": "ord_9F2K",' },
    { state: 'gone', text: '  "shipping_rate": 120,', note: 'gone Feb 2027' },
    { state: 'gone', text: '  "shipping_carrier": "tcat",' },
    { state: 'same', text: '  "total": 1480' },
    { state: 'same', text: '}' }
];

const AFTER = [
    { state: 'same', text: '{' },
    { state: 'same', text: '  "id": "ord_9F2K",' },
    { state: 'new', text: '  "freight": {' },
    { state: 'new', text: '    "rate": 120,' },
    { state: 'new', text: '    "carrier": "tcat",' },
    { state: 'new', text: '    "zone": "north-2",', note: 'new' },
    { state: 'new', text: '    "surcharge": 0,', note: 'new' },
    { state: 'new', text: '    "quoted": false', note: 'new' },
    { state: 'new', text: '  },' },
    { state: 'same', text: '  "total": 1480' },
    { state: 'same', text: '}' }
];

const STEPS = [
    { label: 'Read order.freight.rate where you read order.shipping_rate', note: 'Same number, same currency, same rounding. If that is all you touch, you are done and the rest of this is background.', cost: 'one line, most of the time' },
    { label: 'Decide what to do when quoted is true', note: 'The rate came from the carrier rather than your table, so it can differ from the figure on your own price list by a few dollars. Two shops reconcile against the table and had to stop.', cost: 'ten minutes of thinking, no code for most' },
    { label: 'Turn the old field off in your sandbox before February', note: 'A header on the request — Nomad-Freight: object — makes the API answer as it will after the deadline. Nothing in production changes until you remove the header.', cost: 'an afternoon if you find something' }
];

const ROLLOUT = [
    { region: 'ap-tpe-1', label: 'Taipei', when: '17 Aug, 02:10', share: '4% — 60 shops on the beta list', state: 'done' },
    { region: 'ap-tpe-1', label: 'Taipei, the rest', when: '18 Aug, 09:00', share: '38%', state: 'done' },
    { region: 'ap-sin-1', label: 'Singapore', when: '20 Aug, 02:30', share: '61%', state: 'done' },
    { region: 'eu-fra-1', label: 'Frankfurt', when: '21 Aug, 03:00', share: '84%', state: 'done' },
    { region: 'us-pdx-1', label: 'Portland', when: '23 Aug, 04:00', share: '100%', state: 'now' }
];

const REST = [
    { kind: 'added', title: 'Freight zones you draw rather than list', note: 'Postal codes as ranges, and a map that shades what the range covers so the hole in it is visible before an order falls into it.', who: 'shops that ship outside one city', issue: '#4188' },
    { kind: 'added', title: 'A carrier quote at the till, if the carrier answers in under 900ms', note: 'Three do. The rest fall back to your table, and the order records which of the two it used in freight.quoted.', who: 'shops on Hsinchu Express, T-Cat or SF', issue: '#4201' },
    { kind: 'fixed', title: 'The freight column in the CSV export rounded to whole dollars', note: 'Two years old. It only showed up in the export, and people reconcile off the invoice, so nobody had reported it.', who: 'nobody, until they tried to reconcile off the export', issue: '#3980' },
    { kind: 'removed', title: 'The per-item freight override', note: 'Eleven shops used it, seven of whom told us it did the opposite of what they expected. We moved all eleven onto zone rules by hand in June and wrote to each of them.', who: 'the eleven, who knew about it two months ago', breaking: true, issue: '#4390' }
];

const SOURCES = [
    { who: 'Kerouac Coffee', what: 'asked for zones in March 2025, then again in September', when: '17 months' },
    { who: 'Four shops on the beta list', what: 'found the rounding bug in the export within a day of joining', when: 'May 2026' },
    { who: 'Ourselves', what: 'the per-item override was ours to remove, and it took two years to admit it', when: '2024' },
];

const toolbar = (
    <div className="flex flex-wrap items-center gap-x-3 gap-y-2">
        <a
            href="/templates/changelog/screens/releases"
            target="_top"
            className="inline-flex items-center gap-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream"
        >
            <svg className="size-3" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
            the whole log
        </a>

        <span className="font-mono text-[11px] text-zinc-700">4.2.0</span>

        <div className="ml-auto flex items-center gap-1">
            <a href="/templates/changelog/screens/release" target="_top" className="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">← 4.1.4</a>
            <a href="/templates/changelog/screens/release" target="_top" className="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">4.2.1 →</a>
        </div>
    </div>
);

export function ChangelogRelease() {
    return (
        <ChangelogShell active="One release" toolbar={toolbar}>
            <div className="mx-auto max-w-5xl">
                <div className="flex flex-wrap items-baseline gap-x-4 gap-y-2">
                    <h1 className="font-mono text-2xl tracking-tight text-cream">4.2.0</h1>
                    <span className="font-mono text-[12px] text-zinc-600">17 August 2026</span>
                    <span className="flex items-center gap-1.5 font-mono text-[11px] text-zinc-600">
                        <span className="size-1.5 rounded-full bg-jade-500"></span>
                        live everywhere since the 23rd
                    </span>
                </div>

                <p className="mt-3 max-w-2xl text-[13px]/6 text-zinc-500">
                    Freight stops being a number on the order and becomes an object with the carrier, the zone and the surcharge
                    beside it. That is the change worth reading before your next deploy. Everything else in here is additive, and
                    the old field keeps answering until February 2027.
                </p>

                <div className="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-[1.7fr_1fr]">
                    <div>
                        <section className="overflow-hidden rounded-xl border border-amber-400/25 bg-ink-950">
                            <div className="border-b border-amber-400/15 bg-amber-400/5 px-3.5 py-3">
                                <p className="text-[13px] text-amber-300">The one that breaks something</p>
                                <p className="mt-1 text-[11px]/5 text-zinc-400">
                                    About 340 shops read orders off the API. If yours is one of them, this is a line of work, not
                                    an afternoon.
                                </p>
                            </div>

                            <div className="grid grid-cols-1 divide-y divide-white/5 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                                <div>
                                    <p className="border-b border-white/5 px-3.5 py-2 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Until 4.1.4</p>
                                    <div className="py-2">
                                        {BEFORE.map((line, index) => <ChangelogDiff key={index} {...line} />)}
                                    </div>
                                </div>

                                <div>
                                    <p className="border-b border-white/5 px-3.5 py-2 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">From 4.2.0</p>
                                    <div className="py-2">
                                        {AFTER.map((line, index) => <ChangelogDiff key={index} {...line} />)}
                                    </div>
                                </div>
                            </div>

                            <div className="border-t border-white/5 px-3.5 py-3">
                                <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Three things to do, in this order</p>

                                <ol className="mt-3 flex flex-col gap-3">
                                    {STEPS.map((step, index) => (
                                        <li key={step.label} className="flex gap-3">
                                            <span className="mt-0.5 grid size-5 shrink-0 place-items-center rounded-full border border-white/12 font-mono text-[10px] text-zinc-500">{index + 1}</span>
                                            <span className="min-w-0 flex-1">
                                                <span className="flex flex-wrap items-baseline gap-x-2">
                                                    <span className="text-[13px] text-cream">{step.label}</span>
                                                    <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{step.cost}</span>
                                                </span>
                                                <span className="mt-1 block text-[11px]/5 text-zinc-500">{step.note}</span>
                                            </span>
                                        </li>
                                    ))}
                                </ol>

                                <p className="mt-4 border-t border-white/5 pt-3 text-[11px]/5 text-zinc-600">
                                    <span className="text-amber-300/80">1 February 2027.</span>
                                    {' '}That is 24 weeks from now, and it is the second deadline — the first was November, which we moved
                                    after two shops wrote in to say their own release freeze ran from October to January.
                                </p>
                            </div>
                        </section>

                        <section className="mt-7">
                            <div className="flex items-baseline justify-between gap-3">
                                <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Everything else in it</h2>
                                <span className="font-mono text-[10px] text-zinc-700">four lines</span>
                            </div>

                            <div className="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                                {REST.map((entry) => <ChangelogEntry key={entry.title} {...entry} />)}
                            </div>
                        </section>

                        <section className="mt-7 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            <div className="flex items-baseline justify-between gap-3 border-b border-white/5 px-3.5 py-2.5">
                                <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">How it went out</p>
                                <span className="font-mono text-[10px] text-zinc-700">six days, four regions</span>
                            </div>

                            <ul className="divide-y divide-white/5">
                                {ROLLOUT.map((hop) => (
                                    <li key={hop.when} className="flex items-baseline gap-3 px-3.5 py-2.5">
                                        <span className={`mt-1 size-1.5 shrink-0 rounded-full ${hop.state === 'done' ? 'bg-jade-500' : 'bg-amber-400'}`}></span>
                                        <span className="min-w-0 flex-1 truncate text-[12px] text-zinc-300">{hop.label}</span>
                                        <span className="hidden shrink-0 font-mono text-[10px] text-zinc-700 sm:block">{hop.region}</span>
                                        <span className="shrink-0 font-mono text-[10px] text-zinc-600">{hop.when}</span>
                                        <span className="w-32 shrink-0 text-right font-mono text-[10px] text-zinc-600">{hop.share}</span>
                                    </li>
                                ))}
                            </ul>

                            <p className="border-t border-white/5 px-3.5 py-3 text-[11px]/5 text-zinc-600">
                                Six days is deliberate. The first 4% are shops who asked to be on that list, and the gap between the
                                first two hops is where the hotfix below came from — 60 shops found in eleven hours what our tests had
                                not found in three weeks.
                            </p>
                        </section>
                    </div>

                    <aside>
                        <div className="rounded-xl border border-red-400/25 bg-red-400/4 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-red-400/80 uppercase">Eleven hours later</p>
                            <p className="mt-2 text-[13px] text-cream">4.2.1 — freight came out at zero for 41 shops</p>
                            <p className="mt-1.5 text-[11px]/5 text-zinc-400">
                                Flat rate, no zones: the new object read the zone table, found nothing, and charged nothing. 260 orders
                                shipped free. We paid the freight on all of them rather than going back to the customers, and the
                                fix went out at 21:40 the same evening.
                            </p>
                            <a
                                href="/templates/changelog/screens/releases"
                                target="_top"
                                className="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >The incident note</a>
                        </div>

                        <div className="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            <p className="border-b border-white/5 px-4 py-2.5 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where this came from</p>

                            <ul className="divide-y divide-white/5">
                                {SOURCES.map((source) => (
                                    <li key={source.who} className="px-4 py-3">
                                        <p className="text-[12px] text-cream">{source.who}</p>
                                        <p className="mt-1 text-[11px]/5 text-zinc-500">{source.what}</p>
                                        <p className="mt-1 font-mono text-[10px] text-zinc-700">{source.when}</p>
                                    </li>
                                ))}
                            </ul>
                        </div>

                        <div className="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If you would rather not touch it now</p>
                            <p className="mt-2 text-[12px]/5 text-zinc-400">
                                Nothing you have built stops working today. The old field answers until February, and we will write
                                twice more before then — once in November, once three weeks out. If you tell us your freeze dates,
                                the second mail goes out when your freeze ends rather than when our calendar says.
                            </p>
                            <a
                                href="/templates/changelog/screens/subscribe"
                                target="_top"
                                className="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >Set what you hear about</a>
                        </div>
                    </aside>
                </div>
            </div>
        </ChangelogShell>
    );
}
