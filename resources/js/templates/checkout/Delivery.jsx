import { useState } from 'react';
import { UiButton } from '../../components/ui/actions/Button';
import { UiCheckbox } from '../../components/ui/forms/Checkbox';
import { UiInput } from '../../components/ui/forms/Input';
import { UiSelect } from '../../components/ui/forms/Select';
import { UiTextarea } from '../../components/ui/forms/Textarea';
import { CheckoutShell } from './Shell';
import { CheckoutSummary } from './Summary';
import { CheckoutShipOption } from './ShipOption';

const items = [
    { sku: 'EG83-GRA', name: 'EG-83 grinder', option: 'graphite', price: 1180, qty: 1 },
    { sku: 'SHM-KIT', name: 'Alignment shim kit', option: '0.05 / 0.1 / 0.2 mm', price: 28, qty: 1 },
    { sku: 'CUP-58', name: 'Dosing cup, 58 mm', option: 'stainless', price: 36, qty: 2 },
];

const options = [
    {
        value: 'standard',
        label: 'Home delivery, T-Cat',
        detail: 'Signature on the door. One redelivery attempt, then it waits at the depot for five days.',
        price: 0,
        eta: 'arrives Thu 20 – Mon 24 Aug',
    },
    {
        value: 'express',
        label: 'Next day, before noon',
        detail: "Booked on tonight's run if the order is in before 15:00. Taiwan main island only.",
        price: 18,
        eta: 'arrives tomorrow, Tue 18 Aug',
    },
    {
        value: 'pickup',
        label: 'Collect at the workshop',
        detail: 'We dial it in with you on your beans before you carry it out. Takes about twenty minutes.',
        price: 0,
        eta: 'ready today from 17:00, Taichung West District',
    },
    {
        value: 'intl',
        label: 'International, DHL',
        detail: 'Voltage is set to your region before it ships. Plug type is chosen from the address.',
        price: 68,
        eta: 'DHL · 7–12 business days',
        note: 'duties and local VAT are collected on arrival, not here',
    },
];

const cities = ['Taichung', 'Taipei', 'New Taipei', 'Taoyuan', 'Tainan', 'Kaohsiung'];
const districts = ['West District', 'North District', 'Central District', 'Nantun', 'Xitun'];

export function CheckoutDelivery() {
    const [ship, setShip] = useState('standard');
    const [city, setCity] = useState('Taichung');
    const [district, setDistrict] = useState('West District');

    return (
        <CheckoutShell active="Delivery" ship={ship}>
            <div className="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
                <div className="flex flex-col gap-6">
                    <div>
                        <h1 className="text-2xl font-semibold tracking-tight text-cream">Where it goes, and how fast</h1>
                        <p className="mt-2 max-w-xl text-sm/6 text-zinc-500">
                            Pick the method first — it changes the price, the date, and whether we need a phone number that answers.
                        </p>
                    </div>

                    <section className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                            <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">How it travels</h2>
                            <span className="font-mono text-[10px] text-zinc-600">packed 34 × 24 × 41 cm · 8.6 kg</span>
                        </div>

                        <div className="grid gap-3 p-5 sm:grid-cols-2">
                            {options.map((option) => (
                                <CheckoutShipOption
                                    key={option.value}
                                    value={option.value}
                                    label={option.label}
                                    detail={option.detail}
                                    price={option.price}
                                    eta={option.eta}
                                    note={option.note ?? null}
                                    checked={ship === option.value}
                                    onSelect={setShip}
                                />
                            ))}
                        </div>

                        {ship === 'pickup' && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-4">
                                <div className="flex flex-wrap items-start justify-between gap-4">
                                    <div>
                                        <p className="text-[13px] text-cream">NOMAD workshop · 2F, 227 Minsheng Road, West District, Taichung</p>
                                        <p className="mt-1.5 text-[13px]/6 text-zinc-500">
                                            Ring the bell marked 2F. Weekdays 11:00–19:00, Saturday 12:00–17:00, closed Sunday.
                                            Bring 200 g of the beans you actually drink.
                                        </p>
                                    </div>
                                    <span className="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[10px] text-zinc-500">MRT City Hall · 12 min walk</span>
                                </div>
                            </div>
                        )}

                        {ship === 'intl' && (
                            <div className="border-t border-white/5 bg-ink-950 px-5 py-4">
                                <p className="text-[13px]/6 text-zinc-400">
                                    We declare the full value — no undervalued invoices, no exceptions. Expect your country's import VAT plus a DHL handling fee before it is released.
                                    Returns from outside Taiwan are on you for the freight.
                                </p>
                            </div>
                        )}
                    </section>

                    <section className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                            <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Who signs for it</h2>
                            <span className="font-mono text-[10px] text-zinc-600">the courier calls before the van turns in</span>
                        </div>

                        <form className="grid gap-4 p-5 sm:grid-cols-2" onSubmit={(event) => event.preventDefault()}>
                            <UiInput label="Recipient" defaultValue="Wei-Han Chen" autoComplete="name" />
                            <UiInput label="Phone" type="tel" defaultValue="+886 912 345 678" autoComplete="tel" hint="A mobile that answers. The driver calls, not texts." />

                            <div className="sm:col-span-2">
                                <UiInput label="Email for the receipt" type="email" defaultValue="wei@nomadsupply.tw" autoComplete="email" />
                            </div>

                            <div>
                                <p className="mb-1.5 text-[13px] text-zinc-400">City</p>
                                <UiSelect value={city} onChange={setCity} options={cities} />
                            </div>

                            <div>
                                <p className="mb-1.5 text-[13px] text-zinc-400">District</p>
                                <UiSelect value={district} onChange={setDistrict} options={districts} />
                            </div>

                            <UiInput label="Postcode" defaultValue="403" inputMode="numeric" />
                            <UiInput label="Street and number" defaultValue="227 Minsheng Road" />

                            <div className="sm:col-span-2">
                                <UiInput label="Floor, unit, or landmark" placeholder="5F-2, the door beside the laundry" hint="Optional, but it is the line that saves a redelivery." />
                            </div>

                            <div className="sm:col-span-2">
                                <UiTextarea label="Note for the driver" rows={2} autoResize placeholder="Leave with the shop downstairs if nobody answers." />
                            </div>

                            <div className="flex flex-col gap-3 sm:col-span-2">
                                <UiCheckbox defaultChecked label="Save this address to the account" description="Used for the warranty record too, so the serial stays attached to a real address." />
                                <UiCheckbox label="Wrap it as a gift" description="Kraft paper, no prices on the packing slip, and a card written by whoever packs it." />
                            </div>
                        </form>
                    </section>

                    <div className="flex flex-wrap items-center gap-4">
                        <UiButton variant="secondary" href="/templates/checkout/screens/cart" target="_top">Back to cart</UiButton>
                        <UiButton href="/templates/checkout/screens/payment" target="_top">Continue to payment</UiButton>
                        <span className="font-mono text-[10px] text-zinc-600">nothing is charged until the last screen</span>
                    </div>
                </div>

                <div className="flex flex-col gap-4 lg:sticky lg:top-32">
                    <CheckoutSummary
                        items={items}
                        ship={ship}
                        discount={128}
                        discountLabel="BENCH10"
                        note="Shipping updates the moment you pick a method."
                    />

                    <div className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">If nobody is home</p>
                        <p className="mt-2.5 text-[13px]/6 text-zinc-400">
                            T-Cat tries once more the next working day, then holds it at the depot for five days. After that it comes back to us and we refund the freight, not the order.
                        </p>
                    </div>

                    <p className="px-1 font-mono text-[10px]/5 text-zinc-600">
                        Address changes are possible until the label prints, usually around 16:00 the day it ships.
                    </p>
                </div>
            </div>
        </CheckoutShell>
    );
}
