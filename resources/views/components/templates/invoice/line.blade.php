@props([
    'code' => null,
    'description',
    'note' => null,
    'qty' => 1,
    'unit' => null,
    'price',
    'amount',
    'tax' => null,
    'showTax' => false,
])

<tr {{ $attributes->class('border-t border-white/5 align-top') }}>
    <td class="py-3 pr-3 pl-6 sm:pl-8">
        <span class="block text-[13px]/5 text-cream">{{ $description }}</span>

        @if ($note)
            <span class="mt-1 block max-w-md text-[11px]/5 text-zinc-600">{{ $note }}</span>
        @endif

        @if ($code)
            <span class="mt-1 block font-mono text-[10px] text-zinc-700">{{ $code }}</span>
        @endif
    </td>

    <td class="px-3 py-3 text-right font-mono text-[12px] tabular-nums text-zinc-400 whitespace-nowrap">
        {{ $qty }}@if ($unit)<span class="text-zinc-700"> {{ $unit }}</span>@endif
    </td>

    <td class="px-3 py-3 text-right font-mono text-[12px] tabular-nums text-zinc-400 whitespace-nowrap">{{ $price }}</td>

    @if ($showTax)
        <td data-tax-col class="px-3 py-3 text-right font-mono text-[11px] whitespace-nowrap {{ $tax === '0%' ? 'text-amber-300' : 'text-zinc-600' }}">{{ $tax ?? '5%' }}</td>
    @endif

    <td class="py-3 pr-6 pl-3 text-right font-mono text-[12px] tabular-nums text-cream whitespace-nowrap sm:pr-8">{{ $amount }}</td>
</tr>
