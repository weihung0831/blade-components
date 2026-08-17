@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/terms/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/terms/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/terms/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $clauseCode = <<<'BLADE'
    <x-templates.terms.clause number="08" title="Burrs, and what wears out" bites
        gloss="Burrs go blunt. That is wear, not a fault, and the two years does not stretch to cover it.">
        <p>Burrs, the anti-static collar and the rubber feet are consumables.</p>
    </x-templates.terms.clause>

    {{-- the anchor is the number, so #clause-08 is a permalink somebody can quote at you --}}
    <section id="clause-{{ $number }}" data-changed="{{ $changed }}">
    BLADE;

    $clauseVueCode = <<<'VUE'
    <TermsClause v-for="clause in shown" :key="clause.number" v-bind="clause">
        <p v-for="(paragraph, index) in clause.body" :key="index">{{ paragraph }}</p>
    </TermsClause>

    const shown = computed(() => (changedOnly.value ? clauses.filter((clause) => clause.changed) : clauses));
    VUE;

    $clauseReactCode = <<<'REACT'
    {shown.map((clause) => (
        <TermsClause key={clause.number} {...clause}>
            {clause.body.map((paragraph) => <p key={paragraph}>{paragraph}</p>)}
        </TermsClause>
    ))}
    REACT;

    $gistCode = <<<'BLADE'
    <x-templates.terms.gist
        number="04"
        title="Delivery, customs, and risk"
        says="Shipped delivered-at-place: import duty and VAT are yours."
        means="On an NT$18,000 machine into the EU that is another NT$4,000 to NT$5,000."
        favours="us"
        bites />

    {{-- favours drives the two-cell marker and the data attribute the filter reads --}}
    <a data-gist data-favours="{{ $favours }}" @if ($bites) data-bites @endif>
    BLADE;

    $gistVueCode = <<<'VUE'
    <TermsGist v-for="gist in shown" :key="gist.number" v-bind="gist" />

    const shown = computed(() => gists.filter((gist) => picked.value === 'all' || gist.favours === picked.value));
    VUE;

    $gistReactCode = <<<'REACT'
    {shown.map((gist) => <TermsGist key={gist.number} {...gist} />)}

    const shown = GISTS.filter((gist) => picked === 'all' || gist.favours === picked);
    REACT;

    $diffCode = <<<'BLADE'
    <x-templates.terms.diff
        clause="08"
        title="Burrs, and what wears out"
        verdict="better for you"
        why="Fifty machines came back with burrs measured past 380 kg and still cutting inside spec."
        :lines="[
            ['mark' => ' ', 'text' => 'Burrs, the collar and the feet are consumables.'],
            ['mark' => '-', 'text' => 'Not covered beyond 300 kg through the machine.'],
            ['mark' => '+', 'text' => 'Not covered beyond 500 kg through the machine,'],
        ]" />

    {{-- the counts are derived from the marks, so they cannot drift from the body --}}
    BLADE;

    $diffVueCode = <<<'VUE'
    <TermsDiff v-for="diff in shown.diffs" :key="diff.clause" v-bind="diff" />

    const added = computed(() => props.lines.filter((line) => line.mark === '+').length);
    VUE;

    $diffReactCode = <<<'REACT'
    {shown.diffs.map((diff) => <TermsDiff key={diff.clause} {...diff} />)}

    const added = lines.filter((line) => line.mark === '+').length;
    REACT;

    $revisionCode = <<<'BLADE'
    <x-templates.terms.revision
        version="4.2" date="15 Sep 2026" state="pending"
        lead="A bigger burr allowance, a floor under the liability cap, and mediation before court."
        :touched="['06', '08', '12', '14']"
        :consent="false"
        active />

    {{-- three states: force, pending, retired. consent false prints "notice only" --}}
    BLADE;

    $revisionVueCode = <<<'VUE'
    <TermsRevision
        v-for="version in versions"
        :key="version.version"
        v-bind="version"
        :active="version.version === picked"
        @click="picked = version.version" />
    VUE;

    $revisionReactCode = <<<'REACT'
    {VERSIONS.map((version) => (
        <TermsRevision key={version.version} {...version}
            active={version.version === picked}
            onSelect={() => setPicked(version.version)} />
    ))}
    REACT;

    $noticeCode = <<<'BLADE'
    <x-templates.terms.notice
        version="4.2" effective="15 September 2026" announced="1 Aug 2026"
        :days="28" :window="45" :elapsed="17"
        promise="Every order you have already placed stays under 4.1 for good." />

    <x-templates.terms.stamp
        version="4.1" state="accepted" when="in force for you"
        :rows="$accepted" hash="8f2c41ab…" />

    {{-- the bar is the notice window, not a countdown: elapsed over window, marker at today --}}
    BLADE;

    $noticeVueCode = <<<'VUE'
    <TermsNotice v-if="!takenEarly" version="4.2" :days="28" :window="45" :elapsed="17">
        <template #actions><button @click="takenEarly = true">Take 4.2 now</button></template>
    </TermsNotice>

    <TermsStamp v-else version="4.2" state="accepted" :rows="early" />
    VUE;

    $noticeReactCode = <<<'REACT'
    {takenEarly
        ? <TermsStamp version="4.2" state="accepted" rows={EARLY} />
        : <TermsNotice version="4.2" days={28} window={45} elapsed={17}
            actions={<button onClick={() => setTakenEarly(true)}>Take 4.2 now</button>} />}
    REACT;

    $stampRows = [
        ['label' => 'When', 'value' => '12 March 2026, 09:41 Taipei time', 'mono' => true],
        ['label' => 'Who', 'value' => 'tomas@ferreira.pt', 'mono' => true],
        ['label' => 'How', 'value' => 'Ticked at checkout, not by continuing to browse.'],
    ];
@endphp

<x-layout title="Terms template — BLADE-COMPONENTS">
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
                    A legal page nobody reads is a design failure with a lawyer's name on it. This one marks the four clauses
                    written for the seller, keeps all seven versions since 2019 with the diff between them, and shows you the
                    copy you personally agreed to rather than the one in force today.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Four ways into the same document: read it, skim it with the bias marked, watch it change, or look up your own copy. The version history is a real diff rather than a line saying the terms have been updated.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Seven parts. Two of them exist only to admit something — which clause is written for the seller, and how long you have before the next version lands.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Clause, and the sentence under it" padding="p-8"
                    description="The numbered text is what binds; the line under it is what it means. Keeping both in one block stops the plain-English version drifting into a separate page that quietly says something else. The badges are the two things worth flagging: what the last version rewrote, and what people write in confused about."
                    :code="$clauseCode" :vue-code="$clauseVueCode" :react-code="$clauseReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-5">
                        <x-templates.terms.clause number="05" title="Changing your mind" changed="4.1"
                            gloss="Fourteen days, no reason needed. Grinding a kilo through it does not cost you the refund; taking the burr chamber apart does.">
                            <p>The Consumer Protection Act gives you seven days from delivery. We add seven of our own, so fourteen, and we do not ask why.</p>
                        </x-templates.terms.clause>

                        <x-templates.terms.clause number="08" title="Burrs, and what wears out" bites
                            gloss="Burrs go blunt. That is wear, not a fault, and the two years does not stretch to cover it.">
                            <p>Burrs, the anti-static collar and the rubber feet are consumables. The warranty in clause 06 does not cover them beyond 300 kg through the machine.</p>
                        </x-templates.terms.clause>
                    </div>
                </x-demo>

                <x-demo title="A line each, and who it is for" padding="p-8"
                    description="Fourteen rows, and a two-cell marker on each saying whether the clause gives you something or protects us. It is the one thing a summary usually leaves out, and it costs nothing to admit — the alternative is a reader who assumes all fourteen are traps."
                    :code="$gistCode" :vue-code="$gistVueCode" :react-code="$gistReactCode">
                    <div class="w-full max-w-2xl divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.terms.gist number="05" title="Changing your mind" says="Fourteen days from delivery, no reason asked." means="Seven from the Consumer Protection Act, seven we added." favours="you" />
                        <x-templates.terms.gist number="04" title="Delivery, customs, and risk" says="Shipped delivered-at-place: import duty and VAT are yours." means="Into the EU that is often another quarter on top of the price." favours="us" bites />
                        <x-templates.terms.gist number="09" title="Your account and the help centre" says="Optional. It holds orders and serials, and closes after three dormant years." favours="both" />
                    </div>
                </x-demo>

                <x-demo title="The diff, and the reason under it" padding="p-8"
                    description="Struck out, added, and then the part that matters: who asked for the change and what it cost. The counts in the header come off the marks rather than being typed in, so a diff cannot claim two additions and show three."
                    :code="$diffCode" :vue-code="$diffVueCode" :react-code="$diffReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-3">
                        <x-templates.terms.diff
                            clause="05"
                            title="Changing your mind"
                            verdict="better for you"
                            why="Wen-Yu in Kaohsiung wrote in and said seven days was the legal minimum dressed up as generosity. She was right, so it is fourteen."
                            :lines="[
                                ['mark' => '-', 'text' => 'You may return the machine within seven days of delivery.'],
                                ['mark' => '+', 'text' => 'You may return the machine within fourteen days of delivery,'],
                                ['mark' => '+', 'text' => 'and we do not ask why.'],
                            ]" />

                        <x-templates.terms.diff
                            clause="14"
                            title="Law, and where an argument goes"
                            verdict="about even"
                            why="Two disputes in seven years, both settled in an afternoon once somebody neutral was in the room."
                            :lines="[
                                ['mark' => ' ', 'text' => 'Taiwan law applies.'],
                                ['mark' => '+', 'text' => 'Before either side files anything we will sit down at the Taipei Bar'],
                                ['mark' => '+', 'text' => 'Association mediation service.'],
                            ]" />
                    </div>
                </x-demo>

                <x-demo title="Version list" padding="p-8"
                    description="Seven of these stack into the history rail. Each one says what it touched and whether it went out on notice or had to be signed for, which is the distinction that separates a change you were told about from one you agreed to."
                    :code="$revisionCode" :vue-code="$revisionVueCode" :react-code="$revisionReactCode">
                    <div class="flex w-full max-w-md flex-col gap-2.5">
                        <x-templates.terms.revision version="4.2" date="15 Sep 2026" state="pending"
                            lead="A bigger burr allowance, a floor under the liability cap, and mediation before anybody files anything."
                            :touched="['06', '08', '12', '14']" active />

                        <x-templates.terms.revision version="4.1" date="12 Mar 2026" state="force"
                            lead="Fourteen days to change your mind, and a warranty that follows the machine."
                            :touched="['05', '06', '12']" />

                        <x-templates.terms.revision version="3.0" date="20 Feb 2023" state="retired"
                            lead="Dealer supply moved out into its own signed agreement."
                            :touched="['02', '10']" consent />
                    </div>
                </x-demo>

                <x-demo title="The notice, and the receipt it leaves" padding="p-8"
                    description="One says what is coming and how much of the notice window has already gone; the other says what you took and when. Together they are the whole honest version of consent — a date you can plan around, and a record you can quote back at us."
                    :code="$noticeCode" :vue-code="$noticeVueCode" :react-code="$noticeReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-3">
                        <x-templates.terms.notice
                            version="4.2"
                            effective="15 September 2026"
                            announced="1 Aug 2026"
                            :days="28"
                            :window="45"
                            :elapsed="17"
                            lead="Four clauses. Three of them give you something and the fourth puts a mediator between us."
                            promise="Every order you have already placed stays under 4.1 for good." />

                        <x-templates.terms.stamp
                            version="4.1"
                            state="accepted"
                            when="in force for you"
                            :rows="$stampRows"
                            hash="8f2c41ab6e3d0917c2f4a58b7d1e6033b9c04af281e5d7620b3a9c1f4e8d5720"
                            note="This is the text as it stood that morning, not the text as it stands now." />
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
                ['slug' => 'shell', 'name' => 'Terms shell'],
                ['slug' => 'clause', 'name' => 'Clause'],
                ['slug' => 'gist', 'name' => 'Plain line'],
                ['slug' => 'diff', 'name' => 'Diff'],
                ['slug' => 'revision', 'name' => 'Version card'],
                ['slug' => 'notice', 'name' => 'Change notice'],
                ['slug' => 'stamp', 'name' => 'Acceptance record'],
            ]"
            description="Each screen ships its own source under its preview. These seven are what all four share. The filters and the version switch are a dozen lines of plain JavaScript in the Blade version, and refs in the other two."
            :components="['badge', 'checkbox', 'timeline', 'button', 'tabs']" />
    </div>
</x-layout>
