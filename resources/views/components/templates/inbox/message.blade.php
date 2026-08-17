@props([
    'author' => null,
    'kind' => 'inbound',
    'time' => null,
    'role' => null,
    'via' => null,
    'attachments' => [],
    'seen' => null,
    'internal' => null,
])

@php
    $hidden = $internal ?? in_array($kind, ['note', 'event'], true);
@endphp

@if ($kind === 'event')
    <div @if ($hidden) data-internal @endif {{ $attributes->class('flex items-center gap-2.5 py-1 pl-3') }}>
        <span aria-hidden="true" class="size-1 shrink-0 rounded-full bg-zinc-700"></span>
        <p class="font-mono text-[10px] text-zinc-600">{{ $slot }}</p>
        <span aria-hidden="true" class="h-px min-w-4 flex-1 bg-white/5"></span>
        @if ($time)
            <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ $time }}</span>
        @endif
    </div>
@else
    @php
        $outbound = $kind === 'outbound';
        $note = $kind === 'note';

        $bubble = match ($kind) {
            'outbound' => 'border-jade-500/25 bg-jade-500/8',
            'note' => 'border-dashed border-amber-400/30 bg-amber-400/5',
            default => 'border-white/8 bg-ink-900',
        };
    @endphp

    <article @if ($hidden) data-internal @endif {{ $attributes->class(['flex gap-3', 'flex-row-reverse' => $outbound]) }}>
        <x-templates.inbox.avatar
            :name="$author"
            size="md"
            :kind="$kind === 'inbound' ? 'customer' : 'agent'"
            :meta="$role"
            class="mt-1" />

        <div class="min-w-0 max-w-[44rem] flex-1">
            <div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5 {{ $outbound ? 'flex-row-reverse' : '' }}">
                <span class="text-[13px] font-medium text-cream">{{ $author }}</span>
                @if ($role)
                    <span class="font-mono text-[10px] text-zinc-600">{{ $role }}</span>
                @endif
                <span class="font-mono text-[10px] text-zinc-700">{{ $time }}</span>
            </div>

            <div class="mt-1.5 rounded-xl border px-3.5 py-3 {{ $bubble }}">
                @if ($note)
                    <p class="mb-2 flex items-center gap-1.5 font-mono text-[10px] tracking-wide text-amber-300/80 uppercase">
                        <svg class="size-3" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M11.5 2.5 13.5 4.5 6 12l-3 1 1-3z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                        </svg>
                        internal note — the customer never sees this
                    </p>
                @endif

                <div class="space-y-2.5 text-[13px]/6 text-zinc-300">{{ $slot }}</div>

                @if ($attachments !== [])
                    <div class="mt-3 flex flex-wrap gap-1.5 border-t border-white/5 pt-3">
                        @foreach ($attachments as $file)
                            <span class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 bg-ink-950 px-2 py-1 font-mono text-[10px] text-zinc-400">
                                <svg class="size-3 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                    <path d="M9 2.5H4.5v11h7V5z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M9 2.5V5h2.5" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                                </svg>
                                {{ $file['name'] }}
                                <span class="text-zinc-700">{{ $file['size'] }}</span>
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mt-1 flex items-center gap-2 {{ $outbound ? 'justify-end' : '' }}">
                @if ($via)
                    <span class="font-mono text-[10px] text-zinc-700">{{ $via }}</span>
                @endif
                @if ($seen)
                    <span class="font-mono text-[10px] text-jade-400/70">{{ $seen }}</span>
                @endif
            </div>
        </div>
    </article>
@endif
