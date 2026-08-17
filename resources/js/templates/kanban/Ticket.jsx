import { useState } from 'react';
import { KanbanShell } from './Shell';
import { KanbanTag } from './Tag';
import { KanbanAssignee } from './Assignee';

const STATIONS = ['Queued', 'Machining', 'Assembly', 'Bench test', 'Shipped'];

const CHECKLIST = [
    {
        group: 'Before anything is touched',
        items: [
            { label: 'Pull the 24 serials off the Tuesday build sheet', done: true },
            { label: 'Measure seat height on all 24, log to the sheet', done: true },
            { label: 'Confirm the 0.05 shim stock covers 24 units', done: true },
            { label: 'Park the four that are already at a customer', done: false },
        ],
    },
    {
        group: 'On the bench',
        items: [
            { label: 'Strip carrier, keep the burr set paired to its serial', done: true },
            { label: 'Clean the seat face — no shim goes on swarf', done: true },
            { label: 'Fit shim, torque to 4.2 Nm', done: false },
            { label: 'Re-measure seat height, target 18.40 ±0.02', done: false },
            { label: 'Grind 500 g, check for wander', done: false },
            { label: 'Stamp the serial card, note the shim', done: false },
            { label: 'Hand to Lena for the particle run', done: false },
        ],
    },
];

const MEASUREMENTS = [
    { serial: 'NS-41-004', before: '18.31', after: '18.40', state: 'done' },
    { serial: 'NS-41-007', before: '18.29', after: '18.41', state: 'done' },
    { serial: 'NS-41-011', before: '18.34', after: '18.39', state: 'done' },
    { serial: 'NS-41-012', before: '18.27', after: '—', state: 'open' },
    { serial: 'NS-41-018', before: '18.30', after: '—', state: 'open' },
];

const FACTS = [
    { label: 'Batch', value: 'Batch 41 · 24 units' },
    { label: 'Opened', value: '14 Aug 2026 by Mei Tsai' },
    { label: 'Due', value: 'Thursday van, 20 Aug' },
    { label: 'Est. bench time', value: '6 h · 1.5 h logged' },
];

const PARTS = [
    { code: 'BS-041', name: 'Burr seat, jade run', note: 'the part that moves' },
    { code: 'SH-005', name: 'Shim, 0.05 mm steel', note: 'new, 40 in stock' },
    { code: 'CR-118', name: 'Carrier, 83 mm', note: 'unchanged, strip only' },
];

const ACTIVITY = [
    { who: 'Mei Tsai', when: '2 days ago', body: 'Opened off the fourth warranty call this month. All four machines were built the same Tuesday, all four wander after about a week.' },
    { who: 'Lena Kohler', when: '2 days ago', body: 'Measured six of them cold. Seat sits 0.09 low on average against the drawing. The burrs are fine — I ran them in a known-good carrier and the spread was normal.' },
    { who: 'Piotr Adamek', when: 'yesterday', body: 'The seat op was run on lathe 2 that week. Same lathe that is chattering now. I would hold NS-1068 open until this one closes, they are the same root cause.' },
    { who: 'Mei Tsai', when: '4 hours ago', body: 'Shim stock arrived. Doing the first three on bench 1 this afternoon and measuring each one before it goes back together.' },
];

export function KanbanTicket() {
    const [checklist, setChecklist] = useState(CHECKLIST);
    const [station, setStation] = useState('Queued');
    const [activity, setActivity] = useState(ACTIVITY);
    const [comment, setComment] = useState('');

    const items = checklist.flatMap((group) => group.items);
    const done = items.filter((item) => item.done).length;
    const next = STATIONS[Math.min(STATIONS.length - 1, STATIONS.indexOf(station) + 1)];

    const toggle = (label) =>
        setChecklist((groups) => groups.map((group) => ({
            ...group,
            items: group.items.map((item) => (item.label === label ? { ...item, done: !item.done } : item)),
        })));

    const post = (event) => {
        event.preventDefault();

        if (comment.trim() === '') {
            return;
        }

        setActivity((entries) => [...entries, { who: 'Mei Tsai', when: 'just now', body: comment.trim() }]);
        setComment('');
    };

    return (
        <KanbanShell active="Board">
            <div className="mx-auto w-full max-w-5xl">
                <nav className="flex flex-wrap items-center gap-2 font-mono text-[11px] text-zinc-600">
                    <a href="/templates/kanban/screens/board" target="_top" className="transition-colors duration-150 hover:text-cream">Shop floor</a>
                    <span aria-hidden="true">/</span>
                    <a href="/templates/kanban/screens/board" target="_top" className="transition-colors duration-150 hover:text-cream">{station}</a>
                    <span aria-hidden="true">/</span>
                    <span className="text-zinc-400">NS-1102</span>
                </nav>

                <div className="mt-4 flex flex-wrap items-start justify-between gap-x-6 gap-y-4">
                    <div className="min-w-0">
                        <div className="flex flex-wrap items-center gap-2">
                            <KanbanTag label="Rework" tone="alert" />
                            <KanbanTag label="Batch 41" tone="batch" />
                            <span className="font-mono text-[10px] text-zinc-600">opened 2 days ago · 4 people watching</span>
                        </div>
                        <h1 className="mt-2.5 text-2xl/8 font-semibold tracking-tight text-cream">Shim 24 burr seats from the Tuesday batch</h1>
                    </div>

                    <div className="flex shrink-0 items-center gap-2">
                        <button type="button" className="rounded-lg border border-white/10 px-3 py-1.5 text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Watch</button>
                        <button
                            type="button"
                            onClick={() => setStation(next)}
                            className="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            Move to {next}
                            <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        </button>
                    </div>
                </div>

                <div className="mt-6 grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_19rem]">
                    <div className="flex flex-col gap-5">
                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Why this is open</p>
                            <div className="mt-3 flex flex-col gap-3 text-[13px]/6 text-zinc-400">
                                <p>Four warranty calls in three weeks, all saying the same thing: the grind wanders about a week in. Every one of the four was built on the same Tuesday.</p>
                                <p>The seat sits 0.09 mm low against the drawing, so the burr set has room to settle. A 0.05 shim brings it inside tolerance without touching the carrier or the burrs. Twenty-four machines came off that build sheet; four of them are already with customers and stay parked until the other twenty are proven.</p>
                            </div>
                        </section>

                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <div className="flex flex-wrap items-center justify-between gap-3">
                                <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Checklist</p>
                                <div className="flex items-center gap-2.5">
                                    <span className="block h-1 w-24 overflow-hidden rounded-full bg-white/10">
                                        <span className="block h-full rounded-full bg-jade-500 transition-[width] duration-300 ease-snap" style={{ width: `${(done / items.length) * 100}%` }}></span>
                                    </span>
                                    <span className="font-mono text-[11px] text-zinc-500">{done}/{items.length}</span>
                                </div>
                            </div>

                            <div className="mt-4 flex flex-col gap-5">
                                {checklist.map((group) => (
                                    <div key={group.group}>
                                        <p className="font-mono text-[10px] text-zinc-600">{group.group}</p>
                                        <ul className="mt-2 flex flex-col">
                                            {group.items.map((item) => (
                                                <li key={item.label}>
                                                    <label className="flex cursor-pointer items-start gap-2.5 rounded-lg px-2 py-1.5 transition-colors duration-150 hover:bg-white/5">
                                                        <input type="checkbox" checked={item.done} onChange={() => toggle(item.label)} className="peer sr-only" />
                                                        <span className="mt-px grid size-4 shrink-0 place-items-center rounded border border-white/15 text-transparent transition-colors duration-150 peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-checked:text-ink-950 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70">
                                                            <svg className="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m2.5 6.5 2.5 2.5 4.5-6" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                                        </span>
                                                        <span className="text-[13px]/5 text-zinc-300 transition-colors duration-150 peer-checked:text-zinc-600 peer-checked:line-through">{item.label}</span>
                                                    </label>
                                                </li>
                                            ))}
                                        </ul>
                                    </div>
                                ))}
                            </div>
                        </section>

                        <section className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                            <div className="flex flex-wrap items-center justify-between gap-3 border-b border-white/5 px-5 py-4">
                                <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Seat height, mm</p>
                                <p className="font-mono text-[10px] text-zinc-600">target 18.40 ±0.02 · 3 of 24 done</p>
                            </div>
                            <table className="w-full text-left">
                                <thead>
                                    <tr className="border-b border-white/5 font-mono text-[10px] text-zinc-600">
                                        <th scope="col" className="px-5 py-2 font-normal">Serial</th>
                                        <th scope="col" className="px-5 py-2 font-normal">Before</th>
                                        <th scope="col" className="px-5 py-2 font-normal">After</th>
                                        <th scope="col" className="px-5 py-2 text-right font-normal">State</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-white/5">
                                    {MEASUREMENTS.map((row) => (
                                        <tr key={row.serial} className="font-mono text-[11px]">
                                            <td className="px-5 py-2.5 text-zinc-400">{row.serial}</td>
                                            <td className="px-5 py-2.5 text-red-300">{row.before}</td>
                                            <td className={`px-5 py-2.5 ${row.state === 'done' ? 'text-jade-300' : 'text-zinc-700'}`}>{row.after}</td>
                                            <td className="px-5 py-2.5 text-right text-zinc-600">{row.state === 'done' ? 'shimmed' : 'waiting'}</td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                            <p className="border-t border-white/5 px-5 py-3 font-mono text-[10px] text-zinc-700">19 more rows once the bench gets to them</p>
                        </section>

                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Activity</p>

                            <ol className="mt-4 flex flex-col gap-4 border-l border-white/8 pl-5">
                                {activity.map((entry, index) => (
                                    <li key={index} className="relative">
                                        <span aria-hidden="true" className={`absolute top-2 -left-[1.4rem] size-1.5 rounded-full ${entry.when === 'just now' ? 'bg-jade-400' : 'bg-white/20'}`}></span>
                                        <div className="flex items-center gap-2">
                                            <KanbanAssignee name={entry.who} size="xs" />
                                            <span className="text-[13px] text-zinc-300">{entry.who}</span>
                                            <span className="font-mono text-[10px] text-zinc-600">{entry.when}</span>
                                        </div>
                                        <p className="mt-1.5 text-[13px]/6 text-zinc-500">{entry.body}</p>
                                    </li>
                                ))}
                            </ol>

                            <form onSubmit={post} className="mt-5 flex flex-col gap-2.5 border-t border-white/5 pt-5">
                                <label htmlFor="ticket-comment" className="sr-only">Add a note</label>
                                <textarea
                                    id="ticket-comment"
                                    value={comment}
                                    onChange={(event) => setComment(event.target.value)}
                                    rows="2"
                                    placeholder="What did the bench find?"
                                    className="w-full resize-none rounded-xl border border-white/10 bg-ink-950 px-3.5 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                                ></textarea>
                                <div className="flex items-center gap-3">
                                    <p className="font-mono text-[10px] text-zinc-600">Notes go on the serial card too</p>
                                    <button type="submit" className="ml-auto rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Post note</button>
                                </div>
                            </form>
                        </section>
                    </div>

                    <aside className="flex flex-col gap-4 lg:sticky lg:top-4">
                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Station</p>
                            <div className="mt-2.5 flex flex-col gap-1">
                                {STATIONS.map((entry, index) => (
                                    <label
                                        key={entry}
                                        className={`flex cursor-pointer items-center gap-2.5 rounded-lg px-2 py-1.5 text-[13px] transition-colors duration-150 hover:bg-white/5 ${
                                            station === entry ? 'bg-jade-500/10' : ''
                                        }`}
                                    >
                                        <input type="radio" name="ticket-station" value={entry} checked={station === entry} onChange={() => setStation(entry)} className="sr-only" />
                                        <span className={`size-1.5 rounded-full ${station === entry ? 'bg-jade-400' : 'bg-white/20'}`}></span>
                                        <span className={station === entry ? 'text-jade-300' : 'text-zinc-400'}>{entry}</span>
                                        {index === 0 && <span className="ml-auto font-mono text-[10px] text-zinc-600">since Friday</span>}
                                    </label>
                                ))}
                            </div>
                        </section>

                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">On it</p>
                            <div className="mt-3 flex items-center gap-2.5">
                                <KanbanAssignee name="Mei Tsai" size="md" />
                                <div className="min-w-0">
                                    <p className="text-[13px] text-cream">Mei Tsai</p>
                                    <p className="font-mono text-[10px] text-zinc-600">workshop lead · bench 1</p>
                                </div>
                            </div>

                            <dl className="mt-4 flex flex-col gap-2.5 border-t border-white/5 pt-4">
                                {FACTS.map((fact) => (
                                    <div key={fact.label} className="flex items-baseline gap-3">
                                        <dt className="w-24 shrink-0 font-mono text-[10px] text-zinc-600">{fact.label}</dt>
                                        <dd className="font-mono text-[11px] text-zinc-400">{fact.value}</dd>
                                    </div>
                                ))}
                            </dl>
                        </section>

                        <section className="rounded-2xl border border-red-400/25 bg-red-500/5 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-red-300 uppercase">Waiting on</p>
                            <a href="/templates/kanban/screens/board" target="_top" className="mt-2.5 block">
                                <span className="font-mono text-[10px] text-zinc-500">NS-1068</span>
                                <p className="mt-0.5 text-[13px]/5 text-zinc-300 transition-colors duration-150 hover:text-cream">Lathe 2 chatters above 1800 rpm</p>
                            </a>
                            <p className="mt-2 font-mono text-[10px]/4 text-zinc-600">Same lathe cut these seats. Shimming closes the twenty-four; it does not stop the next batch going the same way.</p>
                        </section>

                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Parts touched</p>
                            <ul className="mt-3 flex flex-col divide-y divide-white/5">
                                {PARTS.map((part) => (
                                    <li key={part.code} className="flex items-baseline gap-2.5 py-2.5 first:pt-0 last:pb-0">
                                        <span className="font-mono text-[10px] text-zinc-600">{part.code}</span>
                                        <div className="min-w-0">
                                            <p className="text-[13px]/5 text-zinc-300">{part.name}</p>
                                            <p className="font-mono text-[10px] text-zinc-700">{part.note}</p>
                                        </div>
                                    </li>
                                ))}
                            </ul>
                        </section>
                    </aside>
                </div>
            </div>
        </KanbanShell>
    );
}
