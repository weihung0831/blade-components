import { useState } from 'react';
import { PrivacyShell } from './Shell';
import { PrivacyConsent } from './Consent';

const SWITCHES = [
    {
        key: 'needed',
        name: 'Strictly needed',
        state: 'locked',
        lead: 'The basket, the sign-in, and the check the payment processor runs before it agrees to take money.',
        breaks: 'Nothing works. There is no version of a shop that forgets what you put in the basket between one page and the next.',
        items: [
            { name: 'nomad_session', life: 'until the tab closes' },
            { name: 'XSRF-TOKEN', life: '2 hours' },
            { name: 'ecpay_guard', life: '30 minutes' },
        ],
    },
    {
        key: 'remembering',
        name: 'Remembering you',
        state: 'off',
        lead: 'Your settings on the configurator, the currency you read prices in, and the fact that you have already dismissed the bar at the bottom of this page.',
        breaks: 'The configurator starts blank each time and the bar comes back on every visit. That is not us punishing you for saying no — it is what off actually means, and pretending otherwise is how these pages get untrustworthy.',
        items: [
            { name: 'nomad_prefs', life: '1 year' },
            { name: 'nomad_bar', life: '6 months' },
        ],
    },
    {
        key: 'counting',
        name: 'Counting visits',
        state: 'off',
        lead: 'Plausible, on a German server. No cookie at all: a hash of your address and today\'s date, thrown out at midnight.',
        breaks: 'We do not know anybody came. What people read gets worked out from the mail they send instead, which is slower and, on the evidence so far, more useful.',
        items: [
            { name: 'no cookie', life: 'none set' },
            { name: 'daily hash', life: 'gone at midnight' },
        ],
    },
    {
        key: 'mail',
        name: 'Hearing from us',
        state: 'off',
        lead: 'Six mails a year, plus a note when something you were looking at comes back onto the shelf.',
        breaks: 'Nothing on the site changes at all. You simply do not get the mail.',
        items: [
            { name: 'nomad_mail', life: 'until you unsubscribe' },
        ],
    },
];

const OUTSIDE = [
    { name: 'The web log', why: 'Fourteen days of addresses, kept so that somebody hammering the checkout can be slowed down.', basis: 'legitimate interest' },
    { name: 'The invoice', why: 'Seven years, because 稅捐稽徵法 says seven years and does not take requests.', basis: 'legal obligation' },
    { name: 'A mail you sent us', why: 'You wrote to us. Answering it is the contract, and there is no switch for a conversation you started.', basis: 'contract' },
];

export function PrivacyControls() {
    const [on, setOn] = useState({ remembering: false, counting: false, mail: false });

    const isOn = (item) => item.state === 'locked' || on[item.key] === true;
    const count = `${SWITCHES.filter(isOn).length} of ${SWITCHES.length} on`;
    const setAll = (wanted) => setOn({ remembering: wanted, counting: wanted, mail: wanted });

    const toolbar = (
        <div className="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span className="font-mono text-[10px] text-zinc-500">{count}</span>

            <span className="hidden font-mono text-[10px] text-zinc-700 sm:inline">nothing here is on unless you turned it on</span>

            <div className="ml-auto flex items-center gap-1.5">
                <button
                    type="button"
                    className="rounded-lg border border-white/12 px-2.5 py-1 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    onClick={() => setAll(false)}
                >Turn it all off</button>
                <button
                    type="button"
                    className="rounded-lg border border-white/12 px-2.5 py-1 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    onClick={() => setAll(true)}
                >Turn it all on</button>
            </div>
        </div>
    );

    return (
        <PrivacyShell active="Your switches" toolbar={toolbar}>
            <div className="mx-auto max-w-4xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">Four switches, and what each one breaks</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Three of the four are off until you turn them on, which is why this page opens saying one of four rather than
                    congratulating you on a choice you never made. Each switch names the cookies it sets and how long they last, and
                    then says what stops working without it — because the honest cost of saying no is the only part of a consent
                    screen worth reading.
                </p>

                <div className="mt-6 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                    {SWITCHES.map((item) => (
                        <PrivacyConsent
                            key={item.key}
                            name={item.name}
                            state={item.state}
                            lead={item.lead}
                            breaks={item.breaks}
                            items={item.items}
                            on={isOn(item)}
                            onToggle={(value) => setOn((current) => ({ ...current, [item.key]: value }))}
                        />
                    ))}
                </div>

                <p className="mt-3 text-[11px]/5 text-zinc-600">
                    Your answer lives in one cookie on your own machine and nowhere else. We hold no record of what you chose, which
                    also means we cannot put it back if you clear it — you would land here again with three of four off.
                </p>

                <section className="mt-9">
                    <h2 className="text-[15px] font-medium tracking-tight text-cream">The bar itself</h2>
                    <p className="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                        What a first-time visitor sees, at the bottom of the page, once. Refusing is one click and it is the same
                        size, the same weight and the same distance from your thumb as accepting. The version where the reject button
                        is a grey word in the corner took ten minutes to build and we deleted it.
                    </p>

                    <div className="mt-3 rounded-xl border border-white/8 bg-ink-800 p-4">
                        <div className="flex flex-col gap-3.5 sm:flex-row sm:items-center sm:gap-5">
                            <div className="min-w-0 flex-1">
                                <p className="text-[13px] text-cream">Three optional things, off right now</p>
                                <p className="mt-1 text-[12px]/5 text-zinc-500">
                                    Settings you keep, a visit counter with no cookie in it, and the mail. None of them is running yet.
                                    {' '}
                                    <a href="#" className="text-jade-400 transition-colors duration-150 hover:text-jade-300">Pick them one at a time</a>
                                    {' '}
                                    if you would rather.
                                </p>
                            </div>
                            <div className="flex shrink-0 gap-2">
                                <button
                                    type="button"
                                    className="rounded-lg border border-white/15 px-3.5 py-1.5 text-[13px] text-zinc-200 transition-colors duration-150 outline-none hover:border-white/30 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    onClick={() => setAll(false)}
                                >No thanks</button>
                                <button
                                    type="button"
                                    className="rounded-lg bg-jade-500 px-3.5 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    onClick={() => setAll(true)}
                                >All three, fine</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section className="mt-9">
                    <h2 className="text-[15px] font-medium tracking-tight text-cream">What the switches do not reach</h2>
                    <p className="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                        Three things carry on whatever you do here, because they do not run on your permission in the first place. A
                        switch that cannot be switched off is a lie, so they are listed rather than drawn.
                    </p>

                    <div className="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        {OUTSIDE.map((row) => (
                            <div key={row.name} className="flex flex-col gap-1.5 px-4 py-3 sm:flex-row sm:items-baseline sm:gap-5">
                                <p className="w-full shrink-0 text-[13px] text-cream sm:w-44">{row.name}</p>
                                <p className="min-w-0 flex-1 text-[12px]/5 text-zinc-500">{row.why}</p>
                                <p className="shrink-0 font-mono text-[10px] text-zinc-600">{row.basis}</p>
                            </div>
                        ))}
                    </div>
                </section>

                <section className="mt-4 flex flex-wrap items-center gap-x-6 gap-y-3 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <div className="min-w-0 flex-1">
                        <p className="text-[13px] text-cream">Turning something off does not delete what it already collected</p>
                        <p className="mt-1 text-[12px]/5 text-zinc-500">
                            It stops the next one. If you want what is already there gone, that is a different button and it is on the
                            next page along.
                        </p>
                    </div>
                    <a
                        href="/templates/privacy/screens/request"
                        target="_top"
                        className="shrink-0 rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                    >Ask us to erase it</a>
                </section>
            </div>
        </PrivacyShell>
    );
}
