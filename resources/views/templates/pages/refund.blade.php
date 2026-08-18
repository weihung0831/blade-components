@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/refund/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/refund/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/refund/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $ruleCode = <<<'BLADE'
    <x-templates.refund.rule
        reason="It has ground more than a kilo"
        window="within 30 days"
        condition="Still comes back. Burrs that have been through more than a kilo cannot be sold as new."
        freight="you"
        back="part"
        note="$40 comes off, which is what the burr set costs us." />

    {{-- back and freight are the two attributes the filter bar reads --}}
    <div data-rule data-back="{{ $back }}" data-freight="{{ $freight }}">
    BLADE;

    $ruleVueCode = <<<'VUE'
    <RefundRule v-for="rule in shown" :key="rule.reason" v-bind="rule" />

    const shown = computed(() => rules.filter((rule) => picked.value === 'all-rules' || rule.back === picked.value));
    VUE;

    $ruleReactCode = <<<'REACT'
    {shown.map((rule) => <RefundRule key={rule.reason} {...rule} />)}

    const shown = RULES.filter((rule) => picked === 'all-rules' || rule.back === picked);
    REACT;

    $windowCode = <<<'BLADE'
    <x-templates.refund.window
        label="Changed your mind"
        :span="30"
        unit="days"
        :used="23"
        then="after that it is the warranty or nothing" />

    {{-- closed swaps jade for amber and prints "shut" instead of the days left --}}
    <x-templates.refund.window label="Parts on the shelf" :span="10" unit="years" :used="0" then="burrs, boards, knobs" closed />
    BLADE;

    $windowVueCode = <<<'VUE'
    <RefundWindow label="Changed your mind" :span="30" unit="days" :used="23" then="after that it is the warranty" />

    const left = computed(() => Math.max(0, props.span - props.used));
    VUE;

    $windowReactCode = <<<'REACT'
    <RefundWindow label="Stopped working" span={24} unit="months" used={1} then="repair, repair, then your money" />

    const ratio = span > 0 ? Math.min(100, (used / span) * 100) : 0;
    REACT;

    $reasonCode = <<<'BLADE'
    <x-templates.refund.reason
        key="mind"
        label="I have changed my mind"
        lead="Boxed, under a kilo of coffee through it, inside thirty days."
        freight="You book it, $18 off the refund"
        back="$1,180 back"
        days="6 days"
        :data-box="$box"
        picked />

    {{-- one listener reads the data attributes off whichever button was clicked --}}
    freight.textContent = option.dataset.freight;
    BLADE;

    $reasonVueCode = <<<'VUE'
    <RefundReason v-for="reason in reasons" :key="reason.key" v-bind="reason"
        :picked="reason.key === picked" @pick="picked = reason.key" />

    const chosen = computed(() => reasons.find((reason) => reason.key === picked.value) ?? reasons[0]);
    VUE;

    $reasonReactCode = <<<'REACT'
    <RefundReason {...reason} picked={reason.key === picked} onPick={() => setPicked(reason.key)} />

    const chosen = REASONS.find((reason) => reason.key === picked) ?? REASONS[0];
    REACT;

    $stageCode = <<<'BLADE'
    <x-templates.refund.stage
        reference="RF-2608-0093"
        order="NS-2608-1174"
        amount="$1,162"
        lands="expected 2 Sep"
        :steps="$steps"
        :stage="2"
        note="Wei has looked at it and it passed." />

    <x-templates.refund.verdict
        when="Nov 2022"
        asked="Noise at coarse settings, day 34"
        said="Four days past the window, so we said no. Then Batch 40 turned out to have a real fault."
        record="RF-2211-0074"
        outcome="wrong" />
    BLADE;

    $stageVueCode = <<<'VUE'
    <RefundStage reference="RF-2608-0093" :steps="steps" :stage="2" />

    <RefundVerdict v-for="entry in refused" :key="entry.record" v-bind="entry" />
    VUE;

    $stageReactCode = <<<'REACT'
    <RefundStage reference="RF-2608-0093" steps={STEPS} stage={2} />

    {REFUSED.map((entry) => <RefundVerdict key={entry.record} {...entry} />)}
    REACT;

    $demoSteps = [
        ['label' => 'You told us', 'at' => '26 Aug, 09:40'],
        ['label' => 'Label used', 'at' => '26 Aug, 18:12'],
        ['label' => 'Opened at the bench', 'at' => '28 Aug, 11:02'],
        ['label' => 'Sent to your card', 'at' => null],
        ['label' => 'In your account', 'at' => null],
    ];
@endphp

<x-layout title="Refund policy template — BLADE-COMPONENTS">
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
                    A refund page is only worth reading if it says how much money follows the machine home, so every rule here
                    carries that figure in the same column. Eight rules, one deduction with its arithmetic shown, a refund you
                    can watch move hop by hop, and the ledger of everything paid — including the request we turned down and
                    then paid six weeks later.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The four questions in the order somebody with a boxed grinder on the kitchen table asks them: am I allowed, how do I start, where is my money, and do you actually pay these.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Six parts, and four of them exist to stop the page making a claim it cannot back: a rule that has to name an outcome, a window drawn as a bar, a picker that costs itself out, and a refusal line with a tone for admitting we were wrong.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="A rule that has to say what you get back" padding="p-8"
                    description="Three outcomes rather than two — everything, most of it, nothing — because the middle case is where real policies live and rounding it up to yes is how a page ends up lying. Freight sits beside it, since who books the courier is the other half of what a return actually costs you."
                    :code="$ruleCode" :vue-code="$ruleVueCode" :react-code="$ruleReactCode">
                    <div class="w-full max-w-3xl divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.refund.rule
                            reason="You changed your mind"
                            window="within 30 days"
                            condition="Back in any box that will survive the trip, with the burr tool and the cable. No more than a kilo of coffee through it."
                            freight="you"
                            back="all"
                            note="The law here gives you seven days. We give thirty, and a third of these come back in the last ten." />

                        <x-templates.refund.rule
                            reason="It has ground more than a kilo"
                            window="within 30 days"
                            condition="Still comes back. Burrs that have been through more than a kilo cannot be sold as new, so a fresh set goes in before it does."
                            freight="you"
                            back="part"
                            note="$40 comes off, which is what the burr set costs us. It is the only deduction on the whole page." />

                        <x-templates.refund.rule
                            reason="Anodised in a colour we do not stock"
                            window="no window"
                            condition="Jade and the two bar colours are run to order in batches of sixty. A returned one sits on the shelf until somebody wants that exact colour."
                            freight="none"
                            back="none"
                            note="Said before you pay, on the configure screen, in the same size as the price." />
                    </div>
                </x-demo>

                <x-demo title="A window, as a bar rather than a sentence" padding="p-8"
                    description="Thirty days means nothing until twenty-three of them are visibly gone. The amber variant is for windows that are shut or that were never a clock in the first place, which keeps a deadline and a standing promise from looking like the same thing."
                    :code="$windowCode" :vue-code="$windowVueCode" :react-code="$windowReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-3 sm:grid-cols-3">
                        <x-templates.refund.window label="Changed your mind" :span="30" unit="days" :used="23" then="after that it is the warranty or nothing" />
                        <x-templates.refund.window label="Stopped working" :span="24" unit="months" :used="1" then="repair, repair, then your money" />
                        <x-templates.refund.window label="Parts on the shelf" :span="10" unit="years" :used="0" then="burrs, boards, knobs, the lot" closed />
                    </div>
                </x-demo>

                <x-demo title="The picker that costs the choice out" padding="p-8"
                    description="Every reason carries its own freight, figure and median, so the summary above the form is never a generic promise. The fifth option is the interesting one: it tells you not to send the machine, and a returns flow that cannot say that is a returns flow optimised for the wrong thing."
                    :code="$reasonCode" :vue-code="$reasonVueCode" :react-code="$reasonReactCode">
                    <div class="flex w-full max-w-md flex-col gap-2.5">
                        <x-templates.refund.reason
                            key="mind"
                            label="I have changed my mind"
                            lead="Boxed, under a kilo of coffee through it, inside thirty days."
                            freight="You book it, $18 off the refund"
                            back="$1,180 back"
                            days="6 days"
                            picked />

                        <x-templates.refund.reason
                            key="fault"
                            label="It has stopped working"
                            lead="Inside two years this is a repair first, and usually only a repair."
                            freight="We pay both directions"
                            back="Fixed in 9 days, or your money on the third try"
                            days="9 days" />

                        <x-templates.refund.reason
                            key="noise"
                            label="It sounds wrong"
                            lead="Do not send this one yet. Read the answer about burrs bedding in first."
                            freight="Nothing to send"
                            back="Probably $0, and twenty minutes"
                            days="0 days" />
                    </div>
                </x-demo>

                <x-demo title="The refund in flight, and the refusals behind it" padding="p-8"
                    description="Five hops, drawn as five, because the last one belongs to a bank and folding it into a single promise is how a shop ends up answering mail about money it already sent. The refusal line underneath has a third tone for the entries where the shop was wrong — the reason worth publishing a refusal list at all."
                    :code="$stageCode" :vue-code="$stageVueCode" :react-code="$stageReactCode">
                    <div class="flex w-full max-w-3xl flex-col gap-4">
                        <x-templates.refund.stage
                            reference="RF-2608-0093"
                            order="NS-2608-1174"
                            amount="$1,162"
                            lands="expected 2 Sep"
                            :steps="$demoSteps"
                            :stage="2"
                            note="Wei has looked at it and it passed. The sign-off is a person clicking a button on a Thursday." />

                        <ul class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            <x-templates.refund.verdict when="Aug 2021" asked="Burrs worn flat at 400 kg" said="Four hundred kilos is about eight years of home use. That is wear, not a fault, and a burr set is $40 on the parts page." record="RF-2108-0031" outcome="refused" />
                            <x-templates.refund.verdict when="Nov 2022" asked="Noise at coarse settings, day 34" said="Four days past the window, so we said no. Then Batch 40 turned out to have a real fault and we paid it in full six weeks later." record="RF-2211-0074" outcome="wrong" />
                            <x-templates.refund.verdict when="Jun 2023" asked="Two machines, one order, both opened" said="One came back on the change-of-mind rule. The second had 3 kg through it, so the burr deduction applied and the rest was paid." record="RF-2306-0102" outcome="paid" />
                        </ul>
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
                ['slug' => 'shell', 'name' => 'Refund shell'],
                ['slug' => 'rule', 'name' => 'Policy row'],
                ['slug' => 'window', 'name' => 'Return window'],
                ['slug' => 'reason', 'name' => 'Reason option'],
                ['slug' => 'stage', 'name' => 'Refund status'],
                ['slug' => 'verdict', 'name' => 'Refusal line'],
            ]"
            description="Each screen ships its own source under its preview. These six are what all four share. The filter bar and the reason picker are about fifteen lines of plain JavaScript in the Blade version, and a ref in the other two."
            :components="['badge', 'meter-group', 'timeline', 'button', 'input']" />
    </div>
</x-layout>
