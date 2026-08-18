@props([
    'steps' => [],
    'layout' => 'rail',
    'interactive' => false,
])

@php
    $dot = 'size-2 shrink-0 rounded-full border border-white/15 bg-transparent transition-colors duration-150 '
        .'group-data-[step-state=done]/step:border-jade-500 group-data-[step-state=done]/step:bg-jade-500 '
        .'group-data-[step-state=current]/step:border-jade-500 group-data-[step-state=current]/step:bg-jade-500 group-data-[step-state=current]/step:ring-4 group-data-[step-state=current]/step:ring-jade-500/20 '
        .'group-data-[step-state=skipped]/step:border-dashed group-data-[step-state=skipped]/step:border-amber-400/60';

    $text = 'text-zinc-600 transition-colors duration-150 '
        .'group-data-[step-state=done]/step:text-zinc-400 '
        .'group-data-[step-state=current]/step:text-cream '
        .'group-data-[step-state=skipped]/step:text-amber-300/70';

    $line = 'bg-white/10 group-data-[step-state=done]/step:bg-jade-500/40';
@endphp

@if ($layout === 'row')
    <ol {{ $attributes->class('flex items-center gap-1.5') }}>
        @foreach ($steps as $step)
            <li class="group/step flex min-w-0 flex-1 items-center gap-1.5" data-step-state="{{ $step['state'] ?? 'todo' }}" data-step="{{ $step['key'] }}">
                <span class="{{ $dot }}"></span>
                <span class="truncate text-[11px] {{ $text }}">{{ $step['label'] }}</span>
                @if (! $loop->last)
                    <span class="h-px min-w-3 flex-1 {{ $line }}"></span>
                @endif
            </li>
        @endforeach
    </ol>
@else
    <ol {{ $attributes->class('flex flex-col') }}>
        @foreach ($steps as $step)
            @php $tag = $interactive ? 'button' : 'div'; @endphp

            <li class="group/step flex gap-3" data-step-state="{{ $step['state'] ?? 'todo' }}" data-step="{{ $step['key'] }}">
                <span class="flex w-2 shrink-0 flex-col items-center pt-1.5">
                    <span class="{{ $dot }}"></span>
                    @if (! $loop->last)
                        <span class="mt-1 w-px flex-1 {{ $line }}"></span>
                    @endif
                </span>

                <{{ $tag }}
                    @if ($interactive) type="button" data-step-jump="{{ $step['key'] }}" @endif
                    @class([
                        'min-w-0 flex-1 pb-4 text-left outline-none',
                        '-mx-2 rounded-lg px-2 transition-colors duration-150 hover:bg-white/4 focus-visible:ring-2 focus-visible:ring-jade-500/70' => $interactive,
                    ])>
                    <span class="flex items-baseline gap-2">
                        <span class="truncate text-[13px] {{ $text }}">{{ $step['label'] }}</span>

                        @if ($step['optional'] ?? false)
                            <span class="shrink-0 font-mono text-[10px] text-zinc-700 group-data-[step-state=skipped]/step:text-amber-300/70">
                                <span class="hidden group-data-[step-state=skipped]/step:inline">skipped</span>
                                <span class="group-data-[step-state=skipped]/step:hidden group-data-[step-state=done]/step:hidden">optional</span>
                            </span>
                        @endif

                        <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ $step['minutes'] ?? '' }}</span>
                    </span>

                    @if (! empty($step['note']))
                        <span class="mt-0.5 block text-[11px]/5 text-zinc-600">{{ $step['note'] }}</span>
                    @endif
                </{{ $tag }}>
            </li>
        @endforeach
    </ol>
@endif
