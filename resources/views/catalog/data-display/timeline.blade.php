<x-layout title="Timeline — BLADE-COMPONENTS">
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
                    An events array becomes a connected line of dots. States cover done, current, and upcoming, and a compact variant squeezes the whole thing into an audit log.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.timeline
                :items="[
                    ['title' => 'Deployed to production', 'description' => 'Rolled out to 3 regions with zero downtime.', 'time' => '14:32', 'state' => 'done'],
                    ['title' => 'Tests passed', 'description' => '412 assertions across 96 files.', 'time' => '14:28', 'state' => 'done'],
                    ['title' => 'Building image', 'time' => '14:27', 'state' => 'current'],
                    ['title' => 'Awaiting approval', 'state' => 'upcoming'],
                ]"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            const pipeline = [
                { title: 'Deployed to production', description: 'Rolled out to 3 regions with zero downtime.', time: '14:32', state: 'done' },
                { title: 'Tests passed', description: '412 assertions across 96 files.', time: '14:28', state: 'done' },
                { title: 'Building image', time: '14:27', state: 'current' },
                { title: 'Awaiting approval', state: 'upcoming' },
            ];

            <UiTimeline :items="pipeline" />
            VUE;

            $basicReactCode = <<<'REACT'
            const pipeline = [
                { title: 'Deployed to production', description: 'Rolled out to 3 regions with zero downtime.', time: '14:32', state: 'done' },
                { title: 'Tests passed', description: '412 assertions across 96 files.', time: '14:28', state: 'done' },
                { title: 'Building image', time: '14:27', state: 'current' },
                { title: 'Awaiting approval', state: 'upcoming' },
            ];

            <UiTimeline items={pipeline} />
            REACT;

            $compactCode = <<<'BLADE'
            <x-ui.timeline
                variant="compact"
                :items="[
                    ['title' => 'ana@acme.dev invited joel@acme.dev', 'time' => 'Aug 14'],
                    ['title' => 'Plan upgraded to Team', 'time' => 'Aug 12'],
                    ['title' => 'API key rotated', 'time' => 'Aug 9'],
                    ['title' => 'Workspace created', 'time' => 'Aug 2'],
                ]"
            />
            BLADE;

            $compactVueCode = <<<'VUE'
            const audit = [
                { title: 'ana@acme.dev invited joel@acme.dev', time: 'Aug 14' },
                { title: 'Plan upgraded to Team', time: 'Aug 12' },
                { title: 'API key rotated', time: 'Aug 9' },
                { title: 'Workspace created', time: 'Aug 2' },
            ];

            <UiTimeline variant="compact" :items="audit" />
            VUE;

            $compactReactCode = <<<'REACT'
            const audit = [
                { title: 'ana@acme.dev invited joel@acme.dev', time: 'Aug 14' },
                { title: 'Plan upgraded to Team', time: 'Aug 12' },
                { title: 'API key rotated', time: 'Aug 9' },
                { title: 'Workspace created', time: 'Aug 2' },
            ];

            <UiTimeline variant="compact" items={audit} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Done steps get a filled check, the current one a jade ring, upcoming ones stay muted. Description and time are optional per item."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="w-full max-w-sm">
                    <x-ui.timeline
                        :items="[
                            ['title' => 'Deployed to production', 'description' => 'Rolled out to 3 regions with zero downtime.', 'time' => '14:32', 'state' => 'done'],
                            ['title' => 'Tests passed', 'description' => '412 assertions across 96 files.', 'time' => '14:28', 'state' => 'done'],
                            ['title' => 'Building image', 'time' => '14:27', 'state' => 'current'],
                            ['title' => 'Awaiting approval', 'state' => 'upcoming'],
                        ]"
                    />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Compact"
                description="The compact variant shrinks the dots and puts title and time on one line — built for audit logs and activity feeds."
                :code="$compactCode" :vue-code="$compactVueCode" :react-code="$compactReactCode">
                <div class="w-full max-w-sm">
                    <x-ui.timeline
                        variant="compact"
                        :items="[
                            ['title' => 'ana@acme.dev invited joel@acme.dev', 'time' => 'Aug 14'],
                            ['title' => 'Plan upgraded to Team', 'time' => 'Aug 12'],
                            ['title' => 'API key rotated', 'time' => 'Aug 9'],
                            ['title' => 'Workspace created', 'time' => 'Aug 2'],
                        ]"
                    />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="timeline" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
