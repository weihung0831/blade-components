<x-layout title="Chip — BLADE-COMPONENTS">
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
                    A compact token for tags and people. Optional avatar, optional remove button backed by a five-line listener.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.chip label="production" />
            <x-ui.chip label="v0.1.0" />
            <x-ui.chip label="eu-west-1" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiChip label="production" />
            <UiChip label="v0.1.0" />
            <UiChip label="eu-west-1" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiChip label="production" />
            <UiChip label="v0.1.0" />
            <UiChip label="eu-west-1" />
            REACT;

            $avatarCode = <<<'BLADE'
            <x-ui.chip avatar="WH" label="weihung" />
            <x-ui.chip avatar="AL" label="alina" />
            BLADE;

            $avatarVueCode = <<<'VUE'
            <UiChip avatar="WH" label="weihung" />
            <UiChip avatar="AL" label="alina" />
            VUE;

            $avatarReactCode = <<<'REACT'
            <UiChip avatar="WH" label="weihung" />
            <UiChip avatar="AL" label="alina" />
            REACT;

            $removableCode = <<<'BLADE'
            <x-ui.chip label="plan: pro" removable />
            <x-ui.chip label="region: eu-west-1" removable />
            <x-ui.chip avatar="KO" label="ko@acme.dev" removable />
            BLADE;

            $removableVueCode = <<<'VUE'
            <UiChip label="plan: pro" removable @remove="clearPlan" />
            <UiChip label="region: eu-west-1" removable @remove="clearRegion" />
            <UiChip avatar="KO" label="ko@acme.dev" removable @remove="uninvite" />
            VUE;

            $removableReactCode = <<<'REACT'
            <UiChip label="plan: pro" removable onRemove={clearPlan} />
            <UiChip label="region: eu-west-1" removable onRemove={clearRegion} />
            <UiChip avatar="KO" label="ko@acme.dev" removable onRemove={uninvite} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="A bordered pill on the raised ink surface. Good for environments, versions, and regions."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.chip label="production" />
                <x-ui.chip label="v0.1.0" />
                <x-ui.chip label="eu-west-1" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="With avatar"
                description="Pass avatar with two initials and the chip becomes a person — assignees, reviewers, invitees."
                :code="$avatarCode" :vue-code="$avatarVueCode" :react-code="$avatarReactCode">
                <x-ui.chip avatar="WH" label="weihung" />
                <x-ui.chip avatar="AL" label="alina" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Removable"
                description="removable adds a close button. In Blade a delegated listener pulls the chip out of the DOM — click one."
                :code="$removableCode" :vue-code="$removableVueCode" :react-code="$removableReactCode">
                <x-ui.chip label="plan: pro" removable />
                <x-ui.chip label="region: eu-west-1" removable />
                <x-ui.chip avatar="KO" label="ko@acme.dev" removable />
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="chip" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
