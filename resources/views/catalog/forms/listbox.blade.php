<x-layout title="Listbox — BLADE-COMPONENTS">
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
                    An always-open option list built on hidden radio and checkbox inputs. Single or multiple selection, zero JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $singleCode = <<<'BLADE'
            <x-ui.listbox
                name="server"
                selected="Caddy"
                :options="['Nginx', 'Caddy', 'Apache', 'FrankenPHP']"
            />
            BLADE;

            $singleVueCode = <<<'VUE'
            <UiListbox
                v-model="server"
                :options="['Nginx', 'Caddy', 'Apache', 'FrankenPHP']"
            />
            VUE;

            $singleReactCode = <<<'REACT'
            <UiListbox
                defaultSelected="Caddy"
                onChange={(server) => setServer(server)}
                options={['Nginx', 'Caddy', 'Apache', 'FrankenPHP']}
            />
            REACT;

            $multipleCode = <<<'BLADE'
            <x-ui.listbox
                multiple
                name="regions"
                :selected="['ap-northeast-1', 'ap-southeast-1']"
                :options="['ap-northeast-1', 'ap-southeast-1', 'eu-west-1', 'us-east-1']"
            />
            BLADE;

            $multipleVueCode = <<<'VUE'
            <UiListbox
                multiple
                v-model="regions"
                :options="['ap-northeast-1', 'ap-southeast-1', 'eu-west-1', 'us-east-1']"
            />
            VUE;

            $multipleReactCode = <<<'REACT'
            <UiListbox
                multiple
                defaultSelected={['ap-northeast-1', 'ap-southeast-1']}
                onChange={(regions) => setRegions(regions)}
                options={['ap-northeast-1', 'ap-southeast-1', 'eu-west-1', 'us-east-1']}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Single"
                description="One hidden radio per row. The checked row gets the jade highlight and a checkmark."
                :code="$singleCode" :vue-code="$singleVueCode" :react-code="$singleReactCode">
                <x-ui.listbox class="w-48" name="server" selected="Caddy"
                    :options="['Nginx', 'Caddy', 'Apache', 'FrankenPHP']" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Multiple"
                description="The multiple prop swaps radios for checkboxes and submits an array."
                :code="$multipleCode" :vue-code="$multipleVueCode" :react-code="$multipleReactCode">
                <x-ui.listbox class="w-56" multiple name="regions" :selected="['ap-northeast-1', 'ap-southeast-1']"
                    :options="['ap-northeast-1', 'ap-southeast-1', 'eu-west-1', 'us-east-1']" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="listbox" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
