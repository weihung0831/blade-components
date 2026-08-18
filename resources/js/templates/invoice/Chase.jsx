import { useState } from 'react';
import { InvoiceShell } from './Shell';
import { InvoiceStamp } from './Stamp';
import { InvoiceTotals } from './Totals';

const EVENTS = [
    {
        when: '6 Jun',
        day: 'day 0',
        title: 'The invoice fell due and nothing happened',
        body: 'No automatic reminder went out, because we stopped sending those in 2024. The first thing anybody at Nanfang hears from us is a person, not a system.',
        tone: 'quiet',
    },
    {
        when: '26 Jun',
        day: 'day 20',
        title: 'Ana rang, nobody picked up, so she wrote',
        body: 'Four lines, no template. It said the invoice was three weeks over, asked whether the PDF had reached the right person, and offered to split it across two months if that helped. No reply.',
        letter: 'Hi Mr Chen — INV-2026-0184 went out on 7 May and was due on the 6th. I know invoices go astray in a busy month, so tell me if it needs resending to somebody else. If it is easier to split it over two payments, say the word and I will redo the paperwork this afternoon. — Ana',
        tone: 'quiet',
    },
    {
        when: '10 Jul',
        day: 'day 34',
        title: 'Second letter, same tone, with the statement attached',
        body: 'The statement showed every invoice on the account back to January and which ones had been settled. Nine of them had. This one had not.',
        letter: 'Following on from the 26th — attached is everything on your account since January. Nine invoices settled, one open, and it is the oldest thing on our book. Is there something wrong with it that we can fix? — Ana',
        tone: 'quiet',
    },
    {
        when: '21 Jul',
        day: 'day 45',
        title: 'He answered the phone',
        body: 'Their own customer, a chain with fourteen shops, had gone to 90 days on them. He was not hiding, he was waiting. He asked for the end of August and we said the 22nd, which is when the hold goes on.',
        tone: 'warn',
    },
    {
        when: '30 Jul',
        day: 'day 54',
        title: 'NT$40,000 arrived with no reference on it',
        body: 'Sat in the suspense account for eleven days. Three of us looked at it. It was matched only because Ana recognised the amount as exactly the freight lines on this invoice, which is not a system, that is luck.',
        tone: 'warn',
    },
    {
        when: '8 Aug',
        day: 'day 63',
        title: 'Third letter, and this one changed tone',
        body: 'Still no threat, no legal language, no interest charged. What it did say was the date: nothing ships to the account after 22 August until the balance clears. They have two orders sitting behind that date.',
        letter: 'Mr Chen — thank you for the NT$40,000 on the 30th. NT$146,900 is still open, 63 days now. I have to tell you plainly that nothing leaves here for your account after 22 August until it clears, and you have two orders behind that date. I would much rather ship them. — Ana',
        tone: 'bad',
    },
    {
        when: '19 Aug',
        day: 'day 74 · today',
        title: 'Fourth letter, written, not sent',
        body: 'It sits in drafts until Wei has read it. The rule here is that anything which could end a seven-year account gets a second pair of eyes before it goes, and Wei is at the anodising shop until Thursday.',
        letter: 'Draft — three days to the 22nd. Offering to hold the orders rather than cancel them, and to take the balance in three payments if he tells us today. Wei to read before this goes.',
        tone: 'bad',
    },
];

const OWED = [
    { label: 'Invoiced 7 May', value: 'NT$186,900', strong: true },
    { label: 'Part payment', note: '30 Jul, no reference', value: '−NT$40,000' },
    { label: 'Interest charged', note: 'we could, we have not', value: 'NT$0' },
];

const RULES = [
    { when: 'day 20', what: 'A person rings. Not an email, and not a template.' },
    { when: 'day 60', what: 'Shipping stops, with fourteen days of warning first.' },
    { when: 'day 90', what: 'The account goes to prepayment only, which has happened four times.' },
    { when: 'never', what: 'A debt collector. Seven years, no exceptions, and we have eaten NT$64,800 rather than start.' },
];

const HISTORY = [
    { label: 'Invoices since 2019', value: '31' },
    { label: 'Average days to pay', value: '38' },
    { label: 'Worst before this one', value: '61 days, in 2023' },
    { label: 'Written off, ever', value: 'nothing' },
];

const DOTS = {
    quiet: 'border-white/20 bg-ink-900',
    warn: 'border-amber-400 bg-amber-400/30',
    bad: 'border-red-400 bg-red-400/40',
};

export function InvoiceChase() {
    const [open, setOpen] = useState([]);

    const toggle = (index) => {
        setOpen((current) => (current.includes(index) ? current.filter((entry) => entry !== index) : [...current, index]));
    };

    return (
        <InvoiceShell
            active="Getting paid"
            toolbar={
                <div className="mx-auto flex max-w-4xl flex-wrap items-center gap-3">
                    <span className="font-mono text-[11px] text-cream">INV-2026-0184</span>
                    <span className="font-mono text-[10px] text-zinc-600">Nanfang Trading · issued 7 May 2026 · due 6 June 2026</span>

                    <span className="ml-auto flex items-center gap-2">
                        <button type="button" className="rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Open the invoice</button>
                        <button type="button" className="rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Record a payment</button>
                    </span>
                </div>
            }
        >
            <div className="mx-auto max-w-4xl">
                <header className="flex flex-col gap-6 rounded-2xl border border-red-400/20 bg-red-400/4 p-6 sm:flex-row sm:items-start sm:justify-between">
                    <div className="max-w-lg">
                        <p className="font-mono text-[10px] tracking-wider text-red-400 uppercase">74 days past due</p>
                        <h1 className="mt-2 text-2xl font-semibold tracking-tight text-balance text-cream">NT$146,900 outstanding, four letters written, one of them still in drafts.</h1>
                        <p className="mt-3 text-[13px]/6 text-zinc-400">
                            Nanfang have bought from us for seven years and paid 31 invoices. This is what chasing the 32nd has
                            actually looked like, including the fortnight we lost to a payment that arrived with nothing written
                            on it.
                        </p>
                    </div>

                    <InvoiceStamp label="Overdue" tone="overdue" note="74 days" className="shrink-0" />
                </header>

                <div className="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)]">
                    <section>
                        <div className="flex items-baseline gap-3">
                            <h2 className="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What has happened so far</h2>
                            <span className="h-px min-w-0 flex-1 bg-white/6"></span>
                            <span className="shrink-0 font-mono text-[10px] text-zinc-700">letters open</span>
                        </div>

                        <ol className="mt-4 flex flex-col">
                            {EVENTS.map((event, index) => (
                                <li key={event.title} className="flex gap-4">
                                    <div className="flex shrink-0 flex-col items-center">
                                        <span className={`mt-1.5 size-2.5 rounded-full border ${DOTS[event.tone]}`}></span>
                                        {index < EVENTS.length - 1 && <span className="w-px flex-1 bg-white/8"></span>}
                                    </div>

                                    <div className={`min-w-0 flex-1 ${index < EVENTS.length - 1 ? 'pb-6' : ''}`}>
                                        <div className="flex flex-wrap items-baseline gap-x-3">
                                            <span className="font-mono text-[11px] text-zinc-300">{event.when}</span>
                                            <span className="font-mono text-[10px] text-zinc-700">{event.day}</span>
                                        </div>

                                        <h3 className="mt-1 text-[13px]/5 text-cream">{event.title}</h3>
                                        <p className="mt-1.5 text-[12px]/5 text-zinc-500">{event.body}</p>

                                        {event.letter && (
                                            <div className="mt-2.5">
                                                <button
                                                    type="button"
                                                    onClick={() => toggle(index)}
                                                    className="inline-flex items-center gap-1.5 font-mono text-[10px] text-jade-300 transition-colors duration-150 outline-none hover:text-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                                >
                                                    <svg className={`size-3 transition-transform duration-150 ${open.includes(index) ? 'rotate-90' : ''}`} viewBox="0 0 12 12" fill="none"><path d="M4 2.5 8 6l-4 3.5" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                                    {open.includes(index) ? 'close it' : 'read what it said'}
                                                </button>

                                                {open.includes(index) && (
                                                    <p className="mt-2 max-w-xl rounded-xl border border-white/8 bg-ink-900 p-3.5 text-[12px]/6 text-zinc-400 italic">{event.letter}</p>
                                                )}
                                            </div>
                                        )}
                                    </div>
                                </li>
                            ))}
                        </ol>
                    </section>

                    <aside className="flex flex-col gap-3">
                        <div className="rounded-2xl border border-white/8 bg-ink-950 p-5">
                            <InvoiceTotals
                                rows={OWED}
                                total="NT$146,900"
                                totalLabel="Still owed"
                                tone="overdue"
                                note="the 22nd is when the account stops shipping" />
                        </div>

                        <div className="rounded-2xl border border-white/8 bg-ink-900/50 p-5">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we do and when</p>

                            <ul className="mt-3 flex flex-col gap-2.5">
                                {RULES.map((rule) => (
                                    <li key={rule.when} className="flex gap-3">
                                        <span className="w-12 shrink-0 font-mono text-[10px] text-zinc-600">{rule.when}</span>
                                        <span className="min-w-0 flex-1 text-[11px]/5 text-zinc-500">{rule.what}</span>
                                    </li>
                                ))}
                            </ul>
                        </div>

                        <div className="rounded-2xl border border-amber-400/25 bg-amber-400/4 p-5">
                            <p className="font-mono text-[10px] tracking-wider text-amber-300 uppercase">The eleven-day payment</p>
                            <p className="mt-2 text-[12px]/5 text-zinc-400">
                                NT$40,000 landed on 30 July with an empty reference field. Our bank feed cannot tell us who sent it,
                                only that it came from a corporate account with a name that matches nothing on our books. It is the
                                reason the invoice now says, in bold, what to put in that box.
                            </p>
                        </div>

                        <div className="rounded-2xl border border-white/8 bg-ink-950 p-5">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Who they have been</p>

                            <dl className="mt-3 flex flex-col gap-2">
                                {HISTORY.map((row) => (
                                    <div key={row.label} className="flex items-baseline justify-between gap-4">
                                        <dt className="text-[12px] text-zinc-500">{row.label}</dt>
                                        <dd className="shrink-0 font-mono text-[12px] tabular-nums text-zinc-300">{row.value}</dd>
                                    </div>
                                ))}
                            </dl>

                            <p className="mt-3 border-t border-white/6 pt-2.5 text-[11px]/5 text-zinc-600">
                                Which is the argument for waiting one more week, and also the argument nobody wants to be making in
                                November.
                            </p>
                        </div>
                    </aside>
                </div>
            </div>
        </InvoiceShell>
    );
}
