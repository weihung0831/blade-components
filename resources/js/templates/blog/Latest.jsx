import { useState } from 'react';
import { BlogShell } from './Shell';
import { BlogPostCard } from './PostCard';
import { BlogTopicPill } from './TopicPill';
import { BlogSubscribe } from './Subscribe';

const FEATURED = {
    title: 'What 412 returned grinders told us about alignment',
    excerpt: 'Every unit that came back last year was measured before anyone touched it. The burrs were rarely the fault. The seat underneath them usually was, and four of those seats came off the same Tuesday.',
    topic: 'Machines',
    date: '12 Aug 2026',
    published: 20260812,
    read: 14,
    author: 'Mei Tsai',
};

const POSTS = [
    {
        title: 'We stopped putting the tamper in the box. Nobody wrote in.',
        excerpt: 'It shipped with every grinder for four years, because it shipped with every grinder the first year.',
        topic: 'Supply',
        date: '29 Jul 2026',
        published: 20260729,
        read: 6,
        author: 'Idris Bahar',
    },
    {
        title: 'The 0.05 mm shim that closed a five-year complaint',
        excerpt: 'People kept saying the grind wandered after a week. It did. The fix cost less than the packaging it came in.',
        topic: 'Workshop',
        date: '15 Jul 2026',
        published: 20260715,
        read: 9,
        author: 'Mei Tsai',
    },
    {
        title: 'Lead time doubled in March. Here is the whole chain.',
        excerpt: 'One anodising shop, one holiday, and a pallet that sat in Kaohsiung for eleven days.',
        topic: 'Supply',
        date: '1 Jul 2026',
        published: 20260701,
        read: 11,
        author: 'Idris Bahar',
    },
    {
        title: 'Burr seasoning is mostly folklore, and here is 40 kg of it',
        excerpt: 'We ran rice, old beans, and nothing at all through three identical sets, then measured the particle spread every kilo.',
        topic: 'Method',
        date: '17 Jun 2026',
        published: 20260617,
        read: 13,
        author: 'Lena Kohler',
    },
    {
        title: 'A bench test you can run with a phone and a spirit level',
        excerpt: 'Two minutes, no jig. It will not tell you the number, but it will tell you whether to call us.',
        topic: 'Method',
        date: '3 Jun 2026',
        published: 20260603,
        read: 5,
        author: 'Lena Kohler',
    },
    {
        title: 'Why the warranty follows the serial and not the receipt',
        excerpt: 'Second-hand machines kept arriving with no paperwork. The serial was always there, stamped under the motor.',
        topic: 'Workshop',
        date: '20 May 2026',
        published: 20260520,
        read: 4,
        author: 'Mei Tsai',
    },
    {
        title: 'Anodising in Taichung: three shops, one finish, three prices',
        excerpt: 'The cheapest quote came back with the best coating and the worst packing. We now pay for both separately.',
        topic: 'Supply',
        date: '6 May 2026',
        published: 20260506,
        read: 8,
        author: 'Idris Bahar',
    },
    {
        title: 'The retention bin we removed, then put back',
        excerpt: 'Single dosing won the argument on paper. Then the cafés told us what happens at 7 am with a queue.',
        topic: 'Machines',
        date: '22 Apr 2026',
        published: 20260422,
        read: 7,
        author: 'Mei Tsai',
    },
];

const POPULAR = [
    { title: 'The 0.05 mm shim that closed a five-year complaint', meta: '9 min · Workshop' },
    { title: 'Burr seasoning is mostly folklore, and here is 40 kg of it', meta: '13 min · Method' },
    { title: 'Lead time doubled in March. Here is the whole chain.', meta: '11 min · Supply' },
];

const TOPICS = ['Workshop', 'Machines', 'Supply', 'Method'];
const ALL = [FEATURED, ...POSTS];

export function BlogLatest() {
    const [topic, setTopic] = useState('all');
    const [sort, setSort] = useState('newest');

    const matches = (post) => topic === 'all' || post.topic === topic;
    const shown = ALL.filter(matches).length;

    const listed = POSTS.filter(matches).sort((a, b) => (sort === 'longest' ? b.read - a.read : b.published - a.published));

    return (
        <BlogShell active="Latest">
            <div className="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h1 className="text-2xl font-semibold tracking-tight text-cream">Notes off the bench</h1>
                    <p className="mt-2 max-w-xl text-sm/6 text-zinc-500">
                        What we took apart, what it cost, and what we got wrong. Written by the three people who do the work, published whenever there is
                        something worth saying.
                    </p>
                </div>
                <span className="font-mono text-[10px] text-zinc-600">since Nov 2023</span>
            </div>

            <div className="mt-8 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_18rem]">
                <div className="flex flex-col gap-6">
                    <div className="flex flex-wrap items-center gap-x-4 gap-y-3">
                        <div className="flex flex-wrap items-center gap-2">
                            <BlogTopicPill value="all" label="Everything" count={ALL.length} checked={topic === 'all'} onSelect={setTopic} />
                            {TOPICS.map((name) => (
                                <BlogTopicPill
                                    key={name}
                                    value={name}
                                    label={name}
                                    count={ALL.filter((post) => post.topic === name).length}
                                    checked={topic === name}
                                    onSelect={setTopic}
                                />
                            ))}
                        </div>

                        <div className="ml-auto flex items-center gap-1 rounded-lg bg-ink-900 p-0.5">
                            {[{ value: 'newest', label: 'Newest' }, { value: 'longest', label: 'Longest' }].map((option) => (
                                <label
                                    key={option.value}
                                    className="cursor-pointer rounded-md px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:bg-white/10 has-[:checked]:text-cream"
                                >
                                    <input
                                        type="radio"
                                        name="sort"
                                        value={option.value}
                                        checked={sort === option.value}
                                        onChange={() => setSort(option.value)}
                                        className="sr-only"
                                    />
                                    {option.label}
                                </label>
                            ))}
                        </div>
                    </div>

                    {matches(FEATURED) && <BlogPostCard post={FEATURED} kicker="Long read" featured />}

                    <div className="grid gap-4 sm:grid-cols-2">
                        {listed.map((post) => (
                            <BlogPostCard key={post.title} post={post} />
                        ))}
                    </div>

                    {shown === 0 && (
                        <div className="rounded-2xl border border-dashed border-white/10 px-6 py-12 text-center">
                            <p className="text-[13px] text-zinc-400">Nothing filed under that yet.</p>
                            <p className="mt-1 font-mono text-[10px] text-zinc-600">Ask for it and it moves up the list.</p>
                        </div>
                    )}

                    <div className="flex flex-wrap items-center justify-between gap-3 border-t border-white/5 pt-5">
                        <p className="font-mono text-[10px] text-zinc-600">
                            Showing <span className="text-zinc-400">{shown}</span> of {ALL.length} · 22 in total
                        </p>
                        <a
                            href="/templates/blog/screens/archive"
                            target="_top"
                            className="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-3 py-1.5 text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            Everything since 2023
                            <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        </a>
                    </div>
                </div>

                <aside className="flex flex-col gap-4 lg:sticky lg:top-20">
                    <BlogSubscribe compact cadence={false} title="Two a month, no more" note="Whatever we measured that week, in plain numbers." />

                    <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Read most this year</p>
                        <ol className="mt-3.5 flex flex-col divide-y divide-white/5">
                            {POPULAR.map((entry, index) => (
                                <li key={entry.title} className="flex gap-3 py-3 first:pt-0 last:pb-0">
                                    <span className="font-mono text-[11px] text-zinc-700">{String(index + 1).padStart(2, '0')}</span>
                                    <div className="min-w-0">
                                        <a
                                            href="/templates/blog/screens/article"
                                            target="_top"
                                            className="text-[13px]/5 text-zinc-300 transition-colors duration-150 hover:text-jade-300"
                                        >
                                            {entry.title}
                                        </a>
                                        <p className="mt-1 font-mono text-[10px] text-zinc-600">{entry.meta}</p>
                                    </div>
                                </li>
                            ))}
                        </ol>
                    </section>

                    <p className="px-1 font-mono text-[10px]/5 text-zinc-600">
                        Corrections go at the top of the piece, dated, with the old line struck through. We have made eleven.
                    </p>
                </aside>
            </div>
        </BlogShell>
    );
}
