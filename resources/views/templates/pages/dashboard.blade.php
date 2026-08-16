@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/dashboard/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/dashboard/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/dashboard/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

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

    $navSections = [
        ['label' => 'Platform', 'items' => [
            ['label' => 'Overview', 'icon' => 'grid', 'href' => '#', 'active' => true],
            ['label' => 'Analytics', 'icon' => 'chart', 'href' => '#'],
            ['label' => 'Merchants', 'icon' => 'users', 'href' => '#'],
            ['label' => 'Deploys', 'icon' => 'deploy', 'href' => '#'],
            ['label' => 'Orders', 'icon' => 'billing', 'href' => '#'],
        ]],
        ['label' => 'Account', 'items' => [
            ['label' => 'Alerts', 'icon' => 'bell', 'href' => '#', 'badge' => 3],
            ['label' => 'Audit log', 'icon' => 'logs', 'href' => '#'],
            ['label' => 'Settings', 'icon' => 'settings', 'href' => '#'],
        ]],
    ];

    $incidents = [7, 8, 24];

    $sidebarCode = <<<'BLADE'
    <x-ui.sidebar :sections="[
        ['label' => 'Platform', 'items' => [
            ['label' => 'Overview', 'icon' => 'grid', 'href' => '#', 'active' => true],
            ['label' => 'Analytics', 'icon' => 'chart', 'href' => '#'],
            ['label' => 'Merchants', 'icon' => 'users', 'href' => '#'],
            ['label' => 'Deploys', 'icon' => 'deploy', 'href' => '#'],
            ['label' => 'Orders', 'icon' => 'billing', 'href' => '#'],
        ]],
        ['label' => 'Account', 'items' => [
            ['label' => 'Alerts', 'icon' => 'bell', 'href' => '#', 'badge' => 3],
            ['label' => 'Audit log', 'icon' => 'logs', 'href' => '#'],
            ['label' => 'Settings', 'icon' => 'settings', 'href' => '#'],
        ]],
    ]">
        <x-slot:brand>
            <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
            <span class="text-sm font-medium text-cream">wharf</span>
            <span class="ml-auto rounded-full border border-white/10 px-1.5 font-mono text-[10px] text-zinc-500">ap-1</span>
        </x-slot>
        <x-slot:footer>
            <div class="rounded-lg bg-ink-950 p-2.5">
                <div class="flex items-baseline justify-between">
                    <span class="text-xs font-medium text-cream">Scale plan</span>
                    <span class="font-mono text-[10px] text-zinc-500">312 / 400</span>
                </div>
                <x-ui.progress :value="78" size="sm" class="mt-2" />
                <p class="mt-2 text-[11px]/4 text-zinc-500">Seats renew 1 Sep</p>
                <x-ui.button variant="secondary" size="sm" class="mt-2.5 w-full">Upgrade</x-ui.button>
            </div>
        </x-slot>
    </x-ui.sidebar>
    BLADE;

    $sidebarVueCode = <<<'VUE'
    <UiSidebar :sections="sections">
        <template #brand>
            <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
            <span class="text-sm font-medium text-cream">wharf</span>
            <span class="ml-auto rounded-full border border-white/10 px-1.5 font-mono text-[10px] text-zinc-500">ap-1</span>
        </template>
        <template #footer>
            <div class="rounded-lg bg-ink-950 p-2.5">
                <div class="flex items-baseline justify-between">
                    <span class="text-xs font-medium text-cream">Scale plan</span>
                    <span class="font-mono text-[10px] text-zinc-500">312 / 400</span>
                </div>
                <UiProgress :value="78" size="sm" class="mt-2" />
                <p class="mt-2 text-[11px]/4 text-zinc-500">Seats renew 1 Sep</p>
                <UiButton variant="secondary" size="sm" class="mt-2.5 w-full">Upgrade</UiButton>
            </div>
        </template>
    </UiSidebar>
    VUE;

    $sidebarReactCode = <<<'REACT'
    <UiSidebar
        sections={sections}
        brand={
            <>
                <span className="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                <span className="text-sm font-medium text-cream">wharf</span>
                <span className="ml-auto rounded-full border border-white/10 px-1.5 font-mono text-[10px] text-zinc-500">ap-1</span>
            </>
        }
        footer={
            <div className="rounded-lg bg-ink-950 p-2.5">
                <div className="flex items-baseline justify-between">
                    <span className="text-xs font-medium text-cream">Scale plan</span>
                    <span className="font-mono text-[10px] text-zinc-500">312 / 400</span>
                </div>
                <UiProgress value={78} size="sm" className="mt-2" />
                <p className="mt-2 text-[11px]/4 text-zinc-500">Seats renew 1 Sep</p>
                <UiButton variant="secondary" size="sm" className="mt-2.5 w-full">Upgrade</UiButton>
            </div>
        }
    />
    REACT;

    $topbarCode = <<<'BLADE'
    <header class="flex h-12 items-center gap-4 rounded-xl border border-white/10 bg-ink-800 px-3">
        <x-ui.breadcrumb :items="[['label' => 'wharf', 'href' => '#'], ['label' => 'Overview']]" separator="slash" />

        <x-ui.search size="sm" placeholder="Search merchants, deploys…" shortcut="⌘ K" class="ml-auto max-w-64" />

        <button type="button" aria-label="Alerts"
            class="relative grid size-8 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
            <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span class="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
        </button>

        <x-ui.separator vertical class="my-2.5" />

        <x-ui.avatar initials="WH" size="sm" color="jade" />
    </header>
    BLADE;

    $topbarVueCode = <<<'VUE'
    <header class="flex h-12 items-center gap-4 rounded-xl border border-white/10 bg-ink-800 px-3">
        <UiBreadcrumb :items="crumbs" separator="slash" />

        <UiSearch size="sm" placeholder="Search merchants, deploys…" shortcut="⌘ K" class="ml-auto max-w-64" />

        <button type="button" aria-label="Alerts"
            class="relative grid size-8 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
            <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span class="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
        </button>

        <UiSeparator vertical class="my-2.5" />

        <UiAvatar initials="WH" size="sm" color="jade" />
    </header>
    VUE;

    $topbarReactCode = <<<'REACT'
    <header className="flex h-12 items-center gap-4 rounded-xl border border-white/10 bg-ink-800 px-3">
        <UiBreadcrumb items={crumbs} separator="slash" />

        <UiSearch size="sm" placeholder="Search merchants, deploys…" shortcut="⌘ K" className="ml-auto max-w-64" />

        <button type="button" aria-label="Alerts"
            className="relative grid size-8 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
            <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
            <span className="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
        </button>

        <UiSeparator vertical className="my-2.5" />

        <UiAvatar initials="WH" size="sm" color="jade" />
    </header>
    REACT;

    $statsCode = <<<'BLADE'
    <div class="grid grid-cols-4 gap-4">
        <x-templates.dashboard.stat label="MRR" :value="48240" prefix="$" delta="12.4%" trend="up"
            hint="vs last month" />
        <x-templates.dashboard.stat label="Active merchants" :value="1284" delta="3.1%" trend="up"
            hint="42 new this month" />
        <x-templates.dashboard.stat label="Net revenue churn" :value="2.1" :decimals="1" suffix="%" delta="0.4pt" trend="down"
            hint="improved" />
        <x-templates.dashboard.stat label="Seats in use" :value="312" delta="18" trend="up"
            hint="of 400 licensed" />
    </div>
    BLADE;

    $statsVueCode = <<<'VUE'
    <div class="grid grid-cols-4 gap-4">
        <DashboardStat label="MRR" :value="48240" prefix="$" delta="12.4%" trend="up"
            hint="vs last month" />
        <DashboardStat label="Active merchants" :value="1284" delta="3.1%" trend="up"
            hint="42 new this month" />
        <DashboardStat label="Net revenue churn" :value="2.1" :decimals="1" suffix="%" delta="0.4pt" trend="down"
            hint="improved" />
        <DashboardStat label="Seats in use" :value="312" delta="18" trend="up"
            hint="of 400 licensed" />
    </div>
    VUE;

    $statsReactCode = <<<'REACT'
    <div className="grid grid-cols-4 gap-4">
        <DashboardStat label="MRR" value={48240} prefix="$" delta="12.4%" trend="up"
            hint="vs last month" />
        <DashboardStat label="Active merchants" value={1284} delta="3.1%" trend="up"
            hint="42 new this month" />
        <DashboardStat label="Net revenue churn" value={2.1} decimals={1} suffix="%" delta="0.4pt" trend="down"
            hint="improved" />
        <DashboardStat label="Seats in use" value={312} delta="18" trend="up"
            hint="of 400 licensed" />
    </div>
    REACT;

    $chartCode = <<<'BLADE'
    <x-ui.card>
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
    BLADE;

    $chartVueCode = <<<'VUE'
    <UiCard>
        <template #header>
            <div class="flex items-baseline justify-between">
                <div>
                    <h2 class="text-sm font-medium text-cream">Recurring revenue</h2>
                    <p class="mt-0.5 text-xs text-zinc-500">Monthly, in thousands of USD</p>
                </div>
                <span class="font-mono text-xs text-jade-400">+69.7% YoY</span>
            </div>
        </template>

        <UiAnimatedColumnChart :items="revenue" height="h-52" />
    </UiCard>
    VUE;

    $chartReactCode = <<<'REACT'
    <UiCard
        header={
            <div className="flex items-baseline justify-between">
                <div>
                    <h2 className="text-sm font-medium text-cream">Recurring revenue</h2>
                    <p className="mt-0.5 text-xs text-zinc-500">Monthly, in thousands of USD</p>
                </div>
                <span className="font-mono text-xs text-jade-400">+69.7% YoY</span>
            </div>
        }
    >
        <UiAnimatedColumnChart items={revenue} height="h-52" />
    </UiCard>
    REACT;

    $quotaCode = <<<'BLADE'
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
    BLADE;

    $quotaVueCode = <<<'VUE'
    <UiCard>
        <template #header>
            <div class="flex items-baseline justify-between">
                <h2 class="text-sm font-medium text-cream">Plan quota</h2>
                <span class="font-mono text-[11px] text-zinc-600">resets 1 Sep</span>
            </div>
        </template>

        <div class="flex flex-col gap-3.5">
            <UiProgress v-for="quota in quotas" :key="quota.label" :value="quota.used" :max="quota.limit"
                :label="`${quota.label} · ${quota.used}/${quota.limit} ${quota.unit}`" />
        </div>
    </UiCard>
    VUE;

    $quotaReactCode = <<<'REACT'
    <UiCard
        header={
            <div className="flex items-baseline justify-between">
                <h2 className="text-sm font-medium text-cream">Plan quota</h2>
                <span className="font-mono text-[11px] text-zinc-600">resets 1 Sep</span>
            </div>
        }
    >
        <div className="flex flex-col gap-3.5">
            {quotas.map((quota) => (
                <UiProgress key={quota.label} value={quota.used} max={quota.limit}
                    label={`${quota.label} · ${quota.used}/${quota.limit} ${quota.unit}`} />
            ))}
        </div>
    </UiCard>
    REACT;

    $filterCode = <<<'BLADE'
    <div class="flex flex-wrap items-center gap-2 rounded-xl border border-white/10 bg-ink-800 p-2">
        <x-ui.search size="sm" placeholder="Filter by name or domain…" class="max-w-64" />
        <x-ui.select :options="['All plans', 'Scale', 'Growth', 'Starter']" value="All plans" size="sm" name="plan" class="w-36" />
        <x-ui.select :options="['Any status', 'Active', 'Trial', 'Past due']" value="Any status" size="sm" name="status" class="w-36" />

        <x-ui.separator vertical class="mx-1 h-6 self-center" />

        <x-ui.chip label="MRR > $400" removable />

        <x-ui.dropdown variant="ghost" align="right" class="ml-auto [&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]">
            Bulk actions
            <x-slot:menu>
                <button type="button">Change plan</button>
                <button type="button">Export selection</button>
                <hr>
                <button type="button">Suspend</button>
            </x-slot>
        </x-ui.dropdown>
    </div>
    BLADE;

    $filterVueCode = <<<'VUE'
    <div class="flex flex-wrap items-center gap-2 rounded-xl border border-white/10 bg-ink-800 p-2">
        <UiSearch size="sm" placeholder="Filter by name or domain…" class="max-w-64" />
        <UiSelect v-model="plan" :options="['All plans', 'Scale', 'Growth', 'Starter']" size="sm" class="w-36" />
        <UiSelect v-model="status" :options="['Any status', 'Active', 'Trial', 'Past due']" size="sm" class="w-36" />

        <UiSeparator vertical class="mx-1 h-6 self-center" />

        <UiChip label="MRR > $400" removable />

        <UiDropdown variant="ghost" align="right" class="ml-auto [&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]">
            Bulk actions
            <template #menu>
                <button type="button">Change plan</button>
                <button type="button">Export selection</button>
                <hr>
                <button type="button">Suspend</button>
            </template>
        </UiDropdown>
    </div>
    VUE;

    $filterReactCode = <<<'REACT'
    <div className="flex flex-wrap items-center gap-2 rounded-xl border border-white/10 bg-ink-800 p-2">
        <UiSearch size="sm" placeholder="Filter by name or domain…" className="max-w-64" />
        <UiSelect options={['All plans', 'Scale', 'Growth', 'Starter']} value={plan} onChange={setPlan} size="sm" className="w-36" />
        <UiSelect options={['Any status', 'Active', 'Trial', 'Past due']} value={status} onChange={setStatus} size="sm" className="w-36" />

        <UiSeparator vertical className="mx-1 h-6 self-center" />

        <UiChip label="MRR > $400" removable />

        <UiDropdown
            variant="ghost"
            align="right"
            className="ml-auto [&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]"
            menu={
                <>
                    <button type="button">Change plan</button>
                    <button type="button">Export selection</button>
                    <hr />
                    <button type="button">Suspend</button>
                </>
            }
        >
            Bulk actions
        </UiDropdown>
    </div>
    REACT;

    $tableCode = <<<'BLADE'
    <x-ui.table :columns="[
        ['key' => 'merchant', 'label' => 'Merchant'],
        ['key' => 'plan', 'label' => 'Plan'],
        ['key' => 'mrr', 'label' => 'MRR', 'align' => 'right'],
        ['key' => 'status', 'label' => 'Status', 'sortable' => false],
    ]" :rows="[
        ['merchant' => 'Northbeam Supply', 'plan' => 'Scale', 'mrr' => '$1,480', 'status' => ['text' => 'Active', 'dot' => 'jade']],
        ['merchant' => 'Verdant Studio', 'plan' => 'Growth', 'mrr' => '$620', 'status' => ['text' => 'Trial', 'dot' => 'zinc']],
        ['merchant' => 'Halcyon Goods', 'plan' => 'Growth', 'mrr' => '$890', 'status' => ['text' => 'Past due', 'dot' => 'zinc']],
    ]" hover striped />
    BLADE;

    $tableVueCode = <<<'VUE'
    <UiTable :columns="columns" :rows="rows" hover striped />
    VUE;

    $tableReactCode = <<<'REACT'
    <UiTable columns={columns} rows={rows} hover striped />
    REACT;

    $uptimeCode = <<<'BLADE'
    <div class="w-56 rounded-xl border border-white/10 bg-ink-800 p-4">
        <div class="flex items-center gap-2">
            <span class="size-1.5 shrink-0 rounded-full bg-amber-400"></span>
            <p class="truncate text-[13px] font-medium text-cream">Webhook fanout</p>
            <span class="ml-auto shrink-0 font-mono text-[11px] text-zinc-500">212 ms</span>
        </div>

        <div class="mt-3 flex h-7 items-end gap-[3px]">
            @foreach (range(0, 29) as $slot)
                <span @class([
                    'h-full flex-1 rounded-[1px]',
                    'bg-red-400' => in_array($slot, $incidents, true),
                    'bg-jade-500/35' => ! in_array($slot, $incidents, true),
                ])></span>
            @endforeach
        </div>

        <div class="mt-2 flex items-baseline justify-between font-mono text-[10px] text-zinc-600">
            <span>30d</span>
            <span class="text-amber-400">99.71%</span>
        </div>
    </div>
    BLADE;

    $uptimeVueCode = <<<'VUE'
    <div class="w-56 rounded-xl border border-white/10 bg-ink-800 p-4">
        <div class="flex items-center gap-2">
            <span class="size-1.5 shrink-0 rounded-full bg-amber-400"></span>
            <p class="truncate text-[13px] font-medium text-cream">Webhook fanout</p>
            <span class="ml-auto shrink-0 font-mono text-[11px] text-zinc-500">212 ms</span>
        </div>

        <div class="mt-3 flex h-7 items-end gap-[3px]">
            <span v-for="slot in slots" :key="slot" class="h-full flex-1 rounded-[1px]"
                :class="incidents.includes(slot) ? 'bg-red-400' : 'bg-jade-500/35'"></span>
        </div>

        <div class="mt-2 flex items-baseline justify-between font-mono text-[10px] text-zinc-600">
            <span>30d</span>
            <span class="text-amber-400">99.71%</span>
        </div>
    </div>
    VUE;

    $uptimeReactCode = <<<'REACT'
    <div className="w-56 rounded-xl border border-white/10 bg-ink-800 p-4">
        <div className="flex items-center gap-2">
            <span className="size-1.5 shrink-0 rounded-full bg-amber-400"></span>
            <p className="truncate text-[13px] font-medium text-cream">Webhook fanout</p>
            <span className="ml-auto shrink-0 font-mono text-[11px] text-zinc-500">212 ms</span>
        </div>

        <div className="mt-3 flex h-7 items-end gap-[3px]">
            {slots.map((slot) => (
                <span key={slot} className={`h-full flex-1 rounded-[1px] ${incidents.includes(slot) ? 'bg-red-400' : 'bg-jade-500/35'}`}></span>
            ))}
        </div>

        <div className="mt-2 flex items-baseline justify-between font-mono text-[10px] text-zinc-600">
            <span>30d</span>
            <span className="text-amber-400">99.71%</span>
        </div>
    </div>
    REACT;
@endphp

<x-layout title="Dashboard template — BLADE-COMPONENTS">
    <div class="mx-auto max-w-6xl px-6 py-16 pb-28">

        <a href="{{ route('templates') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Templates
        </a>

        <div class="rise mt-5 flex flex-wrap items-end justify-between gap-4" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Template</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $template['name'] }}</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    A control room for <span class="text-zinc-300">wharf</span>, a fictional platform where merchants run storefronts
                    on a subscription. Five screens, one shell, and nothing bespoke — every part below comes from the catalog.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $template['pages']) }} screens</span>
        </div>

        <nav class="rise sticky top-14 z-30 -mx-6 mt-8 border-y border-white/5 bg-ink-950/85 px-6 py-2.5 backdrop-blur" style="animation-delay: 120ms">
            <ul class="flex flex-wrap items-center gap-1 text-sm">
                @foreach ($screens as $screen)
                    <li>
                        <a href="#{{ $screen['slug'] }}" data-spy-link
                            class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">{{ $screen['name'] }}</a>
                    </li>
                @endforeach
                <li class="ml-auto flex items-center gap-1">
                    <a href="#blocks" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Blocks</a>
                    <a href="#install" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Installation</a>
                </li>
            </ul>
        </nav>

        <section class="mt-10">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Screens</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Live, not screenshots. Open any of them full screen to poke at the sorting, the filters, and the dropdowns.</p>

            <div class="mt-6 flex flex-col gap-10">
                @foreach ($screens as $screen)
                    <x-screen-preview
                        :id="$screen['slug']"
                        data-spy-section
                        class="scroll-mt-32"
                        :title="$screen['name']"
                        :description="$screen['description']"
                        :href="route('templates.screen', [$template['slug'], $screen['slug']])"
                        :panels="$sourcesFor($screen['slug'])">
                        <x-dynamic-component :component="'templates.'.$template['slug'].'.'.$screen['slug']" />
                    </x-screen-preview>
                @endforeach
            </div>
        </section>

        <section id="blocks" data-spy-section class="mt-16 scroll-mt-32">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Blocks</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The parts those screens are assembled from. Take one, take all of them.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Sidebar" padding="p-8"
                    description="Grouped links, an active row, a badge, and the plan card that turns a nav into a SaaS nav."
                    :code="$sidebarCode" :vue-code="$sidebarVueCode" :react-code="$sidebarReactCode">
                    <x-ui.sidebar :sections="$navSections">
                        <x-slot:brand>
                            <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                            <span class="text-sm font-medium text-cream">wharf</span>
                            <span class="ml-auto rounded-full border border-white/10 px-1.5 font-mono text-[10px] text-zinc-500">ap-1</span>
                        </x-slot>
                        <x-slot:footer>
                            <div class="rounded-lg bg-ink-950 p-2.5">
                                <div class="flex items-baseline justify-between">
                                    <span class="text-xs font-medium text-cream">Scale plan</span>
                                    <span class="font-mono text-[10px] text-zinc-500">312 / 400</span>
                                </div>
                                <x-ui.progress :value="78" size="sm" class="mt-2" />
                                <p class="mt-2 text-[11px]/4 text-zinc-500">Seats renew 1 Sep</p>
                                <x-ui.button variant="secondary" size="sm" class="mt-2.5 w-full">Upgrade</x-ui.button>
                            </div>
                        </x-slot>
                    </x-ui.sidebar>
                </x-demo>

                <x-demo title="Topbar" padding="p-8"
                    description="Breadcrumb on the left, search and identity on the right. Fixed height so it never jumps."
                    :code="$topbarCode" :vue-code="$topbarVueCode" :react-code="$topbarReactCode">
                    <header class="flex h-12 w-full items-center gap-4 rounded-xl border border-white/10 bg-ink-800 px-3">
                        <x-ui.breadcrumb :items="[['label' => 'wharf', 'href' => '#'], ['label' => 'Overview']]" separator="slash" />

                        <x-ui.search size="sm" placeholder="Search merchants, deploys…" shortcut="⌘ K" class="ml-auto max-w-64" />

                        <button type="button" aria-label="Alerts"
                            class="relative grid size-8 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                            <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
                        </button>

                        <x-ui.separator vertical class="my-2.5" />

                        <x-ui.avatar initials="WH" size="sm" color="jade" />
                    </header>
                </x-demo>

                <x-demo title="Stat row" padding="p-8"
                    description="A number that counts up on first view, a delta arrow that picks its own colour, and room for one line of context."
                    :code="$statsCode" :vue-code="$statsVueCode" :react-code="$statsReactCode">
                    <div class="grid w-full grid-cols-4 gap-4">
                        <x-templates.dashboard.stat label="MRR" :value="48240" prefix="$" delta="12.4%" trend="up" hint="vs last month" />
                        <x-templates.dashboard.stat label="Active merchants" :value="1284" delta="3.1%" trend="up" hint="42 new this month" />
                        <x-templates.dashboard.stat label="Net revenue churn" :value="2.1" :decimals="1" suffix="%" delta="0.4pt" trend="down" hint="improved" />
                        <x-templates.dashboard.stat label="Seats in use" :value="312" delta="18" trend="up" hint="of 400 licensed" />
                    </div>
                </x-demo>

                <x-demo title="Chart card" padding="p-8"
                    description="Card header carries the framing, the chart carries the data. Highlight the bar you want read first."
                    :code="$chartCode" :vue-code="$chartVueCode" :react-code="$chartReactCode">
                    <x-ui.card class="w-full">
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
                </x-demo>

                <x-demo title="Quota list" padding="p-8"
                    description="Metered plans need this: what was used, what the ceiling is, and when it resets."
                    :code="$quotaCode" :vue-code="$quotaVueCode" :react-code="$quotaReactCode">
                    <x-ui.card class="w-full max-w-sm">
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
                </x-demo>

                <x-demo title="Filter bar" padding="p-8"
                    description="Search, three selects, removable chips for what is already applied, and bulk actions parked on the right."
                    :code="$filterCode" :vue-code="$filterVueCode" :react-code="$filterReactCode">
                    <div class="flex w-full flex-wrap items-center gap-2 rounded-xl border border-white/10 bg-ink-800 p-2">
                        <x-ui.search size="sm" placeholder="Filter by name or domain…" class="max-w-64" />
                        <x-ui.select :options="['All plans', 'Scale', 'Growth', 'Starter']" value="All plans" size="sm" name="block-plan" class="w-36" />
                        <x-ui.select :options="['Any status', 'Active', 'Trial', 'Past due']" value="Any status" size="sm" name="block-status" class="w-36" />

                        <x-ui.separator vertical class="mx-1 h-6 self-center" />

                        <x-ui.chip label="MRR > $400" removable />

                        <x-ui.dropdown variant="ghost" align="right" class="ml-auto [&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]">
                            Bulk actions
                            <x-slot:menu>
                                <button type="button">Change plan</button>
                                <button type="button">Export selection</button>
                                <hr>
                                <button type="button">Suspend</button>
                            </x-slot>
                        </x-ui.dropdown>
                    </div>
                </x-demo>

                <x-demo title="Tenant table" padding="p-8"
                    description="Click a header to sort. Pass an array cell instead of a string and you get a status dot."
                    :code="$tableCode" :vue-code="$tableVueCode" :react-code="$tableReactCode">
                    <x-ui.table class="w-full" :columns="[
                        ['key' => 'merchant', 'label' => 'Merchant'],
                        ['key' => 'plan', 'label' => 'Plan'],
                        ['key' => 'mrr', 'label' => 'MRR', 'align' => 'right'],
                        ['key' => 'status', 'label' => 'Status', 'sortable' => false],
                    ]" :rows="[
                        ['merchant' => 'Northbeam Supply', 'plan' => 'Scale', 'mrr' => '$1,480', 'status' => ['text' => 'Active', 'dot' => 'jade']],
                        ['merchant' => 'Verdant Studio', 'plan' => 'Growth', 'mrr' => '$620', 'status' => ['text' => 'Trial', 'dot' => 'zinc']],
                        ['merchant' => 'Halcyon Goods', 'plan' => 'Growth', 'mrr' => '$890', 'status' => ['text' => 'Past due', 'dot' => 'zinc']],
                    ]" hover striped />
                </x-demo>

                <x-demo title="Uptime strip" padding="p-8"
                    description="Thirty spans, one per day. Status-page shorthand that costs nothing to render."
                    :code="$uptimeCode" :vue-code="$uptimeVueCode" :react-code="$uptimeReactCode">
                    <div class="w-56 rounded-xl border border-white/10 bg-ink-800 p-4">
                        <div class="flex items-center gap-2">
                            <span class="size-1.5 shrink-0 rounded-full bg-amber-400"></span>
                            <p class="truncate text-[13px] font-medium text-cream">Webhook fanout</p>
                            <span class="ml-auto shrink-0 font-mono text-[11px] text-zinc-500">212 ms</span>
                        </div>

                        <div class="mt-3 flex h-7 items-end gap-[3px]">
                            @foreach (range(0, 29) as $slot)
                                <span @class([
                                    'h-full flex-1 rounded-[1px]',
                                    'bg-red-400' => in_array($slot, $incidents, true),
                                    'bg-jade-500/35' => ! in_array($slot, $incidents, true),
                                ])></span>
                            @endforeach
                        </div>

                        <div class="mt-2 flex items-baseline justify-between font-mono text-[10px] text-zinc-600">
                            <span>30d</span>
                            <span class="text-amber-400">99.71%</span>
                        </div>
                    </div>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[['slug' => 'shell', 'name' => 'App shell'], ['slug' => 'stat', 'name' => 'Stat tile']]"
            description="Each screen above carries its own source under its preview. These two files are what all five share — paste them first."
            :components="['sidebar', 'breadcrumb', 'search', 'avatar', 'separator', 'card', 'table', 'select', 'chip', 'dropdown', 'progress', 'badge', 'alert', 'timeline', 'meter-group', 'pagination', 'number-ticker', 'animated-column-chart', 'animated-bar-chart']" />
    </div>
</x-layout>
