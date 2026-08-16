<x-layout title="Tabs — BLADE-COMPONENTS">
    <div class="mx-auto max-w-4xl px-6 py-16 pb-28">

        <a href="{{ route('components') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Components
        </a>

        <div class="rise mt-5 flex items-end justify-between" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">{{ $category }}</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $item['name'] }}</h1>
                <p class="mt-2 max-w-lg text-sm/6 text-zinc-500">
                    One section visible at a time. The tab strip comes from an array; the panels are your own markup tagged with <code class="font-mono text-xs text-zinc-400">data-ui-tab-panel</code>, so anything can live inside them.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $lineCode = <<<'BLADE'
            <x-ui.tabs class="w-full max-w-md" :items="[
                ['value' => 'account', 'label' => 'Account'],
                ['value' => 'billing', 'label' => 'Billing'],
                ['value' => 'team', 'label' => 'Team'],
            ]">
                <div data-ui-tab-panel="account" data-active class="pt-4 text-sm/6 text-zinc-400">
                    Workspace <span class="text-cream">acme-production</span> on the Scale plan. Owner seat billed annually.
                </div>
                <div data-ui-tab-panel="billing" class="pt-4 text-sm/6 text-zinc-400">
                    Next invoice <span class="text-cream">$480</span> on 1 Sep. Card ending 4242.
                </div>
                <div data-ui-tab-panel="team" class="pt-4 text-sm/6 text-zinc-400">
                    9 of 25 seats used. Two invites pending since last week.
                </div>
            </x-ui.tabs>
            BLADE;

            $lineVueCode = <<<'VUE'
            <UiTabs
                v-model:active="tab"
                class="w-full max-w-md"
                :items="[
                    { value: 'account', label: 'Account' },
                    { value: 'billing', label: 'Billing' },
                    { value: 'team', label: 'Team' },
                ]"
            >
                <template #account><div class="pt-4 text-sm/6 text-zinc-400">Workspace acme-production on the Scale plan.</div></template>
                <template #billing><div class="pt-4 text-sm/6 text-zinc-400">Next invoice $480 on 1 Sep.</div></template>
                <template #team><div class="pt-4 text-sm/6 text-zinc-400">9 of 25 seats used.</div></template>
            </UiTabs>
            VUE;

            $lineReactCode = <<<'REACT'
            const [tab, setTab] = useState('account');

            <UiTabs
                active={tab}
                onActiveChange={setTab}
                className="w-full max-w-md"
                items={[
                    { value: 'account', label: 'Account' },
                    { value: 'billing', label: 'Billing' },
                    { value: 'team', label: 'Team' },
                ]}
                panels={{
                    account: <div className="pt-4 text-sm/6 text-zinc-400">Workspace acme-production on the Scale plan.</div>,
                    billing: <div className="pt-4 text-sm/6 text-zinc-400">Next invoice $480 on 1 Sep.</div>,
                    team: <div className="pt-4 text-sm/6 text-zinc-400">9 of 25 seats used.</div>,
                }}
            />
            REACT;

            $pillCode = <<<'BLADE'
            <x-ui.tabs variant="pill" active="pending" :items="[
                ['value' => 'live', 'label' => 'Live', 'badge' => 12],
                ['value' => 'pending', 'label' => 'Pending', 'badge' => 3],
                ['value' => 'failed', 'label' => 'Failed', 'badge' => 1],
            ]">
                <div data-ui-tab-panel="live" class="pt-4 font-mono text-xs text-zinc-500">12 deploys serving traffic</div>
                <div data-ui-tab-panel="pending" data-active class="pt-4 font-mono text-xs text-zinc-500">3 deploys waiting on approval</div>
                <div data-ui-tab-panel="failed" class="pt-4 font-mono text-xs text-red-400">1 deploy rolled back</div>
            </x-ui.tabs>
            BLADE;

            $pillVueCode = <<<'VUE'
            <UiTabs
                v-model:active="status"
                variant="pill"
                :items="[
                    { value: 'live', label: 'Live', badge: 12 },
                    { value: 'pending', label: 'Pending', badge: 3 },
                    { value: 'failed', label: 'Failed', badge: 1 },
                ]"
            >
                <template #live><p class="pt-4 font-mono text-xs text-zinc-500">12 deploys serving traffic</p></template>
                <template #pending><p class="pt-4 font-mono text-xs text-zinc-500">3 deploys waiting on approval</p></template>
                <template #failed><p class="pt-4 font-mono text-xs text-red-400">1 deploy rolled back</p></template>
            </UiTabs>
            VUE;

            $pillReactCode = <<<'REACT'
            const [status, setStatus] = useState('pending');

            <UiTabs
                active={status}
                onActiveChange={setStatus}
                variant="pill"
                items={[
                    { value: 'live', label: 'Live', badge: 12 },
                    { value: 'pending', label: 'Pending', badge: 3 },
                    { value: 'failed', label: 'Failed', badge: 1 },
                ]}
                panels={{
                    live: <p className="pt-4 font-mono text-xs text-zinc-500">12 deploys serving traffic</p>,
                    pending: <p className="pt-4 font-mono text-xs text-zinc-500">3 deploys waiting on approval</p>,
                    failed: <p className="pt-4 font-mono text-xs text-red-400">1 deploy rolled back</p>,
                }}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Underline"
                description="The first item is selected unless you pass active. Mark the matching panel with data-active so the right one is painted before any script runs."
                :code="$lineCode" :vue-code="$lineVueCode" :react-code="$lineReactCode">
                <x-ui.tabs class="w-full max-w-md" :items="[
                    ['value' => 'account', 'label' => 'Account'],
                    ['value' => 'billing', 'label' => 'Billing'],
                    ['value' => 'team', 'label' => 'Team'],
                ]">
                    <div data-ui-tab-panel="account" data-active class="pt-4 text-sm/6 text-zinc-400">
                        Workspace <span class="text-cream">acme-production</span> on the Scale plan. Owner seat billed annually.
                    </div>
                    <div data-ui-tab-panel="billing" class="pt-4 text-sm/6 text-zinc-400">
                        Next invoice <span class="text-cream">$480</span> on 1 Sep. Card ending 4242.
                    </div>
                    <div data-ui-tab-panel="team" class="pt-4 text-sm/6 text-zinc-400">
                        9 of 25 seats used. Two invites pending since last week.
                    </div>
                </x-ui.tabs>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Segmented, with counts"
                description="variant=pill turns the strip into a segmented control. A badge key adds the count chip — handy for filtering a list by status."
                :code="$pillCode" :vue-code="$pillVueCode" :react-code="$pillReactCode">
                <x-ui.tabs variant="pill" active="pending" :items="[
                    ['value' => 'live', 'label' => 'Live', 'badge' => 12],
                    ['value' => 'pending', 'label' => 'Pending', 'badge' => 3],
                    ['value' => 'failed', 'label' => 'Failed', 'badge' => 1],
                ]">
                    <div data-ui-tab-panel="live" class="pt-4 font-mono text-xs text-zinc-500">12 deploys serving traffic</div>
                    <div data-ui-tab-panel="pending" data-active class="pt-4 font-mono text-xs text-zinc-500">3 deploys waiting on approval</div>
                    <div data-ui-tab-panel="failed" class="pt-4 font-mono text-xs text-red-400">1 deploy rolled back</div>
                </x-ui.tabs>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="tabs" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
