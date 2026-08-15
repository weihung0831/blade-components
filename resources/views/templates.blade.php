<x-layout title="Templates — BLADE-COMPONENTS">
    <div class="mx-auto max-w-6xl px-6 py-16 pb-28">
        <div class="rise mb-10 flex items-end justify-between">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight text-cream">Templates</h1>
                <p class="mt-1.5 text-sm text-zinc-500">Full pages assembled from the component catalog. Copy the whole screen, not just the parts.</p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $total) }} templates</span>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($templates as $template)
                @php
                    $soon = ! View::exists('templates.pages.'.$template['slug']);
                    $tag = $soon ? 'div' : 'a';
                @endphp
                <{{ $tag }} @if (! $soon) href="#" @endif
                    class="rise group overflow-hidden rounded-xl border border-white/8 bg-ink-900 transition-colors duration-150 {{ $soon ? '' : 'hover:border-jade-500/60' }}"
                    style="animation-delay: {{ min(60 + $loop->index * 50, 360) }}ms">
                    <div class="dot-grid h-52 border-b border-white/5 p-5 {{ $soon ? 'opacity-60 grayscale-25' : '' }}">
                        <x-dynamic-component :component="'templates.'.$template['slug']" />
                    </div>
                    <div class="flex items-start justify-between gap-3 px-4 py-3.5">
                        <div>
                            <h2 class="text-sm font-medium {{ $soon ? 'text-zinc-500' : 'text-cream' }}">{{ $template['name'] }}</h2>
                            <p class="mt-0.5 text-xs text-zinc-500">{{ $template['description'] }}</p>
                        </div>
                        @if ($soon)
                            <span class="shrink-0 rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] tracking-wider text-zinc-500 uppercase">Soon</span>
                        @else
                            <span class="shrink-0 font-mono text-xs text-zinc-600">{{ sprintf('%02d', $template['pages']) }} {{ Str::plural('page', $template['pages']) }}</span>
                        @endif
                    </div>
                </{{ $tag }}>
            @endforeach
        </div>
    </div>
</x-layout>
