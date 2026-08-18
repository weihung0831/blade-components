@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/privacy/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/privacy/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/privacy/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $fieldCode = <<<'BLADE'
    <x-templates.privacy.field
        name="Phone number"
        source="you"
        why="The courier rings it on the day. Leave it blank and they leave a card instead."
        keeps="18 months"
        removable="yes"
        note="About a third of orders leave this empty and those parcels arrive fine." />

    {{-- source and removable are the two data attributes the filter reads --}}
    <div data-field data-source="{{ $source }}" data-removable="{{ $removable }}">
    BLADE;

    $fieldVueCode = <<<'VUE'
    <PrivacyField v-for="field in group.fields" :key="field.name" v-bind="field" />

    const shown = computed(() => groups
        .map((group) => ({ ...group, fields: group.fields.filter(keeps) }))
        .filter((group) => group.fields.length > 0));
    VUE;

    $fieldReactCode = <<<'REACT'
    {group.fields.map((field) => <PrivacyField key={field.name} {...field} />)}

    const total = shown.reduce((sum, group) => sum + group.fields.length, 0);
    REACT;

    $clockCode = <<<'BLADE'
    <x-templates.privacy.clock
        label="Your address in the web log"
        :span="14"
        unit="days"
        :elapsed="9"
        then="dropped, and the row becomes a tally" />

    {{-- pinned swaps jade for amber: the clock nobody here can wind back --}}
    <x-templates.privacy.clock label="The invoice" :span="7" unit="years" :elapsed="2" then="deleted the week it clears" pinned />
    BLADE;

    $clockVueCode = <<<'VUE'
    <PrivacyClock label="Your address in the web log" :span="14" unit="days" :elapsed="9" then="dropped, and the row becomes a tally" />

    const ratio = computed(() => (props.span > 0 ? Math.min(100, (props.elapsed / props.span) * 100) : 0));
    VUE;

    $clockReactCode = <<<'REACT'
    <PrivacyClock label="The invoice" span={7} unit="years" elapsed={2} then="deleted the week it clears" pinned />

    const ratio = span > 0 ? Math.min(100, (elapsed / span) * 100) : 0;
    REACT;

    $holderCode = <<<'BLADE'
    <x-templates.privacy.holder
        name="Plausible"
        role="Counts visits"
        country="Germany"
        basis="your consent"
        control="optional"
        since="2023"
        :gets="['a hash that changes daily', 'the page', 'the country']"
        note="Off until you go and switch it on." />

    {{-- control drives the badge and the filter: required, partly, optional --}}
    BLADE;

    $holderVueCode = <<<'VUE'
    <PrivacyHolder v-for="holder in shown" :key="holder.name" v-bind="holder" />

    const shown = computed(() => holders.filter((holder) => picked.value === 'all' || holder.control === picked.value));
    VUE;

    $holderReactCode = <<<'REACT'
    {shown.map((holder) => <PrivacyHolder key={holder.name} {...holder} />)}

    const shown = HOLDERS.filter((holder) => picked === 'all' || holder.control === picked);
    REACT;

    $consentCode = <<<'BLADE'
    <x-templates.privacy.consent
        key="counting"
        name="Counting visits"
        state="off"
        lead="Plausible, on a German server. No cookie at all."
        breaks="We do not know anybody came."
        :items="[['name' => 'no cookie', 'life' => 'none set']]" />

    {{-- state="locked" disables the input and drops the on/off label --}}
    BLADE;

    $consentVueCode = <<<'VUE'
    <PrivacyConsent v-for="item in switches" :key="item.key" v-bind="item" :on="isOn(item)"
        @toggle="(value) => (on[item.key] = value)" />

    const isOn = (item) => item.state === 'locked' || on.value[item.key] === true;
    VUE;

    $consentReactCode = <<<'REACT'
    <PrivacyConsent {...item} on={isOn(item)}
        onToggle={(value) => setOn((current) => ({ ...current, [item.key]: value }))} />

    const setAll = (wanted) => setOn({ remembering: wanted, counting: wanted, mail: wanted });
    REACT;

    $logCode = <<<'BLADE'
    <x-templates.privacy.parcel
        reference="PR-2026-0412"
        asked="14 Aug 2026"
        due="due by 13 Sep"
        :stage="1"
        :steps="[
            ['label' => 'Asked for', 'at' => '14 Aug, 09:12'],
            ['label' => 'Gathered', 'at' => '14 Aug, 16:40'],
            ['label' => 'Read by a person', 'at' => null],
            ['label' => 'Sent', 'at' => null],
        ]" />

    <x-templates.privacy.trail
        who="Yi-Chen" role="counter" when="13 Aug, 11:44"
        why="Opened the wrong Chen. Shut it after nine seconds."
        record="flagged" flagged />
    BLADE;

    $logVueCode = <<<'VUE'
    <PrivacyParcel reference="PR-2026-0412" :steps="steps" :stage="1" />

    <PrivacyTrail v-for="entry in trail" :key="entry.record + entry.when" v-bind="entry" />
    VUE;

    $logReactCode = <<<'REACT'
    <PrivacyParcel reference="PR-2026-0412" steps={STEPS} stage={1} />

    {TRAIL.map((entry) => <PrivacyTrail key={entry.record + entry.when} {...entry} />)}
    REACT;

    $demoSteps = [
        ['label' => 'Asked for', 'at' => '14 Aug, 09:12'],
        ['label' => 'Gathered', 'at' => '14 Aug, 16:40'],
        ['label' => 'Read by a person', 'at' => null],
        ['label' => 'Sent', 'at' => null],
    ];
@endphp

<x-layout title="Privacy template — BLADE-COMPONENTS">
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
                    Most privacy pages are written so that nothing in them can ever be checked. This one is an inventory: every
                    field with a retention clock on it, every outside company by name, four switches that are honest about what
                    they break, and a log of who inside the shop opened your record — including the person who opened it by
                    mistake.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Four questions in the order people actually ask them: what have you got, who else has it, what can I turn off, and can I have it back.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Seven parts. Three of them exist to make a claim checkable — a clock with a bar on it, a badge that admits a recipient cannot be refused, and a log line nobody at the shop wrote by hand.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="One field, and the four things worth knowing about it" padding="p-8"
                    description="What it is, who put it there, why it exists, and whether it can be deleted. Splitting the last one into three answers rather than a yes-or-no is the point: most rows in a real inventory are neither wholly yours to clear nor wholly pinned, and rounding that to yes is where these pages start lying."
                    :code="$fieldCode" :vue-code="$fieldVueCode" :react-code="$fieldReactCode">
                    <div class="w-full max-w-3xl divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.privacy.field
                            name="Phone number"
                            source="you"
                            why="The courier rings it on the day. Leave it blank and they leave a card instead."
                            keeps="18 months"
                            removable="yes"
                            note="About a third of orders leave this empty and those parcels arrive fine." />

                        <x-templates.privacy.field
                            name="Serial number"
                            source="us"
                            why="Which burr set, which motor batch, which bench it was built on."
                            keeps="10 years from build"
                            removable="partly"
                            note="The serial stays, because a recall has to know which forty machines to write to. Your name comes off it the day you ask." />

                        <x-templates.privacy.field
                            name="Invoice record"
                            source="law"
                            why="Every sale, against the 統一發票 number the Ministry of Finance issued for it."
                            keeps="7 years"
                            removable="no"
                            note="稅捐稽徵法 §11-2. We could not delete this one if all four of us agreed to." />
                    </div>
                </x-demo>

                <x-demo title="Retention, as a bar rather than a sentence" padding="p-8"
                    description="Fourteen days means nothing until you can see nine of them gone. The amber variant is for the clocks nobody at the company can wind back, which keeps the honest ones and the imposed ones visually apart — a reader should be able to tell a promise from a legal obligation at a glance."
                    :code="$clockCode" :vue-code="$clockVueCode" :react-code="$clockReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-3 sm:grid-cols-3">
                        <x-templates.privacy.clock label="Your address in the web log" :span="14" unit="days" :elapsed="9" then="dropped, and the row becomes a tally" />
                        <x-templates.privacy.clock label="Phone number after delivery" :span="18" unit="months" :elapsed="4" then="deleted without being asked" />
                        <x-templates.privacy.clock label="The invoice, whatever anybody wants" :span="7" unit="years" :elapsed="2" then="deleted the week it clears" pinned />
                    </div>
                </x-demo>

                <x-demo title="A recipient, with the fields it actually gets" padding="p-8"
                    description="Naming a sub-processor is easy; listing what it is handed is the part most pages skip. The badge on the right says whether you could avoid it, and marking one as unavoidable costs nothing — you already knew somebody has to take the money."
                    :code="$holderCode" :vue-code="$holderVueCode" :react-code="$holderReactCode">
                    <div class="flex w-full max-w-3xl flex-col gap-3">
                        <x-templates.privacy.holder
                            name="綠界科技 ECPay"
                            role="Takes the payment"
                            country="Taiwan"
                            basis="contract"
                            control="required"
                            since="2019"
                            :gets="['name', 'email', 'amount', 'order number']"
                            note="They hand back a token and four digits. The card number goes from your browser to them and never comes past anything we own." />

                        <x-templates.privacy.holder
                            name="Plausible"
                            role="Counts visits"
                            country="Germany"
                            basis="your consent"
                            control="optional"
                            since="2023"
                            :gets="['a hash that changes daily', 'the page', 'the country']"
                            note="Off until you go and switch it on. It cannot reach an order, an address or a name even when it is running." />
                    </div>
                </x-demo>

                <x-demo title="A switch that says what it costs you" padding="p-8"
                    description="The cookie names and their lifespans sit under the toggle, and under those is the line that matters: what stops working if you leave it off. A consent row without that line is asking for a decision while withholding the only fact needed to make it."
                    :code="$consentCode" :vue-code="$consentVueCode" :react-code="$consentReactCode">
                    <div class="w-full max-w-3xl divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.privacy.consent
                            key="needed"
                            name="Strictly needed"
                            state="locked"
                            lead="The basket, the sign-in, and the check the payment processor runs before it agrees to take money."
                            breaks="Nothing works. There is no version of a shop that forgets what you put in the basket between one page and the next."
                            :items="[
                                ['name' => 'nomad_session', 'life' => 'until the tab closes'],
                                ['name' => 'XSRF-TOKEN', 'life' => '2 hours'],
                            ]" />

                        <x-templates.privacy.consent
                            key="counting"
                            name="Counting visits"
                            state="off"
                            lead="Plausible, on a German server. No cookie at all: a hash of your address and today's date, thrown out at midnight."
                            breaks="We do not know anybody came. What people read gets worked out from the mail they send instead."
                            :items="[
                                ['name' => 'no cookie', 'life' => 'none set'],
                                ['name' => 'daily hash', 'life' => 'gone at midnight'],
                            ]" />
                    </div>
                </x-demo>

                <x-demo title="The request, and the log underneath it" padding="p-8"
                    description="A subject access request is a parcel with a tracking number, so it gets a stepper and a due date rather than a promise to be in touch. The log beside it is written by the system, which is why one of the lines is somebody admitting they opened the wrong record — that entry is the whole argument for showing the log at all."
                    :code="$logCode" :vue-code="$logVueCode" :react-code="$logReactCode">
                    <div class="flex w-full max-w-3xl flex-col gap-4">
                        <x-templates.privacy.parcel
                            reference="PR-2026-0412"
                            kind="A copy of everything"
                            asked="14 Aug 2026"
                            due="due by 13 Sep"
                            :steps="$demoSteps"
                            :stage="1"
                            note="Mei-Ling reads the export before it goes anywhere. It is the slow step and it is also where the mistakes get caught." />

                        <ul class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            <x-templates.privacy.trail who="Wei" role="bench" when="12 Aug, 15:05" why="Looked up which burr batch your serial shipped with." record="NS-2411-0392" />
                            <x-templates.privacy.trail who="Yi-Chen" role="counter" when="13 Aug, 11:44" why="Opened the wrong Chen. Shut it after nine seconds and wrote this line herself." record="flagged" flagged />
                            <x-templates.privacy.trail who="Nightly backup" role="automatic" when="13 Aug, 03:00" why="Copied the database. Nothing was opened and nobody read anything." record="job 8842" />
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
                ['slug' => 'shell', 'name' => 'Privacy shell'],
                ['slug' => 'field', 'name' => 'Field row'],
                ['slug' => 'clock', 'name' => 'Retention clock'],
                ['slug' => 'holder', 'name' => 'Recipient card'],
                ['slug' => 'consent', 'name' => 'Consent switch'],
                ['slug' => 'trail', 'name' => 'Access log line'],
                ['slug' => 'parcel', 'name' => 'Request status'],
            ]"
            description="Each screen ships its own source under its preview. These seven are what all four share. The filters and the four toggles are a dozen lines of plain JavaScript in the Blade version, and a ref in the other two."
            :components="['switch', 'badge', 'meter-group', 'timeline', 'button']" />
    </div>
</x-layout>
