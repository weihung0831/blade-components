@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);
    $current = collect($screens)->firstWhere('slug', $screen);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $current['name'] }} — {{ $template['name'] }} template</title>
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.dataset.theme = 'light';
        }
    </script>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-dvh bg-ink-950 font-sans text-zinc-300 antialiased selection:bg-jade-500/30 selection:text-cream">

    <div class="sticky top-0 z-50 flex h-11 items-center gap-4 border-b border-white/5 bg-ink-950/80 px-4 backdrop-blur">
        <a href="{{ route('templates.show', $template['slug']) }}" class="flex shrink-0 items-center gap-1.5 text-xs text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            {{ $template['name'] }}
        </a>

        <nav class="flex items-center gap-1 overflow-x-auto">
            @foreach ($screens as $entry)
                <a href="{{ route('templates.screen', [$template['slug'], $entry['slug']]) }}"
                    @class([
                        'rounded-md px-2.5 py-1 text-xs whitespace-nowrap transition-colors duration-150',
                        'bg-jade-500/15 text-jade-300' => $entry['slug'] === $screen,
                        'text-zinc-500 hover:bg-white/5 hover:text-cream' => $entry['slug'] !== $screen,
                    ])>{{ $entry['name'] }}</a>
            @endforeach
        </nav>

        <button type="button" data-theme-toggle aria-label="Toggle color theme"
            class="ml-auto grid size-7 shrink-0 place-items-center rounded-md text-zinc-400 transition-[transform,color] duration-150 ease-snap hover:text-cream active:scale-[0.92]">
            <svg class="size-4 light:hidden" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="3.25" stroke="currentColor" stroke-width="1.3"/><path d="M8 1.5v1.6M8 12.9v1.6M1.5 8h1.6M12.9 8h1.6M3.4 3.4l1.13 1.13M11.47 11.47l1.13 1.13M12.6 3.4l-1.13 1.13M4.53 11.47 3.4 12.6" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
            <svg class="hidden size-4 light:block" viewBox="0 0 16 16" fill="none"><path d="M13.5 9.8A5.8 5.8 0 0 1 6.2 2.5a5.8 5.8 0 1 0 7.3 7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
        </button>
    </div>

    <div class="h-[calc(100dvh-2.75rem)] overflow-x-auto">
        <x-dynamic-component :component="$component" />
    </div>

</body>
</html>
