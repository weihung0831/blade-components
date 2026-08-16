<script setup>
import { ref } from 'vue';
import DashboardShell from './Shell.vue';
import DashboardStat from './Stat.vue';
import UiSearch from '../../components/ui/Search.vue';
import UiSelect from '../../components/ui/Select.vue';
import UiButton from '../../components/ui/Button.vue';
import UiChip from '../../components/ui/Chip.vue';
import UiSeparator from '../../components/ui/Separator.vue';
import UiDropdown from '../../components/ui/Dropdown.vue';
import UiTable from '../../components/ui/Table.vue';
import UiPagination from '../../components/ui/Pagination.vue';

const plan = ref('All plans');
const status = ref('Any status');
const region = ref('ap-1 · Taipei');

const crumbs = [{ label: 'wharf', href: '#' }, { label: 'Merchants' }];

const columns = [
    { key: 'merchant', label: 'Merchant' },
    { key: 'domain', label: 'Primary domain' },
    { key: 'plan', label: 'Plan' },
    { key: 'seats', label: 'Seats', align: 'right' },
    { key: 'mrr', label: 'MRR', align: 'right' },
    { key: 'status', label: 'Status', sortable: false },
    { key: 'joined', label: 'Joined', align: 'right' },
];

const rows = [
    { merchant: 'Northbeam Supply', domain: 'northbeam.shop', plan: 'Scale', seats: '24', mrr: '$1,480', status: { text: 'Active', dot: 'jade' }, joined: '2024-03-11' },
    { merchant: 'Kettle & Co.', domain: 'kettleandco.store', plan: 'Scale', seats: '18', mrr: '$1,120', status: { text: 'Active', dot: 'jade' }, joined: '2024-05-02' },
    { merchant: 'Verdant Studio', domain: 'verdant.studio', plan: 'Growth', seats: '9', mrr: '$620', status: { text: 'Trial', dot: 'zinc' }, joined: '2026-08-09' },
    { merchant: 'Osprey Outfitters', domain: 'osprey.outfitters', plan: 'Growth', seats: '12', mrr: '$420', status: { text: 'Active', dot: 'jade' }, joined: '2025-01-27' },
    { merchant: 'Halcyon Goods', domain: 'halcyon.goods', plan: 'Growth', seats: '7', mrr: '$890', status: { text: 'Past due', dot: 'zinc' }, joined: '2024-11-14' },
    { merchant: 'Pale Fire Ltd', domain: 'palefire.co', plan: 'Starter', seats: '3', mrr: '$640', status: { text: 'At risk', dot: 'zinc' }, joined: '2025-06-30' },
    { merchant: 'Cormorant Bakery', domain: 'cormorant.bakery', plan: 'Starter', seats: '2', mrr: '$180', status: { text: 'Active', dot: 'jade' }, joined: '2025-09-18' },
    { merchant: 'Tidewater Provisions', domain: 'tidewater.supply', plan: 'Growth', seats: '11', mrr: '$540', status: { text: 'Active', dot: 'jade' }, joined: '2025-02-05' },
    { merchant: 'Marlowe Press', domain: 'marlowe.press', plan: 'Starter', seats: '4', mrr: '$210', status: { text: 'Trial', dot: 'zinc' }, joined: '2026-08-12' },
    { merchant: 'Junebright Ceramics', domain: 'junebright.store', plan: 'Growth', seats: '6', mrr: '$460', status: { text: 'Active', dot: 'jade' }, joined: '2025-04-22' },
];
</script>

<template>
    <DashboardShell active="Merchants" title="Merchants" :crumbs="crumbs">
        <template #actions>
            <UiButton variant="secondary" size="sm">Import CSV</UiButton>
            <UiButton size="sm">Invite merchant</UiButton>
        </template>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <DashboardStat label="Total merchants" :value="1284" delta="42" trend="up" hint="new this month" />
            <DashboardStat label="On trial" :value="96" delta="11" trend="up" hint="31.8% convert" />
            <DashboardStat label="Past due" :value="14" delta="3" trend="down" hint="dunning day 2–14" />
            <DashboardStat label="Seats provisioned" :value="312" delta="5.8%" trend="up" hint="of 400 licensed" />
        </div>

        <div class="flex flex-wrap items-center gap-2 rounded-xl border border-white/10 bg-ink-800 p-2">
            <UiSearch size="sm" placeholder="Filter by name or domain…" class="max-w-64" />
            <UiSelect v-model="plan" :options="['All plans', 'Scale', 'Growth', 'Starter']" size="sm" class="w-36" />
            <UiSelect v-model="status" :options="['Any status', 'Active', 'Trial', 'Past due', 'At risk']" size="sm" class="w-36" />
            <UiSelect v-model="region" :options="['ap-1 · Taipei', 'ap-2 · Tokyo', 'us-1 · Ashburn']" size="sm" class="w-40" />

            <UiSeparator vertical class="mx-1 h-6 self-center" />

            <UiChip label="MRR > $400" removable />
            <UiChip label="Created this year" removable />

            <div class="ml-auto flex items-center gap-1.5">
                <span class="font-mono text-[11px] text-zinc-600">10 of 1,284</span>
                <UiDropdown variant="ghost" align="right" class="[&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]">
                    Bulk actions
                    <template #menu>
                        <button type="button">Change plan</button>
                        <button type="button">Move region</button>
                        <button type="button">Export selection</button>
                        <hr>
                        <button type="button">Suspend</button>
                    </template>
                </UiDropdown>
            </div>
        </div>

        <UiTable :columns="columns" :rows="rows" hover striped />

        <div class="flex flex-wrap items-center justify-between gap-3">
            <p class="font-mono text-[11px] text-zinc-600">Showing 1–10 of 1,284 merchants</p>
            <UiPagination :pages="129" :current="1" />
        </div>
    </DashboardShell>
</template>
