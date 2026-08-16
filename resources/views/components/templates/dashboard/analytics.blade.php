@php
    $sessions = [
        ['label' => '01', 'value' => 24],
        ['label' => '03', 'value' => 27],
        ['label' => '05', 'value' => 31],
        ['label' => '07', 'value' => 29],
        ['label' => '09', 'value' => 34],
        ['label' => '11', 'value' => 38],
        ['label' => '13', 'value' => 36],
        ['label' => '15', 'value' => 41],
        ['label' => '17', 'value' => 44],
        ['label' => '19', 'value' => 40],
        ['label' => '21', 'value' => 47],
        ['label' => '23', 'value' => 52],
        ['label' => '25', 'value' => 49],
        ['label' => '27', 'value' => 58, 'highlight' => true],
    ];

    $sources = [
        ['label' => 'Direct', 'value' => 148, 'highlight' => true],
        ['label' => 'Search', 'value' => 112],
        ['label' => 'Social', 'value' => 74],
        ['label' => 'Email', 'value' => 51],
        ['label' => 'Affiliate', 'value' => 27],
    ];

    $funnel = [
        ['step' => 'Storefront visit', 'count' => 412_800, 'percent' => 100, 'drop' => null],
        ['step' => 'Product viewed', 'count' => 246_100, 'percent' => 60, 'drop' => '−40.4%'],
        ['step' => 'Added to cart', 'count' => 88_400, 'percent' => 21, 'drop' => '−64.1%'],
        ['step' => 'Checkout started', 'count' => 31_900, 'percent' => 8, 'drop' => '−63.9%'],
        ['step' => 'Order paid', 'count' => 14_035, 'percent' => 3, 'drop' => '−56.0%'],
    ];

    $storefronts = [
        ['key' => 'store', 'label' => 'Storefront'],
        ['key' => 'sessions', 'label' => 'Sessions', 'align' => 'right'],
        ['key' => 'conversion', 'label' => 'CVR', 'align' => 'right'],
        ['key' => 'revenue', 'label' => 'Revenue', 'align' => 'right'],
        ['key' => 'trend', 'label' => 'Trend', 'align' => 'right'],
    ];

    $storefrontRows = [
        ['store' => 'northbeam.shop', 'sessions' => '84,120', 'conversion' => '4.8%', 'revenue' => '$62,410', 'trend' => '+18.2%'],
        ['store' => 'kettleandco.store', 'sessions' => '61,904', 'conversion' => '3.9%', 'revenue' => '$41,880', 'trend' => '+9.4%'],
        ['store' => 'verdant.studio', 'sessions' => '48,331', 'conversion' => '3.1%', 'revenue' => '$28,205', 'trend' => '+4.1%'],
        ['store' => 'osprey.outfitters', 'sessions' => '37,712', 'conversion' => '2.6%', 'revenue' => '$19,640', 'trend' => '−2.8%'],
        ['store' => 'palefire.co', 'sessions' => '29,455', 'conversion' => '2.2%', 'revenue' => '$12,915', 'trend' => '−6.5%'],
    ];
@endphp

<x-templates.dashboard.shell active="Analytics" title="Analytics" :crumbs="[['label' => 'wharf', 'href' => '#'], ['label' => 'Analytics']]">
    <x-slot:actions>
        <x-ui.select :options="['All storefronts', 'Scale plan only', 'Trials']" value="All storefronts" size="sm" name="analytics-scope" class="w-44" />
        <x-ui.select :options="['Last 28 days', 'Last 7 days', 'This quarter']" value="Last 28 days" size="sm" name="analytics-range" class="w-40" />
        <x-ui.button variant="secondary" size="sm">Share report</x-ui.button>
    </x-slot>

    <div class="grid grid-cols-4 gap-4">
        <x-templates.dashboard.stat label="Sessions" :value="412800" delta="14.9%" trend="up" hint="vs prior 28 days" />
        <x-templates.dashboard.stat label="Product views" :value="1284900" delta="11.2%" trend="up" hint="across 1,284 stores" />
        <x-templates.dashboard.stat label="Conversion" :value="3.4" :decimals="1" suffix="%" delta="0.3pt" trend="up" hint="paid orders / sessions" />
        <x-templates.dashboard.stat label="Avg order value" :value="86.4" :decimals="2" prefix="$" delta="1.9%" trend="down" hint="promo-heavy month" />
    </div>

    <div class="grid grid-cols-3 gap-4">
        <x-ui.card class="col-span-2">
            <x-slot:header>
                <div class="flex items-baseline justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-cream">Sessions</h2>
                        <p class="mt-0.5 text-xs text-zinc-500">Thousands per day, August</p>
                    </div>
                    <div class="flex items-center gap-3 font-mono text-[11px] text-zinc-600">
                        <span class="flex items-center gap-1.5"><span class="size-2 rounded-full bg-jade-500"></span>peak 58k</span>
                        <span class="flex items-center gap-1.5"><span class="size-2 rounded-full bg-jade-500/30"></span>median 39k</span>
                    </div>
                </div>
            </x-slot>

            <x-ui.animated-column-chart :items="$sessions" height="h-56" :values="false" />
        </x-ui.card>

        <x-ui.card>
            <x-slot:header>
                <div class="flex items-baseline justify-between">
                    <h2 class="text-sm font-medium text-cream">Traffic sources</h2>
                    <span class="font-mono text-[11px] text-zinc-600">thousands</span>
                </div>
            </x-slot>

            <x-ui.animated-bar-chart :items="$sources" :max="185" label-width="w-14" class="pb-1" />

            <x-ui.separator class="my-4" />

            <x-ui.meter-group :segments="[
                ['label' => 'Mobile', 'value' => 63, 'color' => 'jade'],
                ['label' => 'Desktop', 'value' => 31, 'color' => 'mint'],
                ['label' => 'Tablet', 'value' => 6, 'color' => 'zinc'],
            ]" label="Devices" total="412.8k sessions" />
        </x-ui.card>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <x-ui.card class="col-span-2">
            <x-slot:header>
                <div class="flex items-baseline justify-between">
                    <h2 class="text-sm font-medium text-cream">Checkout funnel</h2>
                    <span class="font-mono text-[11px] text-zinc-600">3.4% end to end</span>
                </div>
            </x-slot>

            <ol class="flex flex-col gap-3">
                @foreach ($funnel as $stage)
                    <li>
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="text-[13px] text-zinc-300">{{ $stage['step'] }}</span>
                            <span class="flex items-baseline gap-3 font-mono text-[11px]">
                                <span class="text-cream">{{ number_format($stage['count']) }}</span>
                                @if ($stage['drop'])
                                    <span class="w-16 text-right text-red-400">{{ $stage['drop'] }}</span>
                                @else
                                    <span class="w-16 text-right text-zinc-600">entry</span>
                                @endif
                            </span>
                        </div>
                        <div class="mt-1.5 h-2 overflow-hidden rounded-full bg-ink-950">
                            <span class="block h-full rounded-full bg-jade-500 transition-[width] duration-700 ease-snap"
                                style="width: {{ $stage['percent'] }}%; opacity: {{ 1 - $loop->index * 0.14 }}"></span>
                        </div>
                    </li>
                @endforeach
            </ol>
        </x-ui.card>

        <x-ui.card>
            <x-slot:header>
                <h2 class="text-sm font-medium text-cream">Top regions</h2>
            </x-slot>

            <ul class="flex flex-col gap-3">
                @foreach ([['TW', 'Taiwan', '38.2%'], ['JP', 'Japan', '21.7%'], ['SG', 'Singapore', '14.9%'], ['US', 'United States', '12.4%'], ['AU', 'Australia', '6.1%']] as [$code, $name, $share])
                    <li class="flex items-center gap-3">
                        <span class="grid size-7 shrink-0 place-items-center rounded-md bg-ink-950 font-mono text-[10px] text-zinc-400">{{ $code }}</span>
                        <span class="min-w-0 flex-1 truncate text-[13px] text-zinc-300">{{ $name }}</span>
                        <span class="shrink-0 font-mono text-[11px] text-zinc-500">{{ $share }}</span>
                    </li>
                @endforeach
            </ul>
        </x-ui.card>
    </div>

    <section>
        <div class="mb-3 flex items-baseline justify-between">
            <h2 class="text-sm font-medium text-cream">Top storefronts</h2>
            <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">View all 1,284</a>
        </div>

        <x-ui.table :columns="$storefronts" :rows="$storefrontRows" hover striped />
    </section>
</x-templates.dashboard.shell>
