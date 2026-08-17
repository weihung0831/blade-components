import { useState } from 'react';
import { UiAccordion } from '../../components/ui/data-display/Accordion';
import { UiBadge } from '../../components/ui/data-display/Badge';
import { UiButton } from '../../components/ui/actions/Button';
import { UiInputNumber } from '../../components/ui/forms/InputNumber';
import { UiRating } from '../../components/ui/forms/Rating';
import { UiSeparator } from '../../components/ui/data-display/Separator';
import { ProductShell } from './Shell';
import { ProductGallery } from './Gallery';
import { ProductFinishPicker } from './FinishPicker';

const stock = {
    graphite: { badge: '12 in stock · ships tomorrow', sku: 'GRA' },
    cream: { badge: '4 in stock · ships tomorrow', sku: 'CRM' },
    jade: { badge: 'pre-order · batch 07 ships in March', sku: 'JDE' },
};

const highlights = [
    {
        title: 'It holds a number',
        body: 'The dial clicks into 120 detents and the burr carrier is preloaded against a wave washer, so step 42 is the same grind on Monday as it was on Friday.',
        meta: '±1.5 µm across a 30-shot session',
    },
    {
        title: 'It gives the dose back',
        body: 'A 12° chute, a knocker on the exit, and an anti-static ring. Weigh in 18 g and 17.9 g lands in the cup on the first try.',
        meta: 'under 0.1 g retained',
    },
    {
        title: 'It opens with two screws',
        body: 'Burrs come out in about a minute with the tool in the box. Alignment shims, brush, and a spare washer are stocked as parts, not as a service plan.',
        meta: 'parts listed for 10 years',
    },
];

const quickSpecs = [
    { label: 'Burrs', value: '83 mm flat' },
    { label: 'Steps', value: '0–120' },
    { label: 'Per step', value: '8.5 µm' },
    { label: 'Motor', value: '250 W DC' },
    { label: 'Noise', value: '62 dB(A)' },
    { label: 'Weight', value: '4.8 kg' },
];

const faq = [
    { title: 'Espresso and filter on the same grinder?', content: 'Yes, and without swapping burrs. Steps 8–24 cover espresso, 40–70 covers pour over, 90+ goes coarse enough for a press. Crossing the whole range takes about two turns of the dial.', open: true },
    { title: 'How loud is it next to a sleeping flat?', content: '62 dB(A) measured a metre away, running empty. A shot dose is roughly seven seconds of that, which lands somewhere between a fridge compressor and a hair dryer at its lowest setting.' },
    { title: 'What is the lead time on Jade?', content: 'Jade is anodised in batches of 60. The current batch closes on the 4th and ships from Taichung around three weeks later. You are charged when it ships, not when you order.' },
    { title: 'Can I put it on 110 V later?', content: 'The board takes 100–240 V and the plug is swappable, so moving countries means a new cable, not a new grinder. Tell us the region at checkout and the right cable goes in the box.' },
];

const together = [
    { name: 'Single-dose hopper', price: '$64', meta: 'ships with the grinder' },
    { name: 'Alignment shim kit', price: '$28', meta: '0.05 mm, 0.1 mm, 0.2 mm' },
    { name: 'Dosing cup, 58 mm', price: '$36', meta: 'stainless, magnetic base' },
];

export function ProductOverview() {
    const [finish, setFinish] = useState('graphite');

    const price = finish === 'jade' ? '$1,300' : '$1,180';
    const instalment = finish === 'jade' ? '$216.67' : '$196.67';

    return (
        <ProductShell active="Overview" finish={finish} onFinishChange={setFinish}>
            <nav aria-label="Breadcrumb" className="flex items-center gap-2 font-mono text-[11px] text-zinc-600">
                <a href="#" className="transition-colors duration-150 hover:text-zinc-400">Home</a>
                <span>/</span>
                <a href="#" className="transition-colors duration-150 hover:text-zinc-400">Grinders</a>
                <span>/</span>
                <span className="text-zinc-400">EG-83</span>
            </nav>

            <div className="mt-6 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_23rem]">
                <ProductGallery />

                <div className="flex flex-col">
                    <div className="flex flex-wrap items-center gap-2">
                        <UiBadge variant="dot" color="jade" className="font-mono text-[11px]">{stock[finish].badge}</UiBadge>
                        <span className="font-mono text-[11px] text-zinc-600">SKU EG83-{stock[finish].sku}</span>
                    </div>

                    <h1 className="mt-3 text-3xl font-semibold tracking-tight text-cream">NOMAD EG-83</h1>
                    <p className="mt-1.5 text-sm/6 text-zinc-500">An 83 mm flat burr grinder for a bar that runs espresso all morning and filter all afternoon, without a second machine on the counter.</p>

                    <a href="/templates/product/screens/reviews" target="_top"
                        className="mt-4 inline-flex w-fit items-center gap-2.5 rounded-lg py-1 transition-opacity duration-150 hover:opacity-80">
                        <UiRating value={4.8} readonly />
                        <span className="font-mono text-[11px] text-zinc-500">312 reviews</span>
                    </a>

                    <div className="mt-6 flex items-baseline gap-2">
                        <span className="text-3xl font-semibold tracking-tight text-cream">{price}</span>
                        <span className="font-mono text-xs text-zinc-600">incl. tax</span>
                    </div>
                    <p className="mt-1.5 font-mono text-[11px] text-zinc-600">or 6 × {instalment} at 0% · no fee, no credit check</p>

                    <div className="mt-6">
                        <div className="flex items-baseline justify-between gap-3">
                            <span className="text-[13px] text-zinc-300">Finish</span>
                            <span className="font-mono text-[10px] text-zinc-600">anodised, not painted</span>
                        </div>
                        <ProductFinishPicker value={finish} onChange={setFinish} detailed className="mt-2.5" />
                    </div>

                    <div className="mt-6 flex items-stretch gap-2.5">
                        <UiInputNumber value={1} min={1} max={9} className="w-28! shrink-0 [&_[data-ui-number]]:h-10!" />
                        <UiButton className="h-10 flex-1">Add to cart</UiButton>
                        <button type="button" aria-label="Save for later"
                            className="grid size-10 shrink-0 place-items-center rounded-lg border border-white/10 text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                            <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M8 13.5S2.5 10.2 2.5 6.3A3 3 0 0 1 8 4.6a3 3 0 0 1 5.5 1.7c0 3.9-5.5 7.2-5.5 7.2Z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/></svg>
                        </button>
                    </div>

                    <p className="mt-3 text-center font-mono text-[10px] text-zinc-600">
                        {finish === 'jade' && 'charged when the batch ships, not now · '}free express over $600
                    </p>

                    <UiSeparator className="my-6" />

                    <ul className="flex flex-col gap-3.5">
                        <li className="flex items-start gap-3">
                            <svg className="mt-0.5 size-4 shrink-0 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M1.5 5.5h8v6h-8zM9.5 7.5h3l2 2v2h-5z" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round"/><circle cx="4.5" cy="12.5" r="1.2" stroke="currentColor" strokeWidth="1.3"/><circle cx="11.5" cy="12.5" r="1.2" stroke="currentColor" strokeWidth="1.3"/></svg>
                            <p className="text-[13px]/5 text-zinc-400">Order before 15:00 and it leaves the workshop the same day. Taipei next morning, most of the island the day after.</p>
                        </li>
                        <li className="flex items-start gap-3">
                            <svg className="mt-0.5 size-4 shrink-0 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M2.5 8a5.5 5.5 0 1 1 1.7 4" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round"/><path d="M2 8.5 4 11l2.5-2" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                            <p className="text-[13px]/5 text-zinc-400">Thirty days to change your mind, grounds in the burrs and all. We pay the courier both ways.</p>
                        </li>
                        <li className="flex items-start gap-3">
                            <svg className="mt-0.5 size-4 shrink-0 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M8 1.8 13 4v4.2c0 3-2.1 5.1-5 6-2.9-.9-5-3-5-6V4l5-2.2Z" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round"/></svg>
                            <p className="text-[13px]/5 text-zinc-400">Two years on the machine, five on the burr set. Repairs are quoted before anyone opens anything.</p>
                        </li>
                    </ul>

                    <div className="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Before it ships</p>
                        <p className="mt-2 text-[12px]/5 text-zinc-500">Every unit runs 400 g through it, gets the burr gap checked on a dial indicator, and leaves with the sheet signed by whoever did it. Yours is in the box.</p>
                    </div>
                </div>
            </div>

            <section className="mt-14 grid gap-4 lg:grid-cols-3">
                {highlights.map((highlight) => (
                    <article key={highlight.title} className="flex flex-col rounded-2xl border border-white/8 bg-ink-900 p-6">
                        <h2 className="text-base font-medium text-cream">{highlight.title}</h2>
                        <p className="mt-2.5 text-[13px]/6 text-zinc-500">{highlight.body}</p>
                        <div className="grow" />
                        <p className="mt-5 border-t border-white/5 pt-4 font-mono text-[10px] text-jade-400">{highlight.meta}</p>
                    </article>
                ))}
            </section>

            <section className="mt-12 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div className="flex flex-wrap items-center justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-4">
                    <h2 className="text-base font-medium text-cream">The six numbers people ask for</h2>
                    <a href="/templates/product/screens/specs" target="_top"
                        className="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Full spec sheet →</a>
                </div>

                <div className="grid gap-px bg-white/8 sm:grid-cols-3 lg:grid-cols-6">
                    {quickSpecs.map((spec) => (
                        <div key={spec.label} className="bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{spec.label}</p>
                            <p className="mt-2 font-mono text-[15px] text-cream">{spec.value}</p>
                        </div>
                    ))}
                </div>
            </section>

            <section className="mt-12 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_20rem]">
                <div>
                    <h2 className="text-base font-medium text-cream">Asked often enough to print</h2>
                    <UiAccordion items={faq} variant="outline" className="mt-4 bg-ink-900!" />
                </div>

                <div>
                    <h2 className="text-base font-medium text-cream">Bought with it</h2>
                    <div className="mt-4 flex flex-col divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        {together.map((item) => (
                            <a key={item.name} href="/templates/product/screens/configure" target="_top"
                                className="flex items-center gap-3 px-4 py-3 transition-colors duration-150 hover:bg-white/4">
                                <span className="min-w-0 flex-1">
                                    <span className="block truncate text-[13px] text-zinc-300">{item.name}</span>
                                    <span className="block truncate font-mono text-[10px] text-zinc-600">{item.meta}</span>
                                </span>
                                <span className="shrink-0 font-mono text-[13px] text-zinc-500">{item.price}</span>
                            </a>
                        ))}
                    </div>
                    <a href="/templates/product/screens/configure" target="_top"
                        className="mt-3 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Build the whole setup →</a>
                </div>
            </section>
        </ProductShell>
    );
}
