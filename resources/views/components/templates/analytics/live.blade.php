@php
    $show = [
        '7d' => 'hidden group-data-[range=7d]/shell:inline',
        '28d' => 'hidden group-data-[range=28d]/shell:inline',
        '90d' => 'hidden group-data-[range=90d]/shell:inline',
    ];

    $minutes = [34, 41, 38, 46, 52, 44, 39, 47, 55, 61, 58, 49, 44, 51, 63, 70, 66, 58, 52, 47, 55, 64, 72, 68, 61, 57, 66, 74, 81, 76, 69, 62, 58, 65, 73, 80, 88, 82, 74, 68, 71, 79, 86, 92, 85, 77, 70, 66, 74, 83, 90, 96, 89, 81, 75, 78, 87, 94, 100, 93];

    $stream = [
        ['time' => '14:32:07', 'user' => 'u_8c41d0', 'event' => 'order_paid', 'detail' => '$128.40 · northbeam.shop', 'region' => 'TW', 'kind' => 'paid'],
        ['time' => '14:32:06', 'user' => 'u_2b7e19', 'event' => 'product_viewed', 'detail' => 'sku VG-2213 · mobile', 'region' => 'JP'],
        ['time' => '14:32:05', 'user' => 'u_1f90aa', 'event' => 'checkout_started', 'detail' => 'cart 3 items · $86.00', 'region' => 'SG'],
        ['time' => '14:32:05', 'user' => 'u_44c082', 'event' => 'session_start', 'detail' => 'organic search · desktop', 'region' => 'TW'],
        ['time' => '14:32:03', 'user' => 'u_9d3f57', 'event' => 'payment_failed', 'detail' => 'card declined · retry 1', 'region' => 'US', 'kind' => 'failed'],
        ['time' => '14:32:02', 'user' => 'u_7a1e64', 'event' => 'add_to_cart', 'detail' => 'sku KT-0918 · mobile', 'region' => 'TW'],
        ['time' => '14:32:01', 'user' => 'u_0e88b3', 'event' => 'order_paid', 'detail' => '$41.90 · kettleandco.store', 'region' => 'AU', 'kind' => 'paid'],
        ['time' => '14:32:00', 'user' => 'u_5c62f1', 'event' => 'product_viewed', 'detail' => 'sku OS-4471 · tablet', 'region' => 'JP'],
        ['time' => '14:31:59', 'user' => 'u_b3907c', 'event' => 'session_start', 'detail' => 'paid social · mobile', 'region' => 'SG'],
        ['time' => '14:31:58', 'user' => 'u_e21446', 'event' => 'checkout_started', 'detail' => 'cart 1 item · $24.00', 'region' => 'TW'],
        ['time' => '14:31:57', 'user' => 'u_3f70da', 'event' => 'refund_requested', 'detail' => 'order #48120 · sizing', 'region' => 'US', 'kind' => 'failed'],
        ['time' => '14:31:56', 'user' => 'u_6ac815', 'event' => 'add_to_cart', 'detail' => 'sku VG-2213 · mobile', 'region' => 'TW'],
    ];

    $pages = [
        ['path' => '/products/verdant-carafe', 'value' => 312],
        ['path' => '/collections/kitchen', 'value' => 248],
        ['path' => '/checkout', 'value' => 186],
        ['path' => '/products/osprey-pack-40l', 'value' => 141],
        ['path' => '/cart', 'value' => 119],
    ];

    $rules = [
        ['name' => 'payment_failed rate above 2%', 'state' => 'firing', 'meta' => 'at 3.4% since 14:08 · paging on-call'],
        ['name' => 'checkout_started down 20% hour over hour', 'state' => 'ok', 'meta' => 'currently +6.2%'],
        ['name' => 'order_paid below forecast', 'state' => 'ok', 'meta' => '104% of forecast'],
        ['name' => 'ingest lag over 30s', 'state' => 'ok', 'meta' => 'lag 3s'],
    ];
@endphp

<x-templates.analytics.shell active="Live" title="Right now, in the last sixty seconds"
    description="The stream and the counter ignore the range switch — they are always now. The panel on the right is where the range still applies, so you can tell whether now is unusual.">
    <x-slot:actions>
        <x-ui.select :options="['All events', 'Commerce only', 'Errors only']" value="All events" size="sm" name="live-filter" class="w-40" />
        <x-ui.button variant="secondary" size="sm">Pause stream</x-ui.button>
    </x-slot>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card class="lg:col-span-2">
            <x-slot:header>
                <div class="flex flex-wrap items-baseline justify-between gap-3">
                    <div class="flex items-center gap-2.5">
                        <span class="relative flex size-2">
                            <span class="absolute inline-flex size-full animate-ping rounded-full bg-jade-400 opacity-70"></span>
                            <span class="relative inline-flex size-2 rounded-full bg-jade-500"></span>
                        </span>
                        <h2 class="text-sm font-medium text-cream">Active right now</h2>
                    </div>
                    <span class="font-mono text-[11px] text-zinc-600">events per minute, last hour</span>
                </div>
            </x-slot>

            <div class="flex flex-wrap items-end justify-between gap-6">
                <div>
                    <p class="text-4xl font-semibold tracking-tight text-cream">1,284</p>
                    <p class="mt-1.5 font-mono text-[11px] text-jade-400">+18.2% vs this time yesterday</p>
                </div>

                <dl class="flex gap-8 font-mono text-[11px]">
                    <div>
                        <dt class="text-zinc-600">events / min</dt>
                        <dd class="mt-1 text-lg text-cream">4,218</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-600">carts open</dt>
                        <dd class="mt-1 text-lg text-cream">341</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-600">paid / min</dt>
                        <dd class="mt-1 text-lg text-cream">27</dd>
                    </div>
                </dl>
            </div>

            <div class="mt-6 flex h-28 items-end gap-px">
                @foreach ($minutes as $minute)
                    <span @class([
                        'flex-1 rounded-t-[2px]',
                        'bg-jade-500' => $loop->last,
                        'bg-jade-500/45' => ! $loop->last,
                    ]) style="height: {{ $minute }}%"></span>
                @endforeach
            </div>

            <div class="mt-2 flex justify-between font-mono text-[10px] text-zinc-700">
                <span>13:32</span>
                <span>14:02</span>
                <span>now</span>
            </div>
        </x-ui.card>

        <x-ui.card>
            <x-slot:header>
                <div class="flex items-baseline justify-between">
                    <h2 class="text-sm font-medium text-cream">Is this unusual?</h2>
                    <span class="font-mono text-[11px] text-jade-400">
                        <span class="{{ $show['7d'] }}">7d</span>
                        <span class="{{ $show['28d'] }}">28d</span>
                        <span class="{{ $show['90d'] }}">90d</span>
                    </span>
                </div>
            </x-slot>

            <dl class="flex flex-col gap-4">
                @foreach ([
                    ['label' => 'Peak concurrent', 'values' => ['7d' => '1,612', '28d' => '1,844', '90d' => '2,096']],
                    ['label' => 'Median concurrent', 'values' => ['7d' => '1,104', '28d' => '1,038', '90d' => '921']],
                    ['label' => 'Busiest hour', 'values' => ['7d' => 'Sat 20:00', '28d' => 'Sat 20:00', '90d' => 'Fri 21:00']],
                    ['label' => 'Now sits at', 'values' => ['7d' => '79th percentile', '28d' => '84th percentile', '90d' => '91st percentile']],
                ] as $stat)
                    <div class="flex items-baseline justify-between gap-3 border-b border-white/5 pb-3 last:border-0 last:pb-0">
                        <dt class="text-[13px] text-zinc-400">{{ $stat['label'] }}</dt>
                        <dd class="font-mono text-[13px] text-cream">
                            @foreach (['7d', '28d', '90d'] as $range)
                                <span class="{{ $show[$range] }}">{{ $stat['values'][$range] }}</span>
                            @endforeach
                        </dd>
                    </div>
                @endforeach
            </dl>

            <p class="mt-4 font-mono text-[10px]/5 text-zinc-700">A Monday afternoon this busy usually means a campaign landed. Check the paid social split before calling it growth.</p>
        </x-ui.card>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card class="lg:col-span-2">
            <x-slot:header>
                <div class="flex flex-wrap items-baseline justify-between gap-3">
                    <h2 class="text-sm font-medium text-cream">Event stream</h2>
                    <span class="font-mono text-[11px] text-zinc-600">tailing · 12 of 4,218 per minute</span>
                </div>
            </x-slot>

            <ol class="-mx-1 flex flex-col font-mono text-[11px]">
                @foreach ($stream as $entry)
                    <li @class(['flex items-center gap-3 rounded-md px-1 py-1.5 transition-colors duration-150 hover:bg-white/4', 'rise' => $loop->first])
                        @if ($loop->first) style="animation-delay: 120ms" @endif>
                        <span class="shrink-0 text-zinc-700">{{ $entry['time'] }}</span>
                        <span class="hidden w-20 shrink-0 truncate text-zinc-600 sm:block">{{ $entry['user'] }}</span>
                        <span @class([
                            'w-40 shrink-0 truncate',
                            'text-jade-300' => ($entry['kind'] ?? null) === 'paid',
                            'text-red-400' => ($entry['kind'] ?? null) === 'failed',
                            'text-zinc-300' => ! isset($entry['kind']),
                        ])>{{ $entry['event'] }}</span>
                        <span class="min-w-0 flex-1 truncate text-zinc-500">{{ $entry['detail'] }}</span>
                        <span class="shrink-0 rounded border border-white/8 px-1.5 text-[10px] text-zinc-600">{{ $entry['region'] }}</span>
                    </li>
                @endforeach
            </ol>

            <div class="mt-3 border-t border-white/5 pt-3">
                <p class="font-mono text-[10px] text-zinc-700">Scrolls until you pause it. Click any row to open that user's session replay.</p>
            </div>
        </x-ui.card>

        <div class="flex flex-col gap-4">
            <x-ui.card>
                <x-slot:header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Pages, right now</h2>
                        <span class="font-mono text-[11px] text-zinc-600">viewers</span>
                    </div>
                </x-slot>

                <ul class="flex flex-col gap-2.5">
                    @foreach ($pages as $page)
                        <li class="flex items-center gap-3">
                            <span class="min-w-0 flex-1 truncate font-mono text-[11px] text-zinc-400">{{ $page['path'] }}</span>
                            <span class="h-1 w-12 shrink-0 overflow-hidden rounded-full bg-ink-950">
                                <span class="block h-full rounded-full bg-jade-500/60" style="width: {{ round($page['value'] / 3.12) }}%"></span>
                            </span>
                            <span class="w-8 shrink-0 text-right font-mono text-[11px] text-cream">{{ $page['value'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-ui.card>

            <x-ui.card>
                <x-slot:header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Alert rules</h2>
                        <span class="font-mono text-[11px] text-red-400">1 firing</span>
                    </div>
                </x-slot>

                <ul class="flex flex-col gap-3">
                    @foreach ($rules as $rule)
                        <li class="flex items-start gap-2.5">
                            <span @class([
                                'mt-1.5 size-1.5 shrink-0 rounded-full',
                                'bg-red-400' => $rule['state'] === 'firing',
                                'bg-jade-500' => $rule['state'] !== 'firing',
                            ])></span>
                            <div class="min-w-0">
                                <p @class(['text-[13px]/5', 'text-cream' => $rule['state'] === 'firing', 'text-zinc-400' => $rule['state'] !== 'firing'])>{{ $rule['name'] }}</p>
                                <p class="mt-0.5 font-mono text-[10px] text-zinc-700">{{ $rule['meta'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </x-ui.card>
        </div>
    </div>
</x-templates.analytics.shell>
