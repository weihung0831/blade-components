@php
    $keys = [
        ['name' => 'Storefront server', 'prefix' => 'whk_live_9f2c…', 'scopes' => ['orders:write', 'merchants:read'], 'created' => '14 Mar 2026', 'used' => '2m ago', 'live' => true],
        ['name' => 'Payout worker', 'prefix' => 'whk_live_4a71…', 'scopes' => ['payouts:write'], 'created' => '2 Feb 2026', 'used' => '18m ago', 'live' => true],
        ['name' => 'Staging seeder', 'prefix' => 'whk_test_c08e…', 'scopes' => ['merchants:write', 'orders:write'], 'created' => '9 Jan 2026', 'used' => '3d ago', 'live' => false],
        ['name' => 'Legacy importer', 'prefix' => 'whk_live_1b55…', 'scopes' => ['merchants:read'], 'created' => '30 Nov 2025', 'used' => '94d ago', 'live' => true],
    ];

    $hooks = [
        ['url' => 'https://api.northbeam.com/hooks/wharf', 'events' => ['order.paid', 'order.refunded', 'payout.settled'], 'rate' => 99, 'last' => '12s ago', 'on' => true],
        ['url' => 'https://ops.northbeam.com/wharf/deploys', 'events' => ['deploy.succeeded', 'deploy.failed'], 'rate' => 96, 'last' => '4m ago', 'on' => true],
        ['url' => 'https://hooks.zapier.com/wharf/inbound', 'events' => ['merchant.created'], 'rate' => 61, 'last' => '2d ago', 'on' => false],
    ];
@endphp

<x-templates.settings.shell active="API keys" title="API keys"
    description="Server credentials for the wharf REST API, the webhooks they trigger, and the limits they run under.">
    <x-slot:actions>
        <x-ui.button variant="secondary" size="sm">API reference</x-ui.button>
        <x-ui.button size="sm">Create key</x-ui.button>
    </x-slot>

    <x-ui.alert variant="warning" title="Copy the secret now" dismissible>
        <p>This is the only time <span class="font-mono text-zinc-300">Storefront server</span> will be shown in full. Store it in your secret manager — we keep a hash, not the key.</p>

        <div class="mt-3 flex items-center gap-2 rounded-lg border border-white/10 bg-ink-950 px-3 py-2">
            <span class="min-w-0 flex-1 truncate font-mono text-[12px] text-zinc-300">whk_live_9f2c41b7d0e83a5c6f19b2470dd8e1a3</span>
            <button type="button" class="shrink-0 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Copy</button>
        </div>
    </x-ui.alert>

    <x-templates.settings.section flush heading="Keys" description="Scoped per environment. A revoked key stops working on the next request.">
        <x-slot:actions>
            <span class="font-mono text-[11px] text-zinc-600">4 of 20 used</span>
        </x-slot>

        <ul class="divide-y divide-white/5">
            @foreach ($keys as $key)
                <li class="flex flex-wrap items-center gap-x-4 gap-y-2.5 px-5 py-3.5">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2">
                            <p class="truncate text-[13px] text-zinc-200">{{ $key['name'] }}</p>
                            <span @class([
                                'shrink-0 rounded-full px-1.5 font-mono text-[10px]',
                                'bg-jade-500/15 text-jade-400' => $key['live'],
                                'bg-white/8 text-zinc-500' => ! $key['live'],
                            ])>{{ $key['live'] ? 'live' : 'test' }}</span>
                        </div>
                        <p class="mt-1 truncate font-mono text-[11px] text-zinc-600">{{ $key['prefix'] }} · created {{ $key['created'] }}</p>
                    </div>

                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($key['scopes'] as $scope)
                            <span class="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{{ $scope }}</span>
                        @endforeach
                    </div>

                    <span @class([
                        'w-20 shrink-0 text-right font-mono text-[11px]',
                        'text-amber-400' => $key['used'] === '94d ago',
                        'text-zinc-600' => $key['used'] !== '94d ago',
                    ])>{{ $key['used'] }}</span>

                    <button type="button" class="shrink-0 text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Revoke</button>
                </li>
            @endforeach
        </ul>

        <x-slot:footer>
            <span class="text-[11px]/5 text-zinc-600">Legacy importer hasn't been used in 94 days. Idle keys are the ones that leak.</span>
            <x-ui.button variant="danger" size="sm">Rotate all</x-ui.button>
        </x-slot>
    </x-templates.settings.section>

    <x-templates.settings.section flush heading="Webhook endpoints" description="Delivery is retried for 24 hours, then the endpoint is paused.">
        <x-slot:actions>
            <x-ui.button variant="secondary" size="sm">Add endpoint</x-ui.button>
        </x-slot>

        <ul class="divide-y divide-white/5">
            @foreach ($hooks as $hook)
                <li class="px-5 py-4">
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                        <p class="min-w-0 flex-1 truncate font-mono text-[13px] text-zinc-300">{{ $hook['url'] }}</p>
                        <span class="shrink-0 font-mono text-[11px] text-zinc-600">last {{ $hook['last'] }}</span>
                        <x-ui.switch size="sm" :name="'hook-'.$loop->index" :checked="$hook['on']" />
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-1.5">
                        @foreach ($hook['events'] as $event)
                            <span class="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{{ $event }}</span>
                        @endforeach
                    </div>

                    <x-ui.progress size="sm" class="mt-3" animate :delay="$loop->index * 110" :value="$hook['rate']"
                        label="Delivered · last 7 days" />
                </li>
            @endforeach
        </ul>

        <x-slot:footer>
            <span class="font-mono text-[11px] text-zinc-600">Signing secret whsec_2f…9c</span>
            <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Roll secret</a>
        </x-slot>
    </x-templates.settings.section>

    <x-templates.settings.section heading="Limits" description="Set by the Scale plan. Enterprise lifts them per key.">
        <x-templates.settings.row label="Rate limit" description="Burst of 2,000 over 10 seconds" align="center">
            <div class="flex items-center gap-3">
                <span class="font-mono text-[13px] text-zinc-300">1,000 req / min</span>
                <x-ui.badge variant="outline" class="ml-auto">Plan limit</x-ui.badge>
            </div>
        </x-templates.settings.row>

        <x-templates.settings.row label="IP allowlist" description="Empty means any address">
            <x-ui.tags-input class="w-full! max-w-md" name="allowlist" :tags="['203.0.113.0/24', '198.51.100.7']" placeholder="Add CIDR…" />
        </x-templates.settings.row>

        <x-templates.settings.row label="Key expiry" description="Keys stop working after this window" align="center">
            <x-ui.select size="sm" name="expiry" value="90 days" class="max-w-xs"
                :options="['30 days', '90 days', '180 days', 'Never']" />
        </x-templates.settings.row>

        <x-templates.settings.row label="Log requests" description="Headers and status, never bodies" align="center">
            <div class="flex items-center gap-3">
                <span class="text-[13px] text-zinc-500">Retained 30 days</span>
                <x-ui.switch class="ml-auto" name="request-log" checked />
            </div>
        </x-templates.settings.row>
    </x-templates.settings.section>
</x-templates.settings.shell>
