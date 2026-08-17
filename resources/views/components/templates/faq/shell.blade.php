@props([
    'active' => 'Answers',
    'topic' => null,
    'rail' => true,
    'padded' => true,
])

@php
    $links = [
        ['label' => 'Answers', 'screen' => 'questions'],
        ['label' => 'Ask', 'screen' => 'ask'],
        ['label' => 'Editing', 'screen' => 'editing'],
    ];

    $topics = [
        ['label' => 'Noise and grind', 'count' => 4, 'hot' => true],
        ['label' => 'Setting it up', 'count' => 3],
        ['label' => 'Warranty', 'count' => 3],
        ['label' => 'Orders and delivery', 'count' => 3],
        ['label' => 'Before you buy', 'count' => 2],
        ['label' => 'Dealers', 'count' => 1],
    ];

    $bar = $toolbar ?? null;
@endphp

<div {{ $attributes->class('flex h-full w-full flex-col overflow-hidden bg-ink-950') }}>

    <header class="shrink-0 border-b border-white/5 bg-ink-950">
        <div class="flex h-14 items-center gap-5 px-4 sm:px-5">
            <a href="{{ route('templates.screen', ['faq', 'questions']) }}" target="_top" class="flex shrink-0 items-center gap-2.5">
                <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                    <path d="M4 5.5h7a2 2 0 0 1 2 2v11a2 2 0 0 0-2-2H4zM20 5.5h-7a2 2 0 0 0-2 2v11a2 2 0 0 1 2-2h7z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                </svg>
                <span class="flex flex-col leading-none">
                    <span class="text-sm font-medium tracking-tight text-cream">Help centre</span>
                    <span class="mt-0.5 font-mono text-[10px] text-zinc-600">help.nomadsupply.cc</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 md:flex">
                @foreach ($links as $link)
                    <a href="{{ route('templates.screen', ['faq', $link['screen']]) }}" target="_top"
                        @if ($link['label'] === $active) aria-current="page" @endif
                        @class([
                            'rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                            'bg-white/8 text-cream' => $link['label'] === $active,
                            'text-zinc-500 hover:bg-white/5 hover:text-cream' => $link['label'] !== $active,
                        ])>{{ $link['label'] }}</a>
                @endforeach
            </nav>

            <div class="ml-auto flex shrink-0 items-center gap-3">
                <span class="hidden items-center gap-1.5 font-mono text-[11px] text-zinc-600 lg:flex">
                    <span class="size-1.5 rounded-full bg-jade-400"></span>
                    16 answers · last edited yesterday
                </span>

                <a href="{{ route('templates.screen', ['faq', 'ask']) }}" target="_top"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    Ask a person
                </a>
            </div>
        </div>

        @if ($bar?->isNotEmpty())
            <div class="border-t border-white/5 px-4 py-2.5 sm:px-5">{{ $bar }}</div>
        @endif
    </header>

    <div class="flex min-h-0 flex-1">
        @if ($rail)
            <aside class="hidden w-56 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                <div>
                    <p class="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Headings</p>
                    <nav class="mt-2 px-2">
                        @foreach ($topics as $entry)
                            <a href="{{ route('templates.screen', ['faq', 'questions']) }}" target="_top"
                                @if ($entry['label'] === $topic) aria-current="page" @endif
                                @class([
                                    'flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                                    'bg-white/8 text-cream' => $entry['label'] === $topic,
                                    'text-zinc-500 hover:bg-white/5 hover:text-cream' => $entry['label'] !== $topic,
                                ])>
                                <span class="truncate">{{ $entry['label'] }}</span>
                                @if ($entry['hot'] ?? false)
                                    <span class="size-1 shrink-0 rounded-full bg-jade-400/70"></span>
                                @endif
                                <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ $entry['count'] }}</span>
                            </a>
                        @endforeach
                    </nav>

                    <p class="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Elsewhere</p>
                    <nav class="mt-2 px-2">
                        @foreach ([['label' => 'The manual, as a PDF', 'meta' => '2.4 MB'], ['label' => 'Spare parts list', 'meta' => '48 items'], ['label' => 'Workshop notes', 'meta' => 'blog']] as $link)
                            <a href="{{ route('templates.screen', ['faq', 'answer']) }}" target="_top"
                                class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                <span class="truncate">{{ $link['label'] }}</span>
                                <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ $link['meta'] }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>

                <div class="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                    <p class="font-mono text-[10px] text-zinc-600">If none of this helps</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-400">Four people read the mail. One of them built your grinder.</p>
                    <div class="mt-2.5 flex items-baseline gap-1.5">
                        <span class="font-mono text-lg text-cream">47</span>
                        <span class="font-mono text-[10px] text-zinc-600">min median first reply</span>
                    </div>
                    <a href="{{ route('templates.screen', ['faq', 'ask']) }}" target="_top"
                        class="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Write to the desk</a>
                </div>
            </aside>
        @endif

        @if ($padded)
            <main data-ui-scroll-region class="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">{{ $slot }}</main>
        @else
            <main class="flex min-h-0 flex-1 flex-col overflow-hidden">{{ $slot }}</main>
        @endif
    </div>
</div>
