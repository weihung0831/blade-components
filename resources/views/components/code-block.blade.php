@props(['code', 'lang' => 'blade'])

@php
    $lines = explode("\n", trim($code, "\n"));
    $gutterWidth = count($lines) > 99 ? 'w-7' : 'w-5';
@endphp

<div {{ $attributes->merge(['class' => 'relative']) }}>
    <button type="button" data-copy-code="{{ trim($code, "\n") }}" aria-label="Copy code"
        class="absolute top-2.5 right-2.5 grid size-7 place-items-center rounded-md border border-white/10 bg-ink-900/90 text-zinc-500 backdrop-blur transition-[transform,color,border-color] duration-150 ease-snap outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 active:scale-[0.92]">
        <svg data-copy-icon class="size-3.5" viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 5.5V4a1.5 1.5 0 0 0-1.5-1.5H4A1.5 1.5 0 0 0 2.5 4v5A1.5 1.5 0 0 0 4 10.5h1.5" stroke="currentColor" stroke-width="1.3"/></svg>
        <svg data-copied-icon class="hidden size-3.5 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M3.5 8.5 6.5 11.5l6-7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
    <pre class="overflow-x-auto p-4 font-mono text-[13px]/6"><code>@foreach ($lines as $line)<span class="mr-4 inline-block {{ $gutterWidth }} text-right text-zinc-700 select-none">{{ $loop->iteration }}</span>{!! $lang === 'css' ? App\Support\BladeSyntaxHighlighter::highlightCss($line) : App\Support\BladeSyntaxHighlighter::highlight($line) !!}
@endforeach</code></pre>
</div>
