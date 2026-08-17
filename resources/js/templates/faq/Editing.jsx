import { useState } from 'react';
import { FaqShell } from './Shell';
import { FaqQuery } from './Query';

const QUERIES = [
    { term: 'noise', hits: 214, results: 8, read: 91, state: 'answered' },
    { term: 'batch 40', hits: 148, results: 3, read: 96, state: 'answered' },
    { term: 'warranty', hits: 96, results: 5, read: 74, state: 'answered' },
    { term: 'grinder smells like burning', hits: 61, results: 0, read: 0, state: 'missing' },
    { term: 'static', hits: 58, results: 2, read: 88, state: 'answered' },
    { term: 'shipping to japan', hits: 44, results: 1, read: 31, state: 'thin' },
    { term: 'burr gap', hits: 41, results: 4, read: 79, state: 'answered' },
    { term: 'replacement burrs price', hits: 37, results: 0, read: 0, state: 'missing' },
    { term: 'refund', hits: 33, results: 3, read: 62, state: 'answered' },
    { term: 'motor warm to touch', hits: 28, results: 0, read: 0, state: 'missing' },
    { term: 'voided warranty', hits: 26, results: 1, read: 44, state: 'thin' },
    { term: 'dosing cup spare', hits: 22, results: 1, read: 68, state: 'answered' },
    { term: 'turkish grind', hits: 19, results: 1, read: 84, state: 'answered' },
    { term: '220v adapter', hits: 17, results: 0, read: 0, state: 'missing' },
    { term: 'left handed hopper', hits: 11, results: 0, read: 0, state: 'missing' },
];

const STATS = [
    { value: '1,284', label: 'searches', note: 'up 8% on June', tone: 'text-cream' },
    { value: '63%', label: 'opened something', note: 'the number we watch', tone: 'text-jade-300' },
    { value: '9', label: 'found nothing at all', note: '184 searches between them', tone: 'text-red-300' },
    { value: '3', label: 'answers under 80%', note: 'one has been that way since March', tone: 'text-amber-300' },
];

const FAILING = [
    { q: 'I opened it myself before writing in. Have I voided anything?', helpful: 62, votes: 91, quote: 'It says no, then spends a paragraph on the motor housing. I still do not know if I am covered.', owner: 'Lena', age: 'untouched since March' },
    { q: 'Nine days and the tracking has not moved. Where is it?', helpful: 71, votes: 189, quote: 'Fine, but what do I actually do on day ten? Who do I write to?', owner: 'Hana', age: 'rewritten 11 days ago' },
    { q: 'The dial crept two numbers coarser on its own. Loose?', helpful: 78, votes: 54, quote: 'Where do I find the serial to know if mine is the old spring?', owner: 'unclaimed', age: 'untouched since June' },
];

const FROM_DESK = [
    { q: 'Does the motor get warm on long grinds, and how warm is too warm?', asked: 14, lane: 'Noise and grind', note: 'Idris answered this four times last month by hand' },
    { q: 'Can I buy burrs on their own, and what do they cost?', asked: 9, lane: 'Warranty', note: 'Every answer so far has quoted a different price' },
    { q: 'Do you ship to Japan, and what does the duty come to?', asked: 7, lane: 'Orders and delivery', note: 'The shipping page says sixteen countries and does not list them' },
];

const FILTERS = [
    { key: 'all', label: 'all 15' },
    { key: 'missing', label: 'found nothing' },
    { key: 'thin', label: 'looked and left' },
];

export function FaqEditing() {
    const [filter, setFilter] = useState('all');

    const listed = QUERIES.filter((entry) => filter === 'all' || entry.state === filter);

    return (
        <FaqShell active="Editing" rail={false}>
            <div className="mx-auto max-w-5xl">
                <div className="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <h1 className="text-lg font-semibold tracking-tight text-cream">What the search box heard in July</h1>
                        <p className="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                            A help centre is only as honest as the list of things it could not answer. This is that list,
                            and it is what decides what gets written next month.
                        </p>
                    </div>
                    <span className="font-mono text-[10px] text-zinc-700">updated nightly · 03:00</span>
                </div>

                <div className="mt-6 grid grid-cols-2 gap-3 lg:grid-cols-4">
                    {STATS.map((stat) => (
                        <div key={stat.label} className="rounded-xl border border-white/8 bg-ink-900 px-4 py-3.5">
                            <p className={`font-mono text-2xl ${stat.tone}`}>{stat.value}</p>
                            <p className="mt-1 text-[12px] text-zinc-400">{stat.label}</p>
                            <p className="mt-1.5 font-mono text-[10px] text-zinc-700">{stat.note}</p>
                        </div>
                    ))}
                </div>

                <div className="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-5">
                    <section className="xl:col-span-3">
                        <div className="flex flex-wrap items-center gap-3">
                            <h2 className="text-base font-medium text-cream">Every term, by volume</h2>

                            <div className="ml-auto flex items-center gap-1">
                                {FILTERS.map((entry) => (
                                    <button
                                        key={entry.key}
                                        type="button"
                                        onClick={() => setFilter(entry.key)}
                                        className={`rounded-lg px-2.5 py-1 font-mono text-[10px] transition-colors duration-150 ${
                                            filter === entry.key ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'
                                        }`}
                                    >
                                        {entry.label}
                                    </button>
                                ))}
                            </div>
                        </div>

                        <div className="mt-3 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            <div className="flex items-center gap-3 border-b border-white/5 bg-white/2 py-2 pr-3 pl-4">
                                <span className="size-1.5 shrink-0"></span>
                                <span className="w-52 shrink-0 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">term</span>
                                <span className="ml-auto flex shrink-0 items-baseline gap-4 font-mono text-[10px] tracking-wider whitespace-nowrap text-zinc-700 uppercase">
                                    <span className="hidden w-10 text-right md:block">opened</span>
                                    <span className="w-16 text-right">results</span>
                                    <span className="w-10 text-right">count</span>
                                </span>
                            </div>

                            {listed.map((entry) => (
                                <FaqQuery
                                    key={entry.term}
                                    term={entry.term}
                                    hits={entry.hits}
                                    peak={214}
                                    results={entry.results}
                                    read={entry.read}
                                    state={entry.state}
                                />
                            ))}

                            <div className="flex items-center gap-3 px-4 py-2.5">
                                <p className="font-mono text-[10px] text-zinc-700">
                                    {listed.length} terms · the tail below ten searches is 340 more
                                </p>
                                <a href="/templates/faq/screens/ask" target="_top" className="ml-auto font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream">write one of these →</a>
                            </div>
                        </div>

                        <div className="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Raised from the desk</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-500">Answered by hand more than three times last month. Whoever writes them can copy their own reply out of the thread.</p>

                            <div className="mt-3.5 space-y-3">
                                {FROM_DESK.map((entry) => (
                                    <div key={entry.q} className="flex items-start gap-3 border-t border-white/5 pt-3">
                                        <span className="mt-0.5 shrink-0 rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500">{entry.asked}×</span>
                                        <div className="min-w-0 flex-1">
                                            <p className="text-[13px]/5 text-zinc-300">{entry.q}</p>
                                            <p className="mt-1 flex flex-wrap items-center gap-2.5">
                                                <span className="font-mono text-[10px] text-zinc-700">{entry.lane}</span>
                                                <span className="text-[11px] text-zinc-600">{entry.note}</span>
                                            </p>
                                        </div>
                                        <button type="button" className="shrink-0 rounded-lg border border-white/10 px-2.5 py-1 text-[11px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Claim it</button>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </section>

                    <section className="xl:col-span-2">
                        <h2 className="text-base font-medium text-cream">Written, but not working</h2>
                        <p className="mt-1.5 text-[13px]/6 text-zinc-500">Every one of these has a real sentence under it from someone who voted no.</p>

                        <div className="mt-3 space-y-3">
                            {FAILING.map((entry) => (
                                <div key={entry.q} className="rounded-xl border border-white/8 bg-ink-900 p-4">
                                    <p className="text-[13px]/5 text-zinc-300">{entry.q}</p>

                                    <div className="mt-2.5 flex items-center gap-2.5">
                                        <span className="block h-1 flex-1 overflow-hidden rounded-full bg-white/8">
                                            <span
                                                className={`block h-full rounded-full ${entry.helpful < 70 ? 'bg-red-400/60' : 'bg-amber-400/60'}`}
                                                style={{ width: `${entry.helpful}%` }}
                                            ></span>
                                        </span>
                                        <span className={`shrink-0 font-mono text-[10px] ${entry.helpful < 70 ? 'text-red-300' : 'text-amber-300'}`}>{entry.helpful}% of {entry.votes}</span>
                                    </div>

                                    <p className="mt-3 border-l border-white/10 pl-3 text-[12px]/5 text-zinc-500 italic">{entry.quote}</p>

                                    <div className="mt-3 flex items-center gap-2.5">
                                        <span className="font-mono text-[10px] text-zinc-700">{entry.age}</span>
                                        <span
                                            className={`ml-auto rounded-full px-2 py-0.5 font-mono text-[10px] ${
                                                entry.owner === 'unclaimed' ? 'bg-amber-400/10 text-amber-300' : 'bg-white/6 text-zinc-500'
                                            }`}
                                        >
                                            {entry.owner === 'unclaimed' ? 'nobody has it' : `with ${entry.owner}`}
                                        </span>
                                    </div>
                                </div>
                            ))}
                        </div>

                        <div className="mt-4 rounded-xl border border-dashed border-white/12 p-4">
                            <p className="text-[12px]/5 text-zinc-500">
                                The rule here is simple: anything under 80% gets rewritten or deleted within the month.
                                An answer nobody trusts is worse than an empty page, because the empty page sends them to a person.
                            </p>
                        </div>
                    </section>
                </div>
            </div>
        </FaqShell>
    );
}
