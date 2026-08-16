@php
    $revenue = [
        ['label' => 'Sep', 'value' => 28.4],
        ['label' => 'Oct', 'value' => 30.1],
        ['label' => 'Nov', 'value' => 33.6],
        ['label' => 'Dec', 'value' => 35.2],
        ['label' => 'Jan', 'value' => 34.8],
        ['label' => 'Feb', 'value' => 37.9],
        ['label' => 'Mar', 'value' => 39.5],
        ['label' => 'Apr', 'value' => 41.2],
        ['label' => 'May', 'value' => 43.7],
        ['label' => 'Jun', 'value' => 44.1],
        ['label' => 'Jul', 'value' => 46.8],
        ['label' => 'Aug', 'value' => 48.2, 'highlight' => true],
    ];

    $quotas = [
        ['label' => 'API calls', 'used' => 8.4, 'limit' => 12, 'unit' => 'M'],
        ['label' => 'Asset storage', 'used' => 612, 'limit' => 1024, 'unit' => 'GB'],
        ['label' => 'Bandwidth', 'used' => 3.1, 'limit' => 5, 'unit' => 'TB'],
        ['label' => 'Webhook events', 'used' => 940, 'limit' => 1000, 'unit' => 'k'],
    ];

    $activity = [
        ['title' => 'Northbeam Supply upgraded to Scale', 'time' => '12m ago'],
        ['title' => 'Payout batch #4471 settled — $18,204', 'time' => '48m ago'],
        ['title' => 'Kettle & Co. added 6 seats', 'time' => '2h ago'],
        ['title' => 'Trial started — Verdant Studio', 'time' => '3h ago'],
        ['title' => 'Dunning retry cleared for Halcyon', 'time' => '5h ago', 'state' => 'current'],
    ];

    $risk = [
        ['name' => 'Halcyon Goods', 'reason' => 'Card declined twice', 'mrr' => '$890', 'tone' => 'red'],
        ['name' => 'Pale Fire Ltd', 'reason' => 'Usage down 41%', 'mrr' => '$640', 'tone' => 'amber'],
        ['name' => 'Osprey Outfitters', 'reason' => 'No login in 21 days', 'mrr' => '$420', 'tone' => 'amber'],
    ];
@endphp

<x-templates.dashboard.shell active="Overview" title="Overview" :crumbs="[['label' => 'wharf', 'href' => '#'], ['label' => 'Overview']]">
    <x-slot:actions>
        <x-ui.select :options="['Last 30 days', 'Last 90 days', 'Year to date']" value="Last 30 days" size="sm" name="overview-range" class="w-40" />
        <x-ui.button variant="secondary" size="sm">Export</x-ui.button>
        <x-ui.button size="sm">Invite merchant</x-ui.button>
    </x-slot>

    <div class="grid grid-cols-4 gap-4">
        <x-templates.dashboard.stat label="MRR" :value="48240" prefix="$" delta="12.4%" trend="up" hint="vs last month" />
        <x-templates.dashboard.stat label="Active merchants" :value="1284" delta="3.1%" trend="up" hint="42 new this month" />
        <x-templates.dashboard.stat label="Net revenue churn" :value="2.1" :decimals="1" suffix="%" delta="0.4pt" trend="down" hint="improved" />
        <x-templates.dashboard.stat label="Seats in use" :value="312" delta="18" trend="up" hint="of 400 licensed" />
    </div>

    <div class="grid grid-cols-3 gap-4">
        <x-ui.card class="col-span-2">
            <x-slot:header>
                <div class="flex items-baseline justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-cream">Recurring revenue</h2>
                        <p class="mt-0.5 text-xs text-zinc-500">Monthly, in thousands of USD</p>
                    </div>
                    <span class="font-mono text-xs text-jade-400">+69.7% YoY</span>
                </div>
            </x-slot>

            <x-ui.animated-column-chart :items="$revenue" height="h-52" />
        </x-ui.card>

        <x-ui.card>
            <x-slot:header>
                <h2 class="text-sm font-medium text-cream">Plan mix</h2>
            </x-slot>

            <x-ui.meter-group :segments="[
                ['label' => 'Scale', 'value' => 34, 'color' => 'jade'],
                ['label' => 'Growth', 'value' => 47, 'color' => 'mint'],
                ['label' => 'Starter', 'value' => 19, 'color' => 'zinc'],
            ]" total="1,284 merchants" />

            <x-ui.separator class="my-4" />

            <dl class="grid grid-cols-2 gap-3 text-xs">
                <div>
                    <dt class="text-zinc-500">ARPA</dt>
                    <dd class="mt-1 font-mono text-sm text-cream">$37.60</dd>
                </div>
                <div>
                    <dt class="text-zinc-500">Trial → paid</dt>
                    <dd class="mt-1 font-mono text-sm text-cream">31.8%</dd>
                </div>
                <div>
                    <dt class="text-zinc-500">Expansion MRR</dt>
                    <dd class="mt-1 font-mono text-sm text-jade-400">+$5,120</dd>
                </div>
                <div>
                    <dt class="text-zinc-500">Contraction</dt>
                    <dd class="mt-1 font-mono text-sm text-red-400">−$1,010</dd>
                </div>
            </dl>
        </x-ui.card>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <x-ui.card>
            <x-slot:header>
                <div class="flex items-baseline justify-between">
                    <h2 class="text-sm font-medium text-cream">Plan quota</h2>
                    <span class="font-mono text-[11px] text-zinc-600">resets 1 Sep</span>
                </div>
            </x-slot>

            <div class="flex flex-col gap-3.5">
                @foreach ($quotas as $quota)
                    <x-ui.progress :value="$quota['used']" :max="$quota['limit']"
                        :label="$quota['label'].' · '.$quota['used'].'/'.$quota['limit'].' '.$quota['unit']" />
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card>
            <x-slot:header>
                <h2 class="text-sm font-medium text-cream">Recent activity</h2>
            </x-slot>

            <x-ui.timeline :items="$activity" variant="compact" />
        </x-ui.card>

        <x-ui.card>
            <x-slot:header>
                <div class="flex items-baseline justify-between">
                    <h2 class="text-sm font-medium text-cream">Churn risk</h2>
                    <x-ui.badge color="red" class="py-0.5">3 accounts</x-ui.badge>
                </div>
            </x-slot>

            <ul class="flex flex-col gap-3">
                @foreach ($risk as $account)
                    <li class="flex items-start gap-3">
                        <span @class(['mt-1.5 size-1.5 shrink-0 rounded-full', 'bg-red-400' => $account['tone'] === 'red', 'bg-amber-400' => $account['tone'] === 'amber'])></span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[13px] text-zinc-200">{{ $account['name'] }}</p>
                            <p class="mt-0.5 text-[11px] text-zinc-500">{{ $account['reason'] }}</p>
                        </div>
                        <span class="shrink-0 font-mono text-[11px] text-zinc-500">{{ $account['mrr'] }}</span>
                    </li>
                @endforeach
            </ul>

            <x-ui.button variant="ghost" size="sm" class="mt-3 w-full">Open retention queue</x-ui.button>
        </x-ui.card>
    </div>
</x-templates.dashboard.shell>
