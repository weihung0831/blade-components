@props([
    'title',
    'excerpt' => null,
    'topic',
    'date',
    'published' => null,
    'read' => 6,
    'author' => null,
    'href' => null,
    'featured' => false,
    'kicker' => null,
])

@php
    $target = $href ?? route('templates.screen', ['blog', 'article']);
@endphp

<article data-post-card data-topic="{{ $topic }}" data-read="{{ $read }}" data-published="{{ $published ?? 0 }}"
    data-search="{{ Illuminate\Support\Str::lower($title.' '.$topic.' '.($excerpt ?? '')) }}"
    {{ $attributes->class([
        'group/post flex overflow-hidden rounded-2xl border border-white/8 bg-ink-900 transition-colors duration-200 ease-snap hover:border-white/20',
        'flex-col gap-5 p-6 sm:flex-row sm:items-stretch sm:p-7' => $featured,
        'flex-col p-5' => ! $featured,
    ]) }}>

    @if ($featured)
        <div class="dot-grid grid shrink-0 place-items-center rounded-xl border border-white/8 bg-ink-950 sm:w-56">
            <svg class="size-8 text-zinc-700" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="7.5" stroke="currentColor" stroke-width="1.3"/>
                <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.3"/>
                <path d="M12 4.5v3M12 16.5v3M19.5 12h-3M7.5 12h-3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            </svg>
        </div>
    @endif

    <div class="flex min-w-0 flex-1 flex-col">
        <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
            @if ($kicker)
                <span class="rounded-md border border-jade-500/40 bg-jade-500/10 px-2 py-0.5 font-mono text-[10px] tracking-wider text-jade-300 uppercase">{{ $kicker }}</span>
            @endif
            <span class="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{{ $topic }}</span>
            <span class="font-mono text-[10px] text-zinc-600">{{ $date }}</span>
        </div>

        <h3 @class([
            'font-semibold tracking-tight text-cream',
            'mt-3 text-xl/7 sm:text-2xl/8' => $featured,
            'mt-2.5 text-[15px]/6' => ! $featured,
        ])>
            <a href="{{ $target }}" target="_top" class="outline-none transition-colors duration-150 group-hover/post:text-jade-300 focus-visible:text-jade-300">{{ $title }}</a>
        </h3>

        @if ($excerpt)
            <p @class(['text-zinc-500', 'mt-2.5 max-w-xl text-sm/6' => $featured, 'mt-2 text-[13px]/6' => ! $featured])>{{ $excerpt }}</p>
        @endif

        <div class="mt-4 flex flex-wrap items-center gap-x-3 gap-y-1.5 font-mono text-[10px] text-zinc-600 {{ $featured ? 'sm:mt-auto sm:pt-4' : 'mt-auto pt-4' }}">
            @if ($author)
                <span class="text-zinc-500">{{ $author }}</span>
                <span aria-hidden="true" class="size-1 rounded-full bg-white/15"></span>
            @endif
            <span>{{ $read }} min read</span>
            <span aria-hidden="true" class="size-1 rounded-full bg-white/15"></span>
            <span class="inline-flex items-center gap-1.5 transition-colors duration-150 group-hover/post:text-jade-400">
                Read
                <svg class="size-3 transition-transform duration-200 ease-snap group-hover/post:translate-x-0.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
        </div>
    </div>
</article>
