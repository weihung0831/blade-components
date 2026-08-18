@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/onboarding/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/onboarding/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/onboarding/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $stepperCode = <<<'BLADE'
    <x-templates.onboarding.stepper :steps="$steps" interactive />

    {{-- every dot, label and connector reads the state off its own li --}}
    <li class="group/step" data-step-state="skipped" data-step="catalog">

    {{-- so moving between steps is one attribute, not a class sweep --}}
    mark.dataset.stepState = index === at ? 'current' : index < at ? 'done' : 'todo';
    BLADE;

    $stepperVueCode = <<<'VUE'
    <OnboardingStepper :steps="steps" interactive @jump="go" />

    const steps = computed(() => plan.map((entry, index) => ({
        ...entry,
        state: skipped.includes(entry.key) ? 'skipped'
            : index < at.value ? 'done' : index === at.value ? 'current' : 'todo',
    })));
    VUE;

    $stepperReactCode = <<<'REACT'
    <OnboardingStepper steps={steps} interactive onJump={go} />

    const steps = PLAN.map((entry, index) => ({
        ...entry,
        state: skipped.includes(entry.key) ? 'skipped'
            : index < at ? 'done' : index === at ? 'current' : 'todo',
    }));
    REACT;

    $fieldCode = <<<'BLADE'
    <x-templates.onboarding.field
        label="Address people type"
        value="kerouac"
        prefix="https://"
        suffix=".nomadsupply.cc"
        why="Your own domain can point at this the day you want it to."
        hint="free, and yours from now" />

    {{-- locked prints the value rather than an input, and says so in the corner --}}
    <x-templates.onboarding.field label="Region" value="Taipei · ap-tpe-1" locked />
    BLADE;

    $fieldVueCode = <<<'VUE'
    <OnboardingField label="Tax number" value="90512347" optional
        why="Eight digits, if you are a company." />
    VUE;

    $fieldReactCode = <<<'REACT'
    <OnboardingField label="Tax number" value="90512347" optional
        why="Eight digits, if you are a company." />
    REACT;

    $mappingCode = <<<'BLADE'
    <x-templates.onboarding.mapping
        source="Variant SKU"
        sample="KC-ETH-GUJ-250"
        target="sku"
        state="clash"
        note="Fourteen of these already exist here." />

    {{-- the filter bar reads the state straight off the row --}}
    <div data-mapping data-state="{{ $state }}">
    BLADE;

    $mappingVueCode = <<<'VUE'
    <OnboardingMapping v-for="column in shown" :key="column.source" v-bind="column" />

    const shown = computed(() => columns.filter((column) => keeps[picked.value](column.state)));
    VUE;

    $mappingReactCode = <<<'REACT'
    {shown.map((column) => <OnboardingMapping key={column.source} {...column} />)}

    const shown = COLUMNS.filter((column) => KEEPS[picked](column.state));
    REACT;

    $tallyCode = <<<'BLADE'
    <x-templates.onboarding.task
        label="A bank account for payouts"
        why="Orders can come in without it and the money sits with us."
        cost="6 min"
        required />

    <x-templates.onboarding.funnel
        stage="catalog"
        step="The catalog"
        :reached="1385"
        :of="1847"
        :lost="84"
        :minutes="19"
        :claimed="8"
        worst />
    BLADE;

    $tallyVueCode = <<<'VUE'
    <OnboardingTask v-for="task in shut" :key="task.label" v-bind="task" @toggle="toggle(task)" />

    <OnboardingFunnel v-for="row in rows" :key="row.key" v-bind="row" :of="of[range]" />
    VUE;

    $tallyReactCode = <<<'REACT'
    {shut.map((task) => <OnboardingTask key={task.label} {...task} onToggle={() => toggle(task.label)} />)}

    {rows.map((row) => <OnboardingFunnel key={row.key} {...row} of={OF[range]} />)}
    REACT;

    $demoSteps = [
        ['key' => 'shop', 'label' => 'The shop', 'note' => 'Name, address, what you sell in.', 'minutes' => '2 min', 'state' => 'done'],
        ['key' => 'region', 'label' => 'Where it lives', 'note' => 'No moving it later.', 'minutes' => '1 min', 'state' => 'done'],
        ['key' => 'catalog', 'label' => 'The catalog', 'note' => 'A CSV, or start empty.', 'minutes' => '19 min', 'optional' => true, 'state' => 'skipped'],
        ['key' => 'people', 'label' => 'The others', 'note' => 'Two seats come with the plan.', 'minutes' => '3 min', 'optional' => true, 'state' => 'current'],
        ['key' => 'payouts', 'label' => 'Getting paid', 'note' => 'A bank account before the first order ships.', 'minutes' => '6 min', 'state' => 'todo'],
    ];
@endphp

<x-layout title="Onboarding template — BLADE-COMPONENTS">
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
                    A wizard that says how long each step takes, which ones you can walk past, and what breaks if you do.
                    Five steps, a nineteen-minute import in the middle of them, a checklist sorted by whether it actually
                    blocks anything, and the funnel showing how many people this wizard loses — including the two steps
                    it lost first.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The wizard, the step inside it that eats the afternoon, what is left over when it ends, and the page where the whole thing is held to account.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Five parts. Each one carries a piece of information most onboarding hides: how long, whether it is optional, what we guessed, and what happens if you never come back to it.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="A stepper with four states, one of them skipped" padding="p-8"
                    description="Done, current, todo and skipped — the fourth being the one most steppers cannot draw, which is why they pretend every step is required. State lives in a data attribute on each row, so moving between steps is one assignment rather than a sweep through class lists, and the Vue and React versions bind the same attribute."
                    :code="$stepperCode" :vue-code="$stepperVueCode" :react-code="$stepperReactCode">
                    <div class="grid w-full max-w-4xl grid-cols-1 gap-8 sm:grid-cols-[18rem_1fr]">
                        <x-templates.onboarding.stepper :steps="$demoSteps" interactive />

                        <div class="flex flex-col gap-6">
                            <x-templates.onboarding.stepper layout="row" :steps="$demoSteps" />

                            <p class="text-[12px]/5 text-zinc-600">
                                The row layout is the same component with the connectors turned sideways. It sits in the header
                                on narrow screens, where the rail is not there to carry it.
                            </p>
                        </div>
                    </div>
                </x-demo>

                <x-demo title="A field that says why it is asking" padding="p-8"
                    description="One line under every input explaining what the answer is for. It costs a sentence and it is the difference between a form and an interrogation. The locked variant prints the value instead of an input, for the answers that cannot be changed once given."
                    :code="$fieldCode" :vue-code="$fieldVueCode" :react-code="$fieldReactCode">
                    <div class="flex w-full max-w-md flex-col gap-5">
                        <x-templates.onboarding.field
                            label="Address people type"
                            value="kerouac"
                            prefix="https://"
                            suffix=".nomadsupply.cc"
                            why="Your own domain can point at this the day you want it to. Nobody has to know this address exists."
                            hint="free, and yours from now" />

                        <x-templates.onboarding.field
                            label="Region"
                            value="Taipei · ap-tpe-1"
                            locked
                            why="Moving a shop between regions is a migration one of us runs by hand. Eleven so far." />

                        <x-templates.onboarding.field
                            label="Tax number"
                            value="90512347"
                            optional
                            why="Eight digits, if you are a company. Sole traders leave this empty." />
                    </div>
                </x-demo>

                <x-demo title="A column mapping that owns up to guessing" padding="p-8"
                    description="Four states: matched, guessed, already here, and not coming. The last two are what separate a mapping screen from a progress bar with a lie on it — one warns you about an overwrite before it happens, the other says out loud that a column is being thrown away and why."
                    :code="$mappingCode" :vue-code="$mappingVueCode" :react-code="$mappingReactCode">
                    <div class="w-full max-w-3xl divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.onboarding.mapping source="Handle" sample="ethiopia-guji-natural" target="slug" state="matched" />
                        <x-templates.onboarding.mapping
                            source="Body (HTML)"
                            sample="<p>Peach, jasmine, a lo…"
                            target="description"
                            state="guessed"
                            :options="['notes', 'tasting', 'summary']"
                            note="The HTML comes through as our own small subset. Style attributes and scripts do not." />
                        <x-templates.onboarding.mapping
                            source="Variant SKU"
                            sample="KC-ETH-GUJ-250"
                            target="sku"
                            state="clash"
                            note="Fourteen of these already exist here from the sample catalog." />
                        <x-templates.onboarding.mapping
                            source="SEO Title"
                            sample="Ethiopia Guji | Kerouac"
                            target="seo title"
                            state="dropped"
                            note="We write this from the product name. Yours all end in the shop name, which is the part search engines cut off." />
                    </div>
                </x-demo>

                <x-demo title="A task that knows whether it blocks you, and a funnel row that keeps the receipt" padding="p-8"
                    description="The task carries whether it holds the shop shut and what it costs to leave alone, so a checklist can be sorted by consequence rather than by the order somebody built the features. The funnel row prints the time a step really takes next to the time the label claimed — the pairing that got two steps deleted."
                    :code="$tallyCode" :vue-code="$tallyVueCode" :react-code="$tallyReactCode">
                    <div class="flex w-full max-w-3xl flex-col gap-5">
                        <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            <x-templates.onboarding.task
                                label="A bank account for payouts"
                                why="Orders can come in without it and the money sits with us. Nothing goes to a bank until this is here."
                                cost="6 min"
                                required />

                            <x-templates.onboarding.task
                                label="Bring the catalog over"
                                why="387 products in, 19 rows left behind with a reason against each."
                                cost="19 min"
                                done />

                            <x-templates.onboarding.task
                                label="Put somebody else on the shop"
                                why="Two seats are in the plan and one of them is empty. It matters the first week you are ill."
                                cost="3 min"
                                moved="was on the required list until March" />
                        </div>

                        <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                            <x-templates.onboarding.funnel
                                stage="region"
                                step="Where it lives"
                                :reached="1649"
                                :of="1847"
                                :lost="264"
                                :minutes="4"
                                :claimed="1"
                                note="One radio button, four minutes. People leave to go and ask somebody whether it matters." />

                            <x-templates.onboarding.funnel
                                stage="catalog"
                                step="The catalog"
                                :reached="1385"
                                :of="1847"
                                :lost="84"
                                :minutes="19"
                                :claimed="8"
                                worst
                                note="The longest step by a factor of three, and the one we told people would take eight minutes for two years." />
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
                ['slug' => 'shell', 'name' => 'Wizard shell'],
                ['slug' => 'stepper', 'name' => 'Stepper'],
                ['slug' => 'field', 'name' => 'Field'],
                ['slug' => 'mapping', 'name' => 'Column mapping'],
                ['slug' => 'task', 'name' => 'Checklist item'],
                ['slug' => 'funnel', 'name' => 'Funnel row'],
            ]"
            description="Each screen ships its own source under its preview. These six are what all four share. The shell works out step states from a single step attribute, so a screen names where it is and the rail, the counter and the progress line follow."
            :components="['stepper', 'progress', 'input', 'checkbox', 'button', 'meter-group']" />
    </div>
</x-layout>
