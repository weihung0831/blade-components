@props([
    'ref',
    'from',
    'company' => null,
    'subject',
    'preview' => null,
    'tags' => [],
    'minutes' => null,
    'unread' => false,
    'assignee' => null,
    'count' => 1,
    'time' => null,
    'channel' => 'email',
    'state' => 'open',
    'active' => false,
])

@php
    $labels = array_column($tags, 'label');

    $channels = [
        'email' => 'M2.5 4.5h11v7h-11zM2.5 5l5.5 4 5.5-4',
        'form' => 'M3.5 2.5h9v11h-9zM5.5 5.5h5M5.5 8h5M5.5 10.5h3',
        'chat' => 'M2.5 4.5h11v6h-6l-3 2.5v-2.5h-2z',
        'phone' => 'M4 2.8 5.8 6 4.6 7.4a7 7 0 0 0 4 4L10 10.2l3.2 1.8v2.2A11 11 0 0 1 1.8 2.8z',
    ];

    $states = [
        'open' => null,
        'waiting' => 'waiting on them',
        'snoozed' => 'snoozed till Thu',
        'closed' => 'closed',
    ];
@endphp

<button type="button"
    data-thread
    data-ref="{{ $ref }}"
    data-owner="{{ $assignee ?? 'unassigned' }}"
    data-state="{{ $state }}"
    data-channel="{{ $channel }}"
    data-tags="{{ Illuminate\Support\Str::lower(implode(' ', $labels)) }}"
    data-minutes="{{ $minutes ?? '' }}"
    data-search="{{ Illuminate\Support\Str::lower($ref.' '.$from.' '.$company.' '.$subject.' '.$preview.' '.implode(' ', $labels)) }}"
    @if ($unread) data-unread @endif
    @if ($active) data-active @endif
    {{ $attributes->class([
        'group/thread relative block w-full cursor-pointer border-b border-white/5 py-3 pr-3 pl-4 text-left outline-none',
        'transition-colors duration-150 hover:bg-white/4 focus-visible:bg-white/4 data-active:bg-white/6',
    ]) }}>

    <span aria-hidden="true"
        class="absolute inset-y-0 left-0 w-0.5 bg-jade-400 opacity-0 transition-opacity duration-150 group-data-active/thread:opacity-100"></span>

    <span aria-hidden="true"
        class="absolute top-4.5 left-1.5 size-1.5 rounded-full bg-jade-400 opacity-0 group-data-unread/thread:opacity-100 group-data-active/thread:opacity-0"></span>

    <span class="flex items-start gap-2.5">
        <x-templates.inbox.avatar :name="$from" size="md" kind="customer" :meta="$company" class="mt-0.5" />

        <span class="min-w-0 flex-1">
            <span class="flex items-baseline gap-2">
                <span class="truncate text-[13px] text-zinc-400 group-data-unread/thread:font-medium group-data-unread/thread:text-cream">{{ $from }}</span>
                @if ($company)
                    <span class="hidden truncate font-mono text-[10px] text-zinc-600 sm:block">{{ $company }}</span>
                @endif
                <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ $time }}</span>
            </span>

            <span class="mt-1 flex items-center gap-1.5">
                <svg class="size-3 shrink-0 text-zinc-700" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="{{ $channels[$channel] ?? $channels['email'] }}" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                </svg>
                <span class="truncate text-[13px]/5 text-zinc-300 group-data-unread/thread:text-cream">{{ $subject }}</span>
                @if ($count > 1)
                    <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ $count }}</span>
                @endif
            </span>

            @if ($preview)
                <span class="mt-1 line-clamp-1 block text-[12px]/5 text-zinc-600">{{ $preview }}</span>
            @endif

            <span class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1.5">
                @foreach ($tags as $tag)
                    <x-templates.inbox.tag :label="$tag['label']" :tone="$tag['tone'] ?? 'plain'" />
                @endforeach

                @if ($states[$state] ?? null)
                    <span class="font-mono text-[10px] text-zinc-600">{{ $states[$state] }}</span>
                @endif

                <span class="ml-auto flex items-center gap-2.5">
                    @if ($minutes !== null)
                        <x-templates.inbox.clock :minutes="$minutes" compact />
                    @endif

                    @if ($assignee)
                        <x-templates.inbox.avatar :name="$assignee" size="xs" />
                    @else
                        <span class="grid size-5 place-items-center rounded-full border border-dashed border-white/15 font-mono text-[9px] text-zinc-700">?</span>
                    @endif
                </span>
            </span>
        </span>
    </span>
</button>
