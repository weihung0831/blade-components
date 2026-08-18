import { useState } from 'react';
import { RefundShell } from './Shell';
import { RefundReason } from './Reason';

const REASONS = [
    {
        key: 'mind',
        label: 'I have changed my mind',
        lead: 'Boxed, under a kilo of coffee through it, inside thirty days.',
        freight: 'You book it, $18 off the refund',
        back: '$1,180 back',
        days: '6 days',
        box: 'The grinder, the burr tool, the cable. Keep the hopper if you want it — we do not sell them separately and it is no use to us.',
    },
    {
        key: 'broken',
        label: 'It arrived damaged',
        lead: 'Send the photograph before you send the machine.',
        freight: 'We book the courier',
        back: '$1,180 back, or a new one tomorrow',
        days: '2 days',
        box: 'Everything, in the packaging it came in. The courier claim wants the box more than we do.',
    },
    {
        key: 'wrong',
        label: 'The wrong thing turned up',
        lead: 'Tell us what is actually in the box.',
        freight: 'We book it, and the right one leaves first',
        back: 'The difference, or all of it',
        days: '1 day',
        box: 'Whatever arrived, sealed if it still is. Do not open it to check — the label photograph is enough.',
    },
    {
        key: 'fault',
        label: 'It has stopped working',
        lead: 'Inside two years this is a repair first, and usually only a repair.',
        freight: 'We pay both directions',
        back: 'Fixed in 9 days, or your money on the third try',
        days: '9 days',
        box: 'The machine and the cable. Leave the burrs in — Wei wants to see them exactly as they came off your counter.',
    },
    {
        key: 'noise',
        label: 'It sounds wrong',
        lead: 'Do not send this one yet. Read the next paragraph first.',
        freight: 'Nothing to send',
        back: 'Probably $0, and twenty minutes',
        days: '0 days',
        box: 'Nothing. A third of the machines returned for noise were burrs bedding in, and every one of them went home unchanged with the customer out an afternoon at the courier office.',
    },
];

const NOTS = [
    'The original box. Any box that survives the trip is fine, and the courier has never once complained.',
    'A reason, if you picked the first option. Thirty days means thirty days.',
    'The receipt. The serial tells us when it left here and who it went to.',
    'A restocking fee, a handling charge, or anything else with a name invented to keep 15%.',
];

const STEPS = [
    { title: 'You tell us', body: 'This form, or a reply to any mail we have ever sent you. No form number, no ticket, no portal password.' },
    { title: 'A label arrives', body: 'Within the hour during working hours. Print it or show the QR at any 7-11 counter — they scan it off a phone.' },
    { title: 'Wei opens it', body: 'Usually the morning it lands. He photographs the burrs before touching anything, and you get those photographs whatever the outcome.' },
    { title: 'The money moves', body: 'Back to the card that paid, the same day the bench signs it off. What happens after that belongs to your bank.' },
];

const TOOLBAR = (
    <div className="flex flex-wrap items-center gap-x-5 gap-y-2">
        <span className="font-mono text-[10px] text-zinc-500">order NS-2608-1174 · EG-83 in graphite · delivered 26 Jul</span>
        <span className="hidden font-mono text-[10px] text-zinc-700 sm:inline">day 23 of 30</span>
        <a
            href="/templates/refund/screens/policy"
            target="_top"
            className="ml-auto rounded-lg px-2.5 py-1 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:bg-white/5 hover:text-jade-300"
        >check the rule first →</a>
    </div>
);

export function RefundSend() {
    const [picked, setPicked] = useState('mind');

    const chosen = REASONS.find((reason) => reason.key === picked) ?? REASONS[0];

    return (
        <RefundShell active="Send it back" toolbar={TOOLBAR}>
            <div className="mx-auto max-w-6xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">Pick the reason and the page does the arithmetic</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Who pays the courier, what lands back on the card, and how long it takes all fall out of one choice, so the choice
                    comes first and the form comes after. One of the five reasons tells you not to send anything, which is the honest
                    answer often enough that it earned a place in the list.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_1.3fr]">
                    <section>
                        <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Why is it coming back</p>
                        <div className="mt-3 flex flex-col gap-2.5">
                            {REASONS.map((reason) => (
                                <RefundReason
                                    key={reason.key}
                                    label={reason.label}
                                    lead={reason.lead}
                                    days={reason.days}
                                    picked={reason.key === picked}
                                    onPick={() => setPicked(reason.key)}
                                />
                            ))}
                        </div>

                        <div className="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we will not ask for</p>
                            <ul className="mt-2.5 space-y-2">
                                {NOTS.map((line) => (
                                    <li key={line} className="flex gap-2.5 text-[12px]/5 text-zinc-400">
                                        <span className="mt-1.5 size-1 shrink-0 rounded-full bg-zinc-700"></span>
                                        <span>{line}</span>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </section>

                    <section>
                        <div className="rounded-xl border border-jade-500/25 bg-jade-500/5 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-jade-400/70 uppercase">If you send it for that reason</p>
                            <div className="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-3">
                                <div>
                                    <p className="font-mono text-[10px] text-zinc-600">Freight</p>
                                    <p className="mt-1 text-[13px]/5 text-cream">{chosen.freight}</p>
                                </div>
                                <div>
                                    <p className="font-mono text-[10px] text-zinc-600">What lands back</p>
                                    <p className="mt-1 text-[13px]/5 text-cream">{chosen.back}</p>
                                </div>
                                <div>
                                    <p className="font-mono text-[10px] text-zinc-600">Median, start to bank</p>
                                    <p className="mt-1 text-[13px]/5 text-cream">{chosen.days}</p>
                                </div>
                            </div>
                            <p className="mt-3.5 border-t border-jade-500/15 pt-3 text-[12px]/5 text-zinc-400">{chosen.box}</p>
                        </div>

                        <form className="mt-5 flex flex-col gap-4">
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <label className="block">
                                    <span className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Order number</span>
                                    <input
                                        type="text"
                                        defaultValue="NS-2608-1174"
                                        readOnly
                                        className="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 font-mono text-[12px] text-zinc-400 outline-none"
                                    />
                                </label>
                                <label className="block">
                                    <span className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Serial, under the base</span>
                                    <input
                                        type="text"
                                        placeholder="NS-4471"
                                        className="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 font-mono text-[12px] text-zinc-200 outline-none transition-colors duration-150 placeholder:text-zinc-700 focus:border-jade-500/60 focus-visible:ring-2 focus-visible:ring-jade-500/40"
                                    />
                                </label>
                            </div>

                            <label className="block">
                                <span className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">What happened</span>
                                <textarea
                                    rows="4"
                                    placeholder="A sentence is plenty. Wei reads these before he opens the box, and what you write here is what he goes looking for."
                                    className="mt-1.5 w-full resize-none rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px]/6 text-zinc-200 outline-none transition-colors duration-150 placeholder:text-zinc-700 focus:border-jade-500/60 focus-visible:ring-2 focus-visible:ring-jade-500/40"
                                ></textarea>
                            </label>

                            <label className="block">
                                <span className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Where the courier collects</span>
                                <input
                                    type="text"
                                    defaultValue="台中市西區民生路 227 巷 3 號"
                                    className="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px] text-zinc-200 outline-none transition-colors duration-150 focus:border-jade-500/60 focus-visible:ring-2 focus-visible:ring-jade-500/40"
                                />
                                <span className="mt-1.5 block text-[11px]/5 text-zinc-600">Or drop it at any 7-11 with the QR on your phone. Most people do that and it saves a day.</span>
                            </label>

                            <div className="flex flex-col gap-3 rounded-xl border border-white/8 bg-ink-900 p-4 sm:flex-row sm:items-center sm:gap-5">
                                <p className="min-w-0 flex-1 text-[12px]/5 text-zinc-500">
                                    Nothing is charged and nothing is final. The label sits unused for a fortnight if you change your
                                    mind about changing your mind, and plenty of people do.
                                </p>
                                <div className="flex shrink-0 gap-2">
                                    <button type="button" className="rounded-lg border border-white/15 px-3.5 py-1.5 text-[13px] text-zinc-200 transition-colors duration-150 outline-none hover:border-white/30 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Ask first</button>
                                    <button type="button" className="rounded-lg bg-jade-500 px-3.5 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Send me a label</button>
                                </div>
                            </div>
                        </form>

                        <h2 className="mt-8 text-[15px] font-medium tracking-tight text-cream">The four things that happen next</h2>
                        <ol className="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            {STEPS.map((step, index) => (
                                <li key={step.title} className="flex gap-3.5 px-3.5 py-3">
                                    <span className="mt-0.5 shrink-0 font-mono text-[11px] text-jade-400">{String(index + 1).padStart(2, '0')}</span>
                                    <span className="min-w-0 flex-1">
                                        <span className="block text-[13px] text-cream">{step.title}</span>
                                        <span className="mt-1 block text-[12px]/5 text-zinc-500">{step.body}</span>
                                    </span>
                                </li>
                            ))}
                        </ol>
                    </section>
                </div>
            </div>
        </RefundShell>
    );
}
