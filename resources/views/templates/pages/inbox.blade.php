@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/inbox/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/inbox/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/inbox/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $threadCode = <<<'BLADE'
    <x-templates.inbox.thread
        ref="NS-4471"
        from="Tomás Ferreira"
        subject="Grinder howls above 1800 rpm after three weeks"
        preview="It starts around the middle of the dial…"
        :tags="[['label' => 'Warranty', 'tone' => 'warranty']]"
        :minutes="-40"
        :count="4"
        time="11:12"
        channel="form"
        unread />

    {{-- the row is a button, and every filter on the screen reads its data attributes --}}
    <button data-thread data-owner="unassigned" data-state="open" data-minutes="-40" data-unread>
    BLADE;

    $threadVueCode = <<<'VUE'
    <InboxThread :thread="thread" :active="open?.ref === thread.ref" @click="select(thread)" />

    const listed = computed(() => threads.value.filter(matches));
    VUE;

    $threadReactCode = <<<'REACT'
    <InboxThread thread={thread} active={open?.ref === thread.ref} onSelect={() => select(thread)} />

    const listed = THREADS.filter(matches);
    REACT;

    $messageCode = <<<'BLADE'
    <x-templates.inbox.message kind="inbound" author="Tomás Ferreira" time="Tue 08:41"
        :attachments="[['name' => 'grinder-1800rpm.m4a', 'size' => '1.2 MB']]">
        <p>Three weeks old and it has started screaming past halfway on the dial.</p>
    </x-templates.inbox.message>

    <x-templates.inbox.message kind="note" author="Lena Kohler" role="bench test" time="Tue 09:41">
        <p>Seat depth is 0.15 shallow across the run.</p>
    </x-templates.inbox.message>

    {{-- notes and events carry data-internal, which is the whole trick behind "what they can see" --}}
    BLADE;

    $messageVueCode = <<<'VUE'
    <InboxMessage v-for="(message, index) in shown" :key="index" :message="message" />

    const shown = computed(() => view.value === 'everything'
        ? messages
        : messages.filter((message) => !message.internal));
    VUE;

    $messageReactCode = <<<'REACT'
    {shown.map((message, index) => <InboxMessage key={index} message={message} />)}

    const shown = view === 'everything' ? MESSAGES : MESSAGES.filter((message) => !message.internal);
    REACT;

    $clockCode = <<<'BLADE'
    <x-templates.inbox.clock :minutes="185" />
    <x-templates.inbox.clock :minutes="55" bar />
    <x-templates.inbox.clock :minutes="-40" bar />

    {{-- one number in, three decisions out: the words, the colour, how much of the bar is gone --}}
    $tone = match (true) {
        $late => 'text-red-300',
        $minutes <= 60 => 'text-amber-300',
        default => 'text-zinc-500',
    };
    BLADE;

    $clockVueCode = <<<'VUE'
    <InboxClock :minutes="-40" bar />

    const tone = computed(() => {
        if (late.value) return 'text-red-300';

        return props.minutes <= 60 ? 'text-amber-300' : 'text-zinc-500';
    });
    VUE;

    $clockReactCode = <<<'REACT'
    <InboxClock minutes={-40} bar />

    const tone = late ? 'text-red-300' : minutes <= 60 ? 'text-amber-300' : 'text-zinc-500';
    REACT;

    $faceCode = <<<'BLADE'
    <x-templates.inbox.avatar name="Tomás Ferreira" size="md" kind="customer" />
    <x-templates.inbox.avatar name="Lena Kohler" size="md" />

    <x-templates.inbox.tag label="Warranty" tone="warranty" />
    <x-templates.inbox.tag label="Escalated" tone="escalated" />
    BLADE;

    $faceVueCode = <<<'VUE'
    <InboxAvatar name="Tomás Ferreira" size="md" kind="customer" />
    <InboxAvatar name="Lena Kohler" size="md" />

    <InboxTag label="Warranty" tone="warranty" />
    VUE;

    $faceReactCode = <<<'REACT'
    <InboxAvatar name="Tomás Ferreira" size="md" kind="customer" />
    <InboxAvatar name="Lena Kohler" size="md" />

    <InboxTag label="Warranty" tone="warranty" />
    REACT;

    $macroCode = <<<'BLADE'
    $values = [
        '{{first_name}}' => 'Tomás',
        '{{serial}}' => 'NS-B40-0117',
        '{{eta}}' => '3 working days',
    ];

    // no template engine, no dependency — the canned reply is a string and the desk knows the customer
    const fill = (text) => Object.entries(values)
        .reduce((filled, [token, value]) => filled.split(token).join(value), text);
    BLADE;

    $macroVueCode = <<<'VUE'
    const pick = (macro) => {
        picked.value = macro.slug;
        body.value = fill(macro.body);
    };

    <textarea ref="editor" v-model="body" />
    VUE;

    $macroReactCode = <<<'REACT'
    const pick = (macro) => {
        setPicked(macro.slug);
        setBody(fill(macro.body));
    };

    <textarea ref={editor} value={body} onChange={(event) => setBody(event.target.value)} />
    REACT;

    $demoMacros = [
        ['slug' => 'shim', 'name' => 'Shim kit — dispatch', 'body' => "Hi {{first_name}},\n\nThe kit goes out on today's van, so it should be with you inside {{eta}}. Two shims, a 3 mm hex, and a card with four photographs on it. Serial on file is {{serial}}."],
        ['slug' => 'serial', 'name' => 'Ask for the serial', 'body' => "Hi {{first_name}},\n\nThere is a plate on the underside with a code that starts NS-B. Could you read it to me? It tells me which run your machine came from."],
    ];
@endphp

<x-layout title="Inbox template — BLADE-COMPONENTS">
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
                    The desk that answers for the workshop in the <span class="text-zinc-300">Kanban</span> template. Every conversation carries a clock,
                    and the clock is what sorts the day — not the folder it landed in.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Click a row and the pane beside it changes. Hide the internal notes and watch six of the eleven messages disappear. Pick a canned reply and it fills its own blanks.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Six parts, and the clock is in four of them. A shape tells you who is outside the company before you have read a word.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Thread row" padding="p-6"
                    description="Sender, subject, one line of the message, what it is tagged, how long it has left. Unread is a dot and a weight, not a colour wash — the colour is spent on the thing that is actually late."
                    :code="$threadCode" :vue-code="$threadVueCode" :react-code="$threadReactCode">
                    <div class="w-full max-w-xl overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <x-templates.inbox.thread
                            ref="NS-4471"
                            from="Tomás Ferreira"
                            subject="Grinder howls above 1800 rpm after three weeks"
                            preview="It starts around the middle of the dial and gets worse on lighter roasts."
                            :tags="[['label' => 'Warranty', 'tone' => 'warranty'], ['label' => 'Batch 40', 'tone' => 'order']]"
                            :minutes="-40"
                            :count="4"
                            time="11:12"
                            channel="form"
                            unread
                            active />

                        <x-templates.inbox.thread
                            ref="NS-4468"
                            from="Kenta Mori"
                            company="Osaka Roast Supply"
                            subject="Batch 40 landed — 48 units, no invoice in the crate"
                            preview="Accounts cannot pay against a packing slip."
                            :tags="[['label' => 'Dealer', 'tone' => 'dealer']]"
                            :minutes="80"
                            assignee="Idris Bahar"
                            :count="5"
                            time="10:04" />

                        <x-templates.inbox.thread
                            ref="NS-4455"
                            from="Marta Nowak"
                            subject="Refund, day 12 of 14"
                            preview="Nothing wrong with it. It is louder than my flat allows at 6am."
                            :tags="[['label' => 'Refund', 'tone' => 'plain']]"
                            assignee="Hana Okabe"
                            :count="4"
                            time="Tue"
                            state="waiting" />
                    </div>
                </x-demo>

                <x-demo title="Four ways to say something" padding="p-8"
                    description="What they wrote, what we sent, what we said to each other, and what the system did on its own. The note is dashed and yellow because it is the one that must never leave the building by accident."
                    :code="$messageCode" :vue-code="$messageVueCode" :react-code="$messageReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-4">
                        <x-templates.inbox.message kind="event" time="Tue 08:41">Web form · routed to Unassigned</x-templates.inbox.message>

                        <x-templates.inbox.message kind="inbound" author="Tomás Ferreira" time="Tue 08:41"
                            :attachments="[['name' => 'grinder-1800rpm.m4a', 'size' => '1.2 MB']]">
                            <p>Three weeks old and it has started screaming past halfway on the dial. Is this the burrs bedding in, or is something actually wrong?</p>
                        </x-templates.inbox.message>

                        <x-templates.inbox.message kind="note" author="Lena Kohler" role="bench test" time="Tue 09:41">
                            <p>Batch 40, yes. Seat depth is 0.15 shallow across the run, so the top burr sits proud and touches once the load comes on.</p>
                        </x-templates.inbox.message>

                        <x-templates.inbox.message kind="outbound" author="Lena Kohler" role="bench test" time="Tue 10:05" seen="read Tue 10:44">
                            <p>It is ours, and we already know about it. Two ways out and both are free.</p>
                        </x-templates.inbox.message>
                    </div>
                </x-demo>

                <x-demo title="The reply clock" padding="p-8"
                    description="Four hours is what the contact form promises, so four hours is what the bar measures. Nothing here is a percentage of anything abstract — it is the promise, and how much of it is left."
                    :code="$clockCode" :vue-code="$clockVueCode" :react-code="$clockReactCode">
                    <div class="flex w-full max-w-lg flex-col gap-3">
                        @foreach ([[185, 'answered inside the hour, most days'], [55, 'the amber hour — someone should pick this up'], [-40, 'the promise is gone, and the desk says so']] as [$minutes, $note])
                            <div class="flex items-center gap-4 rounded-xl border border-white/8 bg-ink-950 px-4 py-3">
                                <x-templates.inbox.clock :minutes="$minutes" bar />
                                <span class="ml-auto text-right font-mono text-[10px] text-zinc-700">{{ $note }}</span>
                            </div>
                        @endforeach
                    </div>
                </x-demo>

                <x-demo title="Faces and tags" padding="p-8"
                    description="Customers get a dashed square, the desk gets a filled circle. You never have to read the name to know which side of the conversation someone is on, and no photographs are needed for a workshop of four."
                    :code="$faceCode" :vue-code="$faceVueCode" :react-code="$faceReactCode">
                    <div class="flex w-full max-w-xl flex-col gap-6">
                        <div class="flex flex-wrap items-center gap-6">
                            <div class="flex items-center gap-2.5">
                                <x-templates.inbox.avatar name="Tomás Ferreira" size="md" kind="customer" />
                                <span class="font-mono text-[11px] text-zinc-600">outside</span>
                            </div>
                            @foreach (['Hana Okabe', 'Lena Kohler', 'Idris Bahar'] as $person)
                                <div class="flex items-center gap-2.5">
                                    <x-templates.inbox.avatar :name="$person" size="md" />
                                    <span class="font-mono text-[11px] text-zinc-600">{{ Illuminate\Support\Str::before($person, ' ') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex flex-wrap items-center gap-2">
                            @foreach ([['Warranty', 'warranty'], ['Escalated', 'escalated'], ['Batch 40', 'order'], ['Dealer', 'dealer'], ['Parts', 'plain'], ['Closed', 'quiet']] as [$label, $tone])
                                <x-templates.inbox.tag :label="$label" :tone="$tone" />
                            @endforeach
                        </div>

                        <div class="flex items-end gap-4">
                            @foreach (['xs', 'sm', 'md', 'lg'] as $size)
                                <div class="flex flex-col items-center gap-1.5">
                                    <x-templates.inbox.avatar name="Hana Okabe" :size="$size" />
                                    <span class="font-mono text-[10px] text-zinc-700">{{ $size }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Canned replies that fill themselves" padding="p-8"
                    description="A macro is a string with holes in it. The desk already knows the name, the serial and the lead time, so the holes close on the way in — and what lands in the box is something you would have typed anyway."
                    :code="$macroCode" :vue-code="$macroVueCode" :react-code="$macroReactCode">
                    <div data-macro-demo class="flex w-full max-w-xl flex-col gap-3">
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($demoMacros as $macro)
                                <button type="button" data-demo-macro="{{ $macro['slug'] }}"
                                    class="rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/50 data-picked:border-jade-500/60 data-picked:bg-jade-500/10 data-picked:text-jade-300">{{ $macro['name'] }}</button>
                            @endforeach

                            <label class="ml-auto flex cursor-pointer items-center gap-2 rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:text-jade-300">
                                <input type="checkbox" data-demo-fill checked class="sr-only">
                                fill the blanks
                            </label>
                        </div>

                        @foreach ($demoMacros as $macro)
                            <span class="hidden" data-demo-body="{{ $macro['slug'] }}" data-body="{{ $macro['body'] }}"></span>
                        @endforeach

                        <textarea rows="6" data-demo-output readonly
                            class="w-full resize-none rounded-xl border border-white/10 bg-ink-950 px-3.5 py-3 text-[13px]/6 text-zinc-300 focus:outline-none"
                            placeholder="Pick one."></textarea>
                    </div>

                    <script>
                        (() => {
                            const demo = document.querySelector('[data-macro-demo]');

                            if (!demo) {
                                return;
                            }

                            const output = demo.querySelector('[data-demo-output]');
                            const toggle = demo.querySelector('[data-demo-fill]');

                            const values = {
                                '@{{first_name}}': 'Tomás',
                                '@{{serial}}': 'NS-B40-0117',
                                '@{{eta}}': '3 working days',
                            };

                            let picked = null;

                            const render = () => {
                                if (!picked) {
                                    return;
                                }

                                const raw = demo.querySelector(`[data-demo-body="${picked}"]`).dataset.body;

                                output.value = toggle.checked
                                    ? Object.entries(values).reduce((filled, [token, value]) => filled.split(token).join(value), raw)
                                    : raw;
                            };

                            demo.querySelectorAll('[data-demo-macro]').forEach((button) => {
                                button.addEventListener('click', () => {
                                    picked = button.dataset.demoMacro;

                                    demo.querySelectorAll('[data-demo-macro]').forEach((entry) => entry.toggleAttribute('data-picked', entry === button));

                                    render();
                                });
                            });

                            toggle.addEventListener('change', render);
                        })();
                    </script>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[
                ['slug' => 'shell', 'name' => 'Desk shell'],
                ['slug' => 'thread', 'name' => 'Thread row'],
                ['slug' => 'message', 'name' => 'Message'],
                ['slug' => 'clock', 'name' => 'Reply clock'],
                ['slug' => 'tag', 'name' => 'Tag'],
                ['slug' => 'avatar', 'name' => 'Avatar'],
            ]"
            description="Each screen ships its own source under its preview. These six are what all four share. The clock takes minutes and nothing else — wire it to whatever your backend calls a due date and the colours follow."
            :components="['button', 'search', 'textarea', 'chip', 'avatar']" />
    </div>
</x-layout>
