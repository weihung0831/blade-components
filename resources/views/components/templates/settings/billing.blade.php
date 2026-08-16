@php
    $quotas = [
        ['label' => 'API calls', 'used' => 8.4, 'limit' => 12, 'unit' => 'M', 'rate' => '$0.40 per extra 10k'],
        ['label' => 'Asset storage', 'used' => 612, 'limit' => 1024, 'unit' => 'GB', 'rate' => '$0.09 per extra GB'],
        ['label' => 'Bandwidth', 'used' => 3.1, 'limit' => 5, 'unit' => 'TB', 'rate' => '$0.05 per extra GB'],
        ['label' => 'Webhook events', 'used' => 940, 'limit' => 1000, 'unit' => 'k', 'rate' => '$2 per extra 100k'],
    ];

    $lines = [
        ['label' => 'Scale platform fee', 'detail' => 'Monthly, 1 Aug – 31 Aug', 'amount' => '$1,240.00'],
        ['label' => '312 seats', 'detail' => '$12 each, 18 added mid-cycle', 'amount' => '$3,744.00'],
        ['label' => 'Metered overage', 'detail' => 'Nothing over the limit yet', 'amount' => '$0.00'],
    ];

    $invoices = [
        ['invoice' => 'INV-2026-0801', 'date' => '1 Aug 2026', 'amount' => '$4,908.00', 'status' => ['text' => 'Paid', 'dot' => 'jade']],
        ['invoice' => 'INV-2026-0701', 'date' => '1 Jul 2026', 'amount' => '$4,692.00', 'status' => ['text' => 'Paid', 'dot' => 'jade']],
        ['invoice' => 'INV-2026-0601', 'date' => '1 Jun 2026', 'amount' => '$4,464.00', 'status' => ['text' => 'Paid', 'dot' => 'jade']],
        ['invoice' => 'INV-2026-0501', 'date' => '1 May 2026', 'amount' => '$4,464.00', 'status' => ['text' => 'Refunded', 'dot' => 'zinc']],
    ];

    $included = ['3 data regions', 'SAML SSO', '99.95% SLA', 'Audit log retention 1y', 'Priority support'];
@endphp

<x-templates.settings.shell active="Billing" title="Billing"
    description="Plan, metered usage, and every invoice this workspace has ever raised.">
    <x-slot:actions>
        <x-ui.button variant="secondary" size="sm">Billing portal</x-ui.button>
    </x-slot>

    <x-templates.settings.section flush heading="Plan" description="Renews 1 Sep 2026. Cancel any time and it runs to the end of the cycle.">
        <x-slot:actions>
            <x-ui.badge color="jade">Scale</x-ui.badge>
        </x-slot>

        <div class="px-5 py-4">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Projected total</p>
                    <p class="mt-1.5 text-2xl font-semibold tracking-tight text-cream">
                        $4,984.00 <span class="text-sm font-normal text-zinc-600">/ month</span>
                    </p>
                    <p class="mt-1 text-[11px] text-zinc-600">Charged to Visa •••• 4242 on 1 Sep</p>
                </div>

                <div class="flex items-center gap-2">
                    <x-ui.toggle-button type="radio" name="cycle" size="sm" checked>Monthly</x-ui.toggle-button>
                    <x-ui.toggle-button type="radio" name="cycle" size="sm">Annual · save 16%</x-ui.toggle-button>
                </div>
            </div>

            <x-ui.separator class="my-4" />

            <ul class="flex flex-col gap-2.5">
                @foreach ($lines as $line)
                    <li class="flex items-baseline gap-4">
                        <span class="text-[13px] text-zinc-300">{{ $line['label'] }}</span>
                        <span class="hidden truncate text-[11px] text-zinc-600 sm:block">{{ $line['detail'] }}</span>
                        <span class="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">{{ $line['amount'] }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4 flex flex-wrap gap-1.5">
                @foreach ($included as $feature)
                    <span class="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{{ $feature }}</span>
                @endforeach
            </div>
        </div>

        <x-slot:footer>
            <x-ui.button variant="secondary" size="sm">Change plan</x-ui.button>
            <button type="button" class="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Cancel subscription</button>
        </x-slot>
    </x-templates.settings.section>

    <x-templates.settings.section flush heading="Usage this cycle" description="Metered on top of the plan. Nothing is billed until a limit is crossed.">
        <x-slot:actions>
            <span class="font-mono text-[11px] text-zinc-600">resets 1 Sep</span>
        </x-slot>

        <div class="flex flex-col gap-4 px-5 py-4">
            @foreach ($quotas as $quota)
                <div>
                    <x-ui.progress :value="$quota['used']" :max="$quota['limit']" animate :delay="$loop->index * 110"
                        :label="$quota['label'].' · '.$quota['used'].'/'.$quota['limit'].' '.$quota['unit']" />
                    <p class="mt-1.5 font-mono text-[10px] text-zinc-600">{{ $quota['rate'] }}</p>
                </div>
            @endforeach
        </div>

        <x-slot:footer>
            <span class="text-[11px]/5 text-zinc-600">Webhook events are at 94% — the next 60k trigger overage.</span>
            <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Set a usage alert</a>
        </x-slot>
    </x-templates.settings.section>

    <x-templates.settings.section heading="Payment and tax" description="What the receipt says, and where it lands.">
        <x-templates.settings.row label="Payment method" description="Retried twice before the account is suspended" align="center">
            <div class="flex items-center gap-3">
                <span class="grid h-7 w-11 shrink-0 place-items-center rounded-md border border-white/10 bg-ink-950 font-mono text-[10px] text-zinc-400">VISA</span>
                <div class="min-w-0">
                    <p class="truncate font-mono text-[13px] text-zinc-300">•••• •••• •••• 4242</p>
                    <p class="mt-0.5 font-mono text-[11px] text-zinc-600">expires 09 / 2028</p>
                </div>
                <x-ui.button variant="secondary" size="sm" class="ml-auto">Update</x-ui.button>
            </div>
        </x-templates.settings.row>

        <x-templates.settings.row label="Billing email" description="Separate from the account email">
            <x-ui.input size="sm" type="email" name="billing-email" value="ap@northbeam.com" class="max-w-xs" />
        </x-templates.settings.row>

        <x-templates.settings.row label="Tax ID" description="Printed on every invoice">
            <x-ui.input size="sm" name="vat" value="TW 24681357" class="max-w-xs" />
        </x-templates.settings.row>

        <x-templates.settings.row label="Billing address">
            <x-ui.textarea name="address" rows="3" class="max-w-sm">7F, No. 88 Zhongxiao E. Rd. Sec. 4
Da'an District, Taipei 106
Taiwan</x-ui.textarea>
        </x-templates.settings.row>

        <x-templates.settings.row label="PO number" description="Shown above the line items" align="center">
            <div class="flex items-center gap-3">
                <span class="text-[13px] text-zinc-500">Required by your finance team</span>
                <x-ui.switch class="ml-auto" name="po" />
            </div>
        </x-templates.settings.row>
    </x-templates.settings.section>

    <x-templates.settings.section flush heading="Invoices" description="Seven years of history, downloadable as PDF or CSV.">
        <x-slot:actions>
            <x-ui.button variant="secondary" size="sm">Export CSV</x-ui.button>
        </x-slot>

        <x-ui.table hover class="rounded-none! border-0! bg-transparent!" :rows="$invoices" :columns="[
            ['key' => 'invoice', 'label' => 'Invoice'],
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'status', 'label' => 'Status', 'sortable' => false],
            ['key' => 'amount', 'label' => 'Amount', 'align' => 'right'],
        ]" />

        <x-slot:footer>
            <span class="font-mono text-[11px] text-zinc-600">4 of 26 invoices</span>
            <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">View all</a>
        </x-slot>
    </x-templates.settings.section>
</x-templates.settings.shell>
