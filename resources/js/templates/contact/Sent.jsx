import { useState } from 'react';
import { ContactShell } from './Shell';
import { ContactPromise } from './Promise';

const STEPS = [
    { when: '02:41', label: 'Landed in the mailbox', detail: 'Yours and ours at the same moment. The copy you got is the copy Ines will read.', state: 'done' },
    { when: '09:30', label: 'A person opens it', detail: 'When the bench opens. Nothing is triaged before then, because nobody is there to triage it.', state: 'next' },
    { when: '10:20', label: 'You get an answer', detail: 'The median for a warranty letter with a serial in it. Without the serial it is closer to a day.', state: 'later' },
];

const SENT = [
    { label: 'About', value: 'Something is wrong with the machine', mono: false },
    { label: 'Serial', value: 'NS-B40-0117', mono: true },
    { label: 'Age', value: '1 to 12 months', mono: false },
    { label: 'Attached', value: 'noise-dial-14.m4a · 11 s', mono: true },
    { label: 'Write back to', value: 'tomas@ferreira.pt', mono: true },
];

const MEANWHILE = [
    { q: 'It howls above half the dial after three weeks. Is that normal?', helpful: 94 },
    { q: 'Do I have to season the burrs, and how much coffee does that cost me?', helpful: 96 },
    { q: 'I opened it myself before writing in. Have I voided anything?', helpful: 62 },
];

const QUIET = [
    { when: 'Reply to the mail', what: 'It pushes the letter back to the top of the pile. It does not open a second one.' },
    { when: 'Tue–Thu, 14:00–17:00', what: 'Ring +886 2 2765 4418 and read out the reference. Somebody will have the letter on screen.' },
    { when: 'After a working day', what: 'It goes to Tomas, who runs the bench, whether or not you chase it. That part is automatic.' },
];

const REFERENCE = 'NS-4471';

const DOTS = {
    done: 'border-jade-500/60 bg-jade-500/25',
    next: 'border-white/20 bg-ink-950',
    later: 'border-white/10 bg-ink-950',
};

export function ContactSent() {
    const [copied, setCopied] = useState(false);
    const [note, setNote] = useState('');
    const [added, setAdded] = useState(false);

    const copy = () => {
        navigator.clipboard?.writeText(REFERENCE);
        setCopied(true);
        setTimeout(() => setCopied(false), 1600);
    };

    return (
        <ContactShell active="Write in" rail={false}>
            <div className="mx-auto max-w-4xl">
                <div className="flex flex-wrap items-start gap-x-5 gap-y-4">
                    <span className="flex size-9 shrink-0 items-center justify-center rounded-lg border border-jade-500/40 bg-jade-500/10">
                        <svg className="size-4 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M3 8.5 6.5 12 13 4.5" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    </span>

                    <div className="min-w-0 flex-1">
                        <h1 className="text-lg font-semibold tracking-tight text-cream">It is in, and nobody is awake to read it</h1>
                        <p className="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                            Which is the honest version of the green tick. Your letter is sitting at the top of Ines's mailbox and
                            it will still be there at half past nine, because the pile is read oldest first and yours is the oldest.
                        </p>
                    </div>

                    <div className="flex shrink-0 items-center gap-2 rounded-lg border border-white/10 bg-ink-900 px-3 py-2">
                        <span className="flex flex-col">
                            <span className="font-mono text-[10px] text-zinc-700">reference</span>
                            <span className="font-mono text-[13px] text-cream">{REFERENCE}</span>
                        </span>
                        <button
                            type="button"
                            onClick={copy}
                            className="rounded-md border border-white/10 px-2 py-1 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                        >
                            {copied ? 'copied' : 'copy'}
                        </button>
                    </div>
                </div>

                <div className="mt-6">
                    <ContactPromise
                        sent="02:41"
                        due="10:20"
                        shut={409}
                        worked={0}
                        left={50}
                        lead="is when a warranty letter with a serial in it usually has a reply"
                    />
                </div>

                <div className="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-[1.4fr_1fr]">
                    <div>
                        <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What happens to it</h2>

                        <ol className="mt-4">
                            {STEPS.map((step, index) => (
                                <li key={step.label} className="relative flex gap-4 pb-6 last:pb-0">
                                    {index < STEPS.length - 1 && <span aria-hidden="true" className="absolute top-4 bottom-0 left-[7px] w-px bg-white/8"></span>}

                                    <span className={`relative mt-1 size-3.5 shrink-0 rounded-full border ${DOTS[step.state]}`}>
                                        {step.state === 'done' && <span className="absolute inset-1 rounded-full bg-jade-400"></span>}
                                    </span>

                                    <span className="min-w-0 flex-1">
                                        <span className="flex items-baseline gap-2.5">
                                            <span className={`text-[13px] ${step.state === 'done' ? 'text-cream' : 'text-zinc-400'}`}>{step.label}</span>
                                            <span className="font-mono text-[10px] text-zinc-700">{step.when}</span>
                                        </span>
                                        <span className="mt-1 block text-[12px]/5 text-zinc-500">{step.detail}</span>
                                    </span>
                                </li>
                            ))}
                        </ol>

                        <details className="group/sent mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900" open>
                            <summary className="flex cursor-pointer list-none items-center gap-3 px-4 py-3 outline-none transition-colors duration-150 hover:bg-white/4 [&::-webkit-details-marker]:hidden">
                                <span className="text-[13px] text-zinc-300">What you actually sent</span>
                                <svg className="ml-auto size-3.5 shrink-0 text-zinc-600 transition-transform duration-200 group-open/sent:rotate-45" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/></svg>
                            </summary>

                            <div className="border-t border-white/5 px-4 py-3.5">
                                <dl className="grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-2">
                                    {SENT.map((entry) => (
                                        <div key={entry.label} className="flex items-baseline gap-3">
                                            <dt className="w-24 shrink-0 font-mono text-[10px] text-zinc-700">{entry.label}</dt>
                                            <dd className={`text-[12px] text-zinc-400 ${entry.mono ? 'font-mono' : ''}`}>{entry.value}</dd>
                                        </div>
                                    ))}
                                </dl>

                                <p className="mt-3.5 border-t border-white/5 pt-3 text-[13px]/6 text-zinc-400">
                                    Three weeks old. Quiet at first, and since the weekend it screams anywhere past halfway on the
                                    dial. Ran it empty from 1 to 16 and it only does it with beans in it. Clip attached.
                                </p>
                            </div>
                        </details>

                        <div className="mt-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Remembered something</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-500">Everybody does, about a minute after sending. It goes onto the same letter rather than starting a second one.</p>

                            <textarea
                                value={note}
                                onChange={(event) => { setNote(event.target.value); setAdded(false); }}
                                rows={2}
                                spellCheck="false"
                                placeholder="It also drops the grind by two clicks when it does it…"
                                className="mt-2.5 w-full resize-none rounded-lg border border-white/10 bg-ink-900 px-3 py-2.5 text-[13px]/6 text-cream placeholder:text-zinc-600 transition-colors duration-150 focus:border-jade-500/60 focus:outline-none"
                            ></textarea>

                            <div className="mt-2 flex items-center gap-3">
                                <button
                                    type="button"
                                    disabled={note.trim() === ''}
                                    onClick={() => { setNote(''); setAdded(true); }}
                                    className="rounded-lg border border-white/10 px-3 py-1.5 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream disabled:pointer-events-none disabled:opacity-40"
                                >
                                    Add it to the letter
                                </button>
                                {added && <span className="font-mono text-[10px] text-jade-400/90">added — the reference did not change</span>}
                            </div>
                        </div>
                    </div>

                    <aside>
                        <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If it goes quiet</h2>
                        <div className="mt-3.5 space-y-3.5">
                            {QUIET.map((entry) => (
                                <div key={entry.when} className="border-l border-white/8 pl-3">
                                    <p className="font-mono text-[10px] text-jade-400/80">{entry.when}</p>
                                    <p className="mt-1 text-[12px]/5 text-zinc-500">{entry.what}</p>
                                </div>
                            ))}
                        </div>

                        <h2 className="mt-8 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">While you wait</h2>
                        <p className="mt-2 text-[12px]/5 text-zinc-500">These three come up most against letters that look like yours.</p>

                        <div className="mt-3 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            {MEANWHILE.map((entry) => (
                                <a
                                    key={entry.q}
                                    href="/templates/faq/screens/answer"
                                    target="_top"
                                    className="flex items-start gap-3 border-b border-white/5 px-3.5 py-3 transition-colors duration-150 last:border-b-0 hover:bg-white/4"
                                >
                                    <span className="mt-1 size-1.5 shrink-0 rounded-full bg-jade-400/70"></span>
                                    <span className="min-w-0 flex-1">
                                        <span className="block text-[12px]/5 text-zinc-300">{entry.q}</span>
                                        <span className="mt-1 block font-mono text-[10px] text-zinc-600">{entry.helpful}% said it helped</span>
                                    </span>
                                </a>
                            ))}
                        </div>

                        <div className="mt-6 rounded-xl border border-white/8 bg-ink-900 p-3.5">
                            <p className="font-mono text-[10px] text-zinc-600">One more thing</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-500">
                                Nothing about this letter gets you on a list. There is no newsletter attached to it and no survey
                                afterwards asking how we did.
                            </p>
                        </div>
                    </aside>
                </div>
            </div>
        </ContactShell>
    );
}
