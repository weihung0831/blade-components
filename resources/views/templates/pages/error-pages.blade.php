@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/error-pages/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/error-pages/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/error-pages/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $codeCode = <<<'BLADE'
    <x-templates.error-pages.code
        code="500"
        tone="fault"
        stamp="our fault, not yours"
        headline="Your order went in. The page that was meant to tell you so did not."
        sentence="Nothing was charged and nothing was lost."
        :lines="[
            ['label' => 'broke at', 'value' => '04:12:41 GMT+8, writing the order'],
            ['label' => 'incident', 'value' => 'INC-119, open for 6 minutes'],
            ['label' => 'your part', 'value' => 'nothing. Stay off the back button.'],
        ]" />
    BLADE;

    $codeVueCode = <<<'VUE'
    <ErrorCode
        code="500"
        tone="fault"
        stamp="our fault, not yours"
        headline="Your order went in. The page that was meant to tell you so did not."
        :lines="lines" />

    const tones = {
        quiet: { code: 'text-white/12', rule: 'bg-white/10', stamp: 'text-zinc-600' },
        fault: { code: 'text-red-400/25', rule: 'bg-red-400/40', stamp: 'text-red-400' },
    };
    VUE;

    $codeReactCode = <<<'REACT'
    <ErrorCode
        code="500"
        tone="fault"
        stamp="our fault, not yours"
        headline="Your order went in. The page that was meant to tell you so did not."
        lines={LINES} />

    const TONES = {
        quiet: { code: 'text-white/12', rule: 'bg-white/10', stamp: 'text-zinc-600' },
        fault: { code: 'text-red-400/25', rule: 'bg-red-400/40', stamp: 'text-red-400' },
    };
    REACT;

    $referenceCode = <<<'BLADE'
    <x-templates.error-pages.reference
        tone="fault"
        id="req_2c81f0d3"
        when="04:12:41 GMT+8, 18 August 2026"
        region="tpe-1"
        build="4.2.1 (deployed 15 Aug)"
        note="Worth pasting even if you think the problem is obvious." />

    {{-- the copy button hands over all four rows as one line, labelled --}}
    BLADE;

    $referenceVueCode = <<<'VUE'
    <ErrorReference id="req_2c81f0d3" when="04:12:41 GMT+8, 18 August 2026" region="tpe-1" build="4.2.1" tone="fault" />

    const copy = computed(() => rows.value.map((row) => `${row.label}: ${row.value}`).join('  '));
    VUE;

    $referenceReactCode = <<<'REACT'
    <ErrorReference id="req_2c81f0d3" when="04:12:41 GMT+8, 18 August 2026" region="tpe-1" build="4.2.1" tone="fault" />

    const copy = rows.map((row) => `${row.label}: ${row.value}`).join('  ');
    REACT;

    $wayCode = <<<'BLADE'
    <x-templates.error-pages.route
        tone="primary"
        label="Try the order again in a minute"
        note="It will pick up the same held order rather than starting a second one."
        meta="one order, not two"
        href="#" />

    <x-templates.error-pages.service
        name="Card payments"
        state="slow"
        means="Going through, taking 8 seconds instead of under one."
        since="6 min" />
    BLADE;

    $wayVueCode = <<<'VUE'
    <ErrorRoute v-for="way in ways" :key="way.label" v-bind="way" />

    <ErrorService v-for="service in services" :key="service.name" v-bind="service" />
    VUE;

    $wayReactCode = <<<'REACT'
    {WAYS.map((way) => <ErrorRoute key={way.label} {...way} />)}

    {SERVICES.map((service) => <ErrorService key={service.name} {...service} />)}
    REACT;

    $movedCode = <<<'BLADE'
    <x-templates.error-pages.moved
        address="/shop/grinders/nomad-hand-grinder-mk2"
        was="The Mk2 hand grinder, sold from March 2022 to November 2024"
        happened="Discontinued when the burr supplier stopped making the 38mm set."
        now="The Mk3, same body, burrs you can still buy in 2030"
        when="gone 14 Nov 2024"
        hits="1,284 asks since March"
        href="#" />
    BLADE;

    $movedVueCode = <<<'VUE'
    <ErrorMoved v-for="entry in shown" :key="entry.address" v-bind="entry" />

    const shown = computed(() => {
        const words = query.value.toLowerCase().split(/\s+/).filter(Boolean);

        return nearest.filter((entry) => words.every((word) => terms(entry).includes(word)));
    });
    VUE;

    $movedReactCode = <<<'REACT'
    {shown.map((entry) => <ErrorMoved key={entry.address} {...entry} />)}

    const words = query.toLowerCase().split(/\s+/).filter(Boolean);
    const shown = NEAREST.filter((entry) => words.every((word) => terms(entry).includes(word)));
    REACT;
@endphp

<x-layout title="Error pages template — BLADE-COMPONENTS">
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
                    Four dead ends, each one answering the question the person actually arrived with. Where the page went and
                    what it turned into. Whether the order survived the 500. Who holds the permission your seat does not.
                    And, on the maintenance screen, the nineteen minutes we are over the window we asked for.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">A missing page that knows what stood at the address, a 500 with the order number at the top of it, a 403 that names the person who can undo it, and a maintenance window running late in public.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Five parts. Between them they carry the four things an error page is usually missing: what the machine saw, what you can hand to a human, what still works, and where the thing you wanted actually went.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="The sign, with the machine's own account underneath it" padding="p-8"
                    description="A number, a sentence somebody wrote, and the three lines the support desk needs. The numeral is deliberately faint — it is the least useful thing on the page and it is the thing every error template makes biggest. Four tones, and the one that matters is the difference between our fault and yours."
                    :code="$codeCode" :vue-code="$codeVueCode" :react-code="$codeReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-8">
                        <x-templates.error-pages.code
                            code="500"
                            tone="fault"
                            stamp="our fault, not yours"
                            headline="Your order went in. The page that was meant to tell you so did not."
                            sentence="Nothing was charged, nothing was lost, and you do not need to do it again — the second time is how people end up with two grinders."
                            :lines="[
                                ['label' => 'broke at', 'value' => '04:12:41 GMT+8, writing the order'],
                                ['label' => 'incident', 'value' => 'INC-119, open for 6 minutes'],
                                ['label' => 'your part', 'value' => 'nothing. Stay off the back button.'],
                            ]" />

                        <x-templates.error-pages.code
                            code="403"
                            tone="held"
                            stamp="you are signed in, just not as this"
                            headline="Refunds sit with Ana. Your seat stops one step short of moving money back."
                            :lines="[
                                ['label' => 'it needs', 'value' => 'orders.refund — held by 2 of the 9 seats'],
                                ['label' => 'you have', 'value' => 'orders.read, orders.write, stock.write'],
                            ]" />
                    </div>
                </x-demo>

                <x-demo title="The thing you paste into the mail" padding="p-8"
                    description="Four rows and a button that hands over all of them labelled, so what lands in the desk's inbox is readable rather than a bare hex string. Every screen in this template carries one, including the 404 — the reference is what turns &quot;it did not work&quot; into a request somebody can answer in one go."
                    :code="$referenceCode" :vue-code="$referenceVueCode" :react-code="$referenceReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-3 sm:grid-cols-2">
                        <x-templates.error-pages.reference
                            tone="fault"
                            id="req_2c81f0d3"
                            when="04:12:41 GMT+8, 18 August 2026"
                            region="tpe-1"
                            build="4.2.1 (deployed 15 Aug)"
                            note="Ana can pull the exact request off that reference, including what your basket held." />

                        <x-templates.error-pages.reference
                            id="req_9f4c21a8"
                            when="04:19:02 GMT+8, 18 August 2026"
                            region="tpe-1" />
                    </div>
                </x-demo>

                <x-demo title="A way out, and a service that says what it means for you" padding="p-8"
                    description="The route row can be a link or a dead end — the dead one still says the page exists and who holds it, which is the whole reason the 403 screen is worth reading. The service row refuses to say &quot;degraded&quot;: it says the card takes eight seconds instead of one, which is a thing you can decide about."
                    :code="$wayCode" :vue-code="$wayVueCode" :react-code="$wayReactCode">
                    <div class="flex w-full max-w-3xl flex-col gap-5">
                        <div class="flex flex-col gap-2">
                            <x-templates.error-pages.route
                                tone="primary"
                                label="Try the order again in a minute"
                                note="It will pick up the same held order rather than starting a second one. Safe to press."
                                meta="one order, not two"
                                href="#" />

                            <x-templates.error-pages.route
                                label="Ring the desk"
                                note="02 2771 4180. It is 04:19 in Taipei, so this rings Wei on call rather than the shop."
                                meta="on call"
                                href="#" />

                            <x-templates.error-pages.route
                                tone="dead"
                                label="Refunds — issuing them"
                                note="Ana holds this one, along with payouts and the bank details."
                                meta="not yours" />
                        </div>

                        <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            <x-templates.error-pages.service name="Checkout" state="down" means="The last step. An order that was mid-payment when this started is the reason you are reading this page." since="6 min" />
                            <x-templates.error-pages.service name="Card payments" state="slow" means="Going through, taking 8 seconds instead of under one. Nothing has been charged twice." since="6 min" />
                            <x-templates.error-pages.service name="The shop" state="normal" means="Browsing, search and the basket are all fine. You can keep filling it." />
                            <x-templates.error-pages.service name="The admin" state="off" means="Off entirely. This is the part the work is being done on." since="79 min" />
                        </div>
                    </div>
                </x-demo>

                <x-demo title="An address that is gone, and what it turned into" padding="p-8"
                    description="The old URL struck through, what stood at it, why it went, and the thing that replaced it. Most of a shop's 404s are dead product pages, and the shop always knows what the product became — the row is just the site admitting it. The data attribute carries the words, so the search box on the screen is a filter rather than a round trip."
                    :code="$movedCode" :vue-code="$movedVueCode" :react-code="$movedReactCode">
                    <div class="w-full max-w-3xl divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.error-pages.moved
                            address="/shop/grinders/nomad-hand-grinder-mk2"
                            was="The Mk2 hand grinder, sold from March 2022 to November 2024"
                            happened="Discontinued when the burr supplier stopped making the 38mm set. We kept the page up for a year with a note on it, then the tidy-up in March took it down along with 40 others."
                            now="The Mk3, same body, burrs you can still buy in 2030"
                            when="gone 14 Nov 2024"
                            hits="1,284 asks since March"
                            href="#" />

                        <x-templates.error-pages.moved
                            address="/parts/mk2-burr-set"
                            was="Mk2 burr set, 38mm"
                            happened="Still sold, and will be until the last of the 900 sets goes. This is the page most people who land on the Mk2 are actually after."
                            now="NT$780, 312 sets left"
                            when="still here"
                            hits="410 asks since March"
                            href="#" />

                        <x-templates.error-pages.moved
                            address="/shop/grinders/nomad-electric"
                            was="The electric grinder we announced in 2023"
                            happened="Never shipped. The page went up two weeks before we admitted it was not going to work, and stayed up for four months after."
                            now="Why it was dropped, written out"
                            when="gone 2 Feb 2024"
                            href="#" />
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
                ['slug' => 'shell', 'name' => 'Error shell'],
                ['slug' => 'code', 'name' => 'The sign'],
                ['slug' => 'reference', 'name' => 'Support reference'],
                ['slug' => 'route', 'name' => 'Way out'],
                ['slug' => 'service', 'name' => 'Service row'],
                ['slug' => 'moved', 'name' => 'Moved address'],
            ]"
            description="These six are what all four screens share. The shell is the part worth taking whole: it keeps the reference in the footer of every screen and the status pill in the header, so an error page can never be a dead end that says nothing about the rest of the site."
            :components="['badge', 'chip', 'progress', 'timeline', 'search', 'switch', 'scroll-top']" />
    </div>
</x-layout>
