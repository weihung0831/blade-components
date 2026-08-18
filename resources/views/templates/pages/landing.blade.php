@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/landing/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/landing/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/landing/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $heroCode = <<<'BLADE'
    <x-templates.landing.hero
        eyebrow="one machine, made since 2019"
        headline="A hand grinder we have only changed twice, because the parts have to outlive the sales page."
        sentence="The Mk3 grinds 25 g of filter in about ninety seconds and weighs 620 g."
        price="NT$4,200"
        price-note="incl. tax, ships from Taipei"
        action="Join batch 41"
        second="Read the measurements first"
        action-note="46 of 180 unspoken for"
        :facts="[
            ['label' => 'out there', 'value' => '6,142', 'note' => 'since March 2019'],
            ['label' => 'came back', 'value' => '214', 'note' => '3.5%, every reason listed'],
        ]">

        {{-- the slot is the right-hand column: a drawing, a photo, a spec table --}}
    </x-templates.landing.hero>
    BLADE;

    $heroVueCode = <<<'VUE'
    <LandingHero
        eyebrow="one machine, made since 2019"
        headline="A hand grinder we have only changed twice, because the parts have to outlive the sales page."
        price="NT$4,200"
        action="Join batch 41"
        :facts="facts">

        <div class="rounded-2xl border border-white/8 bg-ink-900/70 p-4">…</div>
    </LandingHero>
    VUE;

    $heroReactCode = <<<'REACT'
    <LandingHero
        eyebrow="one machine, made since 2019"
        headline="A hand grinder we have only changed twice, because the parts have to outlive the sales page."
        price="NT$4,200"
        action="Join batch 41"
        facts={FACTS}>

        <div className="rounded-2xl border border-white/8 bg-ink-900/70 p-4">…</div>
    </LandingHero>
    REACT;

    $featureCode = <<<'BLADE'
    <x-templates.landing.feature
        mark="38 mm"
        tone="primary"
        title="Burrs that three companies still make"
        body="The Mk2 died because one supplier stopped making its burr set."
        meta="stocked to 2030, NT$780 a set" />

    {{-- tone="caveat" is the one that admits a fault, and it is the card people read --}}
    BLADE;

    $featureVueCode = <<<'VUE'
    <LandingFeature v-for="feature in features" :key="feature.title" v-bind="feature" />

    const tones = {
        quiet: { card: 'border-white/8 bg-ink-950', mark: 'text-zinc-600 border-white/10' },
        primary: { card: 'border-jade-500/30 bg-jade-500/5', mark: 'text-jade-300 border-jade-500/40' },
        caveat: { card: 'border-amber-400/25 bg-amber-400/4', mark: 'text-amber-300 border-amber-400/40' },
    };
    VUE;

    $featureReactCode = <<<'REACT'
    {FEATURES.map((feature) => <LandingFeature key={feature.title} {...feature} />)}

    const TONES = {
        quiet: { card: 'border-white/8 bg-ink-950', mark: 'text-zinc-600 border-white/10' },
        primary: { card: 'border-jade-500/30 bg-jade-500/5', mark: 'text-jade-300 border-jade-500/40' },
        caveat: { card: 'border-amber-400/25 bg-amber-400/4', mark: 'text-amber-300 border-amber-400/40' },
    };
    REACT;

    $barCode = <<<'BLADE'
    <x-templates.landing.bar
        label="The Mk3, this one"
        :value="62"
        :max="71"
        display="62%"
        tone="ours"
        note="Nine points behind the electric, at a third of the price." />

    {{-- one scale for the whole group, so a losing row looks like a losing row --}}
    BLADE;

    $barVueCode = <<<'VUE'
    <LandingBar v-for="row in set.rows" :key="row.label" v-bind="row" :max="ceiling" />

    const ceiling = computed(() => Math.max(...set.value.rows.map((row) => row.value)));
    VUE;

    $barReactCode = <<<'REACT'
    {set.rows.map((row) => <LandingBar key={row.label} {...row} max={ceiling} />)}

    const ceiling = Math.max(...set.rows.map((row) => row.value));
    REACT;

    $objectionCode = <<<'BLADE'
    <x-templates.landing.objection
        who="You pull espresso every morning"
        body="Ninety seconds of cranking at a fine setting is work, and you will do it before you are properly awake."
        instead="The NT$12,000 electric we lose to"
        instead-price="named on the measurements page"
        tone="hard"
        href="#" />

    {{-- tone: hard buys elsewhere, soft has second thoughts, fine is the one sale this page makes --}}
    BLADE;

    $objectionVueCode = <<<'VUE'
    <LandingObjection v-for="objection in sorted" :key="objection.who" v-bind="objection" href="#" />

    const sorted = computed(() => [...objections].sort((a, b) => b[sort.value] - a[sort.value]));
    VUE;

    $objectionReactCode = <<<'REACT'
    {sorted.map((objection) => <LandingObjection key={objection.who} {...objection} href="#" />)}

    const sorted = [...OBJECTIONS].sort((a, b) => b[sort] - a[sort]);
    REACT;

    $quoteCode = <<<'BLADE'
    <x-templates.landing.quote
        body="The honest bit sold it. Every other shop told me their grinder was perfect and this one told me the collar comes loose."
        name="Anders Holm"
        role="Grinds for one, badly, most mornings"
        machine="Mk3 graphite"
        since="since Nov 2024" />
    BLADE;

    $quoteVueCode = <<<'VUE'
    <LandingQuote v-for="quote in quotes" :key="quote.name" v-bind="quote" />

    const initials = computed(() => props.name.split(' ').slice(0, 2).map((part) => part.charAt(0)).join(''));
    VUE;

    $quoteReactCode = <<<'REACT'
    {QUOTES.map((quote) => <LandingQuote key={quote.name} {...quote} />)}

    const initials = name.split(' ').slice(0, 2).map((part) => part.charAt(0)).join('');
    REACT;
@endphp

<x-layout title="Landing template — BLADE-COMPONENTS">
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
                    A shop front for one product, built on the assumption that the reader has been lied to by four other
                    grinder pages this morning. The pitch leads with a price and a weight, the second screen shows the test
                    the machine loses, the third names the people who should buy a competitor, and the fourth admits the
                    last batch shipped eleven weeks late.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">A pitch that costs the machine out over ten years, a measurements page where the competitor wins by nine points, a page of reasons to buy elsewhere, and a waiting list that publishes its own late deliveries.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Six parts, and between them they cover the four moves a landing page has: say what it is, show a number, hand the reader an argument against buying, and let somebody else do the talking.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="The hero, with the facts under the fold line rather than over it" padding="p-8"
                    description="Eyebrow, headline, one paragraph, the price sitting on the same line as the button, and four measured facts along the bottom. The facts are the part worth stealing — a hero that ends in numbers is much harder to write badly than one that ends in a promise."
                    :code="$heroCode" :vue-code="$heroVueCode" :react-code="$heroReactCode">
                    <div class="w-full max-w-3xl">
                        <x-templates.landing.hero
                            eyebrow="one machine, made since 2019"
                            headline="A hand grinder we have only changed twice, because the parts have to outlive the sales page."
                            sentence="The Mk3 grinds 25 g of filter in about ninety seconds, weighs 620 g, and every part that wears is on the shelf at a price printed next to it."
                            price="NT$4,200"
                            price-note="incl. tax, ships from Taipei"
                            action="Join batch 41"
                            second="Read the measurements first"
                            action-note="46 of 180 unspoken for · nothing charged until the batch is cut"
                            :facts="[
                                ['label' => 'out there', 'value' => '6,142', 'note' => 'since March 2019'],
                                ['label' => 'came back', 'value' => '214', 'note' => '3.5%, every reason listed'],
                                ['label' => 'burr supply', 'value' => 'to 2030', 'note' => 'three makers, 38 mm'],
                                ['label' => 'per batch', 'value' => '180', 'note' => 'four people, six weeks'],
                            ]" />
                    </div>
                </x-demo>

                <x-demo title="Feature cards, one of which is a confession" padding="p-8"
                    description="A short mark, a title, a sentence of body, and a line of provenance under a rule. Three tones: quiet for the ordinary claim, primary for the one thing worth leading on, and caveat for the fault you would rather people read here than find in a forum thread."
                    :code="$featureCode" :vue-code="$featureVueCode" :react-code="$featureReactCode">
                    <div class="grid w-full max-w-4xl grid-cols-1 gap-3 sm:grid-cols-3">
                        <x-templates.landing.feature
                            mark="38 mm"
                            tone="primary"
                            title="Burrs that three companies still make"
                            body="The Mk2 died because one supplier stopped making its burr set. The Mk3 takes a size three of them make."
                            meta="stocked to 2030, NT$780 a set" />

                        <x-templates.landing.feature
                            mark="620 g"
                            title="Heavy enough to sit still, light enough to pack"
                            body="Steel shaft, aluminium body. It does not walk across the counter while you crank."
                            meta="142 mm tall with the crank off" />

                        <x-templates.landing.feature
                            mark="2 min"
                            tone="caveat"
                            title="The collar works loose. You fix it yourself."
                            body="On roughly one machine in nine, the crank collar backs off within the first year."
                            meta="681 of 6,142 have reported it" />
                    </div>
                </x-demo>

                <x-demo title="A bar that has to share its scale" padding="p-8"
                    description="Label, figure, track, and a line of prose underneath explaining what the figure means. Every bar in a group takes the same max, which is the whole trick: the row where a competitor beats us is visibly longer, and no amount of copy underneath can undo that."
                    :code="$barCode" :vue-code="$barVueCode" :react-code="$barReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-5">
                        <x-templates.landing.bar
                            label="The NT$12,000 electric"
                            :value="71" :max="71" display="71%"
                            note="Flat burrs and a motor that never slows down. This is what the money buys." />

                        <x-templates.landing.bar
                            label="The Mk3, this one"
                            :value="62" :max="71" display="62%" tone="ours"
                            note="Nine points behind, at a third of the price." />

                        <x-templates.landing.bar
                            label="The Mk2, discontinued 2024"
                            :value="58" :max="71" display="58%" tone="warn"
                            note="Same body, older burr geometry. Still on 6,000 counters." />

                        <x-templates.landing.bar
                            label="The NT$1,450 aluminium one"
                            :value="38" :max="71" display="38%" tone="bad"
                            note="A third of it comes out as dust or gravel, brand new." />
                    </div>
                </x-demo>

                <x-demo title="The row that sends the reader somewhere else" padding="p-8"
                    description="Who it is wrong for on the left, where they should go on the right, and a dot whose colour says how firmly we mean it. Six of these are the objections screen, and the last one — the green dot — is the only place on that page where anything is sold."
                    :code="$objectionCode" :vue-code="$objectionVueCode" :react-code="$objectionReactCode">
                    <div class="w-full max-w-3xl divide-y divide-white/5 overflow-hidden rounded-2xl border border-white/8 bg-ink-950">
                        <x-templates.landing.objection
                            who="You pull espresso every morning"
                            body="Ninety seconds of cranking at a fine setting is work, and you will do it before you are properly awake."
                            instead="The NT$12,000 electric we lose to"
                            instead-price="named on the measurements page"
                            tone="hard"
                            href="#" />

                        <x-templates.landing.objection
                            who="You are buying it as a present for someone who does not make coffee yet"
                            body="It arrives, it is beautiful, and it sits in a cupboard. We have watched this happen 31 times."
                            instead="Beans and a NT$450 dripper first"
                            instead-price="come back in a year if it took"
                            tone="soft"
                            href="#" />

                        <x-templates.landing.objection
                            who="You grind one filter cup a day and would rather not hear a motor at six in the morning"
                            body="Then this is the machine, and the rest of the page is us trying to talk you out of a purchase you should probably make."
                            instead="The Mk3, batch 41"
                            instead-price="NT$4,200, 46 places left"
                            tone="fine"
                            href="#" />
                    </div>
                </x-demo>

                <x-demo title="Somebody else talking, with their machine and their date attached" padding="p-8"
                    description="Initials rather than a stock headshot, the role written as a sentence about how they drink coffee, and — the part that does the work — which machine they own and how long they have had it. A testimonial with a date on it reads differently from one without."
                    :code="$quoteCode" :vue-code="$quoteVueCode" :react-code="$quoteReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-3 sm:grid-cols-2">
                        <x-templates.landing.quote
                            body="I bought it because the burr page listed the suppliers by name. Four years on I have replaced the burrs once and the collar twice, and both times the part was in stock the same afternoon."
                            name="Lin Wei-chen"
                            role="Ships two bags a week from a stall in Yonghe"
                            machine="Mk2, then Mk3"
                            since="since Mar 2021" />

                        <x-templates.landing.quote
                            body="The honest bit sold it. Every other shop told me their grinder was perfect and this one told me the collar comes loose. Mine did, in week six, and the video was already on the site."
                            name="Anders Holm"
                            role="Grinds for one, badly, most mornings"
                            machine="Mk3 graphite"
                            since="since Nov 2024" />
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
                ['slug' => 'shell', 'name' => 'Landing shell'],
                ['slug' => 'hero', 'name' => 'Hero'],
                ['slug' => 'feature', 'name' => 'Feature card'],
                ['slug' => 'bar', 'name' => 'Measured bar'],
                ['slug' => 'objection', 'name' => 'Objection row'],
                ['slug' => 'quote', 'name' => 'Quote'],
                ['slug' => 'pitch', 'name' => 'The pitch'],
                ['slug' => 'proof', 'name' => 'The measurements'],
                ['slug' => 'objections', 'name' => 'Not for you'],
                ['slug' => 'batch', 'name' => 'The next batch'],
            ]"
            description="The shell is the part to take whole: it carries the announcement bar, the four-way nav, the batch counter in the header and the footer that repeats the promise about measured numbers. Everything else is a small component that expects real figures rather than adjectives."
            :components="['badge', 'button', 'chip', 'progress', 'timeline', 'tabs', 'scroll-top']" />
    </div>
</x-layout>
