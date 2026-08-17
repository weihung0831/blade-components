import { useState } from 'react';
import { TermsShell } from './Shell';
import { TermsClause } from './Clause';

const COVERS = [
    'Buying a machine, a part or a bag of coffee from nomadsupply.cc',
    'The two-year warranty, and what happens after it',
    'Reading, quoting and reusing anything on this site',
];

const DOES_NOT = [
    'Dealer supply — that runs on a signed agreement, and the signature beats this page',
    'What we do with your address and your serial, which is the privacy notice',
    'Machines bought from a shop, where your contract is with the shop',
];

const CLAUSES = [
    {
        number: '01',
        title: 'Who you are dealing with',
        gloss: 'A company with four people in it, not a brand with a factory somewhere doing the work. The address is where the machines are actually built, and the counter is the same room.',
        body: [
            'Nomad Supply Co., Ltd., registered in Taiwan under number 24681357, at No. 12, Ln. 44, Sec. 3, Bade Rd, Songshan District, Taipei 105.',
            'In everything below, we is that company and you is whoever pays for the machine.',
        ],
    },
    {
        number: '02',
        title: 'What these cover',
        gloss: 'Retail buyers and readers. If you hold a dealer contract with a signature on it, that paper wins wherever the two disagree.',
        body: [
            'These terms govern anything bought from nomadsupply.cc and the use of the site itself. Dealer supply runs on a separately signed agreement; where the two conflict, the signed one prevails.',
            'Work booked in at the counter is covered by clause 07 whether or not the machine came from us.',
        ],
    },
    {
        number: '03',
        title: 'Ordering, price, and when we charge',
        gloss: 'Nothing leaves your account until a machine leaves ours. If the batch slips badly, you get out without a penalty and without asking.',
        body: [
            'An order is an offer to buy until we confirm it. Prices are in New Taiwan dollars and include Taiwanese VAT; we show a converted figure at checkout for information only and your bank decides the rate.',
            'We build in batches of forty. Your card is authorised when you order and charged the day your batch leaves the bench, which can be up to eleven weeks later. If a batch slips more than three weeks past the date we gave you, you may cancel and the authorisation is released.',
        ],
    },
    {
        number: '04',
        title: 'Delivery, customs, and risk',
        bites: true,
        gloss: 'Outside Taiwan the tax bill is yours, and on a machine at this price it can be another quarter on top. We will tell you the tariff code and the value we declare, and we will not under-declare it for you.',
        body: [
            'We ship delivered-at-place. Import duty, VAT and any customs handling in the destination country are yours to pay, and we are not the importer of record.',
            'Risk passes when the courier hands the parcel over. Damage in transit is ours to sort out if you tell us within seven days of delivery and keep the packaging until we have seen a photograph of it.',
        ],
    },
    {
        number: '05',
        title: 'Changing your mind',
        changed: '4.1',
        gloss: 'Fourteen days, no reason needed. Grinding a kilo through it does not cost you the refund; taking the burr chamber apart does.',
        body: [
            'The Consumer Protection Act gives you seven days from delivery. We add seven of our own, so fourteen, and we do not ask why.',
            'Send it back in any box that will survive the trip. We pay the return freight inside Taiwan; from abroad it is yours. A machine that has been run is fine. A machine that has been opened past the burr chamber is not, and we will say so with a photograph rather than a refusal.',
        ],
    },
    {
        number: '06',
        title: 'The two-year warranty',
        changed: '4.1',
        gloss: 'Two years, and it belongs to the machine rather than to you. Selling it on does not kill what is left.',
        body: [
            'Two years from delivery on the motor, the gearbox, the electronics and the frame. It transfers with the machine, so a second-hand buyer keeps whatever is left of it.',
            'We repair first. If we cannot repair it we replace it with the same model, or the nearest one we still build, and we do not charge the difference. Clause 08 lists the parts this does not reach.',
        ],
    },
    {
        number: '07',
        title: 'Repairs outside the warranty',
        gloss: 'You get the number before anything is opened, and you get it again if it moves. Nobody starts work on a quote you have not seen.',
        body: [
            'Bench rate is NT$900 an hour and parts are at cost plus ten per cent. We quote before opening the machine and we ring you if the quote moves by more than a fifth.',
            'A machine bought at auction without a serial we will still look at, but we cannot tell you what is inside it, so we do not guarantee the work.',
        ],
    },
    {
        number: '08',
        title: 'Burrs, and what wears out',
        bites: true,
        gloss: 'Burrs go blunt. That is wear, not a fault, and the two years does not stretch to cover it — though 4.2 pushes the allowance from 300 kg to 500.',
        body: [
            'Burrs, the anti-static collar and the rubber feet are consumables. The warranty in clause 06 does not cover them beyond 300 kg through the machine, which is about three years in a house and four months in a shop.',
            'Replacement burrs are NT$2,400 a set and we will fit them at the counter for nothing while you wait.',
        ],
    },
    {
        number: '09',
        title: 'Your account and the help centre',
        gloss: 'Optional. It holds your orders and your serials so you do not have to dig out a mail from 2023, and nothing else lives in it.',
        body: [
            'You do not need an account to buy anything. If you make one, keep the password to yourself; anything done from inside it we treat as done by you until you tell us otherwise.',
            'Accounts dormant for three years are closed, and we write to you a month before that happens.',
        ],
    },
    {
        number: '10',
        title: 'Our photographs, drawings, and the manual',
        gloss: "Repair guides, reviews, second-hand listings: help yourself. Using our pictures to sell somebody else's grinder: no.",
        body: [
            'The photography, the exploded drawings and the manual are ours. You may reuse them to repair, review, teach or resell a Nomad machine, with a credit and without asking us first.',
            'You may not use them to sell a different machine, or in a way that suggests we built, endorsed or serviced one that we did not.',
        ],
    },
    {
        number: '11',
        title: 'When the site is down',
        gloss: 'No uptime promise on a page that sells grinders. If it falls over mid-checkout nothing was charged and nothing was ordered.',
        body: [
            'The site is a shop, not a service you subscribe to. We do not promise it stays up, and we take it down on purpose when the catalogue changes.',
            'An order that was placed but never confirmed by mail is not an order, whatever the screen said before it broke.',
        ],
    },
    {
        number: '12',
        title: 'What we owe you if it goes wrong',
        changed: '4.1',
        gloss: 'Capped at what you paid, with 4.2 raising the floor to NT$40,000. The caps that would be unlawful are simply not written here, which is why the list of exceptions is short and real.',
        body: [
            'Where we are at fault, what we owe you is capped at the price you paid for the machine in question. We are not liable for lost profit, lost custom, or a morning of espresso that did not happen.',
            'Nothing in this clause limits our liability for death or personal injury caused by us, for fraud, or for anything the Consumer Protection Act does not permit us to limit. Those three are not negotiable and we would not draft them away if they were.',
        ],
    },
    {
        number: '13',
        title: 'Changing these terms',
        gloss: 'Your order stays under the version you actually read on the day you placed it. New versions reach the next order, not the last one.',
        body: [
            "We give at least thirty days' notice before a new version takes effect. Every version since April 2019 stays published on the changes page with a line-by-line diff and the reason for it.",
            'An order is governed by the version in force the day it was placed, and that never moves afterwards. Where a change cuts a right you already have, we ask rather than notify.',
        ],
    },
    {
        number: '14',
        title: 'Law, and where an argument goes',
        bites: true,
        gloss: 'Taipei, in Chinese, unless your own consumer law says otherwise — which across most of the EU it does. Mediation first is not a delaying tactic; it is cheaper than the alternative for both of us.',
        body: [
            "Taiwan law applies. Before either side files anything we will sit down at the Taipei Bar Association's mediation service, which costs a few thousand dollars and usually takes an afternoon.",
            'After that, the Taipei District Court. If you are a consumer resident elsewhere, nothing here removes a right your own law gives you to bring a claim in your own courts.',
        ],
    },
];

export function TermsDocument() {
    const [changedOnly, setChangedOnly] = useState(false);

    const shown = changedOnly ? CLAUSES.filter((clause) => clause.changed) : CLAUSES;

    const toolbar = (
        <div className="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span className="flex items-baseline gap-2">
                <span className="font-mono text-[13px] text-cream">4.1</span>
                <span className="font-mono text-[10px] text-zinc-600">in force since 12 March 2026</span>
            </span>

            <span className="hidden font-mono text-[10px] text-zinc-700 sm:inline">1,940 words · about nine minutes</span>

            <label className="ml-auto flex cursor-pointer items-center gap-2 rounded-lg border border-white/10 px-2.5 py-1 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-white/20 hover:text-cream">
                <input
                    type="checkbox"
                    checked={changedOnly}
                    onChange={(event) => setChangedOnly(event.target.checked)}
                    className="size-3.5 accent-jade-500"
                />
                Only the three 4.1 rewrote
            </label>
        </div>
    );

    return (
        <TermsShell active="The terms" toolbar={toolbar}>
            <div className="mx-auto max-w-3xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">Terms of sale</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Fourteen clauses. Four of them are there to protect us and they are marked as such on the{' '}
                    <a href="/templates/terms/screens/plain" target="_top" className="text-jade-400 transition-colors duration-150 hover:text-jade-300">short version</a>,
                    because a page that pretends every clause is for your benefit is a page nobody believes. The sentence under each
                    clause is the plain reading; where the two disagree, the clause is the one that binds.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <div className="rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">This covers</p>
                        <ul className="mt-2.5 space-y-2">
                            {COVERS.map((line) => (
                                <li key={line} className="flex gap-2.5 text-[12px]/5 text-zinc-400">
                                    <span className="mt-1.5 size-1 shrink-0 rounded-full bg-jade-400/70"></span>
                                    <span>{line}</span>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">This does not</p>
                        <ul className="mt-2.5 space-y-2">
                            {DOES_NOT.map((line) => (
                                <li key={line} className="flex gap-2.5 text-[12px]/5 text-zinc-500">
                                    <span className="mt-1.5 size-1 shrink-0 rounded-full bg-white/20"></span>
                                    <span>{line}</span>
                                </li>
                            ))}
                        </ul>
                    </div>
                </div>

                <div className="mt-8 space-y-5">
                    {shown.map((clause) => (
                        <TermsClause
                            key={clause.number}
                            number={clause.number}
                            title={clause.title}
                            gloss={clause.gloss}
                            changed={clause.changed ?? null}
                            bites={clause.bites ?? false}
                        >
                            {clause.body.map((paragraph) => <p key={paragraph}>{paragraph}</p>)}
                        </TermsClause>
                    ))}
                </div>

                <section className="mt-10 flex flex-wrap items-center gap-x-6 gap-y-3 rounded-xl border border-jade-500/25 bg-jade-500/5 p-4">
                    <div className="min-w-0 flex-1">
                        <p className="text-[13px] text-cream">Argue with a clause and it can move</p>
                        <p className="mt-1 text-[12px]/5 text-zinc-500">
                            Clause 05 got its extra seven days because a customer in Kaohsiung wrote in and said seven was mean.
                            Clause 06 became transferable for the same reason. Quote the number and say what it should say instead.
                        </p>
                    </div>
                    <a
                        href="/templates/contact/screens/write"
                        target="_top"
                        className="shrink-0 rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                    >Write in about a clause</a>
                </section>
            </div>
        </TermsShell>
    );
}
