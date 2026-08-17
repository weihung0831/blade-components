@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/faq/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/faq/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/faq/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $questionCode = <<<'BLADE'
    <x-templates.faq.question
        :number="1"
        question="It howls above half the dial after three weeks. Is that normal?"
        topic="Noise and grind"
        :helpful="94"
        :votes="212"
        updated="3 days ago">
        <p>No. Burrs bedding in are quieter each week, not louder.</p>
    </x-templates.faq.question>

    {{-- details and summary, so it opens with no JavaScript and prints open --}}
    <details data-question data-topic="noise and grind" data-search="...">
    BLADE;

    $questionVueCode = <<<'VUE'
    <FaqQuestion v-for="entry in listed" :key="entry.q" :number="questions.indexOf(entry) + 1" v-bind="entry" />

    <details :open="isOpen" @toggle="isOpen = $event.target.open">
    VUE;

    $questionReactCode = <<<'REACT'
    {listed.map((entry) => <FaqQuestion key={entry.q} number={QUESTIONS.indexOf(entry) + 1} {...entry} />)}

    <details open={isOpen} onToggle={(event) => setIsOpen(event.currentTarget.open)}>
    REACT;

    $scoreCode = <<<'BLADE'
    <x-templates.faq.helpful name="answer-vote" :helpful="94" :votes="212" prompt="Did that fix it?" />

    {{-- the vote needs no JavaScript: a radio, a sibling selector, and the follow-up appears --}}
    <label class="peer/no">
        <input type="radio" name="vote" value="no" class="sr-only">
    </label>

    <p class="hidden peer-has-[:checked]/no:block">Then it is our fault, not yours.</p>
    BLADE;

    $scoreVueCode = <<<'VUE'
    <FaqHelpful :helpful="94" :votes="212" prompt="Did that fix it?" />

    <p v-if="vote === 'no'">Then it is our fault, not yours.</p>
    VUE;

    $scoreReactCode = <<<'REACT'
    <FaqHelpful helpful={94} votes={212} prompt="Did that fix it?" />

    {vote === 'no' && <p>Then it is our fault, not yours.</p>}
    REACT;

    $proseCode = <<<'BLADE'
    <x-templates.faq.callout tone="warn" label="The mistake everyone makes">
        <p>Torquing the four collar screws in a circle rather than a cross puts the noise back.</p>
    </x-templates.faq.callout>

    <x-templates.faq.step :number="3" title="Drop the shims onto the seat"
        minutes="3 min" :tools="['shim kit']">
        <p>Two shims, 0.08 mm each, stacked flat on the machined face.</p>
    </x-templates.faq.step>
    BLADE;

    $proseVueCode = <<<'VUE'
    <FaqCallout tone="warn" label="The mistake everyone makes">
        <p>Torquing the four collar screws in a circle puts the noise back.</p>
    </FaqCallout>

    <FaqStep v-for="(step, index) in steps" :key="step.title" :number="index + 1" v-bind="step" />
    VUE;

    $proseReactCode = <<<'REACT'
    <FaqCallout tone="warn" label="The mistake everyone makes">
        <p>Torquing the four collar screws in a circle puts the noise back.</p>
    </FaqCallout>

    {STEPS.map((step, index) => <FaqStep key={step.title} number={index + 1} {...step} />)}
    REACT;

    $topicCode = <<<'BLADE'
    <x-templates.faq.topic
        name="Warranty"
        :count="5"
        lead="I opened it myself. Have I voided anything?"
        :health="62"
        note="2 need a rewrite" />

    {{-- the bar is the average helpfulness of the heading, so a weak topic shows up amber --}}
    BLADE;

    $topicVueCode = <<<'VUE'
    <FaqTopic v-for="entry in topics" :key="entry.name" v-bind="entry"
        :active="topic === entry.name" @click="pick(entry.name)" />
    VUE;

    $topicReactCode = <<<'REACT'
    {TOPICS.map((entry) => <FaqTopic key={entry.name} {...entry}
        active={topic === entry.name} onSelect={() => setTopic(entry.name)} />)}
    REACT;

    $queryCode = <<<'BLADE'
    <x-templates.faq.query term="grinder smells like burning"
        :hits="61" :peak="214" :results="0" :read="0" state="missing" />

    $states = [
        'answered' => ['bar' => 'bg-jade-500/50', 'dot' => 'bg-white/10'],
        'thin' => ['bar' => 'bg-amber-400/50', 'dot' => 'bg-amber-400'],
        'missing' => ['bar' => 'bg-red-400/50', 'dot' => 'bg-red-400'],
    ];
    BLADE;

    $queryVueCode = <<<'VUE'
    <FaqQuery v-for="entry in listed" :key="entry.term" v-bind="entry" :peak="214" />

    const listed = computed(() => queries.filter((entry) => filter.value === 'all' || entry.state === filter.value));
    VUE;

    $queryReactCode = <<<'REACT'
    {listed.map((entry) => <FaqQuery key={entry.term} {...entry} peak={214} />)}

    const listed = QUERIES.filter((entry) => filter === 'all' || entry.state === filter);
    REACT;
@endphp

<x-layout title="FAQ template — BLADE-COMPONENTS">
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
                    The self-service side of the <span class="text-zinc-300">Inbox</span> desk. Every answer carries the two numbers that decide its fate —
                    how many people opened it, and how many said it was no use.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Type into the search box and the list narrows under it. Put a serial into the answer page and it tells you whether yours is affected. Start writing a question and three answers try to head you off.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Seven parts. Two of them are just a bar and a number, and those two are what stop the page rotting quietly.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Question row" padding="p-6"
                    description="A details and a summary, which means it opens without a line of JavaScript, survives a printer, and lands on the right answer when someone follows a link with a hash in it. The score sits in the summary because an answer that nobody trusts should say so before you read it."
                    :code="$questionCode" :vue-code="$questionVueCode" :react-code="$questionReactCode">
                    <div class="w-full max-w-2xl overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.faq.question
                            :number="1"
                            question="It howls above half the dial after three weeks. Is that normal?"
                            topic="Noise and grind"
                            :helpful="94"
                            :votes="212"
                            updated="3 days ago"
                            open>
                            <p>No. Burrs bedding in are quieter each week, not louder, and they never pick a single point on the dial to scream at.</p>
                        </x-templates.faq.question>

                        <x-templates.faq.question
                            :number="2"
                            question="I opened it myself before writing in. Have I voided anything?"
                            topic="Warranty"
                            :helpful="62"
                            :votes="91"
                            updated="2 Mar"
                            stale>
                            <p>No. There are four hex screws and a service manual on this site.</p>
                        </x-templates.faq.question>

                        <x-templates.faq.question
                            :number="3"
                            question="Do I need the receipt?"
                            topic="Warranty"
                            :helpful="93"
                            :votes="72"
                            updated="9 Aug"
                            class="border-b-0">
                            <p>The serial is enough. It is on a plate under the base and starts NS-B.</p>
                        </x-templates.faq.question>
                    </div>
                </x-demo>

                <x-demo title="The vote, and what it costs the page" padding="p-8"
                    description="Two buttons and a bar. Press the second one and the page admits the failure is its own rather than asking you to rephrase — because the sentence you write next is the only thing that tells the person rewriting it what went wrong."
                    :code="$scoreCode" :vue-code="$scoreVueCode" :react-code="$scoreReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-3">
                        <x-templates.faq.helpful name="demo-vote-a" :helpful="94" :votes="212" prompt="Did that fix it?" />

                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            @foreach ([[94, 'jade', 'earning its place'], [71, 'amber', 'on the watch list'], [62, 'red', 'gets rewritten this month']] as [$score, $tone, $note])
                                <div class="rounded-xl border border-white/8 bg-ink-900 px-4 py-3">
                                    <p class="font-mono text-lg {{ $tone === 'jade' ? 'text-jade-300' : ($tone === 'amber' ? 'text-amber-300' : 'text-red-300') }}">{{ $score }}%</p>
                                    <div class="mt-2 h-0.5 overflow-hidden rounded-full bg-white/10">
                                        <span class="block h-full rounded-full {{ $tone === 'jade' ? 'bg-jade-500/70' : ($tone === 'amber' ? 'bg-amber-400/70' : 'bg-red-400/70') }}" style="width: {{ $score }}%"></span>
                                    </div>
                                    <p class="mt-2 font-mono text-[10px] text-zinc-600">{{ $note }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Furniture for a long answer" padding="p-8"
                    description="A rule down the left instead of a coloured box, because four stacked boxes on one page start to look like a warning label nobody reads. The step numbers thread onto a line so you can see how much is left without counting."
                    :code="$proseCode" :vue-code="$proseVueCode" :react-code="$proseReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-6">
                        <div class="flex flex-col gap-4">
                            @foreach ([['tip', null, 'Run it empty from 1 to 16. If it only sings with beans in it, the seat is proud.'], ['warn', 'The mistake everyone makes', 'Torquing the four collar screws in a circle rather than a cross puts the noise straight back.'], ['stop', null, 'Do not open the motor housing. We cannot reproduce that torque on the bench.'], ['quiet', 'Or skip it', 'Nothing breaks if you do not season the burrs. The dial just keeps moving under you for a fortnight.']] as [$tone, $label, $body])
                                <x-templates.faq.callout :tone="$tone" :label="$label">
                                    <p>{{ $body }}</p>
                                </x-templates.faq.callout>
                            @endforeach
                        </div>

                        <div class="border-t border-white/5 pt-6">
                            <x-templates.faq.step :number="2" title="Take the top burr out" minutes="4 min" :tools="['3 mm hex']">
                                <p>Four screws in the collar, all the same length. The carrier lifts straight up and does not need levering.</p>
                            </x-templates.faq.step>

                            <x-templates.faq.step :number="3" title="Drop the shims onto the seat" minutes="3 min" :tools="['shim kit']" last>
                                <p>Two shims, 0.08 mm each, flat on the machined face. They sit proud of the lip until the carrier squashes them home.</p>
                            </x-templates.faq.step>
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Heading card" padding="p-8"
                    description="Six of these stand in for a menu. Each one carries the question people open most under that heading, so the card does the job a category name never does — it tells you whether your problem lives in there."
                    :code="$topicCode" :vue-code="$topicVueCode" :react-code="$topicReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-2.5 sm:grid-cols-3">
                        <x-templates.faq.topic name="Noise and grind" :count="8" lead="It howls above half the dial after three weeks." :health="91" active />
                        <x-templates.faq.topic name="Warranty" :count="5" lead="I opened it myself. Have I voided anything?" :health="62" note="2 need a rewrite" />
                        <x-templates.faq.topic name="Dealers" :count="2" lead="What do dealer terms look like for two shops?" :health="90" />
                    </div>
                </x-demo>

                <x-demo title="A search term, and what it found" padding="p-8"
                    description="The bar is volume, the colour is whether the site had anything to say. Red rows are the whole point of the screen — 184 searches last month that came back empty, each one a page somebody has not written yet."
                    :code="$queryCode" :vue-code="$queryVueCode" :react-code="$queryReactCode">
                    <div class="w-full max-w-3xl overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.faq.query term="noise" :hits="214" :peak="214" :results="8" :read="91" state="answered" />
                        <x-templates.faq.query term="shipping to japan" :hits="44" :peak="214" :results="1" :read="31" state="thin" />
                        <x-templates.faq.query term="grinder smells like burning" :hits="61" :peak="214" :results="0" :read="0" state="missing" class="border-b-0" />
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
                ['slug' => 'shell', 'name' => 'Help centre shell'],
                ['slug' => 'question', 'name' => 'Question row'],
                ['slug' => 'topic', 'name' => 'Heading card'],
                ['slug' => 'helpful', 'name' => 'Vote'],
                ['slug' => 'callout', 'name' => 'Callout'],
                ['slug' => 'step', 'name' => 'Step'],
                ['slug' => 'query', 'name' => 'Search term'],
            ]"
            description="Each screen ships its own source under its preview. These seven are what all four share. The question row is a details element, so it works before your JavaScript arrives and keeps working if it never does."
            :components="['accordion', 'search', 'input', 'textarea', 'meter-group']" />
    </div>
</x-layout>
