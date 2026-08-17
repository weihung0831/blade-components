import { useState } from 'react';
import { KanbanShell } from './Shell';
import { KanbanAssignee } from './Assignee';

const WEEKS = [
    {
        slug: '33',
        label: 'Week 33',
        range: '17–21 Aug · batch 41 ships Thursday',
        days: ['Mon 17', 'Tue 18', 'Wed 19', 'Thu 20', 'Fri 21'],
        note: 'Everyone wants the van on Thursday, so everyone booked Thursday. The board says the same thing from the other end: bench test is at its limit and assembly is over it.',
        crew: [
            { name: 'Mei Tsai', role: 'assembly · bench 1', capacity: 8, hours: [7, 8, 6, 10, 5] },
            { name: 'Piotr Adamek', role: 'machining · TM-1, lathe 2', capacity: 8, hours: [8, 9, 8, 11, 4] },
            { name: 'Lena Kohler', role: 'test · grind rig', capacity: 8, hours: [4, 6, 7, 9, 8] },
            { name: 'Idris Bahar', role: 'supply · packing', capacity: 6, hours: [3, 4, 5, 8, 6] },
        ],
        machines: [
            { name: 'TM-1', note: 'carriers, jade run', booked: 22, available: 40 },
            { name: 'Lathe 2', note: 'chatters above 1800 rpm', booked: 31, available: 40, flag: true },
            { name: 'Mill', note: 'motor mounts', booked: 18, available: 40 },
            { name: 'Grind rig', note: 'bench test, 3 kg a machine', booked: 27, available: 40 },
            { name: 'Benches 1–3', note: 'assembly and rework', booked: 96, available: 120 },
        ],
    },
    {
        slug: '34',
        label: 'Week 34',
        range: '24–28 Aug · lathe 2 down Monday and Tuesday',
        days: ['Mon 24', 'Tue 25', 'Wed 26', 'Thu 27', 'Fri 28'],
        note: 'Looks like room, is not. Batch 42 has not been scheduled yet and the backlog is holding 63 hours, most of which wants a lathe that is in pieces until Wednesday.',
        crew: [
            { name: 'Mei Tsai', role: 'assembly · bench 1', capacity: 8, hours: [6, 5, 7, 6, 4] },
            { name: 'Piotr Adamek', role: 'machining · TM-1, lathe 2', capacity: 8, hours: [7, 8, 6, 5, 3] },
            { name: 'Lena Kohler', role: 'test · grind rig', capacity: 8, hours: [5, 5, 4, 6, 5] },
            { name: 'Idris Bahar', role: 'supply · packing', capacity: 6, hours: [4, 3, 4, 5, 3] },
        ],
        machines: [
            { name: 'TM-1', note: 'spare carriers', booked: 14, available: 40 },
            { name: 'Lathe 2', note: 'tool holder swap, 16 h down', booked: 8, available: 24, flag: true },
            { name: 'Mill', note: 'keyed loom bracket', booked: 21, available: 40 },
            { name: 'Grind rig', note: 'particle runs', booked: 19, available: 40 },
            { name: 'Benches 1–3', note: 'assembly', booked: 72, available: 120 },
        ],
    },
];

const sum = (numbers) => numbers.reduce((total, value) => total + value, 0);

export function KanbanWorkload() {
    const [current, setCurrent] = useState('33');
    const [focused, setFocused] = useState(null);

    const week = WEEKS.find((entry) => entry.slug === current);
    const booked = sum(week.crew.map((person) => sum(person.hours)));
    const roster = sum(week.crew.map((person) => person.capacity * 5));

    const overs = week.days
        .map((label, index) => ({
            label: label.split(' ')[0],
            excess: sum(week.crew.map((person) => Math.max(0, person.hours[index] - person.capacity))),
        }))
        .filter((day) => day.excess > 0)
        .map((day) => `${day.label} over by ${day.excess} h`);

    return (
        <KanbanShell active="Workload">
            <div className="mx-auto w-full max-w-5xl">
                <div className="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <h1 className="text-xl font-semibold tracking-tight text-cream">Who is carrying what</h1>
                        <p className="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                            Hours already promised, against the hours the roster actually has. Anything over the day's capacity is somebody staying late or a job slipping — the board finds out on Thursday either way.
                        </p>
                    </div>

                    <div className="flex items-center gap-1 rounded-lg bg-ink-900 p-0.5">
                        {WEEKS.map((entry) => (
                            <label
                                key={entry.slug}
                                className={`cursor-pointer rounded-md px-3 py-1.5 font-mono text-[11px] transition-colors duration-150 ${
                                    current === entry.slug ? 'bg-white/10 text-cream' : 'text-zinc-500 hover:text-cream'
                                }`}
                            >
                                <input type="radio" name="workload-week" value={entry.slug} checked={current === entry.slug} onChange={() => setCurrent(entry.slug)} className="sr-only" />
                                {entry.label}
                            </label>
                        ))}
                    </div>
                </div>

                <div className="mt-6">
                    <div className="flex flex-wrap items-baseline gap-x-4 gap-y-1 font-mono text-[11px] text-zinc-600">
                        <span className="text-zinc-400">{week.range}</span>
                        <span>{booked} h booked of {roster} h on the roster</span>
                        {overs.length > 0 && <span className="text-red-300">{overs.join(' · ')}</span>}
                    </div>

                    <div className="mt-4 overflow-x-auto rounded-2xl border border-white/8 bg-ink-900 p-3">
                        <div className="min-w-[48rem]">
                            <div className="grid grid-cols-[12.5rem_repeat(5,minmax(0,1fr))_6rem] items-center gap-2 px-1 pb-2 font-mono text-[10px] text-zinc-600">
                                <span>on the roster</span>
                                {week.days.map((label) => <span key={label} className="text-center">{label}</span>)}
                                <span className="text-right">week</span>
                            </div>

                            <div className="flex flex-col gap-2">
                                {week.crew.map((person) => {
                                    const total = sum(person.hours);
                                    const limit = person.capacity * 5;

                                    return (
                                        <div
                                            key={person.name}
                                            className={`grid grid-cols-[12.5rem_repeat(5,minmax(0,1fr))_6rem] items-stretch gap-2 rounded-xl p-1 transition-opacity duration-200 ${
                                                focused && focused !== person.name ? 'opacity-30' : ''
                                            }`}
                                        >
                                            <button
                                                type="button"
                                                onClick={() => setFocused((name) => (name === person.name ? null : person.name))}
                                                className="flex items-center gap-2.5 rounded-lg px-2 py-1.5 text-left transition-colors duration-150 outline-none hover:bg-white/5 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                            >
                                                <KanbanAssignee name={person.name} size="sm" />
                                                <span className="min-w-0">
                                                    <span className="block truncate text-[13px] text-cream">{person.name}</span>
                                                    <span className="block truncate font-mono text-[10px] text-zinc-600">{person.role}</span>
                                                </span>
                                            </button>

                                            {person.hours.map((hours, index) => {
                                                const over = hours > person.capacity;

                                                return (
                                                    <div
                                                        key={index}
                                                        title={`${person.name} · ${week.days[index]} · ${hours} h against ${person.capacity}`}
                                                        className={`rounded-lg border px-2 py-1.5 ${over ? 'border-red-400/40 bg-red-500/10' : 'border-white/8 bg-ink-950'}`}
                                                    >
                                                        <span className={`font-mono text-[11px] ${over ? 'text-red-300' : 'text-zinc-300'}`}>{hours} h</span>
                                                        <span className="mt-1.5 block h-0.5 overflow-hidden rounded-full bg-white/10">
                                                            <span
                                                                className={`block h-full rounded-full ${over ? 'bg-red-400' : 'bg-jade-500/70'}`}
                                                                style={{ width: `${Math.min(100, (hours / person.capacity) * 100)}%` }}
                                                            ></span>
                                                        </span>
                                                        <span className={`mt-1.5 block font-mono text-[10px] ${over ? 'text-red-300/80' : 'text-zinc-700'}`}>
                                                            {over ? `+${hours - person.capacity} over` : `${person.capacity - hours} free`}
                                                        </span>
                                                    </div>
                                                );
                                            })}

                                            <div className="flex flex-col items-end justify-center gap-1.5 px-1">
                                                <span className={`font-mono text-[11px] ${total > limit ? 'text-red-300' : 'text-zinc-400'}`}>{total}/{limit}</span>
                                                <span className="block h-0.5 w-full overflow-hidden rounded-full bg-white/10">
                                                    <span className="block h-full rounded-full bg-jade-500/70" style={{ width: `${Math.min(100, (total / limit) * 100)}%` }}></span>
                                                </span>
                                            </div>
                                        </div>
                                    );
                                })}
                            </div>
                        </div>
                    </div>

                    <div className="mt-5 grid gap-4 lg:grid-cols-[minmax(0,1fr)_18rem]">
                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Machines</p>
                            <ul className="mt-4 flex flex-col gap-3.5">
                                {week.machines.map((machine) => {
                                    const tight = machine.booked / machine.available >= 0.75;

                                    return (
                                        <li key={machine.name}>
                                            <div className="flex items-baseline gap-2.5">
                                                <span className="text-[13px] text-zinc-300">{machine.name}</span>
                                                <span className={`font-mono text-[10px] ${machine.flag ? 'text-red-300' : 'text-zinc-700'}`}>{machine.note}</span>
                                                <span className={`ml-auto font-mono text-[11px] ${tight ? 'text-amber-300' : 'text-zinc-500'}`}>
                                                    {machine.booked}/{machine.available} h
                                                </span>
                                            </div>
                                            <span className="mt-2 block h-1 overflow-hidden rounded-full bg-white/8">
                                                <span
                                                    className={`block h-full rounded-full ${tight ? 'bg-amber-400' : 'bg-jade-500/70'}`}
                                                    style={{ width: `${Math.min(100, (machine.booked / machine.available) * 100)}%` }}
                                                ></span>
                                            </span>
                                        </li>
                                    );
                                })}
                            </ul>
                        </section>

                        <section className="flex flex-col gap-4">
                            <div className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                                <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">What this says</p>
                                <p className="mt-2.5 text-[13px]/6 text-zinc-400">{week.note}</p>
                            </div>

                            <a href="/templates/kanban/screens/backlog" target="_top" className="group/link flex items-center gap-3 rounded-2xl border border-white/8 bg-ink-900 p-5 transition-colors duration-150 hover:border-jade-500/50">
                                <span>
                                    <span className="block text-[13px] text-cream">Move something out</span>
                                    <span className="mt-1 block font-mono text-[10px] text-zinc-600">the backlog holds 63 h more</span>
                                </span>
                                <svg className="ml-auto size-4 text-zinc-600 transition-transform duration-200 ease-snap group-hover/link:translate-x-0.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                            </a>
                        </section>
                    </div>
                </div>
            </div>
        </KanbanShell>
    );
}
