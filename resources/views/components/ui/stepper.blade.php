@props(['steps' => [], 'current' => 1, 'orientation' => 'horizontal'])

@php
    $circle = function (int $number) use ($current) {
        if ($number < $current) {
            return 'bg-jade-500';
        }

        return $number === $current
            ? 'border-2 border-jade-500 font-mono text-xs text-jade-400'
            : 'border-2 border-white/15 font-mono text-xs text-zinc-500';
    };

    $label = fn (int $number) => $number < $current
        ? 'text-zinc-400'
        : ($number === $current ? 'font-medium text-cream' : 'text-zinc-500');
@endphp

@if ($orientation === 'vertical')
    <div {{ $attributes->merge(['class' => 'flex flex-col']) }}>
        @foreach ($steps as $index => $step)
            @php $number = $index + 1; @endphp
            <div class="flex gap-3">
                <div class="flex flex-col items-center">
                    <span class="grid size-7 shrink-0 place-items-center rounded-full {{ $circle($number) }}">
                        @if ($number < $current)
                            <svg class="size-3.5 text-ink-950" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @else
                            {{ $number }}
                        @endif
                    </span>
                    @unless ($loop->last)
                        <span class="my-1 min-h-4 w-px flex-1 {{ $number < $current ? 'bg-jade-500' : 'bg-white/15' }}"></span>
                    @endunless
                </div>
                <div @class(['pt-1', 'pb-6' => ! $loop->last])>
                    <p class="text-sm {{ $label($number) }}">{{ $step['label'] }}</p>
                    @isset($step['description'])
                        <p class="mt-0.5 text-xs/5 text-zinc-500">{{ $step['description'] }}</p>
                    @endisset
                </div>
            </div>
        @endforeach
    </div>
@else
    <div {{ $attributes->merge(['class' => 'flex items-start']) }}>
        @foreach ($steps as $index => $step)
            @php $number = $index + 1; @endphp
            <div class="flex flex-col items-center gap-1.5 text-center">
                <span class="grid size-7 shrink-0 place-items-center rounded-full {{ $circle($number) }}">
                    @if ($number < $current)
                        <svg class="size-3.5 text-ink-950" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    @else
                        {{ $number }}
                    @endif
                </span>
                <span class="text-xs {{ $label($number) }}">{{ $step['label'] }}</span>
            </div>
            @unless ($loop->last)
                <span class="mx-2 mt-3.5 h-px w-10 {{ $number < $current ? 'bg-jade-500' : 'bg-white/15' }}"></span>
            @endunless
        @endforeach
    </div>
@endif
