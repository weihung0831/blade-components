import { useState } from 'react';
import { OnboardingShell } from './Shell';
import { OnboardingMapping } from './Mapping';

const COLUMNS = [
    { source: 'Handle', sample: 'ethiopia-guji-natural', target: 'slug', state: 'matched' },
    { source: 'Title', sample: 'Ethiopia Guji, natural', target: 'name', state: 'matched' },
    { source: 'Body (HTML)', sample: '<p>Peach, jasmine, a lo…', target: 'description', state: 'guessed', options: ['notes', 'tasting', 'summary'], note: 'The HTML comes through as our own small subset. Style attributes, scripts and the three tables in there do not.' },
    { source: 'Vendor', sample: 'Kerouac Coffee', target: 'roaster', state: 'matched' },
    { source: 'Type', sample: 'Single Origin', target: 'category', state: 'clash', note: '42 different values in the file and nine categories here. Six of them will land in Other unless you pair them up.' },
    { source: 'Tags', sample: 'washed, filter, 2024', target: 'tags', state: 'matched' },
    { source: 'Published', sample: 'TRUE', target: 'visible', state: 'matched' },
    { source: 'Option1 Value', sample: '250 g', target: 'variant · size', state: 'guessed', options: ['weight', 'grind'], note: 'Option1 Name says Size on every row, so this is a safe guess. Option2 is empty throughout and is not listed below.' },
    { source: 'Variant SKU', sample: 'KC-ETH-GUJ-250', target: 'sku', state: 'clash', note: 'Fourteen of these already exist here from the sample catalog. What happens to them is the question at the bottom of this page.' },
    { source: 'Variant Price', sample: '520.00', target: 'price', state: 'matched', note: 'Read as TWD, matching the shop currency. No row in the file carries a currency of its own.' },
    { source: 'Variant Compare At Price', sample: '580.00', target: 'was', state: 'matched' },
    { source: 'Variant Grams', sample: '250', target: 'weight', state: 'matched', note: 'Divided by a thousand on the way in. Freight here is priced in kilos.' },
    { source: 'Variant Inventory Qty', sample: '18', target: 'stock', state: 'matched' },
    { source: 'Variant Barcode', sample: '4710085120451', target: 'barcode', state: 'matched' },
    { source: 'Cost per item', sample: '287.50', target: 'cost', state: 'matched', note: 'Only you and anyone on an owner seat can see this column once it is in.' },
    { source: 'Image Src', sample: 'cdn.shopify.com/s/files…', target: 'photos', state: 'guessed', note: 'Eight per product, fetched over the next hour or so. Nine URLs in the file already 404 and those products arrive without a picture.' },
    { source: 'SEO Title', sample: 'Ethiopia Guji | Kerouac', target: 'seo title', state: 'dropped', note: 'We write this from the product name. Yours all end in the shop name, which is the part search engines cut off.' },
    { source: 'Google Shopping / Condition', sample: 'new', target: 'google condition', state: 'dropped' },
    { source: 'Variant Requires Shipping', sample: 'TRUE', target: 'requires shipping', state: 'dropped', note: 'Everything with a weight ships. There is no switch for it here.' },
    { source: 'Variant Taxable', sample: 'TRUE', target: 'taxable', state: 'dropped', note: 'Tax is worked out from where you ship from and to, not from a flag on the product.' },
    { source: 'Gift Card', sample: 'FALSE', target: 'gift card', state: 'dropped' },
];

const FILTERS = [
    { key: 'all-columns', label: 'All 21 columns' },
    { key: 'attention', label: 'Wants a look' },
    { key: 'dropped', label: 'Not coming' },
];

const REFUSED = [
    { count: 11, reason: 'No price', note: 'Draft products in the old shop. They import as hidden with a price of zero if you would rather have them.' },
    { count: 5, reason: 'Two rows, one handle', note: 'Same slug twice — usually a variant row that lost its parent in the export. The first of each pair comes in.' },
    { count: 3, reason: 'Nothing in the title', note: 'Blank rows at the bottom of the file. Almost every export has a few.' },
];

const DUPLICATES = [
    { key: 'skip', label: 'Leave what is here alone', note: 'The fourteen existing products stay as they are and the file version is dropped. Nothing you have already edited moves.' },
    { key: 'overwrite', label: 'Let the file win', note: 'Prices, stock and descriptions get replaced. Photos you uploaded here stay put.' },
    { key: 'both', label: 'Keep both', note: 'The incoming ones land with -2 on the end of the slug. Nobody has ever wanted this on purpose, but it is here.' },
];

const SUMMARY = [['Products', '387'], ['Photos', '2,914'], ['Wants a look', '4'], ['Dropped', '19']];

const KEEPS = {
    'all-columns': () => true,
    attention: (state) => state === 'guessed' || state === 'clash',
    dropped: (state) => state === 'dropped',
};

export function OnboardingImport() {
    const [picked, setPicked] = useState('all-columns');
    const [duplicate, setDuplicate] = useState('skip');

    const shown = COLUMNS.filter((column) => (KEEPS[picked] ?? KEEPS['all-columns'])(column.state));

    const toolbar = (
        <div className="flex flex-wrap items-center gap-x-3 gap-y-2">
            <span className="flex items-center gap-2 font-mono text-[11px] text-zinc-400">
                <svg className="size-3.5 text-jade-400" viewBox="0 0 16 16" fill="none">
                    <path d="M4 2h5l3 3v9H4z" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round"/>
                    <path d="M9 2v3h3" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round"/>
                </svg>
                products_export.csv
            </span>

            <span className="font-mono text-[10px] text-zinc-600">412 rows · 21 columns · read 2 minutes ago</span>

            <span className="ml-auto flex flex-wrap items-center gap-1">
                {FILTERS.map((filter) => (
                    <button
                        key={filter.key}
                        type="button"
                        data-active={picked === filter.key ? '' : undefined}
                        className="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-jade-500/15 data-active:text-jade-300"
                        onClick={() => setPicked(filter.key)}
                    >{filter.label}</button>
                ))}
            </span>
        </div>
    );

    return (
        <OnboardingShell active="Bringing it over" step="catalog" interactive toolbar={toolbar}>
            <div className="mx-auto max-w-6xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">387 of the 412 rows will land</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Nothing has been written yet. This is what the file says, what we think each column is, and the twenty-five rows
                    that will not make the trip — with the reason for each, before you press anything.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.7fr_1fr]">
                    <section>
                        <div className="flex items-baseline justify-between gap-3">
                            <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Columns, and where they go</h2>
                            <span className="font-mono text-[10px] text-zinc-600">{shown.length} of {COLUMNS.length}</span>
                        </div>

                        <div className="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            {shown.map((column) => <OnboardingMapping key={column.source} {...column} />)}
                        </div>

                        <div className="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Fourteen SKUs are already here</p>
                            <p className="mt-2 max-w-2xl text-[12px]/5 text-zinc-400">
                                They came from the sample catalog we put in when the shop was made. Pick what happens to them, because
                                the wrong answer here is the one thing on this page that quietly overwrites work you have done.
                            </p>

                            <div className="mt-3 flex flex-col gap-2">
                                {DUPLICATES.map((option) => (
                                    <label
                                        key={option.key}
                                        className={`flex cursor-pointer gap-3 rounded-lg border p-3 transition-colors duration-150 ${
                                            duplicate === option.key ? 'border-jade-500/50 bg-jade-500/6' : 'border-white/8 hover:border-white/15'
                                        }`}
                                    >
                                        <input type="radio" name="duplicates" className="sr-only" checked={duplicate === option.key} onChange={() => setDuplicate(option.key)} />
                                        <span className={`mt-0.5 size-3.5 shrink-0 rounded-full border-2 ${duplicate === option.key ? 'border-jade-500 bg-jade-500/30' : 'border-white/20'}`}></span>
                                        <span className="min-w-0 flex-1">
                                            <span className="block text-[13px] text-cream">{option.label}</span>
                                            <span className="mt-0.5 block text-[12px]/5 text-zinc-500">{option.note}</span>
                                        </span>
                                    </label>
                                ))}
                            </div>
                        </div>
                    </section>

                    <aside>
                        <div className="rounded-xl border border-jade-500/25 bg-jade-500/5 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-jade-300/80 uppercase">What lands</p>

                            <div className="mt-3 grid grid-cols-2 gap-3">
                                {SUMMARY.map(([label, value]) => (
                                    <div key={label} className="rounded-lg border border-white/8 bg-ink-950/40 px-2.5 py-2">
                                        <p className="font-mono text-[10px] text-zinc-600">{label}</p>
                                        <p className="mt-1 font-mono text-[15px] text-cream">{value}</p>
                                    </div>
                                ))}
                            </div>

                            <button
                                type="button"
                                className="mt-3 w-full rounded-lg bg-jade-500 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            >Bring in 387 products</button>

                            <p className="mt-2 text-center font-mono text-[10px] text-zinc-600">about 40 seconds, photos carry on after</p>
                        </div>

                        <div className="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The 19 that will not come</p>
                            <ul className="mt-3 flex flex-col gap-3">
                                {REFUSED.map((entry) => (
                                    <li key={entry.reason}>
                                        <p className="flex items-baseline gap-2">
                                            <span className="font-mono text-[13px] text-amber-300/80">{entry.count}</span>
                                            <span className="text-[12px] text-zinc-300">{entry.reason}</span>
                                        </p>
                                        <p className="mt-1 text-[11px]/5 text-zinc-600">{entry.note}</p>
                                    </li>
                                ))}
                            </ul>
                            <a href="#" className="mt-3 block rounded-lg border border-white/10 py-1.5 text-center font-mono text-[11px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Download the 19 rows as a CSV</a>
                        </div>

                        <div className="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If it goes wrong</p>
                            <p className="mt-2 text-[12px]/5 text-zinc-400">
                                An import can be pulled back out whole for 24 hours — every product it created goes, and anything it
                                overwrote comes back. After that the two are tangled together and you are editing products, not
                                undoing an import.
                            </p>
                            <p className="mt-2.5 font-mono text-[10px] text-zinc-600">61 imports undone last year, 58 of them inside ten minutes</p>
                        </div>
                    </aside>
                </div>
            </div>
        </OnboardingShell>
    );
}
