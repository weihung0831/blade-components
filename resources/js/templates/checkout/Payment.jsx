import { useState } from 'react';
import { UiButton } from '../../components/ui/actions/Button';
import { UiCheckbox } from '../../components/ui/forms/Checkbox';
import { UiInput } from '../../components/ui/forms/Input';
import { CheckoutShell } from './Shell';
import { CheckoutSummary } from './Summary';
import { CheckoutCardField } from './CardField';

const items = [
    { sku: 'EG83-GRA', name: 'EG-83 grinder', option: 'graphite', price: 1180, qty: 1 },
    { sku: 'SHM-KIT', name: 'Alignment shim kit', option: '0.05 / 0.1 / 0.2 mm', price: 28, qty: 1 },
    { sku: 'CUP-58', name: 'Dosing cup, 58 mm', option: 'stainless', price: 36, qty: 2 },
];

const methods = [
    { value: 'card', label: 'Card, charged once', detail: 'Visa, Mastercard, JCB. 3-D Secure runs in a sheet, not a new tab.', meta: 'settles tonight' },
    { value: 'instalment', label: 'Six months at 0%', detail: 'Through the issuing bank. Same card, the interest is on us.', meta: '$192 a month' },
    { value: 'transfer', label: 'ATM transfer', detail: 'A virtual account number, good for 24 hours. The order holds until it clears.', meta: 'no card needed' },
    { value: 'onsite', label: 'Pay at the workshop', detail: 'Card or cash on the counter when you collect it.', meta: 'pickup orders only' },
];

const invoices = [
    { value: 'mobile', label: 'Carrier barcode', detail: 'Goes to the phone, nothing printed.' },
    { value: 'company', label: 'Company tax ID', detail: 'Triplicate invoice for a company.' },
    { value: 'donate', label: 'Donate it', detail: 'Donation code, sent straight on.' },
    { value: 'paper', label: 'Paper invoice', detail: 'Printed and posted separately.' },
];

export function CheckoutPayment() {
    const [ship] = useState('standard');
    const [pay, setPay] = useState('card');
    const [invoice, setInvoice] = useState('mobile');
    const [billingSame, setBillingSame] = useState(true);
    const [card, setCard] = useState('4571 2000 1234 3092');

    return (
        <CheckoutShell active="Payment" ship={ship}>
            <div className="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
                <div className="flex flex-col gap-6">
                    <div>
                        <h1 className="text-2xl font-semibold tracking-tight text-cream">The last screen before the money moves</h1>
                        <p className="mt-2 max-w-xl text-sm/6 text-zinc-500">
                            Card details go straight to the processor — this page never sees the number. What we keep is the last four digits and the authorisation code.
                        </p>
                    </div>

                    <section className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                            <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">How you pay</h2>
                            <span className="font-mono text-[10px] text-zinc-600">TWD 36,173 will appear on the statement</span>
                        </div>

                        <div className="grid gap-3 p-5 sm:grid-cols-2">
                            {methods.map((method) => (
                                <label
                                    key={method.value}
                                    className="flex cursor-pointer items-start gap-3 rounded-xl border border-white/10 bg-ink-950 p-4 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5"
                                >
                                    <span className="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                                        <input
                                            type="radio"
                                            name="pay"
                                            value={method.value}
                                            checked={pay === method.value}
                                            onChange={() => setPay(method.value)}
                                            className="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                        />
                                        <span className="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100" />
                                    </span>

                                    <span className="flex min-w-0 flex-1 flex-col gap-1">
                                        <span className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                                            <span className="text-[13px]/5 text-zinc-200">{method.label}</span>
                                            <span className="shrink-0 font-mono text-[10px] text-zinc-600">{method.meta}</span>
                                        </span>
                                        <span className="text-xs/5 text-zinc-500">{method.detail}</span>
                                    </span>
                                </label>
                            ))}
                        </div>

                        {(pay === 'card' || pay === 'instalment') && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-5">
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <div className="sm:col-span-2">
                                        <CheckoutCardField value={card} onChange={setCard} hint="Test card. Nothing here reaches a real processor." />
                                    </div>

                                    <UiInput label="Expiry" defaultValue="09 / 28" autoComplete="cc-exp" className="font-mono" />
                                    <UiInput label="Security code" defaultValue="•••" autoComplete="cc-csc" hint="Three digits on the back, four on the front for Amex." className="font-mono" />

                                    <div className="sm:col-span-2">
                                        <UiInput label="Name on the card" defaultValue="WEI HAN CHEN" autoComplete="cc-name" />
                                    </div>
                                </div>

                                {pay === 'instalment' && (
                                    <div className="mt-4 rounded-xl border border-jade-500/25 bg-jade-500/6 p-4">
                                        <p className="text-[13px]/6 text-zinc-300">
                                            Six payments of <span className="font-mono text-cream">$192</span>, first one tonight, the rest on the same date each month.
                                            Your bank shows it as one transaction and splits it afterwards — cancelling the plan is between you and them.
                                        </p>
                                    </div>
                                )}
                            </div>
                        )}

                        {pay === 'transfer' && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-5">
                                <div className="flex flex-wrap items-start justify-between gap-4">
                                    <div>
                                        <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Virtual account, issued after you place the order</p>
                                        <p className="mt-2 font-mono text-lg text-cream">808 · 2681 5573 0914</p>
                                        <p className="mt-2 text-[13px]/6 text-zinc-500">
                                            Good for 24 hours. We hold the grinder that long and not a minute more — it is the last one in graphite.
                                        </p>
                                    </div>
                                    <span className="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[10px] text-zinc-500">E.SUN Bank 808</span>
                                </div>
                            </div>
                        )}

                        {pay === 'onsite' && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-5">
                                {ship === 'pickup' ? (
                                    <p className="text-[13px]/6 text-zinc-400">Pay on the counter when you collect. Bring the order number; the invoice prints there.</p>
                                ) : (
                                    <p className="text-[13px]/6 text-zinc-400">
                                        This one only works with workshop collection.{' '}
                                        <a href="/templates/checkout/screens/delivery" target="_top" className="text-jade-400 transition-colors duration-150 hover:text-jade-300">Switch the delivery method →</a>
                                    </p>
                                )}
                            </div>
                        )}
                    </section>

                    <section className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <UiCheckbox
                            checked={billingSame}
                            onChange={(event) => setBillingSame(event.target.checked)}
                            label="Billing address is the delivery address"
                            description="Untick it if the card is registered somewhere else — the bank checks the postcode."
                        />

                        {!billingSame && (
                            <div className="mt-5 grid gap-4 sm:grid-cols-2">
                                <UiInput label="Billing postcode" placeholder="106" inputMode="numeric" />
                                <UiInput label="City" placeholder="Taipei" />

                                <div className="sm:col-span-2">
                                    <UiInput label="Billing street" placeholder="205 Dunhua S. Road, Section 1" />
                                </div>
                            </div>
                        )}
                    </section>

                    <section className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                            <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">E-invoice</h2>
                            <span className="font-mono text-[10px] text-zinc-600">issued the day it ships, not today</span>
                        </div>

                        <div className="grid gap-3 p-5 sm:grid-cols-2 lg:grid-cols-4">
                            {invoices.map((option) => (
                                <label
                                    key={option.value}
                                    className="flex cursor-pointer items-start gap-2.5 rounded-xl border border-white/10 bg-ink-950 p-3.5 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5"
                                >
                                    <span className="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                                        <input
                                            type="radio"
                                            name="invoice"
                                            value={option.value}
                                            checked={invoice === option.value}
                                            onChange={() => setInvoice(option.value)}
                                            className="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                        />
                                        <span className="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100" />
                                    </span>

                                    <span className="flex min-w-0 flex-col gap-0.5">
                                        <span className="text-[13px]/5 text-zinc-200">{option.label}</span>
                                        <span className="text-xs/5 text-zinc-500">{option.detail}</span>
                                    </span>
                                </label>
                            ))}
                        </div>

                        {invoice === 'mobile' && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-5">
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <UiInput label="Carrier code" defaultValue="/ABC+123" className="font-mono" hint="Eight characters, starts with a slash." />
                                    <div className="flex items-end">
                                        <p className="pb-2.5 text-[13px]/6 text-zinc-500">The invoice lands in the carrier the night it ships. Nothing is printed and nothing is posted.</p>
                                    </div>
                                </div>
                            </div>
                        )}

                        {invoice === 'company' && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-5">
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <UiInput label="Tax ID number" placeholder="24681357" inputMode="numeric" className="font-mono" />
                                    <UiInput label="Company name" placeholder="Nomad Coffee Ltd" />
                                </div>
                                <p className="mt-3 font-mono text-[10px] text-zinc-600">A company invoice cannot be changed after it is issued — check the number twice.</p>
                            </div>
                        )}

                        {invoice === 'donate' && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-5">
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <UiInput label="Donation code" defaultValue="25885" className="font-mono" hint="Default is the Genesis Foundation. Any registered code works." />
                                    <div className="flex items-end">
                                        <p className="pb-2.5 text-[13px]/6 text-zinc-500">Donated invoices are not returnable to you, so we keep a copy against the order in case of a refund.</p>
                                    </div>
                                </div>
                            </div>
                        )}

                        {invoice === 'paper' && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-5">
                                <p className="text-[13px]/6 text-zinc-400">
                                    Posted to the delivery address a few days behind the box, not inside it. Choose this only if an accountant insists.
                                </p>
                            </div>
                        )}
                    </section>

                    <div className="flex flex-wrap items-center gap-4">
                        <UiButton variant="secondary" href="/templates/checkout/screens/delivery" target="_top">Back to delivery</UiButton>
                        <UiButton href="/templates/checkout/screens/confirmation" target="_top">Place the order</UiButton>
                        <span className="font-mono text-[10px] text-zinc-600">by placing it you accept the return terms below</span>
                    </div>

                    <p className="font-mono text-[10px]/5 text-zinc-600">
                        We store the last four digits and the authorisation code for the warranty and for refunds. Card numbers never touch our servers — the field above talks to the processor directly.
                    </p>
                </div>

                <div className="flex flex-col gap-4 lg:sticky lg:top-32">
                    <CheckoutSummary
                        items={items}
                        ship={ship}
                        discount={128}
                        discountLabel="BENCH10"
                        cta="Place the order"
                        href="/templates/checkout/screens/confirmation"
                        note="Charged when the workshop marks it packed, usually the same evening."
                    />

                    <div className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Delivering to</p>
                        <p className="mt-2.5 text-[13px]/6 text-zinc-400">
                            Wei-Han Chen · +886 912 345 678
                            <br />
                            2F, 227 Minsheng Road, West District, Taichung 403
                        </p>
                        <a href="/templates/checkout/screens/delivery" target="_top" className="mt-3 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">
                            Change it →
                        </a>
                    </div>

                    <p className="px-1 font-mono text-[10px]/5 text-zinc-600">
                        Refunds go back to the card that paid, five to ten working days depending on the bank. We cannot make that faster and nor can they.
                    </p>
                </div>
            </div>
        </CheckoutShell>
    );
}
