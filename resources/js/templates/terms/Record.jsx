import { useState } from 'react';
import { TermsShell } from './Shell';
import { TermsStamp } from './Stamp';
import { TermsNotice } from './Notice';

const HASH = '8f2c41ab6e3d0917c2f4a58b7d1e6033b9c04af281e5d7620b3a9c1f4e8d5720';

const ACCEPTED = [
    { label: 'When', value: '12 March 2026, 09:41 Taipei time', mono: true },
    { label: 'Who', value: 'tomas@ferreira.pt', mono: true },
    { label: 'How', value: 'Ticked at checkout, on the order below. Not a banner, and not by continuing to browse.' },
    { label: 'From', value: '85.240.14.0/24 · Lisbon, Portugal', mono: true },
    { label: 'Order', value: 'NS-2026-0114', mono: true },
];

const EARLY = [
    { label: 'When', value: 'Today, from this page', mono: true },
    { label: 'Who', value: 'tomas@ferreira.pt', mono: true },
    { label: 'Covers', value: 'Orders placed from now on. NS-2026-0114 stays on 4.1.' },
];

const ORDERS = [
    { ref: 'NS-2026-0114', placed: '12 Mar 2026', what: 'NS-B grinder, graphite', version: '4.1', state: 'current' },
    { ref: 'NS-2025-0871', placed: '18 Nov 2025', what: 'Burr set and anti-static collar', version: '4.0', state: 'frozen' },
    { ref: 'NS-2024-0330', placed: '2 Sep 2024', what: 'NS-B grinder, cream', version: '3.1', state: 'frozen' },
];

const HISTORY = [
    { version: '4.1', span: 'since 12 Mar 2026', hash: '8f2c41ab', yours: true },
    { version: '4.0', span: 'Nov 2025 – Mar 2026', hash: 'd704e19c', yours: true },
    { version: '3.1', span: 'Aug 2024 – Nov 2025', hash: '5b93aa07', yours: true },
    { version: '3.0', span: 'Feb 2023 – Aug 2024', hash: 'c118d5e2', yours: false },
    { version: '2.0', span: 'Jun 2021 – Feb 2023', hash: '9ae60f44', yours: false },
    { version: '1.0', span: 'Apr 2019 – Jun 2021', hash: '2d5c8b31', yours: false },
];

const KEPT = [
    { what: 'The version and the timestamp', detail: 'To the second, in Taipei time, because that is what decides which document your order sits under.' },
    { what: 'The first three octets of the address', detail: 'Enough to say the click came from Portugal and not from us. The last one is thrown away on write.' },
    { what: 'Nothing about the browser', detail: 'No user agent, no fingerprint, no session replay. A tick and a clock is the whole record.' },
];

export function TermsRecord() {
    const [copied, setCopied] = useState(false);
    const [takenEarly, setTakenEarly] = useState(false);

    const copy = () => {
        navigator.clipboard?.writeText(HASH);
        setCopied(true);
        setTimeout(() => setCopied(false), 1600);
    };

    const toolbar = (
        <div className="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span className="flex items-baseline gap-2">
                <span className="font-mono text-[13px] text-cream">4.1</span>
                <span className="font-mono text-[10px] text-zinc-600">accepted 12 Mar 2026</span>
            </span>
            <span className="font-mono text-[10px] text-zinc-700">tomas@ferreira.pt</span>
            <a
                href="/templates/terms/screens/changes"
                target="_top"
                className="ml-auto font-mono text-[11px] text-amber-300/90 transition-colors duration-150 hover:text-amber-300"
            >4.2 lands in 28 days →</a>
        </div>
    );

    return (
        <TermsShell active="Your copy" rail={false} toolbar={toolbar}>
            <div className="mx-auto max-w-5xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">What you agreed to, and when you did it</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Not the current terms — yours. Three orders sitting under three different versions, the oldest of which is
                    still binding on us and will be until the machine dies. A terms page that only ever shows today's text is
                    hiding the only version that matters to you.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.5fr_1fr]">
                    <section className="flex flex-col gap-6">
                        <TermsStamp
                            version="4.1"
                            state="accepted"
                            when="in force for you"
                            rows={ACCEPTED}
                            hash={HASH}
                            note="This is the text as it stood that morning, not the text as it stands now. If 4.1 is ever amended, this copy does not move with it."
                            actions={
                                <>
                                    <a
                                        href="/templates/terms/screens/document"
                                        target="_top"
                                        className="rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                                    >Read the copy you accepted</a>

                                    <button
                                        type="button"
                                        onClick={copy}
                                        className={`rounded-lg border border-white/12 px-3 py-1.5 text-[12px] transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                                            copied ? 'text-jade-400' : 'text-zinc-300'
                                        }`}
                                    >{copied ? 'Copied' : 'Copy the hash'}</button>
                                </>
                            }
                        />

                        {takenEarly ? (
                            <TermsStamp
                                version="4.2"
                                state="accepted"
                                when="taken early, today"
                                rows={EARLY}
                                note="It would have reached you on 15 September anyway. Taking it early only means the next order does not have to think about which version it is under."
                            />
                        ) : (
                            <TermsNotice
                                version="4.2"
                                effective="15 September 2026"
                                announced="1 Aug 2026"
                                days={28}
                                window={45}
                                elapsed={17}
                                lead="Nothing is being taken away from you, so we are telling you rather than asking. You can take it early if you would rather not run two versions across two open orders."
                                promise="Order NS-2026-0114 stays on 4.1 whatever you do here. Accepting early moves the next order, not the last one."
                                actions={
                                    <>
                                        <button
                                            type="button"
                                            onClick={() => setTakenEarly(true)}
                                            className="rounded-lg bg-jade-500 px-3 py-1.5 text-[12px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                        >Take 4.2 now</button>

                                        <a
                                            href="/templates/terms/screens/changes"
                                            target="_top"
                                            className="rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                                        >Read the four diffs first</a>
                                    </>
                                }
                            />
                        )}

                        <section>
                            <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Your orders, and the version each one is stuck to</h2>
                            <p className="mt-2 max-w-xl text-[12px]/5 text-zinc-500">
                                Three orders, three versions. The 2024 one is under terms that gave you seven days rather than
                                fourteen — we are not going to hold you to that, but it is what the paper says and pretending
                                otherwise would make the whole record worthless.
                            </p>

                            <div className="mt-3.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                                {ORDERS.map((order) => (
                                    <div key={order.ref} className="flex flex-wrap items-baseline gap-x-4 gap-y-1 px-3.5 py-3">
                                        <span className="font-mono text-[12px] text-zinc-300">{order.ref}</span>
                                        <span className="font-mono text-[10px] text-zinc-700">{order.placed}</span>
                                        <span className="min-w-0 flex-1 truncate text-[12px] text-zinc-500">{order.what}</span>
                                        <span
                                            className={`shrink-0 rounded border px-1.5 py-0.5 font-mono text-[10px] ${
                                                order.state === 'current' ? 'border-jade-500/40 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-600'
                                            }`}
                                        >under {order.version}</span>
                                    </div>
                                ))}
                            </div>
                        </section>
                    </section>

                    <aside>
                        <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Every version, kept</h2>
                        <p className="mt-2 text-[12px]/5 text-zinc-500">Marked ones are versions you have personally been under.</p>

                        <div className="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            {HISTORY.map((entry) => (
                                <div key={entry.version} className="flex items-baseline gap-3 px-3 py-2.5">
                                    <span className={`font-mono text-[12px] ${entry.yours ? 'text-cream' : 'text-zinc-600'}`}>{entry.version}</span>
                                    {entry.yours && <span className="size-1.5 shrink-0 rounded-full bg-jade-400"></span>}
                                    <span className="min-w-0 flex-1 truncate font-mono text-[10px] text-zinc-700">{entry.span}</span>
                                    <span className="shrink-0 font-mono text-[10px] text-zinc-700">{entry.hash}</span>
                                </div>
                            ))}
                        </div>

                        <h2 className="mt-7 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What the record holds</h2>
                        <div className="mt-3 space-y-3.5">
                            {KEPT.map((entry) => (
                                <div key={entry.what} className="border-l border-white/8 pl-3">
                                    <p className="text-[12px] text-zinc-300">{entry.what}</p>
                                    <p className="mt-1 text-[11px]/5 text-zinc-500">{entry.detail}</p>
                                </div>
                            ))}
                        </div>

                        <div className="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] text-zinc-600">Nobody here can edit this</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">
                                Acceptances are written once and never updated. If we ever need to correct one, the correction goes
                                in as a second row with a reason on it and both stay visible — to you and to us.
                            </p>
                            <a
                                href="/templates/contact/screens/write"
                                target="_top"
                                className="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >Query a row</a>
                        </div>
                    </aside>
                </div>
            </div>
        </TermsShell>
    );
}
