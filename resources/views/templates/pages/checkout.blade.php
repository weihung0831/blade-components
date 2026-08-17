@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/checkout/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/checkout/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/checkout/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $demoLines = [
        ['sku' => 'EG83-GRA', 'name' => 'EG-83 grinder', 'option' => 'graphite', 'price' => 1180, 'qty' => 1],
        ['sku' => 'CUP-58', 'name' => 'Dosing cup, 58 mm', 'option' => 'stainless', 'price' => 36, 'qty' => 2],
    ];

    $demoInvoices = [
        ['value' => 'mobile', 'label' => 'Carrier barcode', 'detail' => 'Goes to the phone, nothing printed.'],
        ['value' => 'company', 'label' => 'Company tax ID', 'detail' => 'Triplicate invoice for a company.'],
        ['value' => 'donate', 'label' => 'Donate it', 'detail' => 'Donation code, sent straight on.'],
    ];

    $lineCode = <<<'BLADE'
    <x-templates.checkout.line-item
        sku="CUP-58"
        name="Dosing cup, 58 mm"
        option="stainless, magnetic base"
        :price="36"
        :qty="2"
        :max="6"
        meta="In stock, Taichung."
        editable />

    {{-- the screen owns the arithmetic --}}
    <script>
        root.addEventListener('click', (event) => {
            const step = event.target.closest('[data-qty-step]');

            if (step) {
                const line = step.closest('[data-line-item]');
                setQty(line, Number(line.dataset.qty) + Number(step.dataset.qtyStep));
            }
        });
    </script>
    BLADE;

    $lineVueCode = <<<'VUE'
    <CheckoutLineItem
        :item="item"
        editable
        @step="(delta) => step(item, delta)"
        @remove="setQty(item.sku, 0)"
    />
    VUE;

    $lineReactCode = <<<'REACT'
    <CheckoutLineItem
        item={item}
        editable
        onStep={(delta) => setQty(item.sku, item.qty + delta)}
        onRemove={() => setQty(item.sku, 0)}
    />
    REACT;

    $summaryCode = <<<'BLADE'
    <x-templates.checkout.ship-option value="standard" label="Home delivery, T-Cat"
        :price="0" eta="arrives Thu 20 – Mon 24 Aug" checked />

    <x-templates.checkout.summary :discount="128" discount-label="BENCH10" cta="Continue to delivery">
        <x-templates.checkout.line-item sku="EG83-GRA" name="EG-83 grinder" :price="1180" :qty="1" />
    </x-templates.checkout.summary>

    {{-- the radio writes data-ship on the shell, the summary reads it back --}}
    <script>
        const SHIPPING = {
            standard: { cost: 0, label: 'free', eta: 'arrives Thu 20 – Mon 24 Aug' },
            express: { cost: 18, label: '$18', eta: 'arrives tomorrow, Tue 18 Aug' },
        };

        document.addEventListener('change', (event) => {
            const input = event.target.closest('[data-ship-set]');

            if (input) {
                input.closest('[data-ship]').dataset.ship = input.dataset.shipSet;
            }
        });
    </script>
    BLADE;

    $summaryVueCode = <<<'VUE'
    <CheckoutShipOption v-model="ship" value="standard" label="Home delivery, T-Cat"
        :price="0" eta="arrives Thu 20 – Mon 24 Aug" />

    <CheckoutSummary :items="items" :ship="ship" :discount="128" discount-label="BENCH10" cta="Continue to delivery" />
    VUE;

    $summaryReactCode = <<<'REACT'
    <CheckoutShipOption value="standard" label="Home delivery, T-Cat" price={0}
        eta="arrives Thu 20 – Mon 24 Aug" checked={ship === 'standard'} onSelect={setShip} />

    <CheckoutSummary items={items} ship={ship} discount={128} discountLabel="BENCH10" cta="Continue to delivery" />
    REACT;

    $cardCode = <<<'BLADE'
    <x-templates.checkout.card-field value="4571 2000 1234 3092"
        hint="Test card. Nothing here reaches a real processor." />

    <script>
        const BRANDS = [
            { name: 'visa', test: /^4/ },
            { name: 'mastercard', test: /^5[1-5]/ },
            { name: 'jcb', test: /^35/ },
        ];

        const digits = input.value.replace(/\D/g, '').slice(0, 19);

        input.value = digits.replace(/(.{4})/g, '$1 ').trim();
        badge.textContent = BRANDS.find((brand) => brand.test.test(digits))?.name ?? 'card';
    </script>
    BLADE;

    $cardVueCode = <<<'VUE'
    <CheckoutCardField v-model="card" hint="Test card. Nothing here reaches a real processor." />
    VUE;

    $cardReactCode = <<<'REACT'
    <CheckoutCardField value={card} onChange={setCard} hint="Test card. Nothing here reaches a real processor." />
    REACT;

    $railCode = <<<'BLADE'
    {{-- $index = array_search($active, array_column($steps, 'label'), true); --}}
    {{-- $current = $index === false ? 1 : $index + 1; --}}

    <a href="{{ route('templates.screen', ['checkout', $step['screen']]) }}"
        @if ($number === $current) aria-current="step" @endif
        @class(['flex items-center gap-2.5 rounded-lg px-2.5 py-1.5', 'bg-white/8' => $number === $current])>
        <span @class([
            'grid size-6 place-items-center rounded-full font-mono text-[11px]',
            'bg-jade-500 text-ink-950' => $number < $current,
            'border border-jade-500 text-jade-400' => $number === $current,
            'border border-white/15 text-zinc-600' => $number > $current,
        ])>{{ $number < $current ? '✓' : $number }}</span>
        <span>{{ $step['label'] }}</span>
    </a>
    BLADE;

    $railVueCode = <<<'VUE'
    const current = computed(() => {
        const index = steps.findIndex((step) => step.label === props.active);

        return index === -1 ? 1 : index + 1;
    });

    const markerClasses = (number) => {
        if (number < current.value) {
            return 'bg-jade-500 text-ink-950';
        }

        return number === current.value ? 'border border-jade-500 text-jade-400' : 'border border-white/15 text-zinc-600';
    };
    VUE;

    $railReactCode = <<<'REACT'
    const index = steps.findIndex((step) => step.label === active);
    const current = index === -1 ? 1 : index + 1;

    const markerClasses = (number, current) => {
        if (number < current) {
            return 'bg-jade-500 text-ink-950';
        }

        return number === current ? 'border border-jade-500 text-jade-400' : 'border border-white/15 text-zinc-600';
    };
    REACT;

    $invoiceCode = <<<'BLADE'
    <section data-invoice="mobile" class="group/inv">
        <label class="... has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
            <input type="radio" name="invoice" value="company" data-invoice-set="company" class="peer sr-only">
            <span>Company tax ID</span>
        </label>

        <div class="hidden group-data-[invoice=company]/inv:block">
            <x-ui.input label="Tax ID number" placeholder="24681357" />
        </div>
    </section>

    <script>
        root.addEventListener('change', (event) => {
            const input = event.target.closest('[data-invoice-set]');

            if (input) {
                input.closest('[data-invoice]').dataset.invoice = input.dataset.invoiceSet;
            }
        });
    </script>
    BLADE;

    $invoiceVueCode = <<<'VUE'
    <label v-for="option in invoices" :key="option.value" class="... has-[:checked]:border-jade-500/50">
        <input v-model="invoice" type="radio" name="invoice" :value="option.value" class="peer sr-only" />
        <span>{{ option.label }}</span>
    </label>

    <div v-if="invoice === 'company'">
        <UiInput label="Tax ID number" placeholder="24681357" />
    </div>
    VUE;

    $invoiceReactCode = <<<'REACT'
    {invoices.map((option) => (
        <label key={option.value} className="... has-[:checked]:border-jade-500/50">
            <input
                type="radio"
                name="invoice"
                value={option.value}
                checked={invoice === option.value}
                onChange={() => setInvoice(option.value)}
                className="peer sr-only"
            />
            <span>{option.label}</span>
        </label>
    ))}

    {invoice === 'company' && <UiInput label="Tax ID number" placeholder="24681357" />}
    REACT;
@endphp

<x-layout title="Checkout template — BLADE-COMPONENTS">
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
                    The four screens that take the grinder from the <span class="text-zinc-300">Product page</span> template to a receipt.
                    One order runs through all of them, and the total is worked out from the line items rather than typed in.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Live, not screenshots. Change a quantity on the cart or pick a different courier on delivery — the totals, the dates, and what payment offers all move with it.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The five parts the screens are built from. Every price on this page comes out of the same arithmetic.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Line item" padding="p-8"
                    description="Thumbnail, options, a quantity that moves the total, and the unit price that only shows itself once there is more than one."
                    :code="$lineCode" :vue-code="$lineVueCode" :react-code="$lineReactCode">
                    <div class="w-full max-w-xl rounded-xl border border-white/8 bg-ink-900 px-5">
                        <x-templates.checkout.line-item
                            sku="CUP-58"
                            name="Dosing cup, 58 mm"
                            option="stainless, magnetic base"
                            :price="36"
                            :qty="2"
                            :max="6"
                            meta="In stock, Taichung."
                            editable />
                    </div>
                </x-demo>

                <x-demo title="Shipping switch and summary" padding="p-8"
                    description="The courier writes one attribute on the shell. Freight, the arrival window, and the total are read back from it — no price is written twice."
                    :code="$summaryCode" :vue-code="$summaryVueCode" :react-code="$summaryReactCode">
                    <div class="group/shell flex w-full max-w-sm flex-col gap-3" data-ship="standard">
                        <x-templates.checkout.ship-option value="standard" label="Home delivery, T-Cat"
                            :price="0" eta="arrives Thu 20 – Mon 24 Aug" checked />

                        <x-templates.checkout.ship-option value="express" label="Next day, before noon"
                            :price="18" eta="arrives tomorrow, Tue 18 Aug" />

                        <x-templates.checkout.summary :discount="128" discount-label="BENCH10">
                            @foreach ($demoLines as $line)
                                <x-templates.checkout.line-item
                                    :sku="$line['sku']"
                                    :name="$line['name']"
                                    :option="$line['option']"
                                    :price="$line['price']"
                                    :qty="$line['qty']" />
                            @endforeach
                        </x-templates.checkout.summary>
                    </div>
                </x-demo>

                <x-demo title="Card field" padding="p-8"
                    description="Groups the digits as you type and names the brand from the first two. Type a 35 in front and it becomes JCB — which is what half of Taiwan pays with."
                    :code="$cardCode" :vue-code="$cardVueCode" :react-code="$cardReactCode">
                    <div class="w-full max-w-sm">
                        <x-templates.checkout.card-field value="4571 2000 1234 3092"
                            hint="Test card. Nothing here reaches a real processor." />
                    </div>
                </x-demo>

                <x-demo title="Step rail" padding="p-8"
                    description="Four steps, each one a link. Done steps carry a tick, the current one an outline, and the ones ahead stay dim without being disabled."
                    :code="$railCode" :vue-code="$railVueCode" :react-code="$railReactCode">
                    <div class="w-full max-w-xl overflow-x-auto rounded-xl border border-white/8 bg-ink-950 px-4 py-2.5">
                        <ol class="flex items-stretch gap-1">
                            @foreach ([['Cart', 'one box'], ['Delivery', 'address'], ['Payment', 'card'], ['Done', 'receipt']] as $index => $step)
                                @php $number = $index + 1; @endphp
                                <li class="flex shrink-0 items-center gap-1">
                                    <span @class(['flex items-center gap-2.5 rounded-lg px-2.5 py-1.5', 'bg-white/8' => $number === 2])>
                                        <span @class([
                                            'grid size-6 shrink-0 place-items-center rounded-full font-mono text-[11px]',
                                            'bg-jade-500 text-ink-950' => $number < 2,
                                            'border border-jade-500 text-jade-400' => $number === 2,
                                            'border border-white/15 text-zinc-600' => $number > 2,
                                        ])>
                                            @if ($number < 2)
                                                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            @else
                                                {{ $number }}
                                            @endif
                                        </span>
                                        <span class="flex flex-col">
                                            <span @class(['text-[13px]/4', 'text-cream' => $number === 2, 'text-zinc-400' => $number < 2, 'text-zinc-600' => $number > 2])>{{ $step[0] }}</span>
                                            <span class="font-mono text-[10px] text-zinc-600">{{ $step[1] }}</span>
                                        </span>
                                    </span>

                                    @if ($number < 4)
                                        <span aria-hidden="true" @class(['h-px w-5 shrink-0', 'bg-jade-500/50' => $number < 2, 'bg-white/10' => $number >= 2])></span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </x-demo>

                <x-demo title="E-invoice picker" padding="p-8"
                    description="The part a Taiwanese checkout cannot skip. Picking one reveals only the field it needs — a carrier barcode, a company number, or a donation code."
                    :code="$invoiceCode" :vue-code="$invoiceVueCode" :react-code="$invoiceReactCode">
                    <div data-invoice="mobile" class="group/inv w-full max-w-xl">
                        <div class="grid gap-3 sm:grid-cols-3">
                            @foreach ($demoInvoices as $invoice)
                                <label class="flex cursor-pointer items-start gap-2.5 rounded-xl border border-white/10 bg-ink-950 p-3.5 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
                                    <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                                        <input type="radio" name="demo-invoice" value="{{ $invoice['value'] }}" data-invoice-set="{{ $invoice['value'] }}" @checked($loop->first)
                                            class="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                        <span class="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
                                    </span>

                                    <span class="flex min-w-0 flex-col gap-0.5">
                                        <span class="text-[13px]/5 text-zinc-200">{{ $invoice['label'] }}</span>
                                        <span class="text-xs/5 text-zinc-500">{{ $invoice['detail'] }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        <div class="mt-4 hidden group-data-[invoice=mobile]/inv:block">
                            <x-ui.input label="Carrier code" value="/ABC+123" class="font-mono" hint="Eight characters, starts with a slash." />
                        </div>

                        <div class="mt-4 hidden group-data-[invoice=company]/inv:block">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <x-ui.input label="Tax ID number" placeholder="24681357" inputmode="numeric" class="font-mono" />
                                <x-ui.input label="Company name" placeholder="Nomad Coffee Ltd" />
                            </div>
                        </div>

                        <div class="mt-4 hidden group-data-[invoice=donate]/inv:block">
                            <x-ui.input label="Donation code" value="25885" class="font-mono" hint="Default is the Genesis Foundation. Any registered code works." />
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
                ['slug' => 'shell', 'name' => 'Checkout shell'],
                ['slug' => 'summary', 'name' => 'Order summary'],
                ['slug' => 'line-item', 'name' => 'Line item'],
                ['slug' => 'ship-option', 'name' => 'Shipping option'],
                ['slug' => 'card-field', 'name' => 'Card field'],
            ]"
            description="Each screen ships its own source under its preview. These five are what all four share — the shell carries the delivery method, so paste it first."
            :components="['button', 'input', 'textarea', 'select', 'checkbox', 'radio', 'separator', 'timeline', 'scroll-top']" />
    </div>
</x-layout>
