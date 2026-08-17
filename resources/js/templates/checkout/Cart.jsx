import { useState } from 'react';
import { UiButton } from '../../components/ui/actions/Button';
import { UiSeparator } from '../../components/ui/data-display/Separator';
import { CheckoutShell } from './Shell';
import { CheckoutSummary } from './Summary';
import { CheckoutLineItem } from './LineItem';

const INITIAL = [
    {
        sku: 'EG83-GRA',
        name: 'EG-83 grinder',
        option: 'graphite · single-dose hopper',
        price: 1180,
        qty: 1,
        max: 3,
        meta: 'Dialled in on the bench before it is boxed. One left in graphite at this price.',
    },
    {
        sku: 'SHM-KIT',
        name: 'Alignment shim kit',
        option: '0.05 / 0.1 / 0.2 mm',
        price: 28,
        qty: 1,
        max: 4,
        meta: 'Ships in the same box, no extra weight charge.',
    },
    {
        sku: 'CUP-58',
        name: 'Dosing cup, 58 mm',
        option: 'stainless, magnetic base',
        price: 36,
        qty: 2,
        max: 6,
        meta: 'In stock, Taichung.',
    },
    { sku: 'SPB-83', name: 'Spare burr set, 83 mm', price: 210, qty: 0, max: 4, meta: 'Added from the shelf below.' },
    { sku: 'TAB-12', name: 'Cleaning tablets, 12 pack', price: 18, qty: 0, max: 4, meta: 'Added from the shelf below.' },
];

const suggestions = [
    { sku: 'SPB-83', name: 'Spare burr set, 83 mm', price: 210, detail: 'Worth having on the shelf past 8 kg a week.' },
    { sku: 'TAB-12', name: 'Cleaning tablets, 12 pack', price: 18, detail: 'Grain based. No rinse cycle after.' },
];

export function CheckoutCart() {
    const [ship] = useState('standard');
    const [items, setItems] = useState(INITIAL);

    const live = items.filter((item) => item.qty > 0);
    const inCart = (sku) => items.some((item) => item.sku === sku && item.qty > 0);

    const setQty = (sku, qty) =>
        setItems((current) =>
            current.map((item) => (item.sku === sku ? { ...item, qty: Math.max(0, Math.min(item.max, qty)) } : item)),
        );

    return (
        <CheckoutShell active="Cart" ship={ship}>
            <div className="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
                <div className="flex flex-col gap-6">
                    <div>
                        <h1 className="text-2xl font-semibold tracking-tight text-cream">Three things, one box</h1>
                        <p className="mt-2 max-w-xl text-sm/6 text-zinc-500">
                            Everything here ships together from the workshop. Change the quantities now — after payment it takes an email, and we would rather you did it here.
                        </p>
                    </div>

                    <section className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                            <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">In the box</h2>
                            <span className="font-mono text-[10px] text-zinc-600">reserved for 30 minutes</span>
                        </div>

                        {live.length > 0 ? (
                            <div className="flex flex-col divide-y divide-white/5 px-5">
                                {live.map((item) => (
                                    <CheckoutLineItem
                                        key={item.sku}
                                        item={item}
                                        editable
                                        onStep={(delta) => setQty(item.sku, item.qty + delta)}
                                        onRemove={() => setQty(item.sku, 0)}
                                    />
                                ))}
                            </div>
                        ) : (
                            <div className="px-5 py-10 text-center">
                                <p className="text-[13px] text-zinc-400">Nothing left in the cart.</p>
                                <p className="mt-1 font-mono text-[10px] text-zinc-600">The grinder goes back on the shelf in 30 minutes.</p>
                            </div>
                        )}
                    </section>

                    <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                            <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Bought with it, usually</h2>
                            <span className="font-mono text-[10px] text-zinc-600">no extra shipping</span>
                        </div>

                        <div className="mt-4 grid gap-3 sm:grid-cols-2">
                            {suggestions.map((suggestion) => (
                                <div key={suggestion.sku} className="flex items-start gap-3 rounded-xl border border-white/8 bg-ink-950 p-4">
                                    <div className="dot-grid grid size-11 shrink-0 place-items-center rounded-lg border border-white/8">
                                        <svg className="size-4 text-zinc-700" viewBox="0 0 24 24" fill="none">
                                            <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" strokeWidth="1.3"/>
                                            <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/>
                                        </svg>
                                    </div>

                                    <div className="min-w-0 flex-1">
                                        <p className="text-[13px] text-zinc-200">{suggestion.name}</p>
                                        <p className="mt-0.5 text-xs/5 text-zinc-500">{suggestion.detail}</p>
                                        <div className="mt-2.5 flex items-center gap-3">
                                            <span className="font-mono text-[13px] text-cream">${suggestion.price.toLocaleString('en-US')}</span>
                                            <button
                                                type="button"
                                                disabled={inCart(suggestion.sku)}
                                                onClick={() => setQty(suggestion.sku, 1)}
                                                className="ml-auto rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 disabled:opacity-40"
                                            >
                                                {inCart(suggestion.sku) ? 'In cart' : 'Add'}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </section>

                    <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <div className="flex flex-wrap items-center justify-between gap-x-4 gap-y-3">
                            <div className="flex items-center gap-2.5">
                                <span className="rounded-md border border-jade-500/40 bg-jade-500/10 px-2 py-1 font-mono text-[11px] tracking-wider text-jade-300 uppercase">BENCH10</span>
                                <span className="text-[13px] text-zinc-400">−$128 off the subtotal</span>
                            </div>
                            <button type="button" className="font-mono text-[11px] text-zinc-600 transition-colors duration-150 hover:text-red-400">Remove code</button>
                        </div>

                        <UiSeparator className="my-4" />

                        <form className="flex flex-wrap items-center gap-2.5" onSubmit={(event) => event.preventDefault()}>
                            <input
                                type="text"
                                placeholder="Another code"
                                aria-label="Discount code"
                                className="h-9 w-44 rounded-lg border border-white/10 bg-ink-950 px-3 font-mono text-[13px] tracking-wider text-zinc-200 uppercase transition-colors duration-150 outline-none placeholder:tracking-normal placeholder:text-zinc-600 placeholder:normal-case focus:border-jade-500"
                            />
                            <UiButton variant="secondary" size="sm" type="submit">Apply</UiButton>
                            <span className="font-mono text-[10px] text-zinc-600">codes do not stack, the larger one wins</span>
                        </form>
                    </section>

                    <p className="font-mono text-[10px]/5 text-zinc-600">
                        30-day returns, shipping paid both ways. Burrs are covered for five years, the motor for two — the warranty follows the serial, not the receipt.
                    </p>
                </div>

                <div className="flex flex-col gap-4 lg:sticky lg:top-32">
                    <CheckoutSummary
                        items={items}
                        ship={ship}
                        discount={128}
                        discountLabel="BENCH10"
                        list={false}
                        cta="Continue to delivery"
                        href="/templates/checkout/screens/delivery"
                        note="No card charged yet. Shipping is chosen on the next screen."
                    />

                    <div className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Paying in instalments</p>
                        <p className="mt-2.5 text-[13px]/6 text-zinc-400">
                            Six months at 0% through the card issuer, decided at the payment step. Nothing here changes if you take it.
                        </p>
                    </div>

                    <p className="px-1 font-mono text-[10px]/5 text-zinc-600">
                        Buying three or more grinders? Ask for a quote instead — net-30 terms and a spare burr set thrown in.
                    </p>
                </div>
            </div>
        </CheckoutShell>
    );
}
