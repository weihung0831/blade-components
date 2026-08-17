@php
    $highlights = [
        [
            'title' => 'It holds a number',
            'body' => 'The dial clicks into 120 detents and the burr carrier is preloaded against a wave washer, so step 42 is the same grind on Monday as it was on Friday.',
            'meta' => '±1.5 µm across a 30-shot session',
        ],
        [
            'title' => 'It gives the dose back',
            'body' => 'A 12° chute, a knocker on the exit, and an anti-static ring. Weigh in 18 g and 17.9 g lands in the cup on the first try.',
            'meta' => 'under 0.1 g retained',
        ],
        [
            'title' => 'It opens with two screws',
            'body' => 'Burrs come out in about a minute with the tool in the box. Alignment shims, brush, and a spare washer are stocked as parts, not as a service plan.',
            'meta' => 'parts listed for 10 years',
        ],
    ];

    $quickSpecs = [
        ['label' => 'Burrs', 'value' => '83 mm flat'],
        ['label' => 'Steps', 'value' => '0–120'],
        ['label' => 'Per step', 'value' => '8.5 µm'],
        ['label' => 'Motor', 'value' => '250 W DC'],
        ['label' => 'Noise', 'value' => '62 dB(A)'],
        ['label' => 'Weight', 'value' => '4.8 kg'],
    ];

    $faq = [
        ['title' => 'Espresso and filter on the same grinder?', 'content' => 'Yes, and without swapping burrs. Steps 8–24 cover espresso, 40–70 covers pour over, 90+ goes coarse enough for a press. Crossing the whole range takes about two turns of the dial.', 'open' => true],
        ['title' => 'How loud is it next to a sleeping flat?', 'content' => '62 dB(A) measured a metre away, running empty. A shot dose is roughly seven seconds of that, which lands somewhere between a fridge compressor and a hair dryer at its lowest setting.'],
        ['title' => 'What is the lead time on Jade?', 'content' => 'Jade is anodised in batches of 60. The current batch closes on the 4th and ships from Taichung around three weeks later. You are charged when it ships, not when you order.'],
        ['title' => 'Can I put it on 110 V later?', 'content' => 'The board takes 100–240 V and the plug is swappable, so moving countries means a new cable, not a new grinder. Tell us the region at checkout and the right cable goes in the box.'],
    ];

    $together = [
        ['name' => 'Single-dose hopper', 'price' => '$64', 'meta' => 'ships with the grinder'],
        ['name' => 'Alignment shim kit', 'price' => '$28', 'meta' => '0.05 mm, 0.1 mm, 0.2 mm'],
        ['name' => 'Dosing cup, 58 mm', 'price' => '$36', 'meta' => 'stainless, magnetic base'],
    ];
@endphp

<x-templates.product.shell active="Overview">
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-mono text-[11px] text-zinc-600">
        <a href="#" class="transition-colors duration-150 hover:text-zinc-400">Home</a>
        <span>/</span>
        <a href="#" class="transition-colors duration-150 hover:text-zinc-400">Grinders</a>
        <span>/</span>
        <span class="text-zinc-400">EG-83</span>
    </nav>

    <div class="mt-6 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_23rem]">
        <x-templates.product.gallery />

        <div class="flex flex-col">
            <div class="flex flex-wrap items-center gap-2">
                <x-ui.badge variant="dot" color="jade" class="font-mono text-[11px]">
                    <span class="hidden group-data-[finish=graphite]/shell:inline">12 in stock · ships tomorrow</span>
                    <span class="hidden group-data-[finish=cream]/shell:inline">4 in stock · ships tomorrow</span>
                    <span class="hidden group-data-[finish=jade]/shell:inline">pre-order · batch 07 ships in March</span>
                </x-ui.badge>
                <span class="font-mono text-[11px] text-zinc-600">SKU EG83-<span class="hidden group-data-[finish=graphite]/shell:inline">GRA</span><span class="hidden group-data-[finish=cream]/shell:inline">CRM</span><span class="hidden group-data-[finish=jade]/shell:inline">JDE</span></span>
            </div>

            <h1 class="mt-3 text-3xl font-semibold tracking-tight text-cream">NOMAD EG-83</h1>
            <p class="mt-1.5 text-sm/6 text-zinc-500">An 83 mm flat burr grinder for a bar that runs espresso all morning and filter all afternoon, without a second machine on the counter.</p>

            <a href="{{ route('templates.screen', ['product', 'reviews']) }}" target="_top"
                class="mt-4 inline-flex w-fit items-center gap-2.5 rounded-lg py-1 transition-opacity duration-150 hover:opacity-80">
                <x-ui.rating :value="4.8" readonly />
                <span class="font-mono text-[11px] text-zinc-500">312 reviews</span>
            </a>

            <div class="mt-6 flex items-baseline gap-2">
                <span class="text-3xl font-semibold tracking-tight text-cream">
                    <span class="group-data-[finish=jade]/shell:hidden">$1,180</span>
                    <span class="hidden group-data-[finish=jade]/shell:inline">$1,300</span>
                </span>
                <span class="font-mono text-xs text-zinc-600">incl. tax</span>
            </div>
            <p class="mt-1.5 font-mono text-[11px] text-zinc-600">
                or 6 × <span class="group-data-[finish=jade]/shell:hidden">$196.67</span><span class="hidden group-data-[finish=jade]/shell:inline">$216.67</span> at 0% · no fee, no credit check
            </p>

            <div class="mt-6">
                <div class="flex items-baseline justify-between gap-3">
                    <span class="text-[13px] text-zinc-300">Finish</span>
                    <span class="font-mono text-[10px] text-zinc-600">anodised, not painted</span>
                </div>
                <x-templates.product.finish-picker detailed class="mt-2.5" />
            </div>

            <div class="mt-6 flex items-stretch gap-2.5">
                <x-ui.input-number :value="1" :min="1" :max="9" class="w-28! shrink-0 [&_[data-ui-number]]:h-10!" />
                <x-ui.button class="h-10 flex-1">Add to cart</x-ui.button>
                <button type="button" aria-label="Save for later"
                    class="grid size-10 shrink-0 place-items-center rounded-lg border border-white/10 text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M8 13.5S2.5 10.2 2.5 6.3A3 3 0 0 1 8 4.6a3 3 0 0 1 5.5 1.7c0 3.9-5.5 7.2-5.5 7.2Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
                </button>
            </div>

            <p class="mt-3 text-center font-mono text-[10px] text-zinc-600">
                <span class="hidden group-data-[finish=jade]/shell:inline">charged when the batch ships, not now · </span>
                free express over $600
            </p>

            <x-ui.separator class="my-6" />

            <ul class="flex flex-col gap-3.5">
                <li class="flex items-start gap-3">
                    <svg class="mt-0.5 size-4 shrink-0 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M1.5 5.5h8v6h-8zM9.5 7.5h3l2 2v2h-5z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/><circle cx="4.5" cy="12.5" r="1.2" stroke="currentColor" stroke-width="1.3"/><circle cx="11.5" cy="12.5" r="1.2" stroke="currentColor" stroke-width="1.3"/></svg>
                    <p class="text-[13px]/5 text-zinc-400">Order before 15:00 and it leaves the workshop the same day. Taipei next morning, most of the island the day after.</p>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="mt-0.5 size-4 shrink-0 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M2.5 8a5.5 5.5 0 1 1 1.7 4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/><path d="M2 8.5 4 11l2.5-2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <p class="text-[13px]/5 text-zinc-400">Thirty days to change your mind, grounds in the burrs and all. We pay the courier both ways.</p>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="mt-0.5 size-4 shrink-0 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M8 1.8 13 4v4.2c0 3-2.1 5.1-5 6-2.9-.9-5-3-5-6V4l5-2.2Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                    <p class="text-[13px]/5 text-zinc-400">Two years on the machine, five on the burr set. Repairs are quoted before anyone opens anything.</p>
                </li>
            </ul>

            <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Before it ships</p>
                <p class="mt-2 text-[12px]/5 text-zinc-500">Every unit runs 400 g through it, gets the burr gap checked on a dial indicator, and leaves with the sheet signed by whoever did it. Yours is in the box.</p>
            </div>
        </div>
    </div>

    <section class="mt-14 grid gap-4 lg:grid-cols-3">
        @foreach ($highlights as $highlight)
            <article class="flex flex-col rounded-2xl border border-white/8 bg-ink-900 p-6">
                <h2 class="text-base font-medium text-cream">{{ $highlight['title'] }}</h2>
                <p class="mt-2.5 text-[13px]/6 text-zinc-500">{{ $highlight['body'] }}</p>
                <div class="grow"></div>
                <p class="mt-5 border-t border-white/5 pt-4 font-mono text-[10px] text-jade-400">{{ $highlight['meta'] }}</p>
            </article>
        @endforeach
    </section>

    <section class="mt-12 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
        <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-4">
            <h2 class="text-base font-medium text-cream">The six numbers people ask for</h2>
            <a href="{{ route('templates.screen', ['product', 'specs']) }}" target="_top"
                class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Full spec sheet →</a>
        </div>

        <div class="grid gap-px bg-white/8 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($quickSpecs as $spec)
                <div class="bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $spec['label'] }}</p>
                    <p class="mt-2 font-mono text-[15px] text-cream">{{ $spec['value'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mt-12 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_20rem]">
        <div>
            <h2 class="text-base font-medium text-cream">Asked often enough to print</h2>
            <x-ui.accordion :items="$faq" variant="outline" class="mt-4 bg-ink-900!" />
        </div>

        <div>
            <h2 class="text-base font-medium text-cream">Bought with it</h2>
            <div class="mt-4 flex flex-col divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                @foreach ($together as $item)
                    <a href="{{ route('templates.screen', ['product', 'configure']) }}" target="_top"
                        class="flex items-center gap-3 px-4 py-3 transition-colors duration-150 hover:bg-white/4">
                        <span class="min-w-0 flex-1">
                            <span class="block truncate text-[13px] text-zinc-300">{{ $item['name'] }}</span>
                            <span class="block truncate font-mono text-[10px] text-zinc-600">{{ $item['meta'] }}</span>
                        </span>
                        <span class="shrink-0 font-mono text-[13px] text-zinc-500">{{ $item['price'] }}</span>
                    </a>
                @endforeach
            </div>
            <a href="{{ route('templates.screen', ['product', 'configure']) }}" target="_top"
                class="mt-3 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Build the whole setup →</a>
        </div>
    </section>
</x-templates.product.shell>
