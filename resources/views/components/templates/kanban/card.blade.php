@props([
    'code',
    'title',
    'tags' => [],
    'assignee' => null,
    'station' => null,
    'done' => 0,
    'steps' => 0,
    'qty' => null,
    'days' => 0,
    'blocked' => false,
    'href' => null,
])

@php
    $target = $href ?? route('templates.screen', ['kanban', 'ticket']);

    $labels = array_column($tags, 'label');

    $ageTone = match (true) {
        $days >= 5 => 'text-red-300',
        $days >= 3 => 'text-amber-300',
        default => 'text-zinc-600',
    };

    $progress = $steps > 0 ? round($done / $steps * 100) : 0;
@endphp

<article draggable="true"
    data-card
    data-code="{{ $code }}"
    data-owner="{{ $assignee }}"
    data-days="{{ $days }}"
    data-tags="{{ Illuminate\Support\Str::lower(implode(' ', $labels)) }}"
    data-search="{{ Illuminate\Support\Str::lower($code.' '.$title.' '.$assignee.' '.implode(' ', $labels)) }}"
    @if ($blocked) data-blocked @endif
    {{ $attributes->class([
        'group/card relative cursor-grab rounded-xl border border-white/8 bg-ink-900 p-3 transition-[border-color,transform,opacity] duration-200 ease-snap select-none',
        'hover:border-white/20 active:cursor-grabbing data-dragging:rotate-1 data-dragging:opacity-40',
    ]) }}>

    @if ($blocked)
        <span aria-hidden="true" class="absolute inset-y-3 left-0 w-0.5 rounded-full bg-red-400"></span>
    @endif

    <div class="flex items-center gap-2">
        <span class="font-mono text-[10px] text-zinc-600">{{ $code }}</span>
        @if ($station)
            <span class="truncate font-mono text-[10px] text-zinc-700">{{ $station }}</span>
        @endif
        <span class="ml-auto font-mono text-[10px] {{ $ageTone }}">{{ $days }}d</span>
    </div>

    <h4 class="mt-1.5 text-[13px]/5 font-medium text-cream">
        <a href="{{ $target }}" target="_top" class="outline-none transition-colors duration-150 group-hover/card:text-jade-300 focus-visible:text-jade-300">{{ $title }}</a>
    </h4>

    @if ($tags !== [])
        <div class="mt-2.5 flex flex-wrap gap-1">
            @foreach ($tags as $tag)
                <x-templates.kanban.tag :label="$tag['label']" :tone="$tag['tone'] ?? 'plain'" />
            @endforeach
        </div>
    @endif

    <div class="mt-3 flex items-center gap-2.5 border-t border-white/5 pt-2.5">
        @if ($steps > 0)
            <span class="flex items-center gap-1.5" title="{{ $done }} of {{ $steps }} checks done">
                <span class="block h-0.5 w-8 overflow-hidden rounded-full bg-white/10">
                    <span class="block h-full rounded-full {{ $progress === 100 ? 'bg-jade-400' : 'bg-zinc-500' }}" style="width: {{ $progress }}%"></span>
                </span>
                <span class="font-mono text-[10px] text-zinc-600">{{ $done }}/{{ $steps }}</span>
            </span>
        @endif

        @if ($qty)
            <span class="font-mono text-[10px] text-zinc-600">×{{ $qty }}</span>
        @endif

        @if ($assignee)
            <x-templates.kanban.assignee :name="$assignee" size="xs" :station="$station" class="ml-auto" />
        @endif
    </div>
</article>
