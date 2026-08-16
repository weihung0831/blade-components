<x-layout title="Bulk select — BLADE-COMPONENTS">
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
                    Row checkboxes, a select-all header that goes indeterminate, and an action bar that counts the selection. The Blade version runs on a few lines of delegated JS.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.bulk-select
                label="Name"
                :items="['invoice-001.pdf', 'invoice-002.pdf', 'report-aug.pdf', 'usage-jul.csv']"
                :selected="['invoice-001.pdf', 'invoice-002.pdf']"
                :actions="[
                    ['label' => 'Export'],
                    ['label' => 'Delete', 'danger' => true],
                ]"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            const selected = ref(['invoice-001.pdf', 'invoice-002.pdf']);

            <UiBulkSelect
                v-model="selected"
                label="Name"
                :items="['invoice-001.pdf', 'invoice-002.pdf', 'report-aug.pdf', 'usage-jul.csv']"
                :actions="[
                    { label: 'Export' },
                    { label: 'Delete', danger: true },
                ]"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiBulkSelect
                label="Name"
                items={['invoice-001.pdf', 'invoice-002.pdf', 'report-aug.pdf', 'usage-jul.csv']}
                defaultSelected={['invoice-001.pdf', 'invoice-002.pdf']}
                actions={[
                    { label: 'Export' },
                    { label: 'Delete', danger: true },
                ]}
            />
            REACT;

            $metaCode = <<<'BLADE'
            <x-ui.bulk-select
                label="Member"
                :items="[
                    ['label' => 'ana@acme.dev', 'meta' => 'Owner'],
                    ['label' => 'joel@acme.dev', 'meta' => 'Admin'],
                    ['label' => 'sam@acme.dev', 'meta' => 'Member'],
                    ['label' => 'rio@acme.dev', 'meta' => 'Member'],
                ]"
                :actions="[
                    ['label' => 'Change role'],
                    ['label' => 'Remove', 'danger' => true],
                ]"
            />
            BLADE;

            $metaVueCode = <<<'VUE'
            const members = [
                { label: 'ana@acme.dev', meta: 'Owner' },
                { label: 'joel@acme.dev', meta: 'Admin' },
                { label: 'sam@acme.dev', meta: 'Member' },
                { label: 'rio@acme.dev', meta: 'Member' },
            ];

            <UiBulkSelect
                v-model="selected"
                label="Member"
                :items="members"
                :actions="[
                    { label: 'Change role' },
                    { label: 'Remove', danger: true },
                ]"
            />
            VUE;

            $metaReactCode = <<<'REACT'
            const members = [
                { label: 'ana@acme.dev', meta: 'Owner' },
                { label: 'joel@acme.dev', meta: 'Admin' },
                { label: 'sam@acme.dev', meta: 'Member' },
                { label: 'rio@acme.dev', meta: 'Member' },
            ];

            <UiBulkSelect
                label="Member"
                items={members}
                actions={[
                    { label: 'Change role' },
                    { label: 'Remove', danger: true },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Check rows and the bar keeps count. The header checkbox selects everything, clears everything, and shows a dash in between."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="w-full max-w-sm">
                    <x-ui.bulk-select
                        label="Name"
                        :items="['invoice-001.pdf', 'invoice-002.pdf', 'report-aug.pdf', 'usage-jul.csv']"
                        :selected="['invoice-001.pdf', 'invoice-002.pdf']"
                        :actions="[
                            ['label' => 'Export'],
                            ['label' => 'Delete', 'danger' => true],
                        ]"
                    />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="With meta"
                description="Items can be arrays with a meta field for a muted right-hand column. Nothing preselected, so the action bar stays hidden until the first check."
                :code="$metaCode" :vue-code="$metaVueCode" :react-code="$metaReactCode">
                <div class="w-full max-w-sm">
                    <x-ui.bulk-select
                        label="Member"
                        :items="[
                            ['label' => 'ana@acme.dev', 'meta' => 'Owner'],
                            ['label' => 'joel@acme.dev', 'meta' => 'Admin'],
                            ['label' => 'sam@acme.dev', 'meta' => 'Member'],
                            ['label' => 'rio@acme.dev', 'meta' => 'Member'],
                        ]"
                        :actions="[
                            ['label' => 'Change role'],
                            ['label' => 'Remove', 'danger' => true],
                        ]"
                    />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="bulk-select" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
