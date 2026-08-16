@props([
    'slug',
    'files' => [],
    'components' => [],
    'description' => null,
])

@php
    $languages = [
        'blade' => ['label' => 'Blade', 'dir' => 'resources/views/components/templates/'.$slug.'/', 'ext' => '.blade.php'],
        'vue' => ['label' => 'Vue', 'dir' => 'resources/js/templates/'.$slug.'/', 'ext' => '.vue'],
        'react' => ['label' => 'React', 'dir' => 'resources/js/templates/'.$slug.'/', 'ext' => '.jsx'],
    ];

    $sources = [];

    foreach ($languages as $language => $meta) {
        foreach ($files as $file) {
            $basename = $language === 'blade' ? $file['slug'] : Illuminate\Support\Str::studly($file['slug']);
            $path = $meta['dir'].$basename.$meta['ext'];

            $sources[$language][] = [
                'name' => $file['name'],
                'path' => $path,
                'code' => trim(Illuminate\Support\Facades\File::get(base_path($path))),
            ];
        }
    }
@endphp

<section {{ $attributes }}>
    <h2 class="text-lg font-semibold tracking-tight text-cream">Installation</h2>
    <p class="mt-1 max-w-2xl text-sm/6 text-zinc-500">
        {{ $description ?? 'No package, no build step beyond Tailwind. Paste the files, install the catalog components below, and it runs.' }}
    </p>

    <div class="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900" data-code-tabs>
        <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
            @foreach ($languages as $language => $meta)
                <x-code-tab :panel="$language" :active="$loop->first">{{ $meta['label'] }}</x-code-tab>
            @endforeach
        </div>

        @foreach ($sources as $language => $entries)
            <div data-code-panel="{{ $language }}" @class(['hidden' => ! $loop->first])>
                @foreach ($entries as $entry)
                    <x-code-disclosure class="{{ $loop->first ? '' : 'border-t border-white/5' }}">
                        <x-slot:summary>
                            <span class="font-mono text-xs text-jade-400">{{ sprintf('%02d', $loop->iteration) }}</span>
                            <span class="w-28 shrink-0 truncate text-[13px] text-zinc-200">{{ $entry['name'] }}</span>
                            <span class="truncate font-mono text-[11px] text-zinc-600">Save as <span class="text-zinc-500">{{ $entry['path'] }}</span></span>
                            <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ substr_count($entry['code'], "\n") + 1 }} lines</span>
                        </x-slot>

                        <div class="max-h-[30rem] overflow-auto">
                            <x-code-block :code="$entry['code']" />
                        </div>
                    </x-code-disclosure>
                @endforeach
            </div>
        @endforeach
    </div>

    @if ($components !== [])
        <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
            <p class="font-mono text-xs text-zinc-500">Catalog components it leans on — each ships its own install page</p>
            <div class="mt-3 flex flex-wrap gap-1.5">
                @foreach ($components as $component)
                    <a href="{{ route('components.show', $component) }}"
                        class="rounded-full border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">{{ $component }}</a>
                @endforeach
            </div>
        </div>
    @endif
</section>
