import { UiButton } from '../../components/ui/actions/Button';
import { UiTimeline } from '../../components/ui/data-display/Timeline';
import { CheckoutShell } from './Shell';
import { CheckoutSummary } from './Summary';

const items = [
    { sku: 'EG83-GRA', name: 'EG-83 grinder', option: 'graphite', price: 1180, qty: 1 },
    { sku: 'SHM-KIT', name: 'Alignment shim kit', option: '0.05 / 0.1 / 0.2 mm', price: 28, qty: 1 },
    { sku: 'CUP-58', name: 'Dosing cup, 58 mm', option: 'stainless', price: 36, qty: 2 },
];

const timeline = [
    { title: 'Order placed', description: 'Card authorised for the full amount, nothing captured yet.', time: 'today 14:22', state: 'done' },
    { title: 'On the bench', description: 'Burrs aligned, zero point set, and a test grind pulled at 042.', time: 'today, before we close', state: 'current' },
    { title: 'Packed and charged', description: 'Capture happens here. The e-invoice is issued the same minute.', time: 'tomorrow morning', state: 'upcoming' },
    { title: 'Handed to T-Cat', description: 'Tracking number arrives by email and SMS at the same time.', time: 'tomorrow ~16:00', state: 'upcoming' },
    { title: 'At your door', description: 'Signature required. The driver calls the mobile on the order first.', time: 'Thu 20 – Mon 24 Aug', state: 'upcoming' },
];

const facts = [
    { label: 'Order', value: 'NS-2608-1174', meta: 'quote this in any email' },
    { label: 'Paid', value: '$1,152', meta: 'JCB ···· 3092 · auth 4K7Q2X' },
    { label: 'Invoice', value: 'AB-27461930', meta: 'carrier /ABC+123' },
    { label: 'Serial', value: 'EG83-2608-0417', meta: 'warranty is tied to this' },
];

export function CheckoutConfirmation() {
    const ship = 'standard';

    return (
        <CheckoutShell active="Done" ship={ship}>
            <div className="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
                <div className="flex flex-col gap-6">
                    <section className="relative overflow-hidden rounded-2xl border border-jade-500/30 bg-jade-500/6 p-6">
                        <span aria-hidden="true" className="pointer-events-none absolute -top-24 -right-16 size-64 rounded-full bg-jade-500/10 blur-3xl" />

                        <div className="relative flex flex-wrap items-start gap-4">
                            <span className="grid size-10 shrink-0 place-items-center rounded-full bg-jade-500">
                                <svg className="size-5 text-ink-950" viewBox="0 0 16 16" fill="none"><path d="M3.5 8.5 6.5 11.5 12.5 4.5" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round"/></svg>
                            </span>

                            <div className="min-w-0 flex-1">
                                <h1 className="text-2xl font-semibold tracking-tight text-cream">It is ours to build now</h1>
                                <p className="mt-2 max-w-xl text-sm/6 text-zinc-400">
                                    Order <span className="font-mono text-cream">NS-2608-1174</span> is on the bench list for tomorrow morning.
                                    A receipt is already in <span className="text-zinc-300">wei@nomadsupply.tw</span>; the tracking number follows when the box leaves.
                                </p>
                            </div>
                        </div>

                        <div className="relative mt-6 grid gap-px overflow-hidden rounded-xl border border-white/8 bg-white/8 sm:grid-cols-2 lg:grid-cols-4">
                            {facts.map((fact) => (
                                <div key={fact.label} className="bg-ink-950 p-4">
                                    <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{fact.label}</p>
                                    <p className="mt-2 font-mono text-[15px] text-cream">{fact.value}</p>
                                    <p className="mt-0.5 font-mono text-[10px] text-zinc-600">{fact.meta}</p>
                                </div>
                            ))}
                        </div>
                    </section>

                    <section className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                            <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">What happens, in order</h2>
                            <span className="font-mono text-[10px] text-zinc-600">five steps, three of them ours</span>
                        </div>

                        <div className="p-5">
                            <UiTimeline items={timeline} />
                        </div>
                    </section>

                    <div className="grid gap-5 sm:grid-cols-2">
                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Going to</p>
                            <p className="mt-3 text-[13px]/6 text-zinc-400">
                                Wei-Han Chen · +886 912 345 678
                                <br />
                                2F, 227 Minsheng Road, West District, Taichung 403
                            </p>
                            <p className="mt-3 font-mono text-[10px]/5 text-zinc-600">T-Cat home delivery · signature required · one redelivery attempt</p>
                            <button type="button" className="mt-4 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Change the address →</button>
                        </section>

                        <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Still yours to change</p>
                            <p className="mt-3 text-[13px]/6 text-zinc-400">
                                Until the label prints tomorrow around 16:00 you can move the address, swap the finish, or cancel the whole thing without a fee.
                            </p>
                            <p className="mt-3 font-mono text-[10px]/5 text-zinc-600">After that it becomes a return: 30 days, freight on us both ways.</p>
                        </section>
                    </div>

                    <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                            <h2 className="text-base font-medium text-cream">While you wait</h2>
                            <span className="font-mono text-[10px] text-zinc-600">none of this is an upsell</span>
                        </div>

                        <div className="mt-4 grid gap-3 sm:grid-cols-3">
                            <a href="/templates/product/screens/specs" target="_top" className="rounded-xl border border-white/8 bg-ink-950 p-4 transition-colors duration-150 hover:border-jade-500/50">
                                <p className="text-[13px] text-zinc-200">Where to start on the dial</p>
                                <p className="mt-1.5 text-xs/5 text-zinc-500">Seven brew methods with a number to begin from, so the first bag is not wasted.</p>
                            </a>

                            <a href="#" className="rounded-xl border border-white/8 bg-ink-950 p-4 transition-colors duration-150 hover:border-jade-500/50">
                                <p className="text-[13px] text-zinc-200">Add it to the calendar</p>
                                <p className="mt-1.5 text-xs/5 text-zinc-500">A block on the delivery window, with the tracking link attached once we have it.</p>
                            </a>

                            <a href="#" className="rounded-xl border border-white/8 bg-ink-950 p-4 transition-colors duration-150 hover:border-jade-500/50">
                                <p className="text-[13px] text-zinc-200">Register the serial</p>
                                <p className="mt-1.5 text-xs/5 text-zinc-500">Done automatically on delivery. This is only here if you want it under a company name.</p>
                            </a>
                        </div>
                    </section>

                    <p className="font-mono text-[10px]/5 text-zinc-600">
                        Reply to the confirmation email and a person in Taichung reads it — usually the same one who packed the box.
                    </p>
                </div>

                <div className="flex flex-col gap-4 lg:sticky lg:top-32">
                    <CheckoutSummary
                        title="Receipt"
                        items={items}
                        ship={ship}
                        discount={128}
                        discountLabel="BENCH10"
                        locked
                        note="Authorised on JCB ···· 3092. Captured when the box is packed."
                    />

                    <div className="flex flex-col gap-2.5">
                        <UiButton variant="secondary" className="w-full">Download the invoice PDF</UiButton>
                        <UiButton variant="ghost" className="w-full" href="/templates/product/screens/overview" target="_top">Back to the shop</UiButton>
                    </div>

                    <p className="px-1 font-mono text-[10px]/5 text-zinc-600">
                        The e-invoice sits in your carrier the night it ships. Nothing paper is posted unless you asked for it.
                    </p>
                </div>
            </div>
        </CheckoutShell>
    );
}
