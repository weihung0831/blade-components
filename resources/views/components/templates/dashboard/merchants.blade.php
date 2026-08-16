@php
    $columns = [
        ['key' => 'merchant', 'label' => 'Merchant'],
        ['key' => 'domain', 'label' => 'Primary domain'],
        ['key' => 'plan', 'label' => 'Plan'],
        ['key' => 'seats', 'label' => 'Seats', 'align' => 'right'],
        ['key' => 'mrr', 'label' => 'MRR', 'align' => 'right'],
        ['key' => 'status', 'label' => 'Status', 'sortable' => false],
        ['key' => 'joined', 'label' => 'Joined', 'align' => 'right'],
    ];

    $rows = [
        ['merchant' => 'Northbeam Supply', 'domain' => 'northbeam.shop', 'plan' => 'Scale', 'seats' => '24', 'mrr' => '$1,480', 'status' => ['text' => 'Active', 'dot' => 'jade'], 'joined' => '2024-03-11'],
        ['merchant' => 'Kettle & Co.', 'domain' => 'kettleandco.store', 'plan' => 'Scale', 'seats' => '18', 'mrr' => '$1,120', 'status' => ['text' => 'Active', 'dot' => 'jade'], 'joined' => '2024-05-02'],
        ['merchant' => 'Verdant Studio', 'domain' => 'verdant.studio', 'plan' => 'Growth', 'seats' => '9', 'mrr' => '$620', 'status' => ['text' => 'Trial', 'dot' => 'zinc'], 'joined' => '2026-08-09'],
        ['merchant' => 'Osprey Outfitters', 'domain' => 'osprey.outfitters', 'plan' => 'Growth', 'seats' => '12', 'mrr' => '$420', 'status' => ['text' => 'Active', 'dot' => 'jade'], 'joined' => '2025-01-27'],
        ['merchant' => 'Halcyon Goods', 'domain' => 'halcyon.goods', 'plan' => 'Growth', 'seats' => '7', 'mrr' => '$890', 'status' => ['text' => 'Past due', 'dot' => 'zinc'], 'joined' => '2024-11-14'],
        ['merchant' => 'Pale Fire Ltd', 'domain' => 'palefire.co', 'plan' => 'Starter', 'seats' => '3', 'mrr' => '$640', 'status' => ['text' => 'At risk', 'dot' => 'zinc'], 'joined' => '2025-06-30'],
        ['merchant' => 'Cormorant Bakery', 'domain' => 'cormorant.bakery', 'plan' => 'Starter', 'seats' => '2', 'mrr' => '$180', 'status' => ['text' => 'Active', 'dot' => 'jade'], 'joined' => '2025-09-18'],
        ['merchant' => 'Tidewater Provisions', 'domain' => 'tidewater.supply', 'plan' => 'Growth', 'seats' => '11', 'mrr' => '$540', 'status' => ['text' => 'Active', 'dot' => 'jade'], 'joined' => '2025-02-05'],
        ['merchant' => 'Marlowe Press', 'domain' => 'marlowe.press', 'plan' => 'Starter', 'seats' => '4', 'mrr' => '$210', 'status' => ['text' => 'Trial', 'dot' => 'zinc'], 'joined' => '2026-08-12'],
        ['merchant' => 'Junebright Ceramics', 'domain' => 'junebright.store', 'plan' => 'Growth', 'seats' => '6', 'mrr' => '$460', 'status' => ['text' => 'Active', 'dot' => 'jade'], 'joined' => '2025-04-22'],
    ];
@endphp

<x-templates.dashboard.shell active="Merchants" title="Merchants" :crumbs="[['label' => 'wharf', 'href' => '#'], ['label' => 'Merchants']]">
    <x-slot:actions>
        <x-ui.button variant="secondary" size="sm">Import CSV</x-ui.button>
        <x-ui.button size="sm">Invite merchant</x-ui.button>
    </x-slot>

    <div class="grid grid-cols-4 gap-4">
        <x-templates.dashboard.stat label="Total merchants" :value="1284" delta="42" trend="up" hint="new this month"
            :points="[1180, 1195, 1210, 1218, 1240, 1251, 1270, 1284]" />
        <x-templates.dashboard.stat label="On trial" :value="96" delta="11" trend="up" hint="31.8% convert"
            :points="[72, 78, 81, 84, 88, 90, 93, 96]" />
        <x-templates.dashboard.stat label="Past due" :value="14" delta="3" trend="down" hint="dunning day 2–14"
            :points="[22, 21, 19, 18, 17, 16, 15, 14]" />
        <x-templates.dashboard.stat label="Seats provisioned" :value="312" delta="5.8%" trend="up" hint="of 400 licensed"
            :points="[248, 259, 268, 274, 288, 297, 305, 312]" />
    </div>

    <div class="flex flex-wrap items-center gap-2 rounded-xl border border-white/10 bg-ink-800 p-2">
        <x-ui.search size="sm" placeholder="Filter by name or domain…" class="max-w-64" />
        <x-ui.select :options="['All plans', 'Scale', 'Growth', 'Starter']" value="All plans" size="sm" name="merchant-plan" class="w-36" />
        <x-ui.select :options="['Any status', 'Active', 'Trial', 'Past due', 'At risk']" value="Any status" size="sm" name="merchant-status" class="w-36" />
        <x-ui.select :options="['ap-1 · Taipei', 'ap-2 · Tokyo', 'us-1 · Ashburn']" value="ap-1 · Taipei" size="sm" name="merchant-region" class="w-40" />

        <x-ui.separator vertical class="mx-1 h-6 self-center" />

        <x-ui.chip label="MRR > $400" removable />
        <x-ui.chip label="Created this year" removable />

        <div class="ml-auto flex items-center gap-1.5">
            <span class="font-mono text-[11px] text-zinc-600">10 of 1,284</span>
            <x-ui.dropdown variant="ghost" align="right" class="[&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]">
                Bulk actions
                <x-slot:menu>
                    <button type="button">Change plan</button>
                    <button type="button">Move region</button>
                    <button type="button">Export selection</button>
                    <hr>
                    <button type="button">Suspend</button>
                </x-slot>
            </x-ui.dropdown>
        </div>
    </div>

    <x-ui.table :columns="$columns" :rows="$rows" hover striped />

    <div class="flex items-center justify-between">
        <p class="font-mono text-[11px] text-zinc-600">Showing 1–10 of 1,284 merchants</p>
        <x-ui.pagination :pages="129" :current="1" />
    </div>
</x-templates.dashboard.shell>
