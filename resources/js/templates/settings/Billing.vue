<script setup>
import { ref } from 'vue';
import SettingsShell from './Shell.vue';
import SettingsSection from './Section.vue';
import SettingsRow from './Row.vue';
import UiBadge from '../../components/ui/Badge.vue';
import UiButton from '../../components/ui/Button.vue';
import UiInput from '../../components/ui/Input.vue';
import UiProgress from '../../components/ui/Progress.vue';
import UiSeparator from '../../components/ui/Separator.vue';
import UiSwitch from '../../components/ui/Switch.vue';
import UiTable from '../../components/ui/Table.vue';
import UiTextarea from '../../components/ui/Textarea.vue';
import UiToggleButton from '../../components/ui/ToggleButton.vue';

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

const cycle = ref('monthly');
const purchaseOrder = ref(false);
</script>

<template>
    <SettingsShell active="Billing" title="Billing" description="Plan, metered usage, and every invoice this workspace has ever raised.">
        <template #actions>
            <UiButton variant="secondary" size="sm">Billing portal</UiButton>
        </template>

        <SettingsSection flush heading="Plan" description="Renews 1 Sep 2026. Cancel any time and it runs to the end of the cycle.">
            <template #actions>
                <UiBadge color="jade">Scale</UiBadge>
            </template>

            <div class="px-5 py-4">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Projected total</p>
                        <p class="mt-1.5 text-2xl font-semibold tracking-tight text-cream">
                            $4,984.00 <span class="text-sm font-normal text-zinc-600">/ month</span>
                        </p>
                        <p class="mt-1 text-[11px] text-zinc-600">Charged to Visa •••• 4242 on 1 Sep</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <UiToggleButton v-model="cycle" type="radio" value="monthly" size="sm">Monthly</UiToggleButton>
                        <UiToggleButton v-model="cycle" type="radio" value="annual" size="sm">Annual · save 16%</UiToggleButton>
                    </div>
                </div>

                <UiSeparator class="my-4" />

                <ul class="flex flex-col gap-2.5">
                    <li v-for="line in lines" :key="line.label" class="flex items-baseline gap-4">
                        <span class="text-[13px] text-zinc-300">{{ line.label }}</span>
                        <span class="hidden truncate text-[11px] text-zinc-600 sm:block">{{ line.detail }}</span>
                        <span class="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">{{ line.amount }}</span>
                    </li>
                </ul>

                <div class="mt-4 flex flex-wrap gap-1.5">
                    <span v-for="feature in included" :key="feature" class="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{{ feature }}</span>
                </div>
            </div>

            <template #footer>
                <UiButton variant="secondary" size="sm">Change plan</UiButton>
                <button type="button" class="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Cancel subscription</button>
            </template>
        </SettingsSection>

        <SettingsSection flush heading="Usage this cycle" description="Metered on top of the plan. Nothing is billed until a limit is crossed.">
            <template #actions>
                <span class="font-mono text-[11px] text-zinc-600">resets 1 Sep</span>
            </template>

            <div class="flex flex-col gap-4 px-5 py-4">
                <div v-for="(quota, index) in quotas" :key="quota.label">
                    <UiProgress
                        :value="quota.used"
                        :max="quota.limit"
                        animate
                        :delay="index * 110"
                        :label="`${quota.label} · ${quota.used}/${quota.limit} ${quota.unit}`"
                    />
                    <p class="mt-1.5 font-mono text-[10px] text-zinc-600">{{ quota.rate }}</p>
                </div>
            </div>

            <template #footer>
                <span class="text-[11px]/5 text-zinc-600">Webhook events are at 94% — the next 60k trigger overage.</span>
                <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Set a usage alert</a>
            </template>
        </SettingsSection>

        <SettingsSection heading="Payment and tax" description="What the receipt says, and where it lands.">
            <SettingsRow label="Payment method" description="Retried twice before the account is suspended" align="center">
                <div class="flex items-center gap-3">
                    <span class="grid h-7 w-11 shrink-0 place-items-center rounded-md border border-white/10 bg-ink-950 font-mono text-[10px] text-zinc-400">VISA</span>
                    <div class="min-w-0">
                        <p class="truncate font-mono text-[13px] text-zinc-300">•••• •••• •••• 4242</p>
                        <p class="mt-0.5 font-mono text-[11px] text-zinc-600">expires 09 / 2028</p>
                    </div>
                    <UiButton variant="secondary" size="sm" class="ml-auto">Update</UiButton>
                </div>
            </SettingsRow>

            <SettingsRow label="Billing email" description="Separate from the account email">
                <UiInput size="sm" type="email" name="billing-email" value="ap@northbeam.com" class="max-w-xs" />
            </SettingsRow>

            <SettingsRow label="Tax ID" description="Printed on every invoice">
                <UiInput size="sm" name="vat" value="TW 24681357" class="max-w-xs" />
            </SettingsRow>

            <SettingsRow label="Billing address">
                <UiTextarea name="address" rows="3" :value="address" class="max-w-sm" />
            </SettingsRow>

            <SettingsRow label="PO number" description="Shown above the line items" align="center">
                <div class="flex items-center gap-3">
                    <span class="text-[13px] text-zinc-500">Required by your finance team</span>
                    <UiSwitch v-model="purchaseOrder" class="ml-auto" />
                </div>
            </SettingsRow>
        </SettingsSection>

        <SettingsSection flush heading="Invoices" description="Seven years of history, downloadable as PDF or CSV.">
            <template #actions>
                <UiButton variant="secondary" size="sm">Export CSV</UiButton>
            </template>

            <UiTable hover :rows="invoices" :columns="columns" class="rounded-none! border-0! bg-transparent!" />

            <template #footer>
                <span class="font-mono text-[11px] text-zinc-600">4 of 26 invoices</span>
                <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">View all</a>
            </template>
        </SettingsSection>
    </SettingsShell>
</template>
