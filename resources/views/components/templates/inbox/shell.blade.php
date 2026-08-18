@props([
    'active' => 'Inbox',
    'folder' => 'Unassigned',
    'rail' => true,
    'padded' => true,
    'promise' => '4h first reply, business hours GMT+8',
])

@php
    $links = [
        ['label' => 'Inbox', 'screen' => 'threads'],
        ['label' => 'Compose', 'screen' => 'compose'],
        ['label' => 'Search', 'screen' => 'search'],
    ];

    $folders = [
        ['label' => 'Unassigned', 'count' => 3, 'tone' => 'urgent'],
        ['label' => 'Mine', 'count' => 3, 'tone' => 'plain'],
        ['label' => 'Waiting on them', 'count' => 1, 'tone' => 'plain'],
        ['label' => 'Snoozed', 'count' => 1, 'tone' => 'plain'],
    ];

    $lanes = [
        ['label' => 'Warranty', 'count' => 2],
        ['label' => 'Dealers', 'count' => 3],
        ['label' => 'Orders', 'count' => 2],
        ['label' => 'Parts', 'count' => 1],
    ];

    $desk = ['Hana Okabe', 'Lena Kohler', 'Idris Bahar'];

    $bar = $toolbar ?? null;
@endphp

<div {{ $attributes->class('flex h-full w-full flex-col overflow-hidden bg-ink-950') }}>

    <header class="shrink-0 border-b border-white/5 bg-ink-950">
        <div class="flex h-14 items-center gap-5 px-4 sm:px-5">
            <a href="{{ route('templates.screen', ['inbox', 'threads']) }}" target="_top" class="flex shrink-0 items-center gap-2.5">
                <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                    <path d="M3.5 8.5 12 14l8.5-5.5M3.5 6.5h17v11h-17z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                </svg>
                <span class="flex flex-col leading-none">
                    <span class="text-sm font-medium tracking-tight text-cream">Front desk</span>
                    <span class="mt-0.5 font-mono text-[10px] text-zinc-600">support@nomadsupply.cc</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 md:flex">
                @foreach ($links as $link)
                    <a href="{{ route('templates.screen', ['inbox', $link['screen']]) }}" target="_top"
                        @if ($link['label'] === $active) aria-current="page" @endif
                        @class([
                            'rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                            'bg-white/8 text-cream' => $link['label'] === $active,
                            'text-zinc-500 hover:bg-white/5 hover:text-cream' => $link['label'] !== $active,
                        ])>{{ $link['label'] }}</a>
                @endforeach
            </nav>

            <div class="ml-auto flex shrink-0 items-center gap-3">
                <span class="hidden items-center gap-1.5 rounded-lg border border-red-400/40 bg-red-500/8 px-2.5 py-1.5 font-mono text-[11px] text-red-300 lg:flex">
                    <span class="size-1.5 rounded-full bg-red-400"></span>
                    2 past the promise
                </span>

                <div class="hidden items-center -space-x-1.5 sm:flex">
                    @foreach ($desk as $person)
                        <x-templates.inbox.avatar :name="$person" size="sm" class="ring-2 ring-ink-950" />
                    @endforeach
                </div>

                <button type="button"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    Write
                </button>
            </div>
        </div>

        @if ($bar?->isNotEmpty())
            <div class="border-t border-white/5 px-4 py-2.5 sm:px-5">{{ $bar }}</div>
        @endif
    </header>

    <div class="relative flex min-h-0 flex-1">
        @if ($rail)
            <aside class="hidden w-52 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                <div>
                    <p class="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Queues</p>
                    <nav class="mt-2 px-2">
                        @foreach ($folders as $entry)
                            <a href="{{ route('templates.screen', ['inbox', 'threads']) }}" target="_top"
                                @if ($entry['label'] === $folder) aria-current="page" @endif
                                @class([
                                    'flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                                    'bg-white/8 text-cream' => $entry['label'] === $folder,
                                    'text-zinc-500 hover:bg-white/5 hover:text-cream' => $entry['label'] !== $folder,
                                ])>
                                <span class="truncate">{{ $entry['label'] }}</span>
                                <span @class([
                                    'ml-auto shrink-0 font-mono text-[10px]',
                                    'text-red-300' => $entry['tone'] === 'urgent',
                                    'text-zinc-600' => $entry['tone'] !== 'urgent',
                                ])>{{ $entry['count'] }}</span>
                            </a>
                        @endforeach
                    </nav>

                    <p class="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Lanes</p>
                    <nav class="mt-2 px-2">
                        @foreach ($lanes as $lane)
                            <a href="{{ route('templates.screen', ['inbox', 'search']) }}" target="_top"
                                class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                <span class="truncate">{{ $lane['label'] }}</span>
                                <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ $lane['count'] }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>

                <div class="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                    <p class="font-mono text-[10px] text-zinc-600">Reply promise</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-400">{{ $promise }}</p>
                    <div class="mt-2.5 flex items-center gap-2">
                        <span class="block h-0.5 flex-1 overflow-hidden rounded-full bg-white/10">
                            <span class="block h-full w-[82%] rounded-full bg-jade-500/70"></span>
                        </span>
                        <span class="font-mono text-[10px] text-zinc-500">82%</span>
                    </div>
                    <p class="mt-1.5 font-mono text-[10px] text-zinc-700">kept, last 30 days</p>
                </div>
            </aside>
        @endif

        @if ($padded)
            <main data-ui-scroll-region class="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">{{ $slot }}</main>

            <x-ui.scroll-top anchor="container" variant="progress" :threshold="300" />
        @else
            <main class="flex min-h-0 flex-1 flex-col overflow-hidden">{{ $slot }}</main>
        @endif
    </div>
</div>
