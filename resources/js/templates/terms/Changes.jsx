import { useState } from 'react';
import { TermsShell } from './Shell';
import { TermsNotice } from './Notice';
import { TermsRevision } from './Revision';
import { TermsDiff } from './Diff';

const VERSIONS = [
    {
        version: '4.2',
        date: '15 Sep 2026',
        state: 'pending',
        lead: 'A bigger burr allowance, a floor under the liability cap, and mediation before anybody files anything.',
        touched: ['06', '08', '12', '14'],
        consent: false,
        asked: 'Fifty warranty letters and one repair that should never have been argued about.',
        note: null,
        diffs: [
            {
                clause: '08',
                title: 'Burrs, and what wears out',
                verdict: 'better for you',
                why: 'Fifty machines came back with burrs measured past 380 kg and still cutting inside spec. The old number was set by guessing in 2021 and it was too low.',
                lines: [
                    { mark: ' ', text: 'Burrs, the anti-static collar and the rubber feet are consumables.' },
                    { mark: '-', text: 'The warranty in clause 06 does not cover them beyond 300 kg through the machine.' },
                    { mark: '+', text: 'The warranty in clause 06 does not cover them beyond 500 kg through the machine,' },
                    { mark: '+', text: 'or three years from delivery, whichever comes first.' },
                ],
            },
            {
                clause: '12',
                title: 'What we owe you if it goes wrong',
                verdict: 'better for you',
                why: 'A cap that tracks the price punishes whoever bought the cheapest machine, and they are the least able to absorb it. The floor costs us almost nothing and fixes that.',
                lines: [
                    { mark: '-', text: 'what we owe you is capped at the price you paid for the machine in question.' },
                    { mark: '+', text: 'what we owe you is capped at the price you paid for the machine in question,' },
                    { mark: '+', text: 'or NT$40,000, whichever is the greater.' },
                ],
            },
            {
                clause: '06',
                title: 'The two-year warranty',
                verdict: 'better for you',
                why: 'Three frames cracked at the collar mount in 2025. We paid for all three anyway, which is exactly the sort of thing that should stop being a favour and start being a clause.',
                lines: [
                    { mark: '-', text: 'Two years from delivery on the motor, the gearbox and the electronics.' },
                    { mark: '+', text: 'Two years from delivery on the motor, the gearbox, the electronics and the frame.' },
                ],
            },
            {
                clause: '14',
                title: 'Law, and where an argument goes',
                verdict: 'about even',
                why: 'Two disputes in seven years, both settled in an afternoon once somebody neutral was in the room. Writing the step down costs you a fortnight and saves you a lawyer.',
                lines: [
                    { mark: ' ', text: 'Taiwan law applies.' },
                    { mark: '+', text: 'Before either side files anything we will sit down at the Taipei Bar' },
                    { mark: '+', text: "Association's mediation service." },
                    { mark: ' ', text: 'After that, the Taipei District Court.' },
                ],
            },
        ],
    },
    {
        version: '4.1',
        date: '12 Mar 2026',
        state: 'force',
        lead: 'Fourteen days to change your mind, a warranty that follows the machine, and a liability clause that would survive being read out in court.',
        touched: ['05', '06', '12'],
        consent: false,
        asked: 'One letter from Kaohsiung and a lawyer who told us clause 12 was worthless.',
        note: null,
        diffs: [
            {
                clause: '05',
                title: 'Changing your mind',
                verdict: 'better for you',
                why: 'Wen-Yu in Kaohsiung wrote in and said seven days was the legal minimum dressed up as generosity. She was right, so it is fourteen.',
                lines: [
                    { mark: '-', text: 'You may return the machine within seven days of delivery.' },
                    { mark: '+', text: 'You may return the machine within fourteen days of delivery,' },
                    { mark: '+', text: 'and we do not ask why.' },
                ],
            },
            {
                clause: '06',
                title: 'The two-year warranty',
                verdict: 'better for you',
                why: "A Nomad holds its price and tends to end up on somebody else's counter for a decade. Killing the cover at the first resale served nobody, including us.",
                lines: [
                    { mark: '-', text: 'The warranty is personal to the original purchaser.' },
                    { mark: '+', text: 'The warranty transfers with the machine, so a second-hand buyer keeps' },
                    { mark: '+', text: 'whatever is left of it.' },
                ],
            },
            {
                clause: '12',
                title: 'What we owe you if it goes wrong',
                verdict: 'about even',
                why: 'The old line was unenforceable and everyone who drafts these knows it. We swapped a bluff for the cap we would actually argue for, and named the three things no cap can touch.',
                lines: [
                    { mark: '-', text: 'We shall not be liable for any loss howsoever arising.' },
                    { mark: '+', text: 'Where we are at fault, what we owe you is capped at the price you paid.' },
                    { mark: '+', text: 'Nothing limits our liability for death or personal injury caused by us,' },
                    { mark: '+', text: 'for fraud, or for anything the Consumer Protection Act protects.' },
                ],
            },
        ],
    },
    {
        version: '4.0',
        date: '3 Nov 2025',
        state: 'retired',
        lead: 'The whole document rewritten in shorter sentences. Nothing changed in substance, which is why it went out with thirty days of notice and no fanfare.',
        touched: ['all'],
        consent: false,
        asked: 'Nobody. We could not read our own terms without losing the thread.',
        note: null,
        diffs: [
            {
                clause: '03',
                title: 'Ordering, price, and when we charge',
                verdict: 'about even',
                why: 'Same meaning, two fifths of the words. Nobody has written in to ask what clause 03 means since, which is the only test that mattered.',
                lines: [
                    { mark: '-', text: 'The Seller shall not be obliged to accept any order placed by the Buyer' },
                    { mark: '-', text: 'and no contract shall come into existence until such time as the Seller' },
                    { mark: '-', text: 'has issued a written confirmation of acceptance thereof.' },
                    { mark: '+', text: 'An order is an offer to buy until we confirm it.' },
                ],
            },
        ],
    },
    {
        version: '3.1',
        date: '5 Aug 2024',
        state: 'retired',
        lead: 'Batch charging written down, two years after we started doing it. The practice was fine; the page was lying.',
        touched: ['03'],
        consent: false,
        asked: 'A customer who noticed the charge landed eleven weeks after the order and assumed something had gone wrong.',
        note: null,
        diffs: [
            {
                clause: '03',
                title: 'Ordering, price, and when we charge',
                verdict: 'better for you',
                why: 'We had been authorising and charging at dispatch since the second batch. Saying so turned a monthly support question into no question at all.',
                lines: [
                    { mark: '-', text: 'Payment is taken at the time of order.' },
                    { mark: '+', text: 'Your card is authorised when you order and charged the day your batch' },
                    { mark: '+', text: 'leaves the bench, which can be up to eleven weeks later.' },
                ],
            },
        ],
    },
    {
        version: '3.0',
        date: '20 Feb 2023',
        state: 'retired',
        lead: 'Dealer supply moved out into its own signed agreement, and eight clauses left this page with it.',
        touched: ['02', '10'],
        consent: true,
        asked: 'Eleven shops, all of whom had to sign the new paper before the next delivery.',
        note: null,
        diffs: [
            {
                clause: '02',
                title: 'What these cover',
                verdict: 'about even',
                why: 'Eight clauses that applied to eleven shops and nobody else were making the page longer for four thousand readers a month.',
                lines: [
                    { mark: '-', text: 'Wholesale purchasers are additionally subject to clauses 15 to 22 below.' },
                    { mark: '+', text: 'Dealer supply runs on a separately signed agreement; where the two' },
                    { mark: '+', text: 'conflict, the signed one prevails.' },
                ],
            },
        ],
    },
    {
        version: '2.0',
        date: '14 Jun 2021',
        state: 'retired',
        lead: 'The first version with a warranty in it. Before this the warranty was a sentence Ines typed into every order mail.',
        touched: ['06', '07', '08'],
        consent: true,
        asked: 'The first machine to come back with a dead motor, at fourteen months.',
        note: null,
        diffs: [
            {
                clause: '06',
                title: 'The two-year warranty',
                verdict: 'better for you',
                why: 'Same promise Ines had been making by hand since 2019, finally in a place you could check without writing to her.',
                lines: [
                    { mark: '+', text: 'Two years from delivery on the motor, the gearbox and the electronics.' },
                    { mark: '+', text: 'Burrs, the anti-static collar and the rubber feet are consumables.' },
                ],
            },
        ],
    },
    {
        version: '1.0',
        date: '2 Apr 2019',
        state: 'retired',
        lead: 'Nine clauses on one page, written on a Sunday from a Ministry of Economic Affairs template and a lot of deleting.',
        touched: [],
        consent: false,
        asked: 'The bank, before it would open a merchant account.',
        note: 'There is nothing to diff against. Clauses 01 and 10 survive from this version almost word for word, which is either a compliment to Ines or an indictment of the six revisions since.',
        diffs: [],
    },
];

const HOW = [
    { what: 'Thirty days, minimum', detail: 'Every version gets at least thirty days between the announcement and the day it bites. 4.2 got forty-five because it landed in August.' },
    { what: 'A diff, not a summary', detail: 'Struck out, added, and the reason underneath. A bullet list saying "we have updated our terms" tells you nothing and takes the same effort to write.' },
    { what: 'Your order does not move', detail: 'It stays on the version in force the day you placed it. Seven versions exist and all seven are still binding on somebody.' },
    { what: 'A right taken away gets asked', detail: 'Notice is enough to give you something. Cutting something you already hold needs a yes, which is why 3.0 and 2.0 are marked as they are.' },
];

export function TermsChanges() {
    const [picked, setPicked] = useState('4.2');

    const shown = VERSIONS.find((version) => version.version === picked);

    const toolbar = (
        <div className="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span className="font-mono text-[10px] text-zinc-600">Seven versions since April 2019</span>
            <span className="font-mono text-[10px] text-zinc-700">promised notice 30 days · this one got 45</span>
            <a
                href="/templates/terms/screens/document"
                target="_top"
                className="ml-auto font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300"
            >read 4.1 in full →</a>
        </div>
    );

    return (
        <TermsShell active="What changed" rail={false} toolbar={toolbar}>
            <div className="mx-auto max-w-5xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">Every version, and why it moved</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Terms pages usually appear fully formed with a date on them and no history at all. These have been rewritten
                    seven times in seven years, twice because somebody wrote in and argued, and the argument is in the note under
                    the diff.
                </p>

                <TermsNotice
                    className="mt-6"
                    version="4.2"
                    effective="15 September 2026"
                    announced="1 Aug 2026"
                    days={28}
                    window={45}
                    elapsed={17}
                    lead="Four clauses. Three of them give you something and the fourth puts a mediator between us before either side can file anything."
                    promise="You do not have to do anything. It takes effect on the date whether or not you read it, and every order you have already placed stays under 4.1 for good."
                    actions={
                        <a
                            href="/templates/terms/screens/record"
                            target="_top"
                            className="rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                        >See which version you are on</a>
                    }
                />

                <div className="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,18rem)_1fr]">
                    <div className="flex flex-col gap-2.5">
                        {VERSIONS.map((version) => (
                            <TermsRevision
                                key={version.version}
                                version={version.version}
                                date={version.date}
                                state={version.state}
                                lead={version.lead}
                                touched={version.touched}
                                consent={version.consent}
                                active={version.version === picked}
                                onSelect={() => setPicked(version.version)}
                            />
                        ))}
                    </div>

                    <div>
                        <div className="flex flex-wrap items-baseline gap-x-3 gap-y-1.5">
                            <h2 className="text-[15px] font-medium tracking-tight text-cream">What {shown.version} did</h2>
                            <span className="font-mono text-[11px] text-zinc-700">{shown.date}</span>
                        </div>

                        <p className="mt-2 max-w-2xl text-[13px]/6 text-zinc-500">{shown.lead}</p>

                        <p className="mt-3 flex flex-wrap items-baseline gap-x-2 gap-y-1">
                            <span className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Who asked for it</span>
                            <span className="text-[12px]/5 text-zinc-400">{shown.asked}</span>
                        </p>

                        {shown.note && (
                            <p className="mt-5 rounded-xl border border-white/8 bg-ink-900 p-4 text-[12px]/5 text-zinc-500">{shown.note}</p>
                        )}

                        {shown.diffs.length > 0 && (
                            <div className="mt-5 flex flex-col gap-3">
                                {shown.diffs.map((diff) => (
                                    <TermsDiff
                                        key={diff.clause}
                                        clause={diff.clause}
                                        title={diff.title}
                                        lines={diff.lines}
                                        why={diff.why}
                                        verdict={diff.verdict}
                                    />
                                ))}
                            </div>
                        )}

                        <section className="mt-8 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">How a change happens here</h2>
                            <div className="mt-3.5 grid grid-cols-1 gap-x-6 gap-y-3.5 sm:grid-cols-2">
                                {HOW.map((entry) => (
                                    <div key={entry.what} className="border-l border-white/8 pl-3">
                                        <p className="text-[12px] text-zinc-300">{entry.what}</p>
                                        <p className="mt-1 text-[11px]/5 text-zinc-500">{entry.detail}</p>
                                    </div>
                                ))}
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </TermsShell>
    );
}
