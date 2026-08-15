@props(['slug', 'vue' => false])

@php
    $componentPath = 'resources/views/components/ui/'.$slug.'.blade.php';
    $componentSource = trim(Illuminate\Support\Facades\File::get(base_path($componentPath)));

    if ($vue) {
        $vuePath = 'resources/js/components/ui/'.Illuminate\Support\Str::studly($slug).'.vue';
        $vueSource = trim(Illuminate\Support\Facades\File::get(base_path($vuePath)));
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
        <div class="overflow-hidden rounded-xl border border-white/8 bg-ink-900" @if ($vue) data-code-tabs @endif>
            @if ($vue)
                <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                    <x-code-tab panel="blade" active>Blade</x-code-tab>
                    <x-code-tab panel="vue">Vue</x-code-tab>
                </div>
                <div data-code-panel="blade">
                    <div class="flex items-center gap-3 border-b border-white/5 px-4 py-2.5">
                        <span class="font-mono text-xs text-jade-400">01</span>
                        <p class="font-mono text-xs text-zinc-500">Save as <span class="text-zinc-300">{{ $componentPath }}</span></p>
                    </div>
                    <x-code-block :code="$componentSource" />
                </div>
                <div data-code-panel="vue" class="hidden">
                    <div class="flex items-center gap-3 border-b border-white/5 px-4 py-2.5">
                        <span class="font-mono text-xs text-jade-400">01</span>
                        <p class="font-mono text-xs text-zinc-500">Save as <span class="text-zinc-300">{{ $vuePath }}</span></p>
                    </div>
                    <x-code-block :code="$vueSource" />
                </div>
            @else
                <div class="flex items-center gap-3 border-b border-white/5 px-4 py-2.5">
                    <span class="font-mono text-xs text-jade-400">01</span>
                    <p class="font-mono text-xs text-zinc-500">Save as <span class="text-zinc-300">{{ $componentPath }}</span></p>
                </div>
                <x-code-block :code="$componentSource" />
            @endif
        </div>

        <div class="overflow-hidden rounded-xl border border-white/8 bg-ink-900">
            <div class="flex items-center gap-3 border-b border-white/5 px-4 py-2.5">
                <span class="font-mono text-xs text-jade-400">02</span>
                <p class="font-mono text-xs text-zinc-500">Add these tokens to <span class="text-zinc-300">resources/css/app.css</span> — skip any you already have</p>
            </div>
            <x-code-block :code="$tokensCode" lang="css" />
        </div>
    </div>
</section>
