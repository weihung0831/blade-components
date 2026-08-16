<x-layout title="Table — BLADE-COMPONENTS">
    <div class="mx-auto max-w-4xl px-6 py-16 pb-28">

        <a href="{{ route('components') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Components
        </a>

        <div class="rise mt-5 flex items-end justify-between" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">{{ $category }}</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $item['name'] }}</h1>
                <p class="mt-2 max-w-lg text-sm/6 text-zinc-500">
                    Two arrays in, a styled table out. Every header sorts ascending and descending, columns can right-align, cells can carry a status dot, and rows take striped or hover treatments.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.table
                :columns="[
                    ['key' => 'service', 'label' => 'Service'],
                    ['key' => 'region', 'label' => 'Region'],
                    ['key' => 'status', 'label' => 'Status'],
                ]"
                :rows="[
                    ['service' => 'api', 'region' => 'us-east-1', 'status' => ['text' => 'Live', 'dot' => 'jade']],
                    ['service' => 'queue', 'region' => 'us-east-1', 'status' => ['text' => 'Live', 'dot' => 'jade']],
                    ['service' => 'cron', 'region' => 'eu-west-2', 'status' => ['text' => 'Paused', 'dot' => 'zinc']],
                ]"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            const columns = [
                { key: 'service', label: 'Service' },
                { key: 'region', label: 'Region' },
                { key: 'status', label: 'Status' },
            ];

            const services = [
                { service: 'api', region: 'us-east-1', status: { text: 'Live', dot: 'jade' } },
                { service: 'queue', region: 'us-east-1', status: { text: 'Live', dot: 'jade' } },
                { service: 'cron', region: 'eu-west-2', status: { text: 'Paused', dot: 'zinc' } },
            ];

            <UiTable :columns="columns" :rows="services" />
            VUE;

            $basicReactCode = <<<'REACT'
            const columns = [
                { key: 'service', label: 'Service' },
                { key: 'region', label: 'Region' },
                { key: 'status', label: 'Status' },
            ];

            const services = [
                { service: 'api', region: 'us-east-1', status: { text: 'Live', dot: 'jade' } },
                { service: 'queue', region: 'us-east-1', status: { text: 'Live', dot: 'jade' } },
                { service: 'cron', region: 'eu-west-2', status: { text: 'Paused', dot: 'zinc' } },
            ];

            <UiTable columns={columns} rows={services} />
            REACT;

            $stripedCode = <<<'BLADE'
            <x-ui.table
                striped
                hover
                :columns="[
                    ['key' => 'invoice', 'label' => 'Invoice'],
                    ['key' => 'customer', 'label' => 'Customer'],
                    ['key' => 'amount', 'label' => 'Amount', 'align' => 'right'],
                ]"
                :rows="[
                    ['invoice' => 'INV-0142', 'customer' => 'Northwind', 'amount' => '$249.00'],
                    ['invoice' => 'INV-0141', 'customer' => 'Acme Cloud', 'amount' => '$99.00'],
                    ['invoice' => 'INV-0140', 'customer' => 'Globex', 'amount' => '$549.00'],
                    ['invoice' => 'INV-0139', 'customer' => 'Initech', 'amount' => '$99.00'],
                ]"
            />
            BLADE;

            $stripedVueCode = <<<'VUE'
            const columns = [
                { key: 'invoice', label: 'Invoice' },
                { key: 'customer', label: 'Customer' },
                { key: 'amount', label: 'Amount', align: 'right' },
            ];

            const invoices = [
                { invoice: 'INV-0142', customer: 'Northwind', amount: '$249.00' },
                { invoice: 'INV-0141', customer: 'Acme Cloud', amount: '$99.00' },
                { invoice: 'INV-0140', customer: 'Globex', amount: '$549.00' },
                { invoice: 'INV-0139', customer: 'Initech', amount: '$99.00' },
            ];

            <UiTable striped hover :columns="columns" :rows="invoices" />
            VUE;

            $stripedReactCode = <<<'REACT'
            const columns = [
                { key: 'invoice', label: 'Invoice' },
                { key: 'customer', label: 'Customer' },
                { key: 'amount', label: 'Amount', align: 'right' },
            ];

            const invoices = [
                { invoice: 'INV-0142', customer: 'Northwind', amount: '$249.00' },
                { invoice: 'INV-0141', customer: 'Acme Cloud', amount: '$99.00' },
                { invoice: 'INV-0140', customer: 'Globex', amount: '$549.00' },
                { invoice: 'INV-0139', customer: 'Initech', amount: '$99.00' },
            ];

            <UiTable striped hover columns={columns} rows={invoices} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Columns take a key and a label. Click a header to sort ascending, click again for descending; set sortable to false on a column to keep it fixed. A cell that is an array renders as a status dot with tinted text."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="w-full max-w-md">
                    <x-ui.table
                        :columns="[
                            ['key' => 'service', 'label' => 'Service'],
                            ['key' => 'region', 'label' => 'Region'],
                            ['key' => 'status', 'label' => 'Status'],
                        ]"
                        :rows="[
                            ['service' => 'api', 'region' => 'us-east-1', 'status' => ['text' => 'Live', 'dot' => 'jade']],
                            ['service' => 'queue', 'region' => 'us-east-1', 'status' => ['text' => 'Live', 'dot' => 'jade']],
                            ['service' => 'cron', 'region' => 'eu-west-2', 'status' => ['text' => 'Paused', 'dot' => 'zinc']],
                        ]"
                    />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Striped and hover"
                description="Add striped for alternating row tint and hover for a row highlight. Columns with align: right switch to mono digits, and amounts sort numerically rather than as text."
                :code="$stripedCode" :vue-code="$stripedVueCode" :react-code="$stripedReactCode">
                <div class="w-full max-w-md">
                    <x-ui.table
                        striped
                        hover
                        :columns="[
                            ['key' => 'invoice', 'label' => 'Invoice'],
                            ['key' => 'customer', 'label' => 'Customer'],
                            ['key' => 'amount', 'label' => 'Amount', 'align' => 'right'],
                        ]"
                        :rows="[
                            ['invoice' => 'INV-0142', 'customer' => 'Northwind', 'amount' => '$249.00'],
                            ['invoice' => 'INV-0141', 'customer' => 'Acme Cloud', 'amount' => '$99.00'],
                            ['invoice' => 'INV-0140', 'customer' => 'Globex', 'amount' => '$549.00'],
                            ['invoice' => 'INV-0139', 'customer' => 'Initech', 'amount' => '$99.00'],
                        ]"
                    />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="table" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
