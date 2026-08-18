import { useState } from 'react';
import { InvoiceShell } from './Shell';
import { InvoiceStamp } from './Stamp';

const CUSTOMERS = [
    {
        key: 'formosa',
        name: 'Formosa Coffee Works Ltd',
        meta: 'Kaohsiung · buying since 2021',
        tax: '統一編號 24681357',
        rate: 5,
        rateLabel: 'Business tax 5%',
        note: 'A company invoice. Once it is issued the tax number cannot be changed, only voided and reissued, so check it now rather than on Friday.',
    },
    {
        key: 'kuro',
        name: 'Kuro Roasters KK',
        meta: 'Osaka · export, third order',
        tax: 'no Taiwan tax number',
        rate: 0,
        rateLabel: 'Zero-rated export',
        note: 'Zero-rated, which only holds if the bill of lading is filed with the return. Keep the forwarder receipt against this invoice number.',
    },
    {
        key: 'walkin',
        name: 'A shop with no account yet',
        meta: 'first order · pays before it ships',
        tax: 'tax number to be confirmed',
        rate: 5,
        rateLabel: 'Business tax 5%',
        note: 'No credit on a first order. This one prints as a proforma and turns into an invoice the day the money lands.',
    },
];

const TERMS = [
    { key: '14', label: 'Net 14', due: '2 September 2026', note: 'A Wednesday. Most shops run payments on a Wednesday, so this one usually lands on the day.' },
    { key: '30', label: 'Net 30', due: '18 September 2026', note: 'A Friday, which means the money moves that afternoon or on Monday. Assume Monday.' },
    { key: '60', label: 'Net 60', due: '19 October 2026', note: '60 days lands on a Sunday, so the date on the invoice is the Monday. We give 60 days to four accounts and this is one of them.' },
];

const ISSUING = [
    'Files the e-invoice with the Ministry of Finance, which is the part that cannot be taken back.',
    'Emails the PDF to the address on the account, and nowhere else.',
    'Puts the amount into the ledger as outstanding from that minute, not from when it is opened.',
    'Books the stock out. If the pallet is still here on Friday, that is a separate problem.',
];

const INITIAL_LINES = [
    { code: 'MK3-GR', description: 'Mk3 hand grinder, graphite', note: 'Batch 40, ready now', price: 2940, qty: 40, step: 4, unit: 'ea', kind: 'machine' },
    { code: 'BUR-38', description: '38 mm burr set, spare', note: 'Off the shelf behind the bench', price: 520, qty: 60, step: 10, unit: 'set', kind: 'part' },
    { code: 'COL-02', description: 'Collar, with the 2 mm key', note: 'The part that works loose', price: 45, qty: 100, step: 20, unit: 'ea', kind: 'part' },
    { code: 'FRT-KH', description: 'Freight, two pallets', note: 'At cost, quote attached', price: 3800, qty: 1, step: 1, unit: 'job', kind: 'freight' },
];

const money = (value) => `NT$${Math.round(value).toLocaleString('en-US')}`;

export function InvoiceCompose() {
    const [lines, setLines] = useState(INITIAL_LINES);
    const [picked, setPicked] = useState('formosa');
    const [term, setTerm] = useState('30');

    const customer = CUSTOMERS.find((entry) => entry.key === picked);
    const chosenTerm = TERMS.find((entry) => entry.key === term);

    const machineLines = lines.filter((line) => line.kind === 'machine');
    const machines = machineLines.reduce((sum, line) => sum + line.qty, 0);
    const subtotal = lines.reduce((sum, line) => sum + line.qty * line.price, 0);
    const machineTotal = machineLines.reduce((sum, line) => sum + line.qty * line.price, 0);
    const discount = machines >= 50 ? Math.round(machineTotal * 0.03) : 0;
    const taxable = subtotal - discount;
    const tax = Math.round(taxable * customer.rate / 100);

    const step = (code, direction) => {
        setLines((current) => current.map((line) => (
            line.code === code ? { ...line, qty: Math.max(0, line.qty + line.step * direction) } : line
        )));
    };

    return (
        <InvoiceShell
            active="Writing one"
            toolbar={
                <div className="mx-auto flex max-w-5xl flex-wrap items-center gap-3">
                    <InvoiceStamp label="Draft" tone="draft" tilt="none" className="scale-90" />

                    <span className="font-mono text-[10px] text-zinc-600">INV-2026-0208 · saved 40 seconds ago</span>

                    <span className="ml-auto flex items-center gap-2">
                        <button type="button" className="rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Save and come back</button>
                        <button type="button" className="rounded-lg bg-jade-500 px-3 py-1.5 text-[12px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Issue it</button>
                    </span>
                </div>
            }
        >
            <div className="mx-auto grid max-w-5xl grid-cols-1 gap-4 lg:grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)]">
                <div className="flex flex-col gap-4">
                    <section className="rounded-2xl border border-white/8 bg-ink-950 p-5">
                        <div className="flex items-baseline justify-between gap-3">
                            <h2 className="text-[15px] font-medium tracking-tight text-cream">Who it goes to</h2>
                            <span className="font-mono text-[10px] text-zinc-700">the tax treatment follows from this</span>
                        </div>

                        <div className="mt-4 flex flex-col gap-2">
                            {CUSTOMERS.map((entry) => (
                                <button
                                    key={entry.key}
                                    type="button"
                                    onClick={() => setPicked(entry.key)}
                                    className={`flex items-start gap-3 rounded-xl border px-3.5 py-3 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${picked === entry.key ? 'border-jade-500/50 bg-jade-500/8' : 'border-white/8 hover:border-white/20'}`}
                                >
                                    <span className={`mt-1 size-3.5 shrink-0 rounded-full border ${picked === entry.key ? 'border-jade-400 bg-jade-500' : 'border-white/15'}`}></span>

                                    <span className="min-w-0 flex-1">
                                        <span className="flex flex-wrap items-baseline gap-x-2">
                                            <span className="text-[13px] text-cream">{entry.name}</span>
                                            <span className="font-mono text-[10px] text-zinc-600">{entry.meta}</span>
                                        </span>
                                        <span className="mt-1 block font-mono text-[10px] text-jade-300">{entry.tax}</span>
                                    </span>

                                    <span className={`shrink-0 rounded-lg border px-2 py-0.5 font-mono text-[10px] ${entry.rate === 0 ? 'border-amber-400/30 text-amber-300' : 'border-white/10 text-zinc-500'}`}>{entry.rate}%</span>
                                </button>
                            ))}
                        </div>
                    </section>

                    <section className="rounded-2xl border border-white/8 bg-ink-950 p-5">
                        <div className="flex items-baseline justify-between gap-3">
                            <h2 className="text-[15px] font-medium tracking-tight text-cream">What is on it</h2>
                            <span className="font-mono text-[10px] text-zinc-700">50 machines or more takes 3% off the machines</span>
                        </div>

                        <div className="mt-4 flex flex-col divide-y divide-white/5">
                            {lines.map((line) => (
                                <div key={line.code} className="flex items-center gap-3 py-3 first:pt-0 last:pb-0">
                                    <div className="min-w-0 flex-1">
                                        <p className="text-[13px]/5 text-cream">{line.description}</p>
                                        <p className="mt-0.5 text-[11px]/5 text-zinc-600">{line.note}</p>
                                        <p className="mt-1 font-mono text-[10px] text-zinc-700">{line.code} · {money(line.price)} each</p>
                                    </div>

                                    <div className="flex shrink-0 items-center gap-1.5">
                                        <button type="button" aria-label="fewer" onClick={() => step(line.code, -1)} className="grid size-6 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">−</button>

                                        <span className="w-14 text-center">
                                            <span className="block font-mono text-[13px] tabular-nums text-cream">{line.qty}</span>
                                            <span className="block font-mono text-[9px] text-zinc-700">{line.unit}</span>
                                        </span>

                                        <button type="button" aria-label="more" onClick={() => step(line.code, 1)} className="grid size-6 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">+</button>
                                    </div>

                                    <span className="w-24 shrink-0 text-right font-mono text-[12px] tabular-nums text-zinc-300">{money(line.qty * line.price)}</span>
                                </div>
                            ))}
                        </div>

                        <button type="button" className="mt-4 w-full rounded-xl border border-dashed border-white/12 px-3 py-2.5 text-[12px] text-zinc-500 transition-colors duration-150 outline-none hover:border-jade-500/50 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                            Add a line · the last eleven invoices all used the same four
                        </button>
                    </section>

                    <section className="rounded-2xl border border-white/8 bg-ink-950 p-5">
                        <div className="flex items-baseline justify-between gap-3">
                            <h2 className="text-[15px] font-medium tracking-tight text-cream">When it is due</h2>
                            <span className="font-mono text-[10px] text-zinc-700">issued 19 August 2026</span>
                        </div>

                        <div className="mt-4 flex flex-wrap gap-2">
                            {TERMS.map((entry) => (
                                <button
                                    key={entry.key}
                                    type="button"
                                    onClick={() => setTerm(entry.key)}
                                    className={`rounded-xl border px-3 py-2 text-[12px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${term === entry.key ? 'border-jade-500/50 bg-jade-500/8 text-cream' : 'border-white/8 text-zinc-400 hover:border-white/20 hover:text-cream'}`}
                                >{entry.label}</button>
                            ))}
                        </div>

                        <p className="mt-3 text-[12px]/5 text-zinc-500">{chosenTerm.note}</p>
                    </section>
                </div>

                <div className="flex flex-col gap-4">
                    <section className="overflow-hidden rounded-2xl border border-white/10 bg-ink-900">
                        <div className="flex items-baseline justify-between border-b border-white/8 px-5 py-3">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What the customer will get</p>
                            <p className="font-mono text-[10px] text-zinc-700">INV-2026-0208</p>
                        </div>

                        <div className="px-5 py-4">
                            <p className="text-[14px] font-medium tracking-tight text-cream">{customer.name}</p>
                            <p className="mt-1 font-mono text-[10px] text-jade-300">{customer.tax}</p>

                            <dl className="mt-4 flex flex-col gap-2 border-t border-white/6 pt-3">
                                <div className="flex items-baseline justify-between gap-4">
                                    <dt className="text-[12px] text-zinc-500">Subtotal</dt>
                                    <dd className="font-mono text-[12px] tabular-nums text-zinc-300">{money(subtotal)}</dd>
                                </div>

                                {discount > 0 && (
                                    <div className="flex items-baseline justify-between gap-4">
                                        <dt className="text-[12px] text-zinc-500">Trade discount <span className="font-mono text-[10px] text-zinc-700">3%, machines</span></dt>
                                        <dd className="font-mono text-[12px] tabular-nums text-zinc-400">−{money(discount)}</dd>
                                    </div>
                                )}

                                <div className="flex items-baseline justify-between gap-4">
                                    <dt className="text-[12px] text-zinc-500">{customer.rateLabel}</dt>
                                    <dd className="font-mono text-[12px] tabular-nums text-zinc-400">{money(tax)}</dd>
                                </div>

                                <div className="flex items-baseline justify-between gap-4 border-t border-white/10 pt-3">
                                    <dt className="text-[13px] text-zinc-300">Total</dt>
                                    <dd className="font-mono text-lg font-semibold tracking-tight tabular-nums text-jade-300">{money(taxable + tax)}</dd>
                                </div>
                            </dl>

                            <dl className="mt-4 flex flex-col gap-1.5 border-t border-white/6 pt-3">
                                <div className="flex items-baseline justify-between gap-4">
                                    <dt className="font-mono text-[10px] text-zinc-700">terms</dt>
                                    <dd className="font-mono text-[11px] text-zinc-400">Net {chosenTerm.key}</dd>
                                </div>
                                <div className="flex items-baseline justify-between gap-4">
                                    <dt className="font-mono text-[10px] text-zinc-700">due</dt>
                                    <dd className="font-mono text-[11px] text-zinc-300">{chosenTerm.due}</dd>
                                </div>
                                <div className="flex items-baseline justify-between gap-4">
                                    <dt className="font-mono text-[10px] text-zinc-700">machines</dt>
                                    <dd className="font-mono text-[11px] text-zinc-400">
                                        {machines >= 50 ? `${machines} · discount applies` : `${machines} · ${50 - machines} short of the discount`}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </section>

                    <section className="rounded-2xl border border-amber-400/25 bg-amber-400/4 p-4">
                        <p className="font-mono text-[10px] tracking-wider text-amber-300 uppercase">Before you press issue</p>
                        <p className="mt-2 text-[12px]/5 text-zinc-400">{customer.note}</p>
                    </section>

                    <section className="rounded-2xl border border-white/8 bg-ink-900/50 p-4">
                        <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What issuing actually does</p>
                        <ul className="mt-2.5 flex flex-col gap-1.5">
                            {ISSUING.map((line) => (
                                <li key={line} className="flex gap-2 text-[11px]/5 text-zinc-500">
                                    <span className="mt-1.5 size-1 shrink-0 rounded-full bg-zinc-700"></span>
                                    {line}
                                </li>
                            ))}
                        </ul>
                    </section>
                </div>
            </div>
        </InvoiceShell>
    );
}
