@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);
    $current = collect($screens)->firstWhere('slug', $screen);

    $devices = [
        ['slug' => 'mobile', 'label' => 'Mobile', 'width' => '390 px', 'icon' => 'M6 2.5h4A1.5 1.5 0 0 1 11.5 4v8A1.5 1.5 0 0 1 10 13.5H6A1.5 1.5 0 0 1 4.5 12V4A1.5 1.5 0 0 1 6 2.5ZM7 4.5h2'],
        ['slug' => 'tablet', 'label' => 'Tablet', 'width' => '834 px', 'icon' => 'M4 2.5h8A1.5 1.5 0 0 1 13.5 4v8a1.5 1.5 0 0 1-1.5 1.5H4A1.5 1.5 0 0 1 2.5 12V4A1.5 1.5 0 0 1 4 2.5ZM7 11.5h2'],
        ['slug' => 'desktop', 'label' => 'Desktop', 'width' => 'Full width', 'icon' => 'M2.5 4A1.5 1.5 0 0 1 4 2.5h8A1.5 1.5 0 0 1 13.5 4v5A1.5 1.5 0 0 1 12 10.5H4A1.5 1.5 0 0 1 2.5 9V4ZM6.5 13.5h3M8 10.5v3'],
    ];
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
<body class="bg-ink-900 font-sans text-zinc-300 antialiased selection:bg-jade-500/30 selection:text-cream">

    <div class="flex h-dvh flex-col has-[#device-mobile:checked]:[--frame:24.5rem] has-[#device-tablet:checked]:[--frame:52rem]">

        <div class="flex h-11 shrink-0 items-center gap-4 border-b border-white/5 bg-ink-950 px-4">
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

            <div class="ml-auto flex shrink-0 items-center gap-2">
                <div class="flex items-center gap-0.5 rounded-lg bg-ink-900 p-0.5">
                    @foreach ($devices as $device)
                        <label title="{{ $device['label'] }} · {{ $device['width'] }}"
                            class="grid size-7 cursor-pointer place-items-center rounded-md text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:bg-white/10 has-[:checked]:text-cream">
                            <input type="radio" name="device" id="device-{{ $device['slug'] }}" class="sr-only" @checked($device['slug'] === 'desktop')>
                            <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="{{ $device['icon'] }}" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="sr-only">{{ $device['label'] }}</span>
                        </label>
                    @endforeach
                </div>

                <script>
                    (() => {
                        const stored = localStorage.getItem('device');
                        const input = stored ? document.getElementById('device-' + stored) : null;

                        if (input) {
                            input.checked = true;
                        }

                        document.querySelectorAll('input[name="device"]').forEach((radio) => {
                            radio.addEventListener('change', () => localStorage.setItem('device', radio.id.slice(7)));
                        });
                    })();
                </script>

                <x-ui.separator vertical class="my-2" />

                <a href="{{ route('templates.screen', [$template['slug'], $screen]) }}?frame=1" target="_blank" rel="noopener"
                    title="Open without the frame"
                    class="grid size-7 place-items-center rounded-md text-zinc-500 transition-colors duration-150 hover:text-cream">
                    <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M6 2.5H3.5A1 1 0 0 0 2.5 3.5V6M10 2.5h2.5a1 1 0 0 1 1 1V6M6 13.5H3.5a1 1 0 0 1-1-1V10M10 13.5h2.5a1 1 0 0 0 1-1V10" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="sr-only">Open without the frame</span>
                </a>

                <button type="button" data-theme-toggle aria-label="Toggle color theme"
                    class="grid size-7 place-items-center rounded-md text-zinc-400 transition-[transform,color] duration-150 ease-snap hover:text-cream active:scale-[0.92]">
                    <svg class="size-4 light:hidden" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="3.25" stroke="currentColor" stroke-width="1.3"/><path d="M8 1.5v1.6M8 12.9v1.6M1.5 8h1.6M12.9 8h1.6M3.4 3.4l1.13 1.13M11.47 11.47l1.13 1.13M12.6 3.4l-1.13 1.13M4.53 11.47 3.4 12.6" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                    <svg class="hidden size-4 light:block" viewBox="0 0 16 16" fill="none"><path d="M13.5 9.8A5.8 5.8 0 0 1 6.2 2.5a5.8 5.8 0 1 0 7.3 7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </div>

        <div class="dot-grid flex min-h-0 flex-1 justify-center p-0 sm:p-5">
            <div class="h-full w-full max-w-[var(--frame,100%)] overflow-hidden border-white/10 bg-ink-950 transition-[max-width] duration-300 ease-snap sm:rounded-xl sm:border sm:shadow-xl sm:shadow-black/40">
                <iframe src="{{ route('templates.screen', [$template['slug'], $screen]) }}?frame=1"
                    title="{{ $current['name'] }} preview" class="size-full border-0"></iframe>
            </div>
        </div>
    </div>

</body>
</html>
