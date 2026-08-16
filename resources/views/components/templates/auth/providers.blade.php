@props([
    'sso' => true,
    'note' => 'Scale plan',
])

@php
    $button = 'flex h-10 items-center justify-center gap-2 rounded-lg border border-white/10 bg-ink-950 text-[13px] text-zinc-300 transition-[transform,border-color,color] duration-150 ease-snap outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 active:scale-[0.98]';
@endphp

<div {{ $attributes->class('flex flex-col gap-2') }}>
    <div class="grid grid-cols-2 gap-2">
        <button type="button" class="{{ $button }}">
            <svg class="size-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48Z"/></svg>
            Google
        </button>

        <button type="button" class="{{ $button }}">
            <svg class="size-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .3a12 12 0 0 0-3.8 23.4c.6.1.8-.3.8-.6v-2c-3.3.7-4-1.6-4-1.6-.6-1.4-1.4-1.8-1.4-1.8-1-.7.1-.7.1-.7 1.2.1 1.8 1.2 1.8 1.2 1.1 1.9 2.8 1.3 3.5 1 .1-.8.4-1.3.8-1.6-2.7-.3-5.5-1.3-5.5-5.9 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.5.1-3.2 0 0 1-.3 3.3 1.2a11.5 11.5 0 0 1 6 0C17.2 4.9 18.2 5.2 18.2 5.2c.6 1.7.2 2.9.1 3.2.8.8 1.2 1.9 1.2 3.2 0 4.6-2.8 5.6-5.5 5.9.4.4.8 1.1.8 2.2v3.3c0 .3.2.7.8.6A12 12 0 0 0 12 .3Z"/></svg>
            GitHub
        </button>
    </div>

    @if ($sso)
        <button type="button" class="{{ $button }} px-3">
            <svg class="size-4 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M4.5 7V5.2a3.5 3.5 0 1 1 7 0V7M3.8 7h8.4a1 1 0 0 1 1 1v4.5a1 1 0 0 1-1 1H3.8a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1Z" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Continue with SAML SSO
            <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ $note }}</span>
        </button>
    @endif
</div>
