<script setup>
defineProps({
    code: { type: String, default: null },
    description: { type: String, required: true },
    note: { type: String, default: null },
    qty: { type: [String, Number], default: 1 },
    unit: { type: String, default: null },
    price: { type: String, required: true },
    amount: { type: String, required: true },
    tax: { type: String, default: null },
    showTax: { type: Boolean, default: false },
});
</script>

<template>
    <tr class="border-t border-white/5 align-top">
        <td class="py-3 pr-3 pl-6 sm:pl-8">
            <span class="block text-[13px]/5 text-cream">{{ description }}</span>
            <span v-if="note" class="mt-1 block max-w-md text-[11px]/5 text-zinc-600">{{ note }}</span>
            <span v-if="code" class="mt-1 block font-mono text-[10px] text-zinc-700">{{ code }}</span>
        </td>

        <td class="px-3 py-3 text-right font-mono text-[12px] tabular-nums text-zinc-400 whitespace-nowrap">
            {{ qty }}<span v-if="unit" class="text-zinc-700"> {{ unit }}</span>
        </td>

        <td class="px-3 py-3 text-right font-mono text-[12px] tabular-nums text-zinc-400 whitespace-nowrap">{{ price }}</td>

        <td v-if="showTax" class="px-3 py-3 text-right font-mono text-[11px] whitespace-nowrap" :class="tax === '0%' ? 'text-amber-300' : 'text-zinc-600'">{{ tax ?? '5%' }}</td>

        <td class="py-3 pr-6 pl-3 text-right font-mono text-[12px] tabular-nums text-cream whitespace-nowrap sm:pr-8">{{ amount }}</td>
    </tr>
</template>
