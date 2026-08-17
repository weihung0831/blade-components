<script setup>
import { computed } from 'vue';
import UiButton from '../../components/ui/actions/Button.vue';
import CheckoutLineItem from './LineItem.vue';

const props = defineProps({
    title: { type: String, default: 'Order summary' },
    items: { type: Array, default: () => [] },
    ship: { type: String, default: 'standard' },
    discount: { type: Number, default: 0 },
    discountLabel: { type: String, default: null },
    cta: { type: String, default: null },
    href: { type: String, default: null },
    note: { type: String, default: null },
    list: { type: Boolean, default: true },
    locked: { type: Boolean, default: false },
});

const SHIPPING = {
    standard: { cost: 0, label: 'free', eta: 'arrives Thu 20 – Mon 24 Aug' },
    express: { cost: 18, label: '$18', eta: 'arrives tomorrow, Tue 18 Aug' },
    pickup: { cost: 0, label: 'free', eta: 'ready today from 17:00, Taichung' },
    intl: { cost: 68, label: '$68', eta: 'DHL · 7–12 business days, duties on arrival' },
};

const money = (value) => '$' + value.toLocaleString('en-US');

const shipping = computed(() => SHIPPING[props.ship] ?? SHIPPING.standard);
const live = computed(() => props.items.filter((item) => item.qty > 0));
const units = computed(() => live.value.reduce((sum, item) => sum + item.qty, 0));
const subtotal = computed(() => live.value.reduce((sum, item) => sum + item.price * item.qty, 0));
const total = computed(() => subtotal.value - props.discount + shipping.value.cost);
</script>

<template>
    <aside class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
        <div class="flex items-baseline justify-between gap-4 border-b border-white/5 px-5 py-4">
            <h2 class="text-base font-medium text-cream">{{ title }}</h2>
            <span class="font-mono text-[10px] text-zinc-600">{{ units }} {{ units === 1 ? 'item' : 'items' }}</span>
        </div>

        <div v-if="list" class="flex flex-col divide-y divide-white/5 px-5">
            <CheckoutLineItem v-for="item in live" :key="item.sku" :item="item" />
        </div>

        <dl class="flex flex-col gap-2.5 border-t border-white/5 px-5 py-4">
            <div class="flex items-baseline justify-between gap-4">
                <dt class="text-[13px] text-zinc-500">Subtotal</dt>
                <dd class="font-mono text-[13px] text-zinc-300">{{ money(subtotal) }}</dd>
            </div>

            <div v-if="discount > 0" class="flex items-baseline justify-between gap-4">
                <dt class="text-[13px] text-zinc-500">
                    Discount
                    <span v-if="discountLabel" class="ml-1 font-mono text-[10px] text-jade-400">{{ discountLabel }}</span>
                </dt>
                <dd class="font-mono text-[13px] text-jade-400">−{{ money(discount) }}</dd>
            </div>

            <div class="flex items-baseline justify-between gap-4">
                <dt class="text-[13px] text-zinc-500">Shipping</dt>
                <dd class="font-mono text-[13px]" :class="shipping.cost === 0 ? 'text-jade-400' : 'text-zinc-300'">{{ shipping.label }}</dd>
            </div>

            <p class="font-mono text-[10px] text-zinc-600">{{ shipping.eta }}</p>
        </dl>

        <div class="border-t border-white/8 bg-ink-950 px-5 py-4">
            <div class="flex items-baseline justify-between gap-4">
                <span class="text-[13px] text-cream">{{ locked ? 'Paid' : 'Total' }}</span>
                <span class="font-mono text-2xl text-cream">{{ money(total) }}</span>
            </div>
            <p class="mt-1 text-right font-mono text-[10px] text-zinc-600">
                includes {{ money(Math.round(total / 21)) }} VAT · TWD charged at 31.4
            </p>

            <UiButton v-if="cta" class="mt-4 w-full" :href="href" target="_top">{{ cta }}</UiButton>

            <p v-if="note" class="mt-3 text-center font-mono text-[10px]/4 text-zinc-600">{{ note }}</p>
        </div>
    </aside>
</template>
