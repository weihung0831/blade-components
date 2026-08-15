@props(['title', 'description' => null, 'code'])

<section {{ $attributes }}>
    <h2 class="text-lg font-semibold tracking-tight text-cream">{{ $title }}</h2>
    @if ($description)
        <p class="mt-1 text-sm text-zinc-500">{{ $description }}</p>
    @endif

    <div class="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
        <div class="dot-grid flex flex-wrap items-center justify-center gap-3 border-b border-white/5 p-10">
            {{ $slot }}
        </div>
        <pre class="overflow-x-auto p-4 font-mono text-[13px]/6"><code>@foreach (explode("\n", trim($code, "\n")) as $line)<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">{{ $loop->iteration }}</span>{!! App\Support\BladeSyntaxHighlighter::highlight($line) !!}
@endforeach</code></pre>
    </div>
</section>
