@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/invoice/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/invoice/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/invoice/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $paperCode = <<<'BLADE'
    <x-templates.invoice.paper
        number="INV-2026-0207"
        issued="12 August 2026"
        due="11 September 2026"
        terms="Net 30"
        reference="PO-4471">

        {{-- parties, then the table, then the totals --}}
    </x-templates.invoice.paper>

    <x-templates.invoice.stamp label="Overdue" tone="overdue" note="74 days" />
    BLADE;

    $paperVueCode = <<<'VUE'
    <InvoicePaper number="INV-2026-0207" issued="12 August 2026" due="11 September 2026" terms="Net 30">
        <slot />
    </InvoicePaper>

    <InvoiceStamp label="Overdue" tone="overdue" note="74 days" />
    VUE;

    $paperReactCode = <<<'REACT'
    <InvoicePaper number="INV-2026-0207" issued="12 August 2026" due="11 September 2026" terms="Net 30">
        {children}
    </InvoicePaper>

    <InvoiceStamp label="Overdue" tone="overdue" note="74 days" />
    REACT;

    $partyCode = <<<'BLADE'
    <x-templates.invoice.party
        role="to"
        name="Formosa Coffee Works Ltd"
        tax-id="24681357"
        :lines="['3F, No. 88, Zhongshan 2nd Rd', 'Xinxing District, Kaohsiung 800']"
        contact="accounts@formosacoffee.tw · Ms Hsu" />

    {{-- role: to, ship, from --}}
    BLADE;

    $partyVueCode = <<<'VUE'
    <InvoiceParty role="to" name="Formosa Coffee Works Ltd" tax-id="24681357" :lines="lines" contact="accounts@formosacoffee.tw" />

    const labels = { to: 'billed to', ship: 'shipped to', from: 'from' };
    VUE;

    $partyReactCode = <<<'REACT'
    <InvoiceParty role="to" name="Formosa Coffee Works Ltd" taxId="24681357" lines={LINES} contact="accounts@formosacoffee.tw" />

    const LABELS = { to: 'billed to', ship: 'shipped to', from: 'from' };
    REACT;

    $lineCode = <<<'BLADE'
    <table class="w-full border-collapse text-left">
        <tbody>
            <x-templates.invoice.line
                code="MK3-GR"
                description="Mk3 hand grinder, graphite"
                note="Batch 40. Alignment sheet in each box, signed."
                qty="40" unit="ea" price="2,940" amount="117,600"
                :show-tax="true" />
        </tbody>
    </table>
    BLADE;

    $lineVueCode = <<<'VUE'
    <InvoiceLine v-for="line in lines" :key="line.code" v-bind="line" :show-tax="showTax" />

    {{-- the whole tax column comes and goes with one ref --}}
    const showTax = ref(true);
    VUE;

    $lineReactCode = <<<'REACT'
    {LINES.map((line) => <InvoiceLine key={line.code} {...line} showTax={showTax} />)}

    const [showTax, setShowTax] = useState(true);
    REACT;

    $totalsCode = <<<'BLADE'
    <x-templates.invoice.totals
        :rows="[
            ['label' => 'Subtotal', 'value' => 'NT$241,580', 'strong' => true],
            ['label' => 'Trade discount', 'note' => '3%, over 50 machines', 'value' => '−NT$7,247'],
            ['label' => 'Business tax', 'note' => '5%, rounded to the dollar', 'value' => 'NT$11,717'],
        ]"
        total="NT$246,050"
        total-label="Total due"
        tone="due"
        words="Two hundred and forty-six thousand and fifty New Taiwan dollars." />
    BLADE;

    $totalsVueCode = <<<'VUE'
    <InvoiceTotals :rows="rows" total="NT$146,900" total-label="Still owed" tone="overdue" />

    const tones = { quiet: 'text-cream', due: 'text-jade-300', overdue: 'text-red-400' };
    VUE;

    $totalsReactCode = <<<'REACT'
    <InvoiceTotals rows={ROWS} total="NT$146,900" totalLabel="Still owed" tone="overdue" />

    const TONES = { quiet: 'text-cream', due: 'text-jade-300', overdue: 'text-red-400' };
    REACT;

    $agingCode = <<<'BLADE'
    <x-templates.invoice.aging
        label="Over 60 days"
        :count="5"
        amount="NT$386,700"
        :value="386700"
        :max="1943600"
        tone="bad"
        note="A fifth of the money, and the accounts are on shipping hold."
        :active="true" />
    BLADE;

    $agingVueCode = <<<'VUE'
    <InvoiceAging v-for="entry in buckets" :key="entry.key" v-bind="entry" :max="1943600" :active="bucket === entry.key" />

    const shown = computed(() => rows.filter((row) => bucket.value === 'all' || row.bucket === bucket.value));
    VUE;

    $agingReactCode = <<<'REACT'
    {BUCKETS.map((entry) => <InvoiceAging key={entry.key} {...entry} max={1943600} active={bucket === entry.key} />)}

    const shown = ROWS.filter((row) => bucket === 'all' || row.bucket === bucket);
    REACT;
@endphp

<x-layout title="Invoice template — BLADE-COMPONENTS">
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
                    Four screens for the least glamorous thing a business does. One invoice printed properly, the desk where
                    it gets written, the 42 that have not come back yet, and the seven-year customer who is 74 days late and
                    still answering the phone.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">A document that survives being printed, a composer where the tax treatment follows from who you picked, a receivables list sorted by lateness, and the letters behind one overdue account.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Seven parts. An invoice is mostly a table and an argument about dates, so the pieces are small: a sheet, two addresses, a row, a sum, a stamp, and a bar that says how old the money is.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="The sheet, and the stamp that goes on it" padding="p-8"
                    description="Seller block on the left, document identity on the right, and a jade hairline across the top so the thing reads as paper rather than as a panel. The stamp is deliberately crooked and dashed — it is the one element on an invoice that people look for before they read anything."
                    :code="$paperCode" :vue-code="$paperVueCode" :react-code="$paperReactCode">
                    <div class="w-full max-w-3xl">
                        <x-templates.invoice.paper
                            number="INV-2026-0207"
                            issued="12 August 2026"
                            due="11 September 2026"
                            terms="Net 30"
                            reference="PO-4471">
                            <div class="flex flex-wrap items-center gap-4 p-6">
                                <x-templates.invoice.stamp label="Issued" tone="issued" note="due in 30 days" />
                                <x-templates.invoice.stamp label="Paid" tone="paid" note="8 Aug, in full" tilt="right" />
                                <x-templates.invoice.stamp label="Overdue" tone="overdue" note="74 days" />
                                <x-templates.invoice.stamp label="Draft" tone="draft" tilt="none" />
                                <x-templates.invoice.stamp label="Void" tone="void" note="reissued as 0209" tilt="right" />
                            </div>
                        </x-templates.invoice.paper>
                    </div>
                </x-demo>

                <x-demo title="Who it is for, and where the pallet actually goes" padding="p-8"
                    description="Two of these side by side answer the question that causes the most reprints — the invoice address and the delivery address are rarely the same building, and only one of them has a forklift. The tax number sits in jade because it is the field that cannot be corrected after issue."
                    :code="$partyCode" :vue-code="$partyVueCode" :react-code="$partyReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-8 rounded-2xl border border-white/8 bg-ink-950 p-6 sm:grid-cols-2">
                        <x-templates.invoice.party
                            role="to"
                            name="Formosa Coffee Works Ltd"
                            tax-id="24681357"
                            :lines="['3F, No. 88, Zhongshan 2nd Rd', 'Xinxing District, Kaohsiung 800']"
                            contact="accounts@formosacoffee.tw · Ms Hsu" />

                        <x-templates.invoice.party
                            role="ship"
                            name="Formosa Coffee Works — warehouse"
                            :lines="['No. 5, Ln. 210, Fuxing 3rd Rd', 'Qianzhen District, Kaohsiung 806']"
                            contact="deliveries taken 09:00–16:00, weekdays"
                            note="Two pallets. The dock has no forklift, so the driver brings a tail lift." />
                    </div>
                </x-demo>

                <x-demo title="A line that carries its own explanation" padding="p-8"
                    description="Code, description, and a sentence of context under it — what the batch was, why the part exists, whether the freight is at cost. Accountants only need four columns; the people who ring up about an invoice are always asking about the fifth thing, which is why it is written on the row."
                    :code="$lineCode" :vue-code="$lineVueCode" :react-code="$lineReactCode">
                    <div class="w-full max-w-3xl overflow-x-auto rounded-2xl border border-white/8 bg-ink-950">
                        <table class="w-full min-w-2xl border-collapse text-left">
                            <thead>
                                <tr>
                                    <th class="py-2.5 pr-3 pl-6 font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">what it is</th>
                                    <th class="px-3 py-2.5 text-right font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">qty</th>
                                    <th class="px-3 py-2.5 text-right font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">unit</th>
                                    <th class="px-3 py-2.5 text-right font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">tax</th>
                                    <th class="py-2.5 pr-6 pl-3 text-right font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <x-templates.invoice.line
                                    code="MK3-GR"
                                    description="Mk3 hand grinder, graphite"
                                    note="Batch 40. Alignment sheet in each box, signed."
                                    qty="40" unit="ea" price="2,940" amount="117,600" :show-tax="true" />

                                <x-templates.invoice.line
                                    code="COL-02"
                                    description="Collar, with the 2 mm key"
                                    note="The part that works loose on one machine in nine."
                                    qty="100" unit="ea" price="45" amount="4,500" :show-tax="true" />

                                <x-templates.invoice.line
                                    code="FRT-OS"
                                    description="Freight, Taipei to Osaka"
                                    note="Zero-rated on export, which only holds with the bill of lading filed."
                                    qty="1" unit="job" price="14,200" amount="14,200" tax="0%" :show-tax="true" />
                            </tbody>
                        </table>
                    </div>
                </x-demo>

                <x-demo title="The sum, and what it is called when it is late" padding="p-8"
                    description="Rows in, one emphasised total out, and three tones: plain for a quote, jade for money that is coming, red for money that should already be here. The amount in words underneath is not decoration — it is what stops a transposed digit becoming a fortnight of emails."
                    :code="$totalsCode" :vue-code="$totalsVueCode" :react-code="$totalsReactCode">
                    <div class="grid w-full max-w-3xl grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                            <x-templates.invoice.totals
                                :rows="[
                                    ['label' => 'Subtotal', 'value' => 'NT$241,580', 'strong' => true],
                                    ['label' => 'Trade discount', 'note' => '3%, over 50 machines', 'value' => '−NT$7,247'],
                                    ['label' => 'Taxable amount', 'value' => 'NT$234,333'],
                                    ['label' => 'Business tax', 'note' => '5%, rounded to the dollar', 'value' => 'NT$11,717'],
                                ]"
                                total="NT$246,050"
                                total-label="Total due"
                                tone="due"
                                words="Two hundred and forty-six thousand and fifty New Taiwan dollars." />
                        </div>

                        <div class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                            <x-templates.invoice.totals
                                :rows="[
                                    ['label' => 'Invoiced 7 May', 'value' => 'NT$186,900', 'strong' => true],
                                    ['label' => 'Part payment', 'note' => '30 Jul, no reference', 'value' => '−NT$40,000'],
                                    ['label' => 'Interest charged', 'note' => 'we could, we have not', 'value' => 'NT$0'],
                                ]"
                                total="NT$146,900"
                                total-label="Still owed"
                                tone="overdue"
                                note="the 22nd is when the account stops shipping" />
                        </div>
                    </div>
                </x-demo>

                <x-demo title="How old the money is" padding="p-8"
                    description="One card per ageing bucket, each with the count, the amount, a bar against the whole book, and a line saying what that bucket means in practice rather than what it means in accounting. Clicking one filters the ledger behind it, which is the only interaction anybody performs on this screen."
                    :code="$agingCode" :vue-code="$agingVueCode" :react-code="$agingReactCode">
                    <div class="grid w-full max-w-4xl grid-cols-1 gap-2.5 sm:grid-cols-2 lg:grid-cols-4">
                        <x-templates.invoice.aging label="Not due yet" :count="18" amount="NT$742,300" :value="742300" :max="1943600" tone="ok" note="Nothing to do. Two of these were paid before the invoice arrived." />
                        <x-templates.invoice.aging label="1 – 30 days late" :count="12" amount="NT$486,200" :value="486200" :max="1943600" tone="warn" note="Mostly people who pay on the second run of the month." />
                        <x-templates.invoice.aging label="31 – 60 days" :count="7" amount="NT$328,400" :value="328400" :max="1943600" tone="warn" note="Where a polite email stops working and somebody has to ring." />
                        <x-templates.invoice.aging label="Over 60 days" :count="5" amount="NT$386,700" :value="386700" :max="1943600" tone="bad" note="A fifth of the money, and the accounts are on shipping hold." :active="true" />
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
                ['slug' => 'shell', 'name' => 'Billing shell'],
                ['slug' => 'paper', 'name' => 'The sheet'],
                ['slug' => 'party', 'name' => 'Address block'],
                ['slug' => 'line', 'name' => 'Line item'],
                ['slug' => 'totals', 'name' => 'Totals'],
                ['slug' => 'stamp', 'name' => 'Status stamp'],
                ['slug' => 'aging', 'name' => 'Ageing card'],
                ['slug' => 'document', 'name' => 'The invoice'],
                ['slug' => 'compose', 'name' => 'Writing one'],
                ['slug' => 'ledger', 'name' => 'What is owed'],
                ['slug' => 'chase', 'name' => 'Getting paid'],
            ]"
            description="The sheet and the line are the two worth taking first: between them they are the invoice, and both are plain tables that print without a fight. The shell carries the outstanding total in the header, which is the number the person writing invoices actually wants on screen all day."
            :components="['badge', 'button', 'chip', 'input', 'table', 'timeline', 'scroll-top']" />
    </div>
</x-layout>
