<x-layout title="Pick list — BLADE-COMPONENTS">
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
                    Two columns, one decision. Click rows to mark them, then shuttle them across — the classic dual-list picker for plans and permissions.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.pick-list
                :available="['Tests', 'Docs', 'Previews']"
                :selected="['CI', 'Deploy']"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiPickList
                :available="['Tests', 'Docs', 'Previews']"
                :selected="['CI', 'Deploy']"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiPickList
                available={['Tests', 'Docs', 'Previews']}
                selected={['CI', 'Deploy']}
            />
            REACT;

            $labelledCode = <<<'BLADE'
            <x-ui.pick-list
                all
                available-label="Available"
                selected-label="Granted"
                :available="['Billing', 'Invite members', 'API tokens']"
                :selected="['View projects', 'Deploy']"
            />
            BLADE;

            $labelledVueCode = <<<'VUE'
            <UiPickList
                all
                available-label="Available"
                selected-label="Granted"
                :available="['Billing', 'Invite members', 'API tokens']"
                :selected="['View projects', 'Deploy']"
            />
            VUE;

            $labelledReactCode = <<<'REACT'
            <UiPickList
                all
                availableLabel="Available"
                selectedLabel="Granted"
                available={['Billing', 'Invite members', 'API tokens']}
                selected={['View projects', 'Deploy']}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Click a row to mark it, then use the chevrons to move everything marked to the other side."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.pick-list :available="['Tests', 'Docs', 'Previews']" :selected="['CI', 'Deploy']" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Labels and move-all"
                description="Column labels plus double-chevron controls that shuttle the whole list at once — built for granting role permissions."
                :code="$labelledCode" :vue-code="$labelledVueCode" :react-code="$labelledReactCode">
                <x-ui.pick-list all available-label="Available" selected-label="Granted"
                    :available="['Billing', 'Invite members', 'API tokens']" :selected="['View projects', 'Deploy']" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="pick-list" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
