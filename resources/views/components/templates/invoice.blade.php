@php
    $items = ['w-full', 'w-4/5', 'w-11/12', 'w-2/3', 'w-3/4'];
@endphp

<div class="relative flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-900 p-3 shadow-xl shadow-black/40">
    <span aria-hidden="true" class="absolute inset-x-0 top-0 h-0.5 bg-jade-500/60"></span>

    <div class="flex items-start justify-between gap-3">
        <span class="flex items-start gap-1.5">
            <span class="mt-0.5 block size-2.5 rounded-sm border border-jade-500/60"></span>
            <span class="flex flex-col gap-0.5">
                <span class="block h-1 w-10 rounded bg-cream/25"></span>
                <span class="block h-0.5 w-12 rounded bg-white/10"></span>
                <span class="block h-0.5 w-8 rounded bg-white/8"></span>
            </span>
        </span>

        <span class="flex flex-col items-end gap-0.5">
            <span class="block h-0.5 w-6 rounded bg-white/12"></span>
            <span class="block h-1.5 w-12 rounded bg-cream/30"></span>
            <span class="mt-0.5 block h-0.5 w-9 rounded bg-white/8"></span>
        </span>
    </div>

    <span class="mt-2.5 flex items-center justify-between gap-2 border-t border-white/8 pt-2">
        <span class="flex flex-col gap-0.5">
            <span class="block h-0.5 w-7 rounded bg-white/10"></span>
            <span class="block h-1 w-14 rounded bg-cream/20"></span>
            <span class="block h-0.5 w-10 rounded bg-jade-500/40"></span>
        </span>

        <span class="-rotate-6 rounded border border-dashed border-red-400/60 px-1.5 py-0.5">
            <span class="block h-1 w-8 rounded bg-red-400/50"></span>
        </span>
    </span>

    <span class="mt-2.5 flex min-h-0 flex-1 flex-col gap-1.5 border-t border-white/8 pt-2">
        @foreach ($items as $item)
            <span class="flex items-center justify-between gap-3">
                <span class="block h-1 {{ $item }} rounded bg-white/10"></span>
                <span class="block h-1 w-6 shrink-0 rounded bg-white/14"></span>
            </span>
        @endforeach
    </span>

    <span class="mt-auto flex flex-col gap-1 border-t border-white/10 pt-2">
        <span class="flex items-center justify-between gap-3">
            <span class="block h-0.5 w-8 rounded bg-white/8"></span>
            <span class="block h-0.5 w-6 rounded bg-white/8"></span>
        </span>
        <span class="flex items-center justify-between gap-3">
            <span class="block h-1 w-10 rounded bg-cream/25"></span>
            <span class="block h-2 w-14 rounded bg-jade-500"></span>
        </span>
    </span>
</div>
