import { RefundShell } from './Shell';
import { RefundStage } from './Stage';

const STEPS = [
    { label: 'You told us', at: '26 Aug, 09:40' },
    { label: 'Label used', at: '26 Aug, 18:12' },
    { label: 'Opened at the bench', at: '28 Aug, 11:02' },
    { label: 'Sent to your card', at: null },
    { label: 'In your account', at: null },
];

const PAID = [
    { name: 'EG-83 grinder, graphite', note: 'coming back', amount: '$1,180', tone: 'back' },
    { name: 'Alignment shim kit', note: 'you are keeping it', amount: '$28', tone: 'kept' },
    { name: 'Dosing cup, 58 mm × 2', note: 'you are keeping them', amount: '$72', tone: 'kept' },
    { name: 'Shipping to Taichung', note: 'free at the time and stays free', amount: '$0', tone: 'kept' },
];

const SUMS = [
    { label: 'The grinder', amount: '$1,180', tone: 'plain' },
    { label: 'Return freight, because this one is a change of mind', amount: '−$18', tone: 'minus' },
    { label: 'Burr set — waived, 0.6 kg is under the kilo', amount: '−$0', tone: 'waived' },
    { label: 'Lands on the card ending 4471', amount: '$1,162', tone: 'total' },
];

const FOUND = [
    { title: 'Burrs', body: '0.6 kg through them, measured off the counter reading rather than guessed. Edges clean, no chips. They go back on the shelf as new.', meta: 'photographed 28 Aug, 11:06' },
    { title: 'Body', body: 'One mark on the underside, about 4 mm, from the rubber feet. Everything gets that in a week. Not a deduction and never has been.', meta: 'photographed 28 Aug, 11:09' },
    { title: 'What was in the box', body: 'Grinder, burr tool, cable, and the hopper you were told to keep. Nothing missing, which is worth saying because a missing cable is the one thing that slows this down.', meta: 'checked 28 Aug, 11:14' },
];

const LAGS = [
    ['Card', '3–5 working days'],
    ['ATM transfer', 'next morning'],
    ['Pay on collection', 'transfer, 1 day'],
    ['Instalments', 'next statement'],
];

const HISTORY = [
    { when: 'Mar 2026', what: 'Dosing cup, wrong colour', amount: '$36', took: '4 days' },
    { when: 'Nov 2025', what: 'Cleaning tablets, sealed', amount: '$18', took: '5 days' },
];

const SUM_TONES = {
    total: 'text-jade-300',
    minus: 'text-amber-300/80',
    waived: 'text-zinc-600',
    plain: 'text-zinc-300',
};

const TOOLBAR = (
    <div className="flex flex-wrap items-center gap-x-5 gap-y-2">
        <span className="font-mono text-[10px] text-zinc-500">RF-2608-0093 · opened at the bench, waiting to be signed off</span>
        <span className="hidden font-mono text-[10px] text-zinc-700 sm:inline">day 3 · median is 6</span>
        <a
            href="/templates/refund/screens/ledger"
            target="_top"
            className="ml-auto rounded-lg px-2.5 py-1 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:bg-white/5 hover:text-jade-300"
        >how long these usually take →</a>
    </div>
);

export function RefundProgress() {
    return (
        <RefundShell active="Where yours is" toolbar={TOOLBAR}>
            <div className="mx-auto max-w-6xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">One refund, mid-flight</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Five steps, and only three of them are ours. The bench signs off on the fourth, and the fifth belongs to a bank
                    that will take three to five working days no matter what anybody here does — so it is drawn as a separate hop
                    rather than folded into a promise we cannot keep.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
                    <section>
                        <RefundStage
                            reference="RF-2608-0093"
                            order="NS-2608-1174"
                            amount="$1,162"
                            lands="expected 2 Sep"
                            steps={STEPS}
                            stage={2}
                            note="Wei has looked at it and it passed. The sign-off is a person clicking a button on a Thursday, and Thursdays are the day the bench catches up on paperwork."
                        />

                        <h2 className="mt-8 text-[15px] font-medium tracking-tight text-cream">The arithmetic</h2>
                        <p className="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                            Four lines, all of them shown, including the deduction we chose not to make. A refund figure with no
                            working underneath it is how people end up mailing the support desk to ask where their $40 went.
                        </p>

                        <div className="mt-3 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            <div className="divide-y divide-white/5">
                                {PAID.map((line) => (
                                    <div key={line.name} className="flex items-baseline gap-4 px-3.5 py-2.5">
                                        <p className={`min-w-0 flex-1 text-[13px] ${line.tone === 'back' ? 'text-cream' : 'text-zinc-500'}`}>{line.name}</p>
                                        <p className="shrink-0 font-mono text-[10px] text-zinc-600">{line.note}</p>
                                        <p className={`w-16 shrink-0 text-right font-mono text-[12px] ${line.tone === 'back' ? 'text-zinc-300' : 'text-zinc-600'}`}>{line.amount}</p>
                                    </div>
                                ))}
                            </div>

                            <div className="divide-y divide-white/5 border-t border-white/8 bg-ink-950">
                                {SUMS.map((row) => (
                                    <div key={row.label} className={`flex items-baseline gap-4 px-3.5 py-2.5 ${row.tone === 'total' ? 'bg-jade-500/5' : ''}`}>
                                        <p className={`min-w-0 flex-1 text-[12px]/5 ${row.tone === 'total' ? 'text-cream' : 'text-zinc-500'}`}>{row.label}</p>
                                        <p className={`w-20 shrink-0 text-right font-mono text-[13px] ${SUM_TONES[row.tone]}`}>{row.amount}</p>
                                    </div>
                                ))}
                            </div>
                        </div>

                        <h2 className="mt-8 text-[15px] font-medium tracking-tight text-cream">What the bench found when it opened the box</h2>
                        <p className="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                            Written by Wei on the morning, in the order he did it, and sent to you whether or not the outcome depends
                            on any of it. The photographs come with the mail.
                        </p>

                        <div className="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-3">
                            {FOUND.map((note) => (
                                <div key={note.title} className="rounded-xl border border-white/8 bg-ink-900 p-3.5">
                                    <p className="text-[13px] text-cream">{note.title}</p>
                                    <p className="mt-1.5 text-[12px]/5 text-zinc-400">{note.body}</p>
                                    <p className="mt-2.5 font-mono text-[10px] text-zinc-700">{note.meta}</p>
                                </div>
                            ))}
                        </div>
                    </section>

                    <aside>
                        <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The hop that is not ours</h2>

                        <div className="mt-3 rounded-xl border border-amber-400/20 bg-amber-400/5 p-4">
                            <p className="text-[13px] text-cream">Three to five working days at the bank</p>
                            <p className="mt-2 text-[12px]/5 text-zinc-400">
                                A card refund is not a transfer — it is a reversal that has to clear the same rails the payment came
                                down, and 玉山 posts them on a batch that runs overnight. If you paid by ATM transfer instead, the money
                                goes out as a transfer and lands the next working morning.
                            </p>
                            <div className="mt-3 grid grid-cols-2 gap-2.5">
                                {LAGS.map(([how, lag]) => (
                                    <div key={how} className="rounded-lg border border-white/8 px-2.5 py-2">
                                        <p className="font-mono text-[10px] text-zinc-600">{how}</p>
                                        <p className="mt-1 font-mono text-[11px] text-zinc-300">{lag}</p>
                                    </div>
                                ))}
                            </div>
                        </div>

                        <div className="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If it has been longer</p>
                            <p className="mt-2 text-[12px]/5 text-zinc-400">
                                Past nine days from the sign-off, something has gone wrong and it is worth telling us rather than
                                waiting politely. Twice it has been a card that expired between the order and the refund, which the
                                bank does not tell either of us about.
                            </p>
                            <a
                                href="/templates/contact/screens/write"
                                target="_top"
                                className="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >Chase it</a>
                        </div>

                        <h2 className="mt-7 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Your other two</h2>
                        <ul className="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            {HISTORY.map((row) => (
                                <li key={row.when} className="flex items-baseline gap-3 px-3.5 py-3">
                                    <span className="w-16 shrink-0 font-mono text-[10px] text-zinc-600">{row.when}</span>
                                    <span className="min-w-0 flex-1 text-[12px] text-zinc-400">{row.what}</span>
                                    <span className="shrink-0 font-mono text-[11px] text-zinc-300">{row.amount}</span>
                                    <span className="w-12 shrink-0 text-right font-mono text-[10px] text-zinc-700">{row.took}</span>
                                </li>
                            ))}
                        </ul>
                        <p className="mt-3 text-[11px]/5 text-zinc-600">
                            Neither of those was argued about and neither is held against you. We have never once looked at a return
                            history and decided somebody was returning too much.
                        </p>
                    </aside>
                </div>
            </div>
        </RefundShell>
    );
}
