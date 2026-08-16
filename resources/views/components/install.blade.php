@props(['slug', 'vue' => false, 'react' => false])

@php
    $studlyName = Illuminate\Support\Str::studly($slug);
    $entry = App\Support\ComponentCatalog::find($slug);
    $categoryDir = Illuminate\Support\Str::slug($entry['category']);
    $jsDir = 'resources/js/components/ui/'.$categoryDir.'/';

    $sources = [
        'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/ui/'.$slug.'.blade.php'],
    ];

    if ($vue) {
        $sources['vue'] = ['label' => 'Vue', 'path' => $jsDir.$studlyName.'.vue'];
    }

    if ($react) {
        $sources['react'] = ['label' => 'React', 'path' => $jsDir.$studlyName.'.jsx'];
    }

    foreach ($sources as $language => $source) {
        $sources[$language]['code'] = trim(Illuminate\Support\Facades\File::get(base_path($source['path'])));
    }

    $tokensCode = <<<'CSS'
    @theme {
        --color-ink-950: #0b0b0e;
        --color-cream: #fefbee;

        --color-jade-300: #8ed3c6;
        --color-jade-400: #6abcae;
        --color-jade-500: #4ea396;
        --color-jade-600: #3a8478;

        --ease-snap: cubic-bezier(0.23, 1, 0.32, 1);
    }
    CSS;
@endphp

<section {{ $attributes }}>
    <h2 class="text-lg font-semibold tracking-tight text-cream">Installation</h2>
    <p class="mt-1 text-sm text-zinc-500">Two pastes and it runs. No package, no build step beyond Tailwind — the code below is the whole component.</p>

    <div class="mt-4 flex flex-col gap-4">
        <div class="overflow-hidden rounded-xl border border-white/8 bg-ink-900" @if (count($sources) > 1) data-code-tabs @endif>
            @if (count($sources) > 1)
                <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                    @foreach ($sources as $language => $source)
                        <x-code-tab :panel="$language" :active="$loop->first">{{ $source['label'] }}</x-code-tab>
                    @endforeach
                </div>
            @endif
            @foreach ($sources as $language => $source)
                <div @if (count($sources) > 1) data-code-panel="{{ $language }}" @endif @class(['hidden' => ! $loop->first])>
                    <x-code-disclosure>
                        <x-slot:summary>
                            <span class="font-mono text-xs text-jade-400">01</span>
                            <span class="truncate font-mono text-xs text-zinc-500">Save as <span class="text-zinc-300">{{ $source['path'] }}</span></span>
                            <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ substr_count($source['code'], "\n") + 1 }} lines</span>
                        </x-slot>

                        <x-code-block :code="$source['code']" />
                    </x-code-disclosure>
                </div>
            @endforeach
        </div>

        <div class="overflow-hidden rounded-xl border border-white/8 bg-ink-900">
            <x-code-disclosure>
                <x-slot:summary>
                    <span class="font-mono text-xs text-jade-400">02</span>
                    <span class="truncate font-mono text-xs text-zinc-500">Add these tokens to <span class="text-zinc-300">resources/css/app.css</span> — skip any you already have</span>
                </x-slot>

                <x-code-block :code="$tokensCode" lang="css" />
            </x-code-disclosure>
        </div>
    </div>
</section>
