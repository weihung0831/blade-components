@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/changelog/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/changelog/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/changelog/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $entryCode = <<<'BLADE'
    <x-templates.changelog.entry
        kind="changed"
        title="Freight is an object on the order, not a number"
        who="anyone reading orders off the API — about 340 shops"
        issue="#4392"
        breaking />

    {{-- the kind and the breaking flag sit on the row, so the filter bar reads them --}}
    <div data-entry data-kind="{{ $kind }}" data-breaking="{{ $breaking ? 'yes' : 'no' }}">
    BLADE;

    $entryVueCode = <<<'VUE'
    <ChangelogEntry v-for="entry in release.entries" :key="entry.title" v-bind="entry" />

    const shown = computed(() => months
        .map((month) => ({
            ...month,
            releases: month.releases
                .map((release) => ({ ...release, entries: release.entries.filter(keeps[picked.value]) }))
                .filter((release) => release.entries.length > 0),
        }))
        .filter((month) => month.releases.length > 0));
    VUE;

    $entryReactCode = <<<'REACT'
    {release.entries.map((entry) => <ChangelogEntry key={entry.title} {...entry} />)}

    const KEEPS = {
        'all-lines': () => true,
        breaking: (entry) => entry.breaking === true,
        broke: (entry) => entry.kind === 'broke',
    };
    REACT;

    $stampCode = <<<'BLADE'
    <x-templates.changelog.stamp
        version="4.1.3"
        date="4 Aug 2026"
        state="pulled"
        lived="up for four hours"
        note="The stock counter double-counted returns, so anything sent back read as two back on the shelf." />

    {{-- live, pulled, superseded, rolling — the middle one is the reason this block exists --}}
    BLADE;

    $stampVueCode = <<<'VUE'
    <ChangelogStamp
        :version="release.version"
        :date="`${release.date} 2026`"
        :state="release.state"
        :lines="release.entries.length"
        :lived="release.lived ?? null" />
    VUE;

    $stampReactCode = <<<'REACT'
    <ChangelogStamp
        version={release.version}
        date={`${release.date} 2026`}
        state={release.state}
        lines={release.entries.length}
        lived={release.lived ?? null} />
    REACT;

    $diffCode = <<<'BLADE'
    <x-templates.changelog.diff state="gone" text='  "shipping_rate": 120,' note="gone Feb 2027" />
    <x-templates.changelog.diff state="new" text='  "freight": {' />
    <x-templates.changelog.diff state="same" text="  \"total\": 1480" />
    BLADE;

    $diffVueCode = <<<'VUE'
    <ChangelogDiff v-for="(line, index) in before" :key="index" v-bind="line" />
    <ChangelogDiff v-for="(line, index) in after" :key="index" v-bind="line" />
    VUE;

    $diffReactCode = <<<'REACT'
    {BEFORE.map((line, index) => <ChangelogDiff key={index} {...line} />)}
    {AFTER.map((line, index) => <ChangelogDiff key={index} {...line} />)}
    REACT;

    $tellCode = <<<'BLADE'
    <x-templates.changelog.channel
        name="Webhook"
        handle="POST https://ops.kerouac.coffee/hooks/nomad"
        icon="hook"
        volume="only breaking, 9 last year"
        lag="the moment the first region gets it"
        on />

    <x-templates.changelog.promise
        thing="Freight zones you draw rather than list"
        announced="8 Feb 26"
        shipped="17 Aug 26"
        :slip="27"
        state="late"
        version="4.2.0" />
    BLADE;

    $tellVueCode = <<<'VUE'
    <ChangelogChannel v-for="channel in channels" :key="channel.handle" v-bind="channel" @toggle="toggle(channel)" />

    <ChangelogPromise v-for="promise in shown" :key="promise.thing" v-bind="promise" />
    VUE;

    $tellReactCode = <<<'REACT'
    {channels.map((channel) => <ChangelogChannel key={channel.handle} {...channel} onToggle={() => toggle(channel.handle)} />)}

    {shown.map((promise) => <ChangelogPromise key={promise.thing} {...promise} />)}
    REACT;
@endphp

<x-layout title="Changelog template — BLADE-COMPONENTS">
    <div class="mx-auto max-w-6xl px-6 py-16 pb-28">

        <a href="{{ route('templates') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Templates
        </a>

        <div class="rise mt-5 flex flex-wrap items-end justify-between gap-4" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Template</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $template['name'] }}</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    A release log written for the people on the other end of it. Every line names who would notice it, the
                    release we pulled after four hours stays in the list with the reason under it, and the last screen keeps
                    the half a changelog usually leaves out — what was announced and never shipped.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $template['pages']) }} screens</span>
        </div>

        <nav class="rise sticky top-14 z-30 -mx-6 mt-8 border-y border-white/5 bg-ink-950/85 px-6 py-2.5 backdrop-blur" style="animation-delay: 120ms">
            <ul class="flex flex-wrap items-center gap-1 text-sm">
                @foreach ($screens as $screen)
                    <li>
                        <a href="#{{ $screen['slug'] }}" data-spy-link
                            class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">{{ $screen['name'] }}</a>
                    </li>
                @endforeach
                <li class="ml-auto flex items-center gap-1">
                    <a href="#blocks" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Blocks</a>
                    <a href="#install" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Installation</a>
                </li>
            </ul>
        </nav>

        <section class="mt-10">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Screens</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The log, one release read end to end, the settings that decide how much of it reaches you, and the page where the roadmap is held against the releases.</p>

            <div class="mt-6 flex flex-col gap-10">
                @foreach ($screens as $screen)
                    <x-screen-preview
                        :id="$screen['slug']"
                        data-spy-section
                        class="scroll-mt-32"
                        :title="$screen['name']"
                        :description="$screen['description']"
                        :href="route('templates.screen', [$template['slug'], $screen['slug']])"
                        :panels="$sourcesFor($screen['slug'])">
                        <x-dynamic-component :component="'templates.'.$template['slug'].'.'.$screen['slug']" />
                    </x-screen-preview>
                @endforeach
            </div>
        </section>

        <section id="blocks" data-spy-section class="mt-16 scroll-mt-32">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Blocks</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Five parts, each carrying something a changelog usually leaves to the reader: who a line affects, whether the release survived, what the field looked like before, and how long the wait was.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="A line that says who would notice it" padding="p-8"
                    description="Five kinds, one of which is we broke it. That fifth tag is the whole argument — a log that can only say added, changed and fixed cannot tell you the thing it shipped was worse than what it replaced. The kind and the breaking flag live in data attributes on the row, so a filter bar is a query rather than a rebuild."
                    :code="$entryCode" :vue-code="$entryVueCode" :react-code="$entryReactCode">
                    <div class="w-full max-w-3xl divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.changelog.entry
                            kind="changed"
                            title="Freight is an object on the order, not a number"
                            note="order.shipping_rate becomes order.freight.rate, with the carrier, the zone and the surcharge beside it. The old field keeps answering until 1 February 2027 and then stops."
                            who="anyone reading orders off the API — about 340 shops"
                            issue="#4392"
                            breaking />

                        <x-templates.changelog.entry
                            kind="added"
                            title="Freight zones you draw rather than list"
                            who="shops that ship outside one city"
                            issue="#4188" />

                        <x-templates.changelog.entry
                            kind="broke"
                            title="Freight came out at zero for shops with a flat rate and no zones"
                            note="41 shops, 260 orders, all of them shipped free of charge for eleven hours. We paid the freight on those ourselves."
                            who="fixed the same evening in 4.2.1"
                            issue="INC-118" />

                        <x-templates.changelog.entry
                            kind="removed"
                            title="The per-item freight override"
                            who="eleven shops, each written to in June"
                            issue="#4390"
                            breaking />
                    </div>
                </x-demo>

                <x-demo title="A version stamp that can say the release came back off" padding="p-8"
                    description="Live, pulled, superseded, still rolling out. Most changelogs only have the first, which is why a bad release quietly disappears from them. The pulled state strikes the number through and keeps it in the list — the log becomes worth reading precisely because it can contain a mistake."
                    :code="$stampCode" :vue-code="$stampVueCode" :react-code="$stampReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-3">
                        <div class="rounded-xl border border-white/8 bg-ink-950 px-3.5 py-3">
                            <x-templates.changelog.stamp version="4.2.0" date="17 Aug 2026" state="live" :lines="5" />
                        </div>

                        <div class="rounded-xl border border-red-400/25 bg-red-400/4 px-3.5 py-3">
                            <x-templates.changelog.stamp
                                version="4.1.3"
                                date="4 Aug 2026"
                                state="pulled"
                                :lines="2"
                                lived="up for four hours"
                                note="Pulled at 14:20 the same afternoon. The stock counter double-counted returns, so anything sent back read as two back on the shelf." />
                        </div>

                        <div class="rounded-xl border border-white/8 bg-ink-950 px-3.5 py-3">
                            <x-templates.changelog.stamp version="4.1.4" date="11 Aug 2026" state="superseded" :lines="3" />
                        </div>
                    </div>
                </x-demo>

                <x-demo title="The field, before and after" padding="p-8"
                    description="Three states and a sign in the gutter. A breaking change explained in prose is an argument; the same change shown as eleven lines of response body is a job you can cost. The note on the right is where the deadline goes, next to the line it applies to rather than in a paragraph underneath."
                    :code="$diffCode" :vue-code="$diffVueCode" :react-code="$diffReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                        <div>
                            <p class="border-b border-white/5 px-3.5 py-2 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Until 4.1.4</p>
                            <div class="py-2">
                                <x-templates.changelog.diff text="{" />
                                <x-templates.changelog.diff state="gone" text='  "shipping_rate": 120,' note="gone Feb 2027" />
                                <x-templates.changelog.diff state="gone" text='  "shipping_carrier": "tcat",' />
                                <x-templates.changelog.diff text='  "total": 1480' />
                                <x-templates.changelog.diff text="}" />
                            </div>
                        </div>

                        <div>
                            <p class="border-b border-white/5 px-3.5 py-2 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">From 4.2.0</p>
                            <div class="py-2">
                                <x-templates.changelog.diff text="{" />
                                <x-templates.changelog.diff state="new" text='  "freight": {' />
                                <x-templates.changelog.diff state="new" text='    "rate": 120,' />
                                <x-templates.changelog.diff state="new" text='    "zone": "north-2",' note="new" />
                                <x-templates.changelog.diff state="new" text="  }," />
                                <x-templates.changelog.diff text="}" />
                            </div>
                        </div>
                    </div>
                </x-demo>

                <x-demo title="A channel that admits its own volume, and a promise with the wait drawn on it" padding="p-8"
                    description="The channel card carries how many notifications it sent last year and how quickly they arrive, so choosing one is a decision rather than a guess. The promise row puts the announcement date and the ship date at either end of a bar — the bar is the wait, and it is the only honest way to draw a roadmap after the fact."
                    :code="$tellCode" :vue-code="$tellVueCode" :react-code="$tellReactCode">
                    <div class="flex w-full max-w-3xl flex-col gap-5">
                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                            <x-templates.changelog.channel
                                name="Mail"
                                handle="ana@kerouac.coffee"
                                icon="mail"
                                note="One mail per release, written by whoever shipped it. The unsubscribe link is at the top rather than the bottom."
                                volume="9 last year"
                                lag="the morning after the last region"
                                on />

                            <x-templates.changelog.channel
                                name="Webhook"
                                handle="POST https://ops.kerouac.coffee/hooks/nomad"
                                icon="hook"
                                note="A signed POST with the release, the affected endpoints, and the deadline if there is one."
                                volume="only breaking, 9 last year"
                                lag="the moment the first region gets it" />
                        </div>

                        <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            <x-templates.changelog.promise
                                thing="Freight zones you draw rather than list"
                                announced="8 Feb 26"
                                shipped="17 Aug 26"
                                :slip="27"
                                state="late"
                                version="4.2.0"
                                note="Announced as spring. Two rewrites, and the second one is the reason the field changed shape." />

                            <x-templates.changelog.promise
                                thing="API keys shown once and then hashed"
                                announced="14 Jun 26"
                                shipped="14 Jul 26"
                                :slip="4"
                                version="4.1.0" />

                            <x-templates.changelog.promise
                                thing="Prices in more than one currency"
                                announced="Jan 26"
                                state="dropped"
                                note="Dropped in July after eleven weeks of work. Doing it properly means holding a rate at the moment of sale and again at the refund, and we could not make the refund side honest." />
                        </div>
                    </div>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[
                ['slug' => 'shell', 'name' => 'Log shell'],
                ['slug' => 'entry', 'name' => 'Change line'],
                ['slug' => 'stamp', 'name' => 'Version stamp'],
                ['slug' => 'diff', 'name' => 'Diff line'],
                ['slug' => 'channel', 'name' => 'Channel card'],
                ['slug' => 'promise', 'name' => 'Roadmap row'],
            ]"
            description="Each screen ships its own source under its preview. These six are what all four share. The shell carries the month rail and the release count, and every filter on these screens works off the data attributes the blocks already write, so nothing needs a second pass to be filterable."
            :components="['timeline', 'badge', 'chip', 'progress', 'switch', 'scroll-top']" />
    </div>
</x-layout>
