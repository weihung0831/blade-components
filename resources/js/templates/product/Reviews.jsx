import { useState } from 'react';
import { UiButton } from '../../components/ui/actions/Button';
import { UiRating } from '../../components/ui/forms/Rating';
import { ProductShell } from './Shell';
import { ProductReviewBar } from './ReviewBar';

const distribution = [
    { stars: 5, count: 241, percent: 77 },
    { stars: 4, count: 48, percent: 15 },
    { stars: 3, count: 14, percent: 5 },
    { stars: 2, count: 6, percent: 2 },
    { stars: 1, count: 3, percent: 1 },
];

const traits = [
    { label: 'Grind consistency', score: '4.9', percent: 98 },
    { label: 'Retention', score: '4.8', percent: 96 },
    { label: 'Build', score: '4.9', percent: 98 },
    { label: 'Noise', score: '4.1', percent: 82 },
    { label: 'Cleaning', score: '4.6', percent: 92 },
];

const filters = [
    { key: 'all', label: 'All 312' },
    { key: 'photos', label: 'With photos' },
    { key: 'verified', label: 'Verified buyers' },
];

const reviews = [
    {
        name: 'Tsai Yi-chun',
        initials: 'TY',
        stars: 5,
        date: '11 Jan 2026',
        setup: 'Linea Mini · 3 kg a week',
        title: 'Two months on a bar, no drift',
        body: 'We swapped it in on a Tuesday and by Thursday nobody was touching the dial between the espresso and the batch brew. Step 14 in the morning, step 64 after lunch, and it comes back to the same shot both ways. The old grinder needed a nudge every service.',
        photos: true,
        verified: true,
        helpful: 42,
    },
    {
        name: 'Marcus Feld',
        initials: 'MF',
        stars: 4,
        date: '2 Jan 2026',
        setup: 'Silvia Pro · home',
        title: 'Loud enough that I grind the night before',
        body: 'No complaints about the coffee. But the flat is small and the first shot is at 5:40, so I dose into the cup the night before and let it sit. Seven seconds of it is fine at nine in the morning, less fine before dawn. Knocking a star off for that alone.',
        photos: false,
        verified: true,
        helpful: 118,
        reply: 'That is the honest trade for an 83 mm burr at 1,400 rpm. The rubber feet in the accessory box take about 3 dB off if the counter is resonating — happy to send you a set.',
    },
    {
        name: 'Priya Raman',
        initials: 'PR',
        stars: 5,
        date: '28 Dec 2025',
        setup: 'V60 and Aeropress',
        title: 'Light roasts finally taste like the bag says',
        body: 'I bought it for filter only, which everyone told me was overkill. The washed Ethiopians I was giving up on are the reason I kept it. Same beans, same recipe, and the cup is sweet instead of thin. Retention is genuinely under a tenth of a gram — I weighed in and out for a week to check.',
        photos: true,
        verified: true,
        helpful: 76,
    },
    {
        name: 'Danny Okafor',
        initials: 'DO',
        stars: 3,
        date: '19 Dec 2025',
        setup: 'Two cafés · 11 kg a week',
        title: 'Great grinder, the chute needs a habit',
        body: 'Grind quality is not in question. But on a humid week the chute cakes up if nobody brushes it, and we lost a morning working out why doses were creeping light. It is a two-second job once it is on the opening list. Would be four stars if the anti-static ring handled that on its own.',
        photos: false,
        verified: true,
        helpful: 54,
    },
    {
        name: 'Sofia Lindqvist',
        initials: 'SL',
        stars: 5,
        date: '6 Dec 2025',
        setup: 'Home · Jade finish',
        title: 'The Jade batch was worth the wait',
        body: 'Ordered in October, arrived in the second week of December, charged the day it shipped exactly as they said. The anodising is deeper than the photos manage and it has not marked at all next to a stainless kettle. Alignment sheet in the box was signed by a person, which I did not expect at this price.',
        photos: true,
        verified: true,
        helpful: 31,
    },
    {
        name: 'Ben Whitfield',
        initials: 'BW',
        stars: 5,
        date: '30 Nov 2025',
        setup: 'Roastery QC bench',
        title: 'We use it to cup, which says enough',
        body: 'Cupping means the same grind on twenty samples in a row with nothing carried between them. Nothing under three thousand dollars did that in our tests. Burrs come out in a minute for a brush between tables, and the shim kit meant we could set the zero exactly where our old bench grinder had it.',
        photos: false,
        verified: true,
        helpful: 89,
    },
];

export function ProductReviews() {
    const [filter, setFilter] = useState('all');

    const visible = reviews.filter((review) => {
        if (filter === 'all') {
            return true;
        }

        if (filter === 'photos' || filter === 'verified') {
            return review[filter];
        }

        return review.stars === Number(filter);
    });

    return (
        <ProductShell active="Reviews">
            <div className="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h1 className="text-2xl font-semibold tracking-tight text-cream">312 people wrote about living with it</h1>
                    <p className="mt-2 max-w-xl text-sm/6 text-zinc-500">
                        Only buyers can post, one review per order, and we do not take anything down for being unkind. The three-star ones are usually the most useful.
                    </p>
                </div>
                <span className="font-mono text-[11px] text-zinc-600">96% would buy it again</span>
            </div>

            <div className="mt-8 grid items-start gap-6 lg:grid-cols-[20rem_minmax(0,1fr)]">
                <div className="flex flex-col gap-4 lg:sticky lg:top-32">
                    <div className="rounded-2xl border border-white/8 bg-ink-900 p-6">
                        <div className="flex items-end gap-4">
                            <span className="text-5xl font-semibold tracking-tight text-cream">4.8</span>
                            <div className="pb-1">
                                <UiRating value={5} readonly className="[&>span:last-child]:hidden" />
                                <p className="mt-1 font-mono text-[10px] text-zinc-600">312 reviews · 298 verified</p>
                            </div>
                        </div>

                        <div className="mt-5 flex flex-col gap-0.5">
                            {distribution.map((row) => (
                                <ProductReviewBar
                                    key={row.stars}
                                    stars={row.stars}
                                    count={row.count}
                                    percent={row.percent}
                                    active={filter === String(row.stars)}
                                    onSelect={(stars) => setFilter(String(stars))}
                                />
                            ))}
                        </div>

                        <div className="mt-5 border-t border-white/5 pt-5">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Rated on</p>
                            <div className="mt-3 flex flex-col gap-3">
                                {traits.map((trait) => (
                                    <div key={trait.label}>
                                        <div className="flex items-baseline justify-between gap-3">
                                            <span className="text-[12px] text-zinc-400">{trait.label}</span>
                                            <span className="font-mono text-[11px] text-zinc-500">{trait.score}</span>
                                        </div>
                                        <div className="mt-1.5 h-1 overflow-hidden rounded-full bg-ink-800">
                                            <span className="block h-full rounded-full bg-jade-500/70" style={{ width: `${trait.percent}%` }}></span>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>

                    <div className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p className="text-[13px]/6 text-zinc-400">Bought one? Tell the next person what surprised you — good or bad. It takes about four minutes.</p>
                        <UiButton variant="secondary" size="sm" className="mt-4 w-full">Write a review</UiButton>
                    </div>
                </div>

                <div className="flex flex-col gap-4">
                    <div className="flex flex-wrap items-center gap-2 rounded-xl border border-white/8 bg-ink-900 px-4 py-3">
                        {filters.map((item) => (
                            <button
                                key={item.key}
                                type="button"
                                onClick={() => setFilter(item.key)}
                                className={`rounded-full border px-3 py-1.5 text-[12px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${filter === item.key ? 'border-jade-500/50 bg-jade-500/10 text-jade-300' : 'border-white/8 text-zinc-500 hover:border-white/25 hover:text-cream'}`}
                            >
                                {item.label}
                            </button>
                        ))}

                        <span className="ml-auto font-mono text-[10px] text-zinc-600">showing {visible.length} of {reviews.length} loaded</span>
                    </div>

                    <div className="flex flex-col gap-4">
                        {visible.map((review) => (
                            <article key={review.name} className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                                <div className="flex flex-wrap items-center gap-3">
                                    <span className="grid size-9 shrink-0 place-items-center rounded-full border border-white/10 bg-ink-950 font-mono text-[11px] text-zinc-400">{review.initials}</span>

                                    <div className="min-w-0">
                                        <div className="flex flex-wrap items-center gap-2">
                                            <span className="text-[13px] text-zinc-200">{review.name}</span>
                                            {review.verified && (
                                                <span className="inline-flex items-center gap-1 font-mono text-[10px] text-jade-400">
                                                    <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M2 6.5 4.5 9 10 3" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                                    verified
                                                </span>
                                            )}
                                        </div>
                                        <p className="mt-0.5 font-mono text-[10px] text-zinc-600">{review.setup}</p>
                                    </div>

                                    <div className="ml-auto flex shrink-0 items-center gap-3">
                                        <UiRating value={review.stars} readonly className="[&>span:last-child]:hidden [&_svg]:size-3.5!" />
                                        <span className="font-mono text-[10px] text-zinc-600">{review.date}</span>
                                    </div>
                                </div>

                                <h2 className="mt-4 text-[15px] font-medium text-cream">{review.title}</h2>
                                <p className="mt-2 text-[13px]/6 text-zinc-400">{review.body}</p>

                                {review.photos && (
                                    <div className="mt-4 flex gap-2">
                                        {[1, 2, 3].map((photo) => (
                                            <span key={photo} className="dot-grid grid size-16 place-items-center rounded-lg border border-white/8 bg-ink-950">
                                                <svg className="size-4 text-zinc-700" viewBox="0 0 16 16" fill="none"><rect x="2" y="3" width="12" height="10" rx="1.5" stroke="currentColor" strokeWidth="1.3"/><path d="m4 11 3-3 2.5 2.5L11 9l1.5 2" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                            </span>
                                        ))}
                                    </div>
                                )}

                                {review.reply && (
                                    <div className="mt-4 rounded-xl border border-white/8 bg-ink-950 p-4">
                                        <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">NOMAD Supply replied</p>
                                        <p className="mt-2 text-[13px]/6 text-zinc-400">{review.reply}</p>
                                    </div>
                                )}

                                <div className="mt-4 flex flex-wrap items-center gap-3 border-t border-white/5 pt-3.5">
                                    <span className="font-mono text-[10px] text-zinc-600">{review.helpful} found this useful</span>
                                    <div className="ml-auto flex items-center gap-1.5">
                                        <button type="button" className="rounded-lg border border-white/8 px-2.5 py-1 font-mono text-[10px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Useful</button>
                                        <button type="button" className="rounded-lg px-2.5 py-1 font-mono text-[10px] text-zinc-600 transition-colors duration-150 outline-none hover:text-zinc-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Report</button>
                                    </div>
                                </div>
                            </article>
                        ))}

                        {visible.length === 0 && (
                            <p className="rounded-2xl border border-dashed border-white/10 px-5 py-10 text-center text-[13px] text-zinc-600">
                                Nothing loaded matches that filter yet. The next page might.
                            </p>
                        )}
                    </div>

                    <div className="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-white/8 bg-ink-900 px-4 py-3">
                        <span className="font-mono text-[10px] text-zinc-600">6 of 312 · sorted by most useful</span>
                        <UiButton variant="secondary" size="sm">Load 20 more</UiButton>
                    </div>
                </div>
            </div>
        </ProductShell>
    );
}
