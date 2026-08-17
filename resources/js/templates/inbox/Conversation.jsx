import { useState } from 'react';
import { InboxShell } from './Shell';
import { InboxMessage } from './Message';
import { InboxAvatar } from './Avatar';
import { InboxTag } from './Tag';
import { InboxClock } from './Clock';

const THREAD = {
    ref: 'NS-4471',
    subject: 'Grinder howls above 1800 rpm after three weeks',
    minutes: -40,
    tags: [{ label: 'Warranty', tone: 'warranty' }, { label: 'Batch 40', tone: 'order' }, { label: 'Escalated', tone: 'escalated' }],
};

const MESSAGES = [
    { kind: 'event', internal: true, time: 'Tue 08:41', body: ['Web form · picked the "something is wrong with it" box · routed to Unassigned'] },
    { kind: 'inbound', author: 'Tomás Ferreira', time: 'Tue 08:41', body: ['Three weeks old and it has started screaming past halfway on the dial. Espresso settings are where it is worst — anything coarser than that and I barely hear it.', 'I have recorded it. Is this the burrs bedding in, or is something actually wrong?'], attachments: [{ name: 'grinder-1800rpm.m4a', size: '1.2 MB' }, { name: 'dial-position.jpg', size: '1.8 MB' }] },
    { kind: 'event', internal: true, time: 'Tue 08:52', body: ['Hana Okabe took the thread out of Unassigned'] },
    { kind: 'outbound', author: 'Hana Okabe', role: 'front desk', time: 'Tue 08:53', seen: 'read Tue 09:18', body: ['That is not bedding in. Bedding in is a hiss that fades over a fortnight — what is on your clip is metal touching metal, and it should not.', 'Two things and then I can tell you exactly what happened: the serial off the underside plate, and roughly where the dial sits when it starts.'] },
    { kind: 'inbound', author: 'Tomás Ferreira', time: 'Tue 09:20', body: ['NS-B40-0117, jade finish, bought straight from you on the 21st. It starts about a third of the way up and gets uglier from there.'] },
    { kind: 'note', author: 'Hana Okabe', role: 'front desk', time: 'Tue 09:24', internal: true, body: ['@Lena — B40 is the run where the seats came back shallow, isn\'t it? This is the third one this week that starts at the same place on the dial.'] },
    { kind: 'note', author: 'Lena Kohler', role: 'bench test', time: 'Tue 09:41', internal: true, body: ['Batch 40, yes. Seat depth is 0.15 shallow across the run, so the top burr sits proud and touches once the load comes on. It is not dangerous, it will eat the burr edge in a couple of months.', 'Workshop job NS-1102 is shimming 24 of them. We have kits on the shelf — no need to make him post the machine anywhere.'] },
    { kind: 'event', internal: true, time: 'Tue 09:42', body: ['Assigned to Lena Kohler · tagged Warranty · escalated'] },
    { kind: 'outbound', author: 'Lena Kohler', role: 'bench test', time: 'Tue 10:05', seen: 'read Tue 10:44', body: ['It is ours, and we already know about it. Your machine is from a run where the burr seats were cut 0.15 mm shallow — the top burr sits a fraction proud and touches under load. That is the noise.', 'You have two ways out and both are free. I post you a shim kit with a 3 mm hex and a card of instructions, twenty minutes at your kitchen table. Or you post the machine to us on our label and it comes back in about ten days.', 'If you would rather not open it, say so and I will send the label instead — no argument from me either way.'], attachments: [{ name: 'seat-shim-instructions.pdf', size: '620 KB' }] },
    { kind: 'inbound', author: 'Tomás Ferreira', time: 'Tue 11:12', body: ['Send the kit. I would rather spend twenty minutes than ten days without it. How long before the noise comes back if I leave it as it is?'] },
    { kind: 'event', internal: true, time: '40m ago', body: ['Reply promise passed · 4h from Tue 11:12'] },
];

const RELATED = [
    { ref: 'NS-4450', who: 'Kenji Sato', note: 'same batch, twice repaired' },
    { ref: 'NS-4402', who: 'Julia Brandt', note: 'same noise, took the shim kit' },
    { ref: 'NS-4388', who: 'Owen Pryce', note: 'same noise, sent it back' },
];

const FACTS = [
    ['Machine', 'NS-B40-0117'],
    ['Finish', 'Jade'],
    ['Shipped', '21 Mar, direct'],
    ['Warranty', 'runs to Mar 2028'],
    ['Lifetime', '€389, one machine'],
];

const HINTS = {
    reply: 'goes to tomas.ferreira@…pt · 04:12 where he is, so it will land with his morning',
    note: 'stays in the workshop — nobody outside this desk sees it',
    forward: 'picks a new recipient and takes the whole thread with it',
};

const PLACEHOLDERS = {
    reply: 'Answer him — the kit is on the shelf and he has already said yes',
    note: 'Leave it for whoever picks this up next',
    forward: 'Say why you are handing it on',
};

export function InboxConversation() {
    const [view, setView] = useState('everything');
    const [mode, setMode] = useState('reply');

    const shown = view === 'everything' ? MESSAGES : MESSAGES.filter((message) => !message.internal);

    return (
        <InboxShell active="Inbox" rail={false} padded={false}>
            <div className="flex min-h-0 flex-1 overflow-hidden">
                <div className="flex min-w-0 flex-1 flex-col">
                    <header className="shrink-0 border-b border-white/5 px-5 py-4">
                        <a href="/templates/inbox/screens/threads" target="_top" className="inline-flex items-center gap-1.5 font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream">
                            <svg className="size-3" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                            Unassigned
                        </a>

                        <div className="mt-2 flex flex-wrap items-start gap-x-4 gap-y-3">
                            <div className="min-w-0 flex-1">
                                <h3 className="text-[17px] font-medium tracking-tight text-cream">{THREAD.subject}</h3>
                                <div className="mt-2 flex flex-wrap items-center gap-2">
                                    <span className="font-mono text-[10px] text-zinc-600">{THREAD.ref}</span>
                                    {THREAD.tags.map((tag) => <InboxTag key={tag.label} label={tag.label} tone={tag.tone} />)}
                                    <InboxClock minutes={THREAD.minutes} bar />
                                </div>
                            </div>

                            <div className="flex shrink-0 flex-wrap items-center gap-1.5">
                                <button type="button" className="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                    <InboxAvatar name="Lena Kohler" size="xs" />
                                    Lena has it
                                </button>
                                {['Snooze', 'Merge', 'Close'].map((action) => (
                                    <button
                                        key={action}
                                        type="button"
                                        className="rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    >
                                        {action}
                                    </button>
                                ))}
                            </div>
                        </div>
                    </header>

                    <div className="flex shrink-0 flex-wrap items-center gap-2 border-b border-white/5 px-5 py-2.5">
                        {[['everything', 'Everything', 11], ['sent', 'What they can see', 5]].map(([value, label, count]) => (
                            <label
                                key={value}
                                className={`cursor-pointer rounded-lg border px-2.5 py-1 font-mono text-[11px] transition-colors duration-150 ${
                                    view === value ? 'border-jade-500/60 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-500 hover:text-cream'
                                }`}
                            >
                                <input type="radio" name="transcript-view" checked={view === value} onChange={() => setView(value)} className="sr-only" />
                                {label} <span className="text-zinc-700">{count}</span>
                            </label>
                        ))}

                        <p className="ml-auto font-mono text-[10px] text-zinc-700">two hands on this one · 2h 31m from first touch to a real answer</p>
                    </div>

                    <div className="min-h-0 flex-1 space-y-4 overflow-y-auto px-5 py-6">
                        {shown.map((message, index) => <InboxMessage key={index} message={message} />)}
                    </div>

                    <footer className="shrink-0 border-t border-white/5 px-5 py-3.5">
                        <div className={`rounded-xl border bg-ink-900 transition-colors duration-150 focus-within:border-jade-500/50 ${mode === 'note' ? 'border-amber-400/40 bg-amber-400/5' : 'border-white/10'}`}>
                            <div className="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                                {[['reply', 'Reply'], ['note', 'Internal note'], ['forward', 'Forward']].map(([value, label]) => (
                                    <label
                                        key={value}
                                        className={`cursor-pointer rounded-md px-2 py-1 font-mono text-[11px] transition-colors duration-150 ${
                                            mode === value ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:text-cream'
                                        }`}
                                    >
                                        <input type="radio" name="reply-mode" checked={mode === value} onChange={() => setMode(value)} className="sr-only" />
                                        {label}
                                    </label>
                                ))}

                                <span className="ml-auto font-mono text-[10px] text-zinc-600">{HINTS[mode]}</span>
                            </div>

                            <textarea
                                rows="3"
                                placeholder={PLACEHOLDERS[mode]}
                                className="w-full resize-none bg-transparent px-3.5 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:outline-none"
                            ></textarea>

                            <div className="flex flex-wrap items-center gap-2 border-t border-white/5 px-3 py-2">
                                {['Shim kit — dispatch', 'Warranty, no charge', 'Ask for the serial'].map((macro) => (
                                    <button
                                        key={macro}
                                        type="button"
                                        className="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                                    >
                                        {macro}
                                    </button>
                                ))}

                                <a href="/templates/inbox/screens/compose" target="_top" className="ml-auto inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">
                                    Send and close
                                </a>
                            </div>
                        </div>
                    </footer>
                </div>

                <aside className="hidden w-72 shrink-0 overflow-y-auto border-l border-white/5 px-4 py-5 xl:block">
                    <div className="flex items-center gap-3">
                        <InboxAvatar name="Tomás Ferreira" size="lg" kind="customer" />
                        <div className="min-w-0">
                            <p className="truncate text-[13px] font-medium text-cream">Tomás Ferreira</p>
                            <p className="mt-0.5 font-mono text-[10px] text-zinc-600">Porto, PT · 04:12 there</p>
                        </div>
                    </div>

                    <dl className="mt-5 space-y-2.5 border-t border-white/5 pt-4">
                        {FACTS.map(([term, value]) => (
                            <div key={term} className="flex items-baseline gap-3">
                                <dt className="font-mono text-[10px] text-zinc-700">{term}</dt>
                                <dd className="ml-auto text-right font-mono text-[11px] text-zinc-400">{value}</dd>
                            </div>
                        ))}
                    </dl>

                    <div className="mt-5 rounded-xl border border-amber-400/25 bg-amber-400/5 p-3">
                        <p className="font-mono text-[10px] tracking-wide text-amber-300/80 uppercase">Known fault</p>
                        <p className="mt-1.5 text-[12px]/5 text-zinc-300">Batch 40 seats cut 0.15 mm shallow. 24 machines on the bench, kits in stock, no charge either way.</p>
                        <a href="/templates/kanban/screens/ticket" target="_top" className="mt-2.5 inline-flex items-center gap-1.5 font-mono text-[10px] text-amber-300 transition-colors duration-150 hover:text-amber-200">
                            workshop job NS-1102 →
                        </a>
                    </div>

                    <div className="mt-5">
                        <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Same batch, same noise</p>
                        <ul className="mt-2 space-y-1">
                            {RELATED.map((entry) => (
                                <li key={entry.ref}>
                                    <a href="/templates/inbox/screens/threads" target="_top" className="block rounded-lg px-2 py-1.5 transition-colors duration-150 hover:bg-white/5">
                                        <span className="flex items-baseline gap-2">
                                            <span className="shrink-0 font-mono text-[10px] text-jade-400">{entry.ref}</span>
                                            <span className="truncate text-[12px] text-zinc-400">{entry.who}</span>
                                        </span>
                                        <span className="mt-0.5 block truncate font-mono text-[10px] text-zinc-700">{entry.note}</span>
                                    </a>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="mt-5 border-t border-white/5 pt-4">
                        <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Before this</p>
                        <p className="mt-2 text-[12px]/5 text-zinc-500">One thread, April, asking which basket fits a 58 mm portafilter. Answered in eleven minutes, closed happy.</p>
                    </div>
                </aside>
            </div>
        </InboxShell>
    );
}
