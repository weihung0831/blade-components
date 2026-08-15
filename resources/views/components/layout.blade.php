@props(['title' => 'BLADE-COMPONENTS — Hand-crafted UI for Laravel Blade'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ink-950 font-sans text-zinc-300 antialiased selection:bg-jade-500/30 selection:text-cream">

    {{-- Nav --}}
    <header class="sticky top-0 z-40 border-b border-white/5 bg-ink-950/80 backdrop-blur">
        <div class="mx-auto flex h-14 max-w-6xl items-center justify-between px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <svg class="size-7 shrink-0" viewBox="0 0 28 28" aria-hidden="true">
                    <rect width="28" height="28" rx="7.5" fill="#4ea396" />
                    <path d="M7 19 L11 9 M12.5 19 L16.5 9 M18 19 L22 9" stroke="#fefbee" stroke-width="2.6" stroke-linecap="round" fill="none" />
                </svg>
                <span class="text-[13px] font-semibold tracking-[0.12em] text-cream">BLADE<span class="text-jade-400">-</span>COMPONENTS</span>
            </a>
            <nav class="flex items-center gap-6 text-sm">
                <a href="{{ route('components') }}"
                    class="hidden transition-colors duration-150 sm:block {{ request()->routeIs('components', 'components.*') ? 'text-cream' : 'text-zinc-400 hover:text-cream' }}">Components</a>
                <a href="{{ route('templates') }}"
                    class="hidden transition-colors duration-150 sm:block {{ request()->routeIs('templates') ? 'text-cream' : 'text-zinc-400 hover:text-cream' }}">Templates</a>
                <a href="#" class="hidden text-zinc-400 transition-colors duration-150 hover:text-cream sm:block">Docs</a>
                <a href="#" class="text-zinc-400 transition-colors duration-150 hover:text-cream">GitHub</a>
                <span class="rounded-full border border-white/10 px-2.5 py-0.5 font-mono text-xs text-zinc-500">v0.1.0</span>
            </nav>
        </div>
    </header>

    {{ $slot }}

    {{-- Back to top --}}
    <button type="button" data-back-to-top aria-label="Back to top"
        class="pointer-events-none fixed right-6 bottom-6 z-40 grid size-10 translate-y-2 place-items-center rounded-full border border-white/10 bg-ink-900/90 text-zinc-400 opacity-0 backdrop-blur transition-[opacity,translate,color,border-color] duration-200 ease-snap hover:border-jade-500 hover:text-cream active:scale-[0.95] data-visible:pointer-events-auto data-visible:translate-y-0 data-visible:opacity-100">
        <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M8 12.5v-9M4 7l4-3.5L12 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>

    {{-- Footer --}}
    <footer class="border-t border-white/5">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-8 font-mono text-xs text-zinc-600">
            <span class="flex items-center gap-2">
                <svg class="size-5 shrink-0" viewBox="0 0 28 28" aria-hidden="true">
                    <rect width="28" height="28" rx="7.5" fill="#1a1a21" />
                    <path d="M7 19 L11 9 M12.5 19 L16.5 9 M18 19 L22 9" stroke="#4ea396" stroke-width="2.6" stroke-linecap="round" fill="none" />
                </svg>
                BLADE-COMPONENTS © 2026
            </span>
            <span>MIT License</span>
        </div>
    </footer>

</body>
</html>
