@props([
    'active' => 'Overview',
    'title' => 'Overview',
    'crumbs' => [],
])

@php
    $nav = [
        ['label' => 'Platform', 'items' => [
            ['label' => 'Overview', 'icon' => 'grid', 'screen' => 'overview'],
            ['label' => 'Analytics', 'icon' => 'chart', 'screen' => 'analytics'],
            ['label' => 'Merchants', 'icon' => 'users', 'screen' => 'merchants'],
            ['label' => 'Deploys', 'icon' => 'deploy', 'screen' => 'deploys'],
            ['label' => 'Orders', 'icon' => 'billing', 'screen' => 'orders'],
        ]],
        ['label' => 'Account', 'items' => [
            ['label' => 'Alerts', 'icon' => 'bell', 'badge' => 3],
            ['label' => 'Audit log', 'icon' => 'logs'],
            ['label' => 'Settings', 'icon' => 'settings'],
        ]],
    ];

    $link = fn (array $item): array => isset($item['screen'])
        ? ['href' => route('templates.screen', ['dashboard', $item['screen']]), 'target' => '_top']
        : ['href' => '#'];

    $sections = array_map(fn (array $section): array => [
        'label' => $section['label'],
        'items' => array_map(
            fn (array $item): array => $item + $link($item) + ['active' => $item['label'] === $active],
            $section['items'],
        ),
    ], $nav);
@endphp

<div {{ $attributes->class('flex h-full min-h-[42rem] w-full gap-3 overflow-hidden bg-ink-950 p-3 sm:gap-4 sm:p-4') }}>
    <x-ui.sidebar :sections="$sections" class="hidden shrink-0 lg:flex">
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
            <div class="mt-2 flex items-center gap-2.5 px-1.5 py-1">
                <x-ui.avatar initials="WH" size="sm" color="jade" />
                <div class="min-w-0">
                    <p class="truncate text-xs text-zinc-300">Wei Hung</p>
                    <p class="truncate font-mono text-[10px] text-zinc-600">Owner</p>
                </div>
            </div>
        </x-slot>
    </x-ui.sidebar>

    <div class="flex min-w-0 flex-1 flex-col gap-3 overflow-y-auto sm:gap-4">
        <header class="flex h-12 shrink-0 items-center gap-3 rounded-xl border border-white/10 bg-ink-800 px-3 sm:gap-4">
            <button type="button" aria-label="Open navigation" class="grid size-8 shrink-0 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream lg:hidden">
                <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M2.5 4.5h11M2.5 8h11M2.5 11.5h11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
            </button>

            <x-ui.breadcrumb :items="$crumbs" separator="slash" class="min-w-0 shrink" />

            <div class="ml-auto flex shrink-0 items-center gap-3 sm:gap-4">
                <x-ui.search size="sm" placeholder="Search merchants, deploys…" shortcut="⌘ K" class="hidden basis-64 md:flex" />

                <button type="button" aria-label="Alerts" class="relative grid size-8 shrink-0 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                    <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
                </button>

                <x-ui.separator vertical class="my-2.5" />

                <x-ui.avatar initials="WH" size="sm" color="jade" />
            </div>
        </header>

        <main class="flex min-w-0 flex-col gap-3 sm:gap-4">
            <div class="flex flex-wrap items-end justify-between gap-3">
                <h1 class="text-xl font-semibold tracking-tight text-cream">{{ $title }}</h1>
                @isset($actions)
                    <div class="flex flex-wrap items-center gap-2">{{ $actions }}</div>
                @endisset
            </div>

            {{ $slot }}
        </main>
    </div>
</div>
