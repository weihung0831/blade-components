<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    placeholder: { type: String, default: 'Pick a date' },
    min: { type: String, default: null },
    max: { type: String, default: null },
});

const model = defineModel({ default: null });

const open = ref(false);

const iso = (date) => `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;

const base = model.value ? new Date(`${model.value}T00:00:00`) : new Date();
const year = ref(base.getFullYear());
const month = ref(base.getMonth());

const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const weekdays = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];

const today = iso(new Date());

const days = computed(() => {
    const first = new Date(year.value, month.value, 1);

    return Array.from({ length: 42 }, (_, i) => {
        const date = new Date(year.value, month.value, 1 - first.getDay() + i);
        const value = iso(date);

        return {
            value,
            label: date.getDate(),
            inMonth: date.getMonth() === month.value,
            outOfBounds: (props.min && value < props.min) || (props.max && value > props.max),
        };
    });
});

const shiftMonth = (delta) => {
    const next = new Date(year.value, month.value + delta, 1);

    year.value = next.getFullYear();
    month.value = next.getMonth();
};

const select = (value) => {
    model.value = value;

    if (value) {
        const date = new Date(`${value}T00:00:00`);

        year.value = date.getFullYear();
        month.value = date.getMonth();
        open.value = false;
    }
};

const dayClasses = (day) => {
    if (day.value === model.value) {
        return 'bg-jade-500 text-ink-950';
    }

    const tone = day.outOfBounds ? 'text-zinc-700' : day.inMonth ? 'text-zinc-300 hover:bg-white/5 hover:text-cream' : 'text-zinc-600 hover:bg-white/5 hover:text-cream';
    const ring = day.value === today ? ' border border-jade-500/40' : '';

    return tone + ring;
};
</script>

<template>
    <div class="w-56">
        <label v-if="label" class="mb-1.5 block text-xs text-zinc-500">{{ label }}</label>
        <div class="relative block">
            <button
                type="button"
                @click="open = !open"
                class="flex h-10 w-full cursor-pointer items-center justify-between gap-3 rounded-lg border bg-ink-950 px-3 font-mono text-xs transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                :class="open ? 'border-jade-500' : 'border-white/10 hover:border-white/25'"
            >
                <span :class="model !== null ? 'text-zinc-300' : 'text-zinc-600'">{{ model ?? placeholder }}</span>
                <svg class="size-3.5 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><rect x="2.5" y="3.5" width="11" height="10" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M2.5 6.5h11M5.5 2v2.5M10.5 2v2.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
            </button>
            <template v-if="open">
                <div class="fixed inset-0 z-10" @click="open = false"></div>
                <div class="absolute top-full left-0 z-20 mt-2 w-max rounded-lg border border-white/10 bg-ink-900 p-3 shadow-lg shadow-black/40">
                    <div class="flex items-center justify-between">
                        <button type="button" aria-label="Previous month" @click="shiftMonth(-1)" class="grid size-7 cursor-pointer place-items-center rounded-md text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                        <span class="font-mono text-xs text-zinc-300">{{ months[month] }} {{ year }}</span>
                        <button type="button" aria-label="Next month" @click="shiftMonth(1)" class="grid size-7 cursor-pointer place-items-center rounded-md text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                    </div>
                    <div class="mt-2 grid grid-cols-7">
                        <span v-for="weekday in weekdays" :key="weekday" class="grid size-8 place-items-center font-mono text-[10px] text-zinc-600">{{ weekday }}</span>
                    </div>
                    <div class="grid grid-cols-7 gap-y-0.5">
                        <button
                            v-for="day in days"
                            :key="day.value"
                            type="button"
                            :disabled="day.outOfBounds"
                            @click="select(day.value)"
                            class="grid size-8 cursor-pointer place-items-center rounded-md font-mono text-xs transition-colors duration-150 disabled:pointer-events-none"
                            :class="dayClasses(day)"
                        >
                            {{ day.label }}
                        </button>
                    </div>
                    <div class="mt-2 flex items-center justify-between border-t border-white/5 pt-2">
                        <button type="button" @click="select(null)" class="cursor-pointer rounded px-1.5 py-0.5 text-xs text-zinc-500 transition-colors duration-150 hover:text-cream">Clear</button>
                        <button type="button" @click="select(today)" class="cursor-pointer rounded px-1.5 py-0.5 text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">Today</button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
