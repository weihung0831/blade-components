@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/contact/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/contact/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/contact/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $routeCode = <<<'BLADE'
    <x-templates.contact.route
        name="Warranty and repairs"
        lead="It arrived broken, or it has started making a noise it did not make in March."
        person="Ines"
        reply="47 min"
        window="09:30–18:30 Mon–Fri"
        :bring="['serial', 'a ten-second clip']"
        :open="false"
        active />

    {{-- the median is measured, so the card can be wrong in public and get fixed --}}
    BLADE;

    $routeVueCode = <<<'VUE'
    <ContactRoute v-for="(entry, index) in routes" :key="entry.name" v-bind="entry" :active="index === 0" />
    VUE;

    $routeReactCode = <<<'REACT'
    {ROUTES.map((entry, index) => <ContactRoute key={entry.name} {...entry} active={index === 0} />)}
    REACT;

    $hoursCode = <<<'BLADE'
    <x-templates.contact.hours
        zone="Taipei" time="04:12" :cursor="4.2" state="shut"
        :windows="[[9.5, 18.5]]"
        note="Mail is read 09:30–18:30, Mon–Fri" />

    {{-- hours are floats, so 09:30 is 9.5 and the band and the marker share one scale --}}
    <span class="absolute inset-y-0" style="left: {{ $from / 24 * 100 }}%; width: {{ ($to - $from) / 24 * 100 }}%"></span>
    BLADE;

    $hoursVueCode = <<<'VUE'
    <ContactHours :cursor="4.2" state="shut" :windows="[[9.5, 18.5]]" note="Tue–Thu only" />

    const at = (hour) => `${(hour / 24 * 100).toFixed(3)}%`;
    VUE;

    $hoursReactCode = <<<'REACT'
    <ContactHours cursor={4.2} state="shut" windows={[[9.5, 18.5]]} note="Tue–Thu only" />

    const at = (hour) => `${(hour / 24 * 100).toFixed(3)}%`;
    REACT;

    $promiseCode = <<<'BLADE'
    <x-templates.contact.promise
        sent="02:41" due="10:20"
        :shut="409" :worked="0" :left="50"
        lead="is when a warranty letter with a serial in it usually has a reply" />

    {{-- the hatched run is the shut hours; it is drawn, not subtracted, so the wait stays honest --}}
    BLADE;

    $promiseVueCode = <<<'VUE'
    <ContactPromise sent="02:41" due="10:20" :shut="409" :worked="0" :left="50" />

    const span = (minutes) => `${(minutes / total.value * 100).toFixed(3)}%`;
    VUE;

    $promiseReactCode = <<<'REACT'
    <ContactPromise sent="02:41" due="10:20" shut={409} worked={0} left={50} />

    const span = (minutes) => `${(minutes / total * 100).toFixed(3)}%`;
    REACT;

    $fieldCode = <<<'BLADE'
    <x-templates.contact.field
        label="Serial" mono placeholder="NS-B40-0117"
        hint="Plate under the base, six digits after NS-B." />

    <x-templates.contact.person
        name="Ines Marto" initials="IM" role="builds them"
        hours="at the bench 09:30–18:30" here />

    {{-- pass a slot and the field keeps the label and hint but hands you the control --}}
    <x-templates.contact.field label="What happened">
        <textarea data-message rows="5"></textarea>
    </x-templates.contact.field>
    BLADE;

    $fieldVueCode = <<<'VUE'
    <ContactField v-model="serial" label="Serial" mono placeholder="NS-B40-0117" />

    <ContactField label="What happened">
        <textarea v-model="message" rows="5"></textarea>
    </ContactField>
    VUE;

    $fieldReactCode = <<<'REACT'
    <ContactField label="Serial" value={serial} onChange={setSerial} mono placeholder="NS-B40-0117" />

    <ContactField label="What happened">
        <textarea value={message} onChange={(event) => setMessage(event.target.value)} rows={5} />
    </ContactField>
    REACT;

    $placeCode = <<<'BLADE'
    <x-templates.contact.place
        map
        name="The workshop"
        :lines="['No. 12, Ln. 44, Sec. 3, Bade Rd', 'Songshan District, Taipei 105']"
        :hours="[['when' => 'Tue and Thu', 'what' => '14:00–18:00 — counter open, walk in']]"
        :travel="[['mode' => 'MRT', 'detail' => 'Nanjing Fuxing, exit 4. Seven minutes east.']]"
        note="Number 12 has a roller door and no plate." />

    {{-- map leaves a 2:1 hole at the top; drop a static image or an embed in and nothing else moves --}}
    <div class="flex aspect-2/1 items-center justify-center rounded-lg border border-dashed border-white/12">
        <span class="font-mono text-[10px] text-zinc-700">{{ $mapLabel }}</span>
    </div>
    BLADE;

    $placeVueCode = <<<'VUE'
    <ContactPlace map name="The workshop" :lines="lines" :hours="workshopHours" :travel="travel" />

    <ContactPlace v-for="entry in elsewhere" :key="entry.name" v-bind="entry" />
    VUE;

    $placeReactCode = <<<'REACT'
    <ContactPlace map name="The workshop" lines={LINES} hours={WORKSHOP_HOURS} travel={TRAVEL} />

    {ELSEWHERE.map((entry) => <ContactPlace key={entry.name} {...entry} />)}
    REACT;
@endphp

<x-layout title="Contact template — BLADE-COMPONENTS">
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
                    Where the <span class="text-zinc-300">FAQ</span> gives up, this takes over. Every screen carries the same
                    awkward fact — it is 04:12 at the workshop and nobody is going to read your letter until half past nine.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Pick a different reason on the form and it grows a different set of fields, with the name of whoever gets it. The receipt counts down in working hours, so the six hours the bench is shut are hatched out rather than quietly counted.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Seven parts. Three of them are just clocks, which is what a contact page mostly is once you stop calling the wait a promise.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Route card" padding="p-8"
                    description="A category name tells you nothing about whether your problem lives in it. This one carries the person who reads it, the hours they read in, and the median that actually came out of the last ninety days — which means the card can be visibly wrong, and get fixed."
                    :code="$routeCode" :vue-code="$routeVueCode" :react-code="$routeReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-3 sm:grid-cols-2">
                        <x-templates.contact.route
                            name="Warranty and repairs"
                            lead="It arrived broken, it stopped working, or it has started making a noise it did not make in March."
                            person="Ines"
                            reply="47 min"
                            window="09:30–18:30 Mon–Fri"
                            :bring="['serial', 'a ten-second clip']"
                            active />

                        <x-templates.contact.route
                            name="Orders and delivery"
                            lead="Where the parcel is, and the ones customs has sat on for nine days."
                            person="Ping"
                            reply="2 h"
                            window="09:00–18:00 Mon–Sat"
                            :bring="['order number']"
                            open />
                    </div>
                </x-demo>

                <x-demo title="A day, and where you are in it" padding="p-8"
                    description="Twenty-four hours drawn end to end, the watched window filled in, and a hairline for now. Three of these on one site say more than a table of opening hours, because the reader never has to work out what their own clock means."
                    :code="$hoursCode" :vue-code="$hoursVueCode" :react-code="$hoursReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-5">
                        <x-templates.contact.hours zone="Taipei" time="04:12" :cursor="4.2" state="shut" :windows="[[9.5, 18.5]]" note="Mail, Mon–Fri" />
                        <x-templates.contact.hours zone="Taipei" time="15:04" :cursor="15.07" state="open" :windows="[[14, 17]]" note="Telephone, Tue–Thu" />
                        <x-templates.contact.hours zone="Taipei" time="09:18" :cursor="9.3" state="soon" :windows="[[9.5, 18.5]]" note="Twelve minutes off" />
                    </div>
                </x-demo>

                <x-demo title="The wait, hatched where it does not count" padding="p-8"
                    description="Eight hours between sending and the answer, and six and a half of them are the workshop being shut. Hatching that run rather than deleting it keeps both facts on screen: how long you waited, and how much of it anybody could have done something about."
                    :code="$promiseCode" :vue-code="$promiseVueCode" :react-code="$promiseReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-3">
                        <x-templates.contact.promise sent="02:41" due="10:20" :shut="409" :worked="0" :left="50" lead="is when a warranty letter with a serial in it usually has a reply" />
                        <x-templates.contact.promise sent="11:20" due="12:07" :shut="0" :worked="34" :left="13" lead="and the clock has been running the whole time" />
                    </div>
                </x-demo>

                <x-demo title="A field, and the desk it lands on" padding="p-8"
                    description="The field is a label, a hint and a control, and it will hand the control back to you through the slot when a textarea needs its own behaviour. The person card next to it is the reason the form asks what the letter is about before it asks anything else."
                    :code="$fieldCode" :vue-code="$fieldVueCode" :react-code="$fieldReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="flex flex-col gap-4">
                            <x-templates.contact.field label="Serial" mono placeholder="NS-B40-0117" hint="Plate under the base, six digits after NS-B." />
                            <x-templates.contact.field label="Where to write back" type="email" value="tomas@ferreira.pt" note="we reply here" />
                        </div>

                        <div class="flex flex-col gap-5 rounded-xl border border-white/8 bg-ink-950 p-4">
                            <x-templates.contact.person name="Ines Marto" initials="IM" role="builds them" handles="Warranty, repairs, dealer terms." hours="at the bench 09:30–18:30" here />
                            <x-templates.contact.person name="Sofia Reis" initials="SR" role="writes it down" handles="Press, the help centre, and the manual." hours="part time, Mon Wed Fri" />
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Address card" padding="p-8"
                    description="The picture is left as a hole: a 2:1 slot at the top, waiting for whatever you would rather put there — a static image, a tile embed, a photograph of the corner. Nothing under it depends on the choice, and out of the box the card pulls in no third party at all."
                    :code="$placeCode" :vue-code="$placeVueCode" :react-code="$placeReactCode">
                    <div class="w-full max-w-md">
                        <x-templates.contact.place
                            map
                            name="The workshop"
                            tag="the bench"
                            :lines="['No. 12, Ln. 44, Sec. 3, Bade Rd', 'Songshan District, Taipei 105']"
                            :hours="[
                                ['when' => 'Tue and Thu', 'what' => '14:00–18:00 — counter open, walk in'],
                                ['when' => 'Saturday', 'what' => '10:00–13:00 — collection only'],
                            ]"
                            :travel="[['mode' => 'MRT', 'detail' => 'Nanjing Fuxing, exit 4. Left onto Bade, seven minutes east.']]"
                            note="Number 12 has a roller door and no plate. A noodle shop means you have gone twenty metres too far." />
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
                ['slug' => 'shell', 'name' => 'Contact shell'],
                ['slug' => 'route', 'name' => 'Route card'],
                ['slug' => 'hours', 'name' => 'Opening hours'],
                ['slug' => 'person', 'name' => 'Person'],
                ['slug' => 'field', 'name' => 'Field'],
                ['slug' => 'promise', 'name' => 'Reply clock'],
                ['slug' => 'place', 'name' => 'Address and map'],
            ]"
            description="Each screen ships its own source under its preview. These seven are what all four share. Nothing here fetches a map tile or a font, so the page has no third party in it at all."
            :components="['input', 'textarea', 'file-upload', 'timeline', 'badge']" />
    </div>
</x-layout>
