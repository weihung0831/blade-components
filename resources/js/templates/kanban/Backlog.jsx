import { useState } from 'react';
import { KanbanShell } from './Shell';
import { KanbanTag } from './Tag';
import { KanbanAssignee } from './Assignee';

const CAPACITY = 46;

const ROWS = [
    { code: 'NS-1108', title: 'Cut a go/no-go gauge for seat height', type: 'Tooling', tone: 'plain', hours: 6, qty: null, raiser: 'Lena Kohler', age: 3, note: 'ends the calipers argument' },
    { code: 'NS-1107', title: 'Deburr the hopper threads on the graphite run', type: 'Rework', tone: 'alert', hours: 4, qty: 40, raiser: 'Mei Tsai', age: 4, note: 'caught at torque check' },
    { code: 'NS-1105', title: 'Swap the motor loom to the keyed connector', type: 'ECR-20', tone: 'batch', hours: 9, qty: null, raiser: 'Piotr Adamek', age: 5, note: 'two came back wired backwards' },
    { code: 'NS-1101', title: 'Quote a second anodiser in Taichung', type: 'Supply', tone: 'plain', hours: 3, qty: null, raiser: 'Idris Bahar', age: 6, note: 'one shop, one holiday, eleven days lost' },
    { code: 'NS-1099', title: 'Retest the 1800 rpm chatter with the short holder', type: 'Machine', tone: 'alert', hours: 5, qty: null, raiser: 'Piotr Adamek', age: 8, note: 'root cause behind NS-1102' },
    { code: 'NS-1096', title: 'Photograph the shim procedure for the service manual', type: 'Docs', tone: 'quiet', hours: 2, qty: null, raiser: 'Lena Kohler', age: 9, note: 'while the bench is set up for it' },
    { code: 'NS-1093', title: 'Cut 20 spare carriers so assembly stops waiting', type: 'Tooling', tone: 'plain', hours: 7, qty: 20, raiser: 'Piotr Adamek', age: 11, note: 'bench sat idle 3 h last Tuesday' },
    { code: 'NS-1089', title: 'Stamp the serial before assembly, not after', type: 'ECR-21', tone: 'batch', hours: 4, qty: null, raiser: 'Mei Tsai', age: 13, note: 'stops the unstamped-return problem' },
    { code: 'NS-1084', title: 'Ask the burr supplier for a flatness certificate', type: 'Supply', tone: 'plain', hours: 1, qty: null, raiser: 'Idris Bahar', age: 15, note: 'they have offered twice' },
    { code: 'NS-1079', title: 'Sort the returns shelf — 19 machines with no card', type: 'Rework', tone: 'alert', hours: 8, qty: 19, raiser: 'Mei Tsai', age: 18, note: 'moved four times, done zero times' },
    { code: 'NS-1072', title: 'Put the packing check on the shipping card', type: 'Docs', tone: 'quiet', hours: 2, qty: null, raiser: 'Idris Bahar', age: 21, note: 'one box went out without the tool' },
    { code: 'NS-1066', title: 'Build the jig for the 45° chamfer', type: 'Tooling', tone: 'plain', hours: 12, qty: null, raiser: 'Piotr Adamek', age: 26, note: 'hand-held every batch since March' },
].map((row, index) => ({ ...row, rank: index + 1, kind: row.type.split('-')[0].toLowerCase() }));

const TYPES = ['Rework', 'ECR', 'Tooling', 'Supply', 'Docs', 'Machine'];

const SORTS = [
    { value: 'rank', label: 'Priority' },
    { value: 'age', label: 'Oldest' },
    { value: 'hours', label: 'Longest' },
];

const TOTAL = ROWS.reduce((sum, row) => sum + row.hours, 0);

export function KanbanBacklog() {
    const [type, setType] = useState('all');
    const [sort, setSort] = useState('rank');
    const [picked, setPicked] = useState([]);

    const listed = ROWS
        .filter((row) => type === 'all' || row.kind === type)
        .sort((a, b) => (sort === 'rank' ? a.rank - b.rank : b[sort] - a[sort]));

    const hours = ROWS.filter((row) => picked.includes(row.code)).reduce((sum, row) => sum + row.hours, 0);
    const allPicked = listed.length > 0 && listed.every((row) => picked.includes(row.code));

    const toggle = (code) =>
        setPicked((current) => (current.includes(code) ? current.filter((entry) => entry !== code) : [...current, code]));

    return (
        <KanbanShell active="Backlog">
            <div className="mx-auto w-full max-w-5xl">
                <div className="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <h1 className="text-xl font-semibold tracking-tight text-cream">Not scheduled yet</h1>
                        <p className="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                            Twelve jobs, {TOTAL} bench hours between them. The week has {CAPACITY} hours left once batch 41 is out, so roughly half of this list is a lie until something moves.
                        </p>
                    </div>
                    <div className="flex items-baseline gap-2 font-mono text-[11px] text-zinc-600">
                        <span className="text-zinc-400">{hours}</span> h picked
                        <span aria-hidden="true" className="text-zinc-700">/</span>
                        <span>{CAPACITY} h free</span>
                    </div>
                </div>

                <div className="mt-6 flex flex-wrap items-center gap-x-4 gap-y-3">
                    <div className="flex flex-wrap items-center gap-1.5">
                        {['all', ...TYPES.map((entry) => entry.toLowerCase())].map((entry) => (
                            <label
                                key={entry}
                                className={`cursor-pointer rounded-lg border px-2.5 py-1 font-mono text-[11px] transition-colors duration-150 ${
                                    type === entry ? 'border-jade-500/50 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-500 hover:text-cream'
                                }`}
                            >
                                <input type="radio" name="backlog-type" value={entry} checked={type === entry} onChange={() => setType(entry)} className="sr-only" />
                                {entry === 'all' ? 'everything' : entry}
                            </label>
                        ))}
                    </div>

                    <div className="ml-auto flex items-center gap-1 rounded-lg bg-ink-900 p-0.5">
                        {SORTS.map((option) => (
                            <label
                                key={option.value}
                                className={`cursor-pointer rounded-md px-2.5 py-1 font-mono text-[11px] transition-colors duration-150 ${
                                    sort === option.value ? 'bg-white/10 text-cream' : 'text-zinc-500 hover:text-cream'
                                }`}
                            >
                                <input type="radio" name="backlog-sort" value={option.value} checked={sort === option.value} onChange={() => setSort(option.value)} className="sr-only" />
                                {option.label}
                            </label>
                        ))}
                    </div>
                </div>

                <div className="mt-4 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                    <div className="flex items-center gap-3 border-b border-white/5 px-4 py-2.5">
                        <label className="flex cursor-pointer items-center gap-2.5">
                            <input
                                type="checkbox"
                                checked={allPicked}
                                onChange={() => setPicked(allPicked ? [] : listed.map((row) => row.code))}
                                className="peer sr-only"
                            />
                            <span className="grid size-4 place-items-center rounded border border-white/15 text-transparent transition-colors duration-150 peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-checked:text-ink-950 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70">
                                <svg className="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m2.5 6.5 2.5 2.5 4.5-6" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round"/></svg>
                            </span>
                            <span className="font-mono text-[10px] text-zinc-600">select the lot</span>
                        </label>
                        <p className="ml-auto font-mono text-[10px] text-zinc-600"><span className="text-zinc-400">{listed.length}</span> jobs listed</p>
                    </div>

                    <ul className="flex flex-col divide-y divide-white/5">
                        {listed.map((row) => (
                            <li key={row.code} className={`transition-colors duration-150 hover:bg-white/5 ${picked.includes(row.code) ? 'bg-jade-500/5' : ''}`}>
                                <label className="flex cursor-pointer items-start gap-3 px-4 py-3">
                                    <input type="checkbox" checked={picked.includes(row.code)} onChange={() => toggle(row.code)} className="peer sr-only" />
                                    <span className="mt-0.5 grid size-4 shrink-0 place-items-center rounded border border-white/15 text-transparent transition-colors duration-150 peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-checked:text-ink-950 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70">
                                        <svg className="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m2.5 6.5 2.5 2.5 4.5-6" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                    </span>

                                    <span className="w-6 shrink-0 pt-px font-mono text-[11px] text-zinc-700">{String(row.rank).padStart(2, '0')}</span>

                                    <span className="min-w-0 flex-1">
                                        <span className="flex flex-wrap items-center gap-x-2.5 gap-y-1">
                                            <span className="font-mono text-[10px] text-zinc-600">{row.code}</span>
                                            <span className="text-[13px]/5 text-cream">{row.title}</span>
                                        </span>
                                        <span className="mt-1 flex flex-wrap items-center gap-x-2.5 gap-y-1">
                                            <KanbanTag label={row.type} tone={row.tone} />
                                            <span className="font-mono text-[10px] text-zinc-700">{row.note}</span>
                                        </span>
                                    </span>

                                    <span className="hidden shrink-0 flex-col items-end gap-1 sm:flex">
                                        <span className="font-mono text-[11px] text-zinc-400">{row.hours} h{row.qty ? ` · ×${row.qty}` : ''}</span>
                                        <span className={`font-mono text-[10px] ${row.age >= 14 ? 'text-amber-300' : 'text-zinc-700'}`}>{row.age} days old</span>
                                    </span>

                                    <KanbanAssignee name={row.raiser} size="xs" className="mt-0.5 hidden shrink-0 sm:grid" />
                                </label>
                            </li>
                        ))}
                    </ul>

                    {listed.length === 0 && <p className="px-4 py-10 text-center font-mono text-[11px] text-zinc-700">Nothing of that kind is waiting.</p>}
                </div>

                <div
                    className={`pointer-events-none sticky bottom-4 z-20 mt-4 flex justify-center transition-[opacity,transform] duration-200 ease-snap ${
                        picked.length > 0 ? 'pointer-events-auto translate-y-0 opacity-100' : 'translate-y-2 opacity-0'
                    }`}
                >
                    <div className="flex flex-wrap items-center gap-3 rounded-2xl border border-white/10 bg-ink-800 px-4 py-3 shadow-xl shadow-black/40">
                        <p className="font-mono text-[11px] text-zinc-400">
                            <span className="text-cream">{picked.length}</span> picked · <span className="text-cream">{hours}</span> h
                        </p>
                        <span aria-hidden="true" className="h-4 w-px bg-white/10"></span>
                        {hours > CAPACITY && <p className="font-mono text-[11px] text-red-300">past what the week holds</p>}
                        <button type="button" className="rounded-lg border border-white/10 px-3 py-1.5 text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Assign</button>
                        <button type="button" className="rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Send to Queued</button>
                    </div>
                </div>

                <p className="mt-6 max-w-xl font-mono text-[10px]/5 text-zinc-700">
                    Anything past 14 days turns amber. Three of these are older than the machine problem that caused half of them, which is its own kind of answer.
                </p>
            </div>
        </KanbanShell>
    );
}
