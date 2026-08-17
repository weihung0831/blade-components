import { UiButton } from '../../components/ui/actions/Button';
import { CheckoutLineItem } from './LineItem';

const SHIPPING = {
    standard: { cost: 0, label: 'free', eta: 'arrives Thu 20 – Mon 24 Aug' },
    express: { cost: 18, label: '$18', eta: 'arrives tomorrow, Tue 18 Aug' },
    pickup: { cost: 0, label: 'free', eta: 'ready today from 17:00, Taichung' },
    intl: { cost: 68, label: '$68', eta: 'DHL · 7–12 business days, duties on arrival' },
};

const money = (value) => '$' + value.toLocaleString('en-US');

export function CheckoutSummary({
    title = 'Order summary',
    items = [],
    ship = 'standard',
    discount = 0,
    discountLabel = null,
    cta = null,
    href = null,
    note = null,
    list = true,
    locked = false,
}) {
    const shipping = SHIPPING[ship] ?? SHIPPING.standard;
    const live = items.filter((item) => item.qty > 0);
    const units = live.reduce((sum, item) => sum + item.qty, 0);
    const subtotal = live.reduce((sum, item) => sum + item.price * item.qty, 0);
    const total = subtotal - discount + shipping.cost;

    return (
        <aside className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
            <div className="flex items-baseline justify-between gap-4 border-b border-white/5 px-5 py-4">
                <h2 className="text-base font-medium text-cream">{title}</h2>
                <span className="font-mono text-[10px] text-zinc-600">{units} {units === 1 ? 'item' : 'items'}</span>
            </div>

            {list && (
                <div className="flex flex-col divide-y divide-white/5 px-5">
                    {live.map((item) => (
                        <CheckoutLineItem key={item.sku} item={item} />
                    ))}
                </div>
            )}

            <dl className="flex flex-col gap-2.5 border-t border-white/5 px-5 py-4">
                <div className="flex items-baseline justify-between gap-4">
                    <dt className="text-[13px] text-zinc-500">Subtotal</dt>
                    <dd className="font-mono text-[13px] text-zinc-300">{money(subtotal)}</dd>
                </div>

                {discount > 0 && (
                    <div className="flex items-baseline justify-between gap-4">
                        <dt className="text-[13px] text-zinc-500">
                            Discount
                            {discountLabel && <span className="ml-1 font-mono text-[10px] text-jade-400">{discountLabel}</span>}
                        </dt>
                        <dd className="font-mono text-[13px] text-jade-400">−{money(discount)}</dd>
                    </div>
                )}

                <div className="flex items-baseline justify-between gap-4">
                    <dt className="text-[13px] text-zinc-500">Shipping</dt>
                    <dd className={`font-mono text-[13px] ${shipping.cost === 0 ? 'text-jade-400' : 'text-zinc-300'}`}>{shipping.label}</dd>
                </div>

                <p className="font-mono text-[10px] text-zinc-600">{shipping.eta}</p>
            </dl>

            <div className="border-t border-white/8 bg-ink-950 px-5 py-4">
                <div className="flex items-baseline justify-between gap-4">
                    <span className="text-[13px] text-cream">{locked ? 'Paid' : 'Total'}</span>
                    <span className="font-mono text-2xl text-cream">{money(total)}</span>
                </div>
                <p className="mt-1 text-right font-mono text-[10px] text-zinc-600">
                    includes {money(Math.round(total / 21))} VAT · TWD charged at 31.4
                </p>

                {cta && <UiButton className="mt-4 w-full" href={href} target="_top">{cta}</UiButton>}

                {note && <p className="mt-3 text-center font-mono text-[10px]/4 text-zinc-600">{note}</p>}
            </div>
        </aside>
    );
}
