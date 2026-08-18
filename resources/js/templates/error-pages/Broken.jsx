import { useState } from 'react';
import { ErrorPagesCode } from './Code';
import { ErrorPagesReference } from './Reference';
import { ErrorPagesRoute } from './Route';
import { ErrorPagesService } from './Service';
import { ErrorPagesShell } from './Shell';

const SERVICES = [
    { name: 'Checkout', state: 'down', means: 'The last step. An order that was mid-payment when this started is the reason you are reading this page.', since: '6 min' },
    { name: 'Card payments', state: 'slow', means: 'Going through, taking 8 seconds instead of under one. Nothing has been charged twice.', since: '6 min' },
    { name: 'The shop', state: 'normal', means: 'Browsing, search and the basket are all fine. You can keep filling it.' },
    { name: 'Your account', state: 'normal', means: 'Orders, addresses and past invoices all read normally.' },
    { name: 'Order emails', state: 'slow', means: 'Queued rather than lost. They go out in order once checkout is back.', since: '6 min' },
    { name: 'The desk', state: 'normal', means: 'Ana is at it and already knows about this one.' },
];

const UPDATES = [
    { time: '04:18', who: 'Ana, on the desk', text: 'Confirmed with the bank that nothing settled in the window. Anyone who saw this page has an order held, not a charge.', state: 'now' },
    { time: '04:14', who: 'Wei, on call', text: 'It is the freight quote call. The carrier stopped answering and the checkout waited on it instead of falling back to our own table. Fix is a one-line timeout and it is in review.', state: 'done' },
    { time: '04:12', who: 'automatic', text: 'Checkout started returning 500s. 41 shops affected, 6 orders caught mid-payment. Paged.', state: 'done' },
];

const LINES = [
    { label: 'broke at', value: '04:12:41 GMT+8, writing the order' },
    { label: 'incident', value: 'INC-119, open for 6 minutes' },
    { label: 'your part', value: 'nothing. Stay off the back button.' },
];

export function ErrorPagesBroken() {
    const [notify, setNotify] = useState(false);

    return (
        <ErrorPagesShell
            active="Our fault"
            state="down"
            reference="req_2c81f0d3 · 500 · 04:19 GMT+8"
            toolbar={
                <div className="mx-auto flex max-w-3xl flex-wrap items-center gap-x-4 gap-y-1.5">
                    <span className="flex items-center gap-1.5 font-mono text-[11px] text-red-400">
                        <span className="size-1.5 animate-pulse rounded-full bg-red-400"></span>
                        INC-119 · open 6 minutes
                    </span>
                    <span className="text-[11px] text-zinc-500">41 shops, 6 orders caught mid-payment, none of them charged</span>
                    <span className="ml-auto font-mono text-[10px] text-zinc-600">next update 04:35, whether or not it is fixed</span>
                </div>
            }
        >
            <div className="mx-auto max-w-3xl">
                <ErrorPagesCode
                    code="500"
                    tone="fault"
                    stamp="our fault, not yours"
                    headline="Your order went in. The page that was meant to tell you so did not."
                    sentence="This is the only sentence on the page that matters, so it goes first. Nothing was charged, nothing was lost, and you do not need to do it again — the second time is how people end up with two grinders."
                    lines={LINES} />

                <section className="mt-8 overflow-hidden rounded-xl border border-jade-500/25 bg-jade-500/4">
                    <div className="border-b border-jade-500/15 px-4 py-3">
                        <p className="font-mono text-[10px] tracking-wider text-jade-300 uppercase">The answer to the question you came with</p>
                        <p className="mt-1.5 text-[15px] text-cream">Order NS-24817 is held, and the card has not been touched.</p>
                    </div>

                    <dl className="grid grid-cols-1 divide-y divide-white/5 sm:grid-cols-3 sm:divide-x sm:divide-y-0">
                        <div className="px-4 py-3">
                            <dt className="font-mono text-[10px] text-zinc-600">What we have</dt>
                            <dd className="mt-1 text-[13px]/5 text-zinc-300">One Mk3 grinder and a spare burr set, NT$4,980, going to the Da'an address.</dd>
                        </div>
                        <div className="px-4 py-3">
                            <dt className="font-mono text-[10px] text-zinc-600">The card</dt>
                            <dd className="mt-1 text-[13px]/5 text-zinc-300">Authorised, never captured. The hold falls off by itself inside seven days if we never finish this.</dd>
                        </div>
                        <div className="px-4 py-3">
                            <dt className="font-mono text-[10px] text-zinc-600">What happens</dt>
                            <dd className="mt-1 text-[13px]/5 text-zinc-300">Checkout comes back, we finish it, and you get the confirmation that should have been this page.</dd>
                        </div>
                    </dl>

                    <div className="flex flex-wrap items-center gap-2 border-t border-jade-500/15 px-4 py-3">
                        <a href="#" target="_top" className="rounded-lg border border-jade-500/40 bg-jade-500/10 px-2.5 py-1.5 text-[12px] text-cream transition-colors duration-150 hover:border-jade-500/70">Watch NS-24817</a>

                        <button
                            type="button"
                            onClick={() => setNotify((on) => !on)}
                            className={`rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${notify ? 'border-jade-500/50 text-cream' : 'border-white/10 text-zinc-300 hover:border-jade-500/60 hover:text-cream'}`}
                        >{notify ? 'We will mail you' : 'Mail me when it is finished'}</button>

                        <span className="font-mono text-[10px] text-zinc-600">
                            {notify ? 'goes to the address on NS-24817, once, and that is the end of it' : 'one mail, to the address on the order'}
                        </span>
                    </div>
                </section>

                <div className="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <section>
                        <div className="flex items-baseline gap-3">
                            <h2 className="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What is still working</h2>
                            <span className="h-px min-w-0 flex-1 bg-white/6"></span>
                        </div>

                        <div className="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            {SERVICES.map((service) => <ErrorPagesService key={service.name} {...service} />)}
                        </div>
                    </section>

                    <section>
                        <div className="flex items-baseline gap-3">
                            <h2 className="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What we are doing about it</h2>
                            <span className="h-px min-w-0 flex-1 bg-white/6"></span>
                        </div>

                        <div className="mt-3 rounded-xl border border-white/8 bg-ink-950 p-3.5">
                            <ol className="flex flex-col gap-4">
                                {UPDATES.map((update, index) => (
                                    <li key={update.time} className="flex gap-3">
                                        <span className="flex flex-col items-center pt-1">
                                            <span className={`size-1.5 shrink-0 rounded-full ${update.state === 'now' ? 'bg-red-400' : 'bg-white/25'}`}></span>
                                            {index < UPDATES.length - 1 && <span className="mt-1 w-px flex-1 bg-white/8"></span>}
                                        </span>

                                        <span className="min-w-0 flex-1 pb-1">
                                            <span className="flex items-baseline gap-2">
                                                <span className="font-mono text-[11px] text-zinc-400">{update.time}</span>
                                                <span className="font-mono text-[10px] text-zinc-700">{update.who}</span>
                                            </span>
                                            <span className="mt-1 block text-[12px]/5 text-zinc-400">{update.text}</span>
                                        </span>
                                    </li>
                                ))}
                            </ol>

                            <p className="mt-4 border-t border-white/5 pt-3 text-[11px]/5 text-zinc-600">
                                These are written by whoever is holding it, not by a status tool. The 04:14 one names the cause before
                                we had a fix, which is the point — a page that only says "we are investigating" for forty minutes is
                                a page nobody comes back to.
                            </p>
                        </div>
                    </section>
                </div>

                <div className="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <ErrorPagesReference
                        tone="fault"
                        id="req_2c81f0d3"
                        when="04:12:41 GMT+8, 18 August 2026"
                        region="tpe-1"
                        build="4.2.1 (deployed 15 Aug)"
                        note="Ana can pull the exact request off that reference, including what your basket held. It is worth pasting even if you think the problem is obvious." />

                    <div className="flex flex-col gap-2">
                        <ErrorPagesRoute
                            tone="primary"
                            label="Try the order again in a minute"
                            note="It will pick up the same held order rather than starting a second one. Safe to press."
                            meta="one order, not two"
                            href="#" />

                        <ErrorPagesRoute
                            label="Ring the desk"
                            note="02 2771 4180. It is 04:19 in Taipei, so this rings Wei on call rather than the shop."
                            meta="on call"
                            href="#" />

                        <ErrorPagesRoute
                            label="Read the write-up when it exists"
                            note="Every incident over five minutes gets one within a week, with what we changed so it does not happen twice. Last month's is up."
                            meta="within a week"
                            href="#" />
                    </div>
                </div>
            </div>
        </ErrorPagesShell>
    );
}
