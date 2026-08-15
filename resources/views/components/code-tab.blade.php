@props(['panel', 'active' => false])

<button type="button" data-code-tab="{{ $panel }}" @if ($active) data-active @endif
    {{ $attributes->merge(['class' => 'rounded-md px-2.5 py-1 font-mono text-xs text-zinc-500 transition-colors duration-150 outline-none hover:text-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-white/5 data-active:text-jade-400']) }}>{{ $slot }}</button>
