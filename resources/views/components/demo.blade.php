@props(['title', 'description' => null, 'code', 'vueCode' => null, 'reactCode' => null, 'padding' => 'p-10', 'collapsible' => true])

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
        <div class="dot-grid flex flex-wrap items-center justify-center gap-3 border-b border-white/5 {{ $padding }}">
            {{ $slot }}
        </div>

        @if ($collapsible)
            <x-code-disclosure :hint="implode(' · ', array_column($panels, 'label'))">
                <x-code-panels :panels="$panels" />
            </x-code-disclosure>
        @else
            <x-code-panels :panels="$panels" />
        @endif
    </div>
</section>
