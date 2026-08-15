@props(['title', 'description' => null, 'code', 'vueCode' => null, 'reactCode' => null])

@php
    $panels = ['blade' => ['label' => 'Blade', 'code' => $code]];

    if ($vueCode !== null && $vueCode === $reactCode) {
        $panels['vue react'] = ['label' => 'Vue / React', 'code' => $vueCode];
    } else {
        if ($vueCode !== null) {
            $panels['vue'] = ['label' => 'Vue', 'code' => $vueCode];
        }

        if ($reactCode !== null) {
            $panels['react'] = ['label' => 'React', 'code' => $reactCode];
        }
    }
@endphp

<section {{ $attributes }}>
    <h2 class="text-lg font-semibold tracking-tight text-cream">{{ $title }}</h2>
    @if ($description)
        <p class="mt-1 text-sm text-zinc-500">{{ $description }}</p>
    @endif

    <div class="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900" @if (count($panels) > 1) data-code-tabs @endif>
        <div class="dot-grid flex flex-wrap items-center justify-center gap-3 border-b border-white/5 p-10">
            {{ $slot }}
        </div>
        @if (count($panels) > 1)
            <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                @foreach ($panels as $language => $panel)
                    <x-code-tab :panel="$language" :active="$loop->first">{{ $panel['label'] }}</x-code-tab>
                @endforeach
            </div>
            @foreach ($panels as $language => $panel)
                <div data-code-panel="{{ $language }}" @class(['hidden' => ! $loop->first])><x-code-block :code="$panel['code']" /></div>
            @endforeach
        @else
            <x-code-block :code="$code" />
        @endif
    </div>
</section>
