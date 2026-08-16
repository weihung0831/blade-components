<x-layout title="Tree select — BLADE-COMPONENTS">
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
                    A dropdown that unfolds a tree. Branches expand with native details, leaves select through hidden radios.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.tree-select
                name="path"
                placeholder="Pick a directory"
                value="resources / views"
                :expanded="['resources']"
                :options="[
                    'resources' => ['views', 'css', 'js'],
                    'app' => ['Models', 'Http', 'Support'],
                ]"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiTreeSelect
                v-model="path"
                placeholder="Pick a directory"
                :expanded="['resources']"
                :options="{
                    resources: ['views', 'css', 'js'],
                    app: ['Models', 'Http', 'Support'],
                }"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiTreeSelect
                placeholder="Pick a directory"
                expanded={['resources']}
                onChange={(path) => setPath(path)}
                options={{
                    resources: ['views', 'css', 'js'],
                    app: ['Models', 'Http', 'Support'],
                }}
            />
            REACT;

            $disabledCode = <<<'BLADE'
            <x-ui.tree-select disabled value="resources / views" :options="[…]" />
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiTreeSelect disabled placeholder="resources / views" options={…} />
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Chevrons expand branches in place. Picking a leaf stores the full path and closes the panel."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="flex h-72 w-64 items-start justify-center pt-2">
                    <x-ui.tree-select class="w-56" name="path" placeholder="Pick a directory"
                        value="resources / views" :expanded="['resources']" :options="[
                            'resources' => ['views', 'css', 'js'],
                            'app' => ['Models', 'Http', 'Support'],
                        ]" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Disabled"
                description="The disabled prop dims the control and drops pointer events."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <x-ui.tree-select class="w-56" disabled name="path-disabled" value="resources / views" :options="[
                    'resources' => ['views', 'css', 'js'],
                ]" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="tree-select" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
