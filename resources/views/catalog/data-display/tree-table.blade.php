<x-layout title="Tree table — BLADE-COMPONENTS">
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
                    A table whose rows nest. Parent rows expand with native details, so columns stay aligned and the Blade version ships zero JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $storageRows = [
                ['cells' => ['resources', '1.2 MB'], 'open' => true, 'children' => [
                    ['cells' => ['views', '840 KB']],
                    ['cells' => ['css', '96 KB']],
                    ['cells' => ['js', '312 KB']],
                ]],
                ['cells' => ['app', '480 KB'], 'children' => [
                    ['cells' => ['Models', '210 KB']],
                    ['cells' => ['Http', '188 KB']],
                ]],
            ];

            $usageRows = [
                ['cells' => ['Acme Corp', '48', '92 GB'], 'open' => true, 'children' => [
                    ['cells' => ['Production', '12', '64 GB']],
                    ['cells' => ['Staging', '8', '21 GB']],
                    ['cells' => ['Preview', '28', '7 GB']],
                ]],
                ['cells' => ['Initech', '15', '18 GB'], 'children' => [
                    ['cells' => ['Production', '9', '14 GB']],
                    ['cells' => ['Staging', '6', '4 GB']],
                ]],
            ];

            $basicCode = <<<'BLADE'
            <x-ui.tree-table
                :columns="['Name', 'Size']"
                :rows="[
                    ['cells' => ['resources', '1.2 MB'], 'open' => true, 'children' => [
                        ['cells' => ['views', '840 KB']],
                        ['cells' => ['css', '96 KB']],
                    ]],
                    ['cells' => ['app', '480 KB'], 'children' => [
                        ['cells' => ['Models', '210 KB']],
                    ]],
                ]"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiTreeTable
                :columns="['Name', 'Size']"
                :rows="[
                    { cells: ['resources', '1.2 MB'], open: true, children: [
                        { cells: ['views', '840 KB'] },
                        { cells: ['css', '96 KB'] },
                    ] },
                    { cells: ['app', '480 KB'], children: [
                        { cells: ['Models', '210 KB'] },
                    ] },
                ]"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiTreeTable
                columns={['Name', 'Size']}
                rows={[
                    { cells: ['resources', '1.2 MB'], open: true, children: [
                        { cells: ['views', '840 KB'] },
                        { cells: ['css', '96 KB'] },
                    ] },
                    { cells: ['app', '480 KB'], children: [
                        { cells: ['Models', '210 KB'] },
                    ] },
                ]}
            />
            REACT;

            $usageCode = <<<'BLADE'
            <x-ui.tree-table
                :columns="['Workspace', 'Seats', 'Storage']"
                :rows="[
                    ['cells' => ['Acme Corp', '48', '92 GB'], 'open' => true, 'children' => [
                        ['cells' => ['Production', '12', '64 GB']],
                        ['cells' => ['Staging', '8', '21 GB']],
                    ]],
                ]"
            />
            BLADE;

            $usageVueCode = <<<'VUE'
            <UiTreeTable
                :columns="['Workspace', 'Seats', 'Storage']"
                :rows="[
                    { cells: ['Acme Corp', '48', '92 GB'], open: true, children: [
                        { cells: ['Production', '12', '64 GB'] },
                        { cells: ['Staging', '8', '21 GB'] },
                    ] },
                ]"
            />
            VUE;

            $usageReactCode = <<<'REACT'
            <UiTreeTable
                columns={['Workspace', 'Seats', 'Storage']}
                rows={[
                    { cells: ['Acme Corp', '48', '92 GB'], open: true, children: [
                        { cells: ['Production', '12', '64 GB'] },
                        { cells: ['Staging', '8', '21 GB'] },
                    ] },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Columns are plain labels; rows carry cells plus optional children. Click a parent row to fold its subtree."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.tree-table class="max-w-xs" :columns="['Name', 'Size']" :rows="$storageRows" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="More columns"
                description="Extra columns line up right-aligned, handy for per-workspace quota breakdowns."
                :code="$usageCode" :vue-code="$usageVueCode" :react-code="$usageReactCode">
                <x-ui.tree-table class="max-w-sm" :columns="['Workspace', 'Seats', 'Storage']" :rows="$usageRows" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="tree-table" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
