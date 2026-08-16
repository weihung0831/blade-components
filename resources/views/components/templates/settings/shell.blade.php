@props([
    'active' => 'Profile',
    'title' => 'Profile',
    'description' => null,
    'dirty' => false,
])

@php
    $nav = [
        ['label' => 'Personal', 'items' => [
            ['label' => 'Profile', 'screen' => 'profile'],
            ['label' => 'Notifications'],
            ['label' => 'Appearance'],
        ]],
        ['label' => 'Workspace', 'items' => [
            ['label' => 'General'],
            ['label' => 'Team', 'screen' => 'team', 'meta' => '312'],
            ['label' => 'Billing', 'screen' => 'billing'],
            ['label' => 'API keys', 'screen' => 'api-keys'],
            ['label' => 'Audit log'],
            ['label' => 'Data region', 'meta' => 'ap-1'],
        ]],
    ];

    $sections = array_map(fn (array $section): array => [
        'label' => $section['label'],
        'items' => array_map(fn (array $item): array => $item + [
            'href' => isset($item['screen']) ? route('templates.screen', ['settings', $item['screen']]) : '#',
            'active' => $item['label'] === $active,
        ], $section['items']),
    ], $nav);

    $crumbs = [
        ['label' => 'wharf', 'href' => '#'],
        ['label' => 'Settings', 'href' => '#'],
        ['label' => $title],
    ];
@endphp

<div {{ $attributes->class('flex h-full w-full flex-col overflow-hidden bg-ink-950') }}>
    <header class="flex h-14 shrink-0 items-center gap-3 border-b border-white/5 px-4 sm:gap-4 sm:px-6">
        <a href="{{ route('templates.screen', ['dashboard', 'overview']) }}" target="_top"
            class="inline-flex shrink-0 items-center gap-1.5 text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Console
        </a>

        <x-ui.separator vertical class="my-3.5" />

        <x-ui.breadcrumb :items="array_slice($crumbs, 1)" separator="slash" class="min-w-0 shrink sm:hidden" />
        <x-ui.breadcrumb :items="$crumbs" separator="slash" class="hidden min-w-0 shrink sm:flex" />

        <div class="ml-auto flex shrink-0 items-center gap-3">
            <span class="hidden items-center gap-2 rounded-full border border-white/10 py-1 pr-3 pl-1 md:inline-flex">
                <x-ui.avatar initials="NB" size="sm" />
                <span class="text-[13px] text-zinc-300">Northbeam Supply</span>
                <span class="font-mono text-[10px] text-zinc-600">Scale</span>
            </span>

            <x-ui.avatar initials="WH" size="sm" color="jade" />
        </div>
    </header>

    <div class="flex min-h-0 flex-1">
        <nav class="hidden w-56 shrink-0 flex-col gap-0.5 overflow-y-auto border-r border-white/5 p-4 lg:flex">
            @foreach ($sections as $section)
                <p @class(['px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase', 'pt-4' => ! $loop->first])>{{ $section['label'] }}</p>

                @foreach ($section['items'] as $item)
                    <a href="{{ $item['href'] }}" @isset($item['screen']) target="_top" @endisset
                        @if ($item['active']) aria-current="page" @endif
                        @class([
                            'flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                            'bg-jade-500/12 text-jade-300' => $item['active'],
                            'text-zinc-400 hover:bg-white/5 hover:text-cream' => ! $item['active'],
                        ])>
                        <span class="truncate">{{ $item['label'] }}</span>
                        @isset($item['meta'])
                            <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ $item['meta'] }}</span>
                        @endisset
                    </a>
                @endforeach
            @endforeach

            <div class="mt-auto rounded-lg border border-white/8 p-3">
                <p class="text-[11px]/5 text-zinc-500">Owners see every panel. Developers see the first four.</p>
                <a href="#" class="mt-1.5 inline-block font-mono text-[10px] text-jade-400 hover:text-jade-300">Role reference</a>
            </div>
        </nav>

        <div class="relative flex min-w-0 flex-1">
            <div data-ui-scroll-region class="flex min-w-0 flex-1 flex-col overflow-y-auto">
                <div class="shrink-0 border-b border-white/5 px-4 py-2.5 lg:hidden">
                    <x-ui.dropdown>
                        {{ $active }}

                        <x-slot:menu>
                            @foreach ($sections as $section)
                                <p @class(['px-3 pb-1 font-mono text-[10px] tracking-wider text-zinc-600 uppercase', 'pt-2' => ! $loop->first])>{{ $section['label'] }}</p>

                                @foreach ($section['items'] as $item)
                                    <a href="{{ $item['href'] }}" @isset($item['screen']) target="_top" @endisset
                                        @class(['text-jade-300!' => $item['active']])>
                                        {{ $item['label'] }}
                                        @isset($item['meta'])
                                            <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ $item['meta'] }}</span>
                                        @endisset
                                    </a>
                                @endforeach
                            @endforeach
                        </x-slot>
                    </x-ui.dropdown>
                </div>

                <div class="mx-auto w-full max-w-3xl shrink-0 px-5 py-8 sm:px-8">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <h1 class="text-xl font-semibold tracking-tight text-cream">{{ $title }}</h1>
                            @if ($description)
                                <p class="mt-1.5 max-w-lg text-[13px]/6 text-zinc-500">{{ $description }}</p>
                            @endif
                        </div>
                        @isset($actions)
                            <div class="flex shrink-0 flex-wrap items-center gap-2">{{ $actions }}</div>
                        @endisset
                    </div>

                    <div class="mt-7 flex flex-col gap-5">{{ $slot }}</div>

                    @if ($dirty)
                        <div class="sticky bottom-0 z-10 mt-6 flex flex-wrap items-center gap-x-3 gap-y-2 rounded-xl border border-jade-500/25 bg-ink-900/95 px-4 py-3 backdrop-blur">
                            <span class="size-1.5 shrink-0 rounded-full bg-jade-400"></span>
                            <p class="text-[13px] text-zinc-200">Unsaved changes</p>
                            <p class="font-mono text-[11px] text-zinc-600">applies to every workspace you belong to</p>

                            <div class="ml-auto flex shrink-0 items-center gap-2">
                                <x-ui.button variant="ghost" size="sm">Reset</x-ui.button>
                                <x-ui.button size="sm">Save changes</x-ui.button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <x-ui.scroll-top anchor="container" variant="progress" :threshold="300" />
        </div>
    </div>
</div>
