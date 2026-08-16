<x-layout title="Progress — BLADE-COMPONENTS">
    <div class="mx-auto max-w-4xl px-6 py-16 pb-28">

        <a href="{{ route('components') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Components
        </a>

        <div class="rise mt-5 flex items-end justify-between" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">{{ $category }}</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $item['name'] }}</h1>
                <p class="mt-2 max-w-lg text-sm/6 text-zinc-500">
                    A slim bar for quotas, uploads, and anything else with a percentage. Give it a value, or set indeterminate when the backend will not say how long it needs.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.progress label="Seats used" :value="12" :max="20" class="w-80" />
            <x-ui.progress label="Storage" :value="66" size="sm" class="w-80" />
            <x-ui.progress label="Import" :value="100" size="lg" class="w-80" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiProgress label="Seats used" :value="12" :max="20" class="w-80" />
            <UiProgress label="Storage" :value="66" size="sm" class="w-80" />
            <UiProgress label="Import" :value="100" size="lg" class="w-80" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiProgress label="Seats used" value={12} max={20} className="w-80" />
            <UiProgress label="Storage" value={66} size="sm" className="w-80" />
            <UiProgress label="Import" value={100} size="lg" className="w-80" />
            REACT;

            $indeterminateCode = <<<'BLADE'
            <x-ui.progress label="Provisioning workspace" :indeterminate="true" class="w-80" />
            BLADE;

            $indeterminateVueCode = <<<'VUE'
            <UiProgress label="Provisioning workspace" indeterminate class="w-80" />
            VUE;

            $indeterminateReactCode = <<<'REACT'
            <UiProgress label="Provisioning workspace" indeterminate className="w-80" />
            REACT;

            $animateCode = <<<'BLADE'
            @foreach ($quotas as $quota)
                <x-ui.progress :label="$quota['label']" :value="$quota['value']"
                    animate :delay="$loop->index * 110" class="w-80" />
            @endforeach
            BLADE;

            $animateVueCode = <<<'VUE'
            <UiProgress v-for="(quota, index) in quotas" :key="quota.label"
                :label="quota.label" :value="quota.value" animate :delay="index * 110" class="w-80" />
            VUE;

            $animateReactCode = <<<'REACT'
            {quotas.map((quota, index) => (
                <UiProgress key={quota.label} label={quota.label} value={quota.value}
                    animate delay={index * 110} className="w-80" />
            ))}
            REACT;

            $quotas = [
                ['label' => 'API calls', 'value' => 70],
                ['label' => 'Asset storage', 'value' => 60],
                ['label' => 'Bandwidth', 'value' => 62],
                ['label' => 'Webhook events', 'value' => 94],
            ];
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Determinate"
                description="Value and max map to a percentage; the label row prints it in mono. Three track heights: sm, md, lg."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="flex flex-col gap-6">
                    <x-ui.progress label="Seats used" :value="12" :max="20" class="w-80" />
                    <x-ui.progress label="Storage" :value="66" size="sm" class="w-80" />
                    <x-ui.progress label="Import" :value="100" size="lg" class="w-80" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Indeterminate"
                description="A segment sweeps the track on loop. Use it when there is no honest percentage to show."
                :code="$indeterminateCode" :vue-code="$indeterminateVueCode" :react-code="$indeterminateReactCode">
                <x-ui.progress label="Provisioning workspace" :indeterminate="true" class="w-80" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Growing in"
                description="Set animate and the fill scales out from the left on first paint. Stagger a stack of them with delay, in milliseconds."
                :code="$animateCode" :vue-code="$animateVueCode" :react-code="$animateReactCode">
                <div class="flex w-80 flex-col gap-4">
                    @foreach ($quotas as $quota)
                        <x-ui.progress :label="$quota['label']" :value="$quota['value']" animate :delay="$loop->index * 110" />
                    @endforeach
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="progress" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
