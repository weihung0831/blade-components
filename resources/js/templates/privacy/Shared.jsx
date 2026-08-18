import { useState } from 'react';
import { PrivacyShell } from './Shell';
import { PrivacyHolder } from './Holder';

const HOLDERS = [
    { name: '綠界科技 ECPay', role: 'Takes the payment', country: 'Taiwan', basis: 'contract', control: 'required', since: '2019', gets: ['name', 'email', 'amount', 'order number'], note: 'They hand back a token and four digits. The card number goes from your browser to them and never comes past anything we own.' },
    { name: '黑貓宅急便', role: 'Delivers inside Taiwan', country: 'Taiwan', basis: 'contract', control: 'partly', since: '2019', gets: ['name', 'address', 'phone', 'weight'], note: 'Collect at the counter instead and they never hear your name at all.' },
    { name: 'DHL Express', role: 'Delivers everywhere else', country: 'Germany, then wherever it lands', basis: 'contract and customs law', control: 'partly', since: '2020', gets: ['name', 'address', 'phone', 'contents', 'declared value'], note: 'The declaration is a legal document in two countries, so it is the one list here we cannot trim down.' },
    { name: 'Fastmail', role: 'Holds the mailbox', country: 'Netherlands', basis: 'contract', control: 'required', since: '2021', gets: ['everything in a thread you sent us'], note: 'Which means a support mail sits on a Dutch server until it turns three and we delete it.' },
    { name: '中華電信 HiNet', role: 'Racks the server', country: 'Taiwan, Neihu', basis: 'contract', control: 'required', since: '2019', gets: ['the database, encrypted at rest'], note: 'A rented box in a building in Taipei, not a region in somebody\'s cloud. Two of us have keys to the cage.' },
    { name: 'Bunny CDN', role: 'Serves the photographs', country: 'Slovenia, edge in Taipei', basis: 'legitimate interest', control: 'partly', since: '2023', gets: ['IP address', 'which image'], note: 'It sees an address and a filename. It has never once seen an order.' },
    { name: 'Plausible', role: 'Counts visits', country: 'Germany', basis: 'your consent', control: 'optional', since: '2023', gets: ['a hash that changes daily', 'the page', 'the country'], note: 'Off until you go and switch it on. It cannot reach an order, an address or a name even when it is running.' },
    { name: '誠泰記帳士事務所', role: 'Files the tax', country: 'Taipei, two streets away', basis: 'legal obligation', control: 'required', since: '2019', gets: ['the invoice list, quarterly'], note: 'A bookkeeper with a filing cabinet rather than a platform. She signed the same confidentiality paper the four of us did.' },
    { name: '財政部電子發票平台', role: 'Issues the e-invoice', country: 'Taiwan', basis: 'legal obligation', control: 'required', since: '2019', gets: ['invoice number', 'amount', 'your carrier code'], note: 'Statutory. Every shop in Taiwan feeds this and not one of us was asked whether we wanted to.' },
];

const FILTERS = [
    { key: 'all', label: 'All nine' },
    { key: 'required', label: 'Unavoidable' },
    { key: 'partly', label: 'Avoidable' },
    { key: 'optional', label: 'Only if you say yes' },
];

const COUNTRIES = [
    { name: 'Taiwan', count: 5, note: 'Payment, courier, server, bookkeeper, tax platform.' },
    { name: 'Germany', count: 2, note: 'The export courier, and the visit counter if you turned it on.' },
    { name: 'Netherlands', count: 1, note: 'The mailbox, and nothing else.' },
    { name: 'Slovenia', count: 1, note: 'Images only, served from a cache in Taipei.' },
];

const REFUSALS = [
    { when: 'Nov 2024', who: 'An advertising network', wanted: 'The purchase list, to build a lookalike audience out of it.', said: 'The offer was NT$140,000 a year, which is a lathe and a month of somebody\'s time. It took an afternoon to say no and about four minutes to decide.' },
    { when: 'Jun 2025', who: 'A second-hand marketplace', wanted: 'The serial-to-owner map, so listings could be verified against it.', said: 'We offered to answer yes or no on a serial with no name attached, which does the same job. They stopped replying.' },
    { when: 'Feb 2026', who: 'A district prosecutor\'s office', wanted: 'One customer\'s order history, by email, with nothing attached.', said: 'We asked for the warrant. Nothing came back, and nothing went out. If one arrives we will comply with exactly what it names and tell the customer unless we are ordered not to.' },
];

const SPELL = ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

export function PrivacyShared() {
    const [picked, setPicked] = useState('all');

    const shown = HOLDERS.filter((holder) => picked === 'all' || holder.control === picked);
    const count = picked === 'all' ? 'showing all nine' : `showing ${SPELL[shown.length]} of nine`;

    const toolbar = (
        <div className="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span className="font-mono text-[10px] text-zinc-600">9 companies · 4 countries · 0 advertisers</span>

            <span className="hidden font-mono text-[10px] text-zinc-700 sm:inline">{count}</span>

            <div className="ml-auto flex flex-wrap items-center gap-1">
                {FILTERS.map((filter) => (
                    <button
                        key={filter.key}
                        type="button"
                        className={`rounded-lg px-2.5 py-1 text-[12px] transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                            picked === filter.key ? 'bg-white/8 text-cream' : 'text-zinc-500'
                        }`}
                        onClick={() => setPicked(filter.key)}
                    >{filter.label}</button>
                ))}
            </div>
        </div>
    );

    return (
        <PrivacyShell active="Who sees it" toolbar={toolbar}>
            <div className="mx-auto max-w-6xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">Everyone outside the workshop who sees any of it</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Nine companies, named, with the exact fields each one is handed and the country it lands in. Five of them are
                    unavoidable — you cannot pay, post or invoice without somebody. Three you can dodge by collecting at the counter,
                    and one does not run until you switch it on. Nobody on this list is in the business of advertising.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.7fr_1fr]">
                    <section>
                        <div className="flex flex-col gap-3">
                            {shown.map((holder) => <PrivacyHolder key={holder.name} {...holder} />)}
                        </div>

                        {shown.length === 0 && <p className="mt-3 text-[12px]/5 text-zinc-600">Nothing under this filter.</p>}

                        <p className="mt-4 text-[11px]/5 text-zinc-600">
                            None of the nine may use what they are given for anything except the job named beside their name. That is a
                            clause in a contract rather than a law of physics, so it is worth saying plainly: we would find out about a
                            breach the same way you would.
                        </p>
                    </section>

                    <aside>
                        <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where it physically sits</h2>
                        <div className="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            {COUNTRIES.map((country) => (
                                <div key={country.name} className="px-3.5 py-3">
                                    <p className="flex items-baseline gap-2">
                                        <span className="text-[13px] text-cream">{country.name}</span>
                                        <span className="ml-auto font-mono text-[11px] text-zinc-500">{country.count}</span>
                                    </p>
                                    <p className="mt-1 text-[11px]/5 text-zinc-600">{country.note}</p>
                                </div>
                            ))}
                        </div>

                        <h2 className="mt-7 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Who asked and was told no</h2>
                        <div className="mt-3 space-y-3">
                            {REFUSALS.map((refusal) => (
                                <div key={refusal.when} className="rounded-xl border border-white/8 bg-ink-900 p-3.5">
                                    <p className="flex items-baseline gap-2">
                                        <span className="font-mono text-[10px] text-zinc-600">{refusal.when}</span>
                                        <span className="text-[13px] text-cream">{refusal.who}</span>
                                    </p>
                                    <p className="mt-1.5 text-[12px]/5 text-zinc-400">{refusal.wanted}</p>
                                    <p className="mt-2 border-l-2 border-jade-500/40 pl-2.5 text-[11px]/5 text-zinc-500">{refusal.said}</p>
                                </div>
                            ))}
                        </div>

                        <div className="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Seven years of asking</p>
                            <p className="mt-2 text-[12px]/5 text-zinc-400">
                                Four requests for something nobody was entitled to. One arrived with a court order and got precisely
                                what the order named — one customer, one date range, nothing either side of it. The other three left
                                empty-handed and are written up above.
                            </p>
                            <p className="mt-2.5 font-mono text-[10px] text-zinc-600">Updated 12 June 2026. If this paragraph ever quietly disappears, read something into that.</p>
                        </div>
                    </aside>
                </div>
            </div>
        </PrivacyShell>
    );
}
