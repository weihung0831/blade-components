<x-layout title="Stepper — BLADE-COMPONENTS">
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
                    Numbered progress through a flow. Steps behind the current one collapse into a check, connectors fill in as you advance, and the whole thing renders from a plain array.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.stepper :current="2" :steps="[
                ['label' => 'Account'],
                ['label' => 'Workspace'],
                ['label' => 'Invite team'],
                ['label' => 'Done'],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiStepper :current="2" :steps="[
                { label: 'Account' },
                { label: 'Workspace' },
                { label: 'Invite team' },
                { label: 'Done' },
            ]" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiStepper current={2} steps={[
                { label: 'Account' },
                { label: 'Workspace' },
                { label: 'Invite team' },
                { label: 'Done' },
            ]} />
            REACT;

            $verticalCode = <<<'BLADE'
            <x-ui.stepper orientation="vertical" :current="3" class="w-72" :steps="[
                ['label' => 'Provision workspace', 'description' => 'Database, storage bucket, and API keys created.'],
                ['label' => 'Point your DNS', 'description' => 'CNAME verified against app.acme.dev.'],
                ['label' => 'Go live', 'description' => 'Flip the switch once staging looks right.'],
            ]" />
            BLADE;

            $verticalVueCode = <<<'VUE'
            <UiStepper orientation="vertical" :current="3" class="w-72" :steps="[
                { label: 'Provision workspace', description: 'Database, storage bucket, and API keys created.' },
                { label: 'Point your DNS', description: 'CNAME verified against app.acme.dev.' },
                { label: 'Go live', description: 'Flip the switch once staging looks right.' },
            ]" />
            VUE;

            $verticalReactCode = <<<'REACT'
            <UiStepper orientation="vertical" current={3} className="w-72" steps={[
                { label: 'Provision workspace', description: 'Database, storage bucket, and API keys created.' },
                { label: 'Point your DNS', description: 'CNAME verified against app.acme.dev.' },
                { label: 'Go live', description: 'Flip the switch once staging looks right.' },
            ]} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Steps are an array of labels and current is one-based. Everything before it shows a check, everything after stays muted."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.stepper :current="2" :steps="[
                    ['label' => 'Account'],
                    ['label' => 'Workspace'],
                    ['label' => 'Invite team'],
                    ['label' => 'Done'],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Vertical"
                description="Stacks the steps and makes room for a description under each label — built for setup checklists and provisioning flows."
                :code="$verticalCode" :vue-code="$verticalVueCode" :react-code="$verticalReactCode">
                <x-ui.stepper orientation="vertical" :current="3" class="w-72" :steps="[
                    ['label' => 'Provision workspace', 'description' => 'Database, storage bucket, and API keys created.'],
                    ['label' => 'Point your DNS', 'description' => 'CNAME verified against app.acme.dev.'],
                    ['label' => 'Go live', 'description' => 'Flip the switch once staging looks right.'],
                ]" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="stepper" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
