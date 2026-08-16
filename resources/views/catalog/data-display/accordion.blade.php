<x-layout title="Accordion — BLADE-COMPONENTS">
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
                    Collapsible rows built on native details and summary, with a grid-rows height animation. The Blade version ships zero JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.accordion class="w-96" :items="[
                ['title' => 'How do seats work?', 'content' => 'Every plan includes five seats. Extra seats are billed per member, prorated to your cycle.', 'open' => true],
                ['title' => 'Can I change plans mid-cycle?', 'content' => 'Yes. Upgrades apply immediately and we credit the unused portion of your current plan.'],
                ['title' => 'What happens when I hit my quota?', 'content' => 'Requests keep working. We email you at 80% and 100%, then apply overage pricing.'],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiAccordion class="w-96" :items="[
                { title: 'How do seats work?', content: 'Every plan includes five seats. Extra seats are billed per member, prorated to your cycle.', open: true },
                { title: 'Can I change plans mid-cycle?', content: 'Yes. Upgrades apply immediately and we credit the unused portion of your current plan.' },
                { title: 'What happens when I hit my quota?', content: 'Requests keep working. We email you at 80% and 100%, then apply overage pricing.' },
            ]" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiAccordion className="w-96" items={[
                { title: 'How do seats work?', content: 'Every plan includes five seats. Extra seats are billed per member, prorated to your cycle.', open: true },
                { title: 'Can I change plans mid-cycle?', content: 'Yes. Upgrades apply immediately and we credit the unused portion of your current plan.' },
                { title: 'What happens when I hit my quota?', content: 'Requests keep working. We email you at 80% and 100%, then apply overage pricing.' },
            ]} />
            REACT;

            $flushCode = <<<'BLADE'
            <x-ui.accordion variant="flush" class="w-96" :items="[
                ['title' => 'Rotate an API key', 'content' => 'Create the new key first, swap it into your app, then revoke the old one.'],
                ['title' => 'Restore a deleted project', 'content' => 'Deleted projects stay recoverable for 30 days on every paid plan.'],
            ]" />
            BLADE;

            $flushVueCode = <<<'VUE'
            <UiAccordion variant="flush" class="w-96" :items="[
                { title: 'Rotate an API key', content: 'Create the new key first, swap it into your app, then revoke the old one.' },
                { title: 'Restore a deleted project', content: 'Deleted projects stay recoverable for 30 days on every paid plan.' },
            ]" />
            VUE;

            $flushReactCode = <<<'REACT'
            <UiAccordion variant="flush" className="w-96" items={[
                { title: 'Rotate an API key', content: 'Create the new key first, swap it into your app, then revoke the old one.' },
                { title: 'Restore a deleted project', content: 'Deleted projects stay recoverable for 30 days on every paid plan.' },
            ]} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Items are plain arrays with a title, content, and an optional open flag. Each row is a real details element."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.accordion class="w-96" :items="[
                    ['title' => 'How do seats work?', 'content' => 'Every plan includes five seats. Extra seats are billed per member, prorated to your cycle.', 'open' => true],
                    ['title' => 'Can I change plans mid-cycle?', 'content' => 'Yes. Upgrades apply immediately and we credit the unused portion of your current plan.'],
                    ['title' => 'What happens when I hit my quota?', 'content' => 'Requests keep working. We email you at 80% and 100%, then apply overage pricing.'],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Flush"
                description="Drops the border and background, keeping only the dividers — for accordions inside an existing panel."
                :code="$flushCode" :vue-code="$flushVueCode" :react-code="$flushReactCode">
                <x-ui.accordion variant="flush" class="w-96" :items="[
                    ['title' => 'Rotate an API key', 'content' => 'Create the new key first, swap it into your app, then revoke the old one.'],
                    ['title' => 'Restore a deleted project', 'content' => 'Deleted projects stay recoverable for 30 days on every paid plan.'],
                ]" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="accordion" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
