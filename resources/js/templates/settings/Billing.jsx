import { useState } from 'react';
import { SettingsShell } from './Shell';
import { SettingsSection } from './Section';
import { SettingsRow } from './Row';
import { UiBadge } from '../../components/ui/Badge';
import { UiButton } from '../../components/ui/Button';
import { UiInput } from '../../components/ui/Input';
import { UiProgress } from '../../components/ui/Progress';
import { UiSeparator } from '../../components/ui/Separator';
import { UiSwitch } from '../../components/ui/Switch';
import { UiTable } from '../../components/ui/Table';
import { UiTextarea } from '../../components/ui/Textarea';
import { UiToggleButton } from '../../components/ui/ToggleButton';

const quotas = [
    { label: 'API calls', used: 8.4, limit: 12, unit: 'M', rate: '$0.40 per extra 10k' },
    { label: 'Asset storage', used: 612, limit: 1024, unit: 'GB', rate: '$0.09 per extra GB' },
    { label: 'Bandwidth', used: 3.1, limit: 5, unit: 'TB', rate: '$0.05 per extra GB' },
    { label: 'Webhook events', used: 940, limit: 1000, unit: 'k', rate: '$2 per extra 100k' },
];

const lines = [
    { label: 'Scale platform fee', detail: 'Monthly, 1 Aug – 31 Aug', amount: '$1,240.00' },
    { label: '312 seats', detail: '$12 each, 18 added mid-cycle', amount: '$3,744.00' },
    { label: 'Metered overage', detail: 'Nothing over the limit yet', amount: '$0.00' },
];

const columns = [
    { key: 'invoice', label: 'Invoice' },
    { key: 'date', label: 'Date' },
    { key: 'status', label: 'Status', sortable: false },
    { key: 'amount', label: 'Amount', align: 'right' },
];

const invoices = [
    { invoice: 'INV-2026-0801', date: '1 Aug 2026', amount: '$4,908.00', status: { text: 'Paid', dot: 'jade' } },
    { invoice: 'INV-2026-0701', date: '1 Jul 2026', amount: '$4,692.00', status: { text: 'Paid', dot: 'jade' } },
    { invoice: 'INV-2026-0601', date: '1 Jun 2026', amount: '$4,464.00', status: { text: 'Paid', dot: 'jade' } },
    { invoice: 'INV-2026-0501', date: '1 May 2026', amount: '$4,464.00', status: { text: 'Refunded', dot: 'zinc' } },
];

const included = ['3 data regions', 'SAML SSO', '99.95% SLA', 'Audit log retention 1y', 'Priority support'];

const address = `7F, No. 88 Zhongxiao E. Rd. Sec. 4
Da'an District, Taipei 106
Taiwan`;

export function SettingsBilling() {
    const [cycle, setCycle] = useState('monthly');

    return (
        <SettingsShell
            active="Billing"
            title="Billing"
            description="Plan, metered usage, and every invoice this workspace has ever raised."
            actions={<UiButton variant="secondary" size="sm">Billing portal</UiButton>}
        >
            <SettingsSection
                flush
                heading="Plan"
                description="Renews 1 Sep 2026. Cancel any time and it runs to the end of the cycle."
                actions={<UiBadge color="jade">Scale</UiBadge>}
                footer={
                    <>
                        <UiButton variant="secondary" size="sm">Change plan</UiButton>
                        <button type="button" className="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Cancel subscription</button>
                    </>
                }
            >
                <div className="px-5 py-4">
                    <div className="flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Projected total</p>
                            <p className="mt-1.5 text-2xl font-semibold tracking-tight text-cream">
                                $4,984.00 <span className="text-sm font-normal text-zinc-600">/ month</span>
                            </p>
                            <p className="mt-1 text-[11px] text-zinc-600">Charged to Visa •••• 4242 on 1 Sep</p>
                        </div>

                        <div className="flex items-center gap-2">
                            <UiToggleButton type="radio" name="cycle" size="sm" checked={cycle === 'monthly'} onChange={() => setCycle('monthly')}>Monthly</UiToggleButton>
                            <UiToggleButton type="radio" name="cycle" size="sm" checked={cycle === 'annual'} onChange={() => setCycle('annual')}>Annual · save 16%</UiToggleButton>
                        </div>
                    </div>

                    <UiSeparator className="my-4" />

                    <ul className="flex flex-col gap-2.5">
                        {lines.map((line) => (
                            <li key={line.label} className="flex items-baseline gap-4">
                                <span className="text-[13px] text-zinc-300">{line.label}</span>
                                <span className="hidden truncate text-[11px] text-zinc-600 sm:block">{line.detail}</span>
                                <span className="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">{line.amount}</span>
                            </li>
                        ))}
                    </ul>

                    <div className="mt-4 flex flex-wrap gap-1.5">
                        {included.map((feature) => (
                            <span key={feature} className="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{feature}</span>
                        ))}
                    </div>
                </div>
            </SettingsSection>

            <SettingsSection
                flush
                heading="Usage this cycle"
                description="Metered on top of the plan. Nothing is billed until a limit is crossed."
                actions={<span className="font-mono text-[11px] text-zinc-600">resets 1 Sep</span>}
                footer={
                    <>
                        <span className="text-[11px]/5 text-zinc-600">Webhook events are at 94% — the next 60k trigger overage.</span>
                        <a href="#" className="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Set a usage alert</a>
                    </>
                }
            >
                <div className="flex flex-col gap-4 px-5 py-4">
                    {quotas.map((quota, index) => (
                        <div key={quota.label}>
                            <UiProgress
                                value={quota.used}
                                max={quota.limit}
                                animate
                                delay={index * 110}
                                label={`${quota.label} · ${quota.used}/${quota.limit} ${quota.unit}`}
                            />
                            <p className="mt-1.5 font-mono text-[10px] text-zinc-600">{quota.rate}</p>
                        </div>
                    ))}
                </div>
            </SettingsSection>

            <SettingsSection heading="Payment and tax" description="What the receipt says, and where it lands.">
                <SettingsRow label="Payment method" description="Retried twice before the account is suspended" align="center">
                    <div className="flex items-center gap-3">
                        <span className="grid h-7 w-11 shrink-0 place-items-center rounded-md border border-white/10 bg-ink-950 font-mono text-[10px] text-zinc-400">VISA</span>
                        <div className="min-w-0">
                            <p className="truncate font-mono text-[13px] text-zinc-300">•••• •••• •••• 4242</p>
                            <p className="mt-0.5 font-mono text-[11px] text-zinc-600">expires 09 / 2028</p>
                        </div>
                        <UiButton variant="secondary" size="sm" className="ml-auto">Update</UiButton>
                    </div>
                </SettingsRow>

                <SettingsRow label="Billing email" description="Separate from the account email">
                    <UiInput size="sm" type="email" name="billing-email" defaultValue="ap@northbeam.com" className="max-w-xs" />
                </SettingsRow>

                <SettingsRow label="Tax ID" description="Printed on every invoice">
                    <UiInput size="sm" name="vat" defaultValue="TW 24681357" className="max-w-xs" />
                </SettingsRow>

                <SettingsRow label="Billing address">
                    <UiTextarea name="address" rows={3} defaultValue={address} className="max-w-sm" />
                </SettingsRow>

                <SettingsRow label="PO number" description="Shown above the line items" align="center">
                    <div className="flex items-center gap-3">
                        <span className="text-[13px] text-zinc-500">Required by your finance team</span>
                        <UiSwitch className="ml-auto" />
                    </div>
                </SettingsRow>
            </SettingsSection>

            <SettingsSection
                flush
                heading="Invoices"
                description="Seven years of history, downloadable as PDF or CSV."
                actions={<UiButton variant="secondary" size="sm">Export CSV</UiButton>}
                footer={
                    <>
                        <span className="font-mono text-[11px] text-zinc-600">4 of 26 invoices</span>
                        <a href="#" className="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">View all</a>
                    </>
                }
            >
                <UiTable hover rows={invoices} columns={columns} className="rounded-none! border-0! bg-transparent!" />
            </SettingsSection>
        </SettingsShell>
    );
}
